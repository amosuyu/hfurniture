<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidateColors;
use Illuminate\Http\Request;
use App\Models\Colors;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.colors.index',['Colors' => Colors::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateColors $request)
    {
        $row = new Colors([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $row->save();
        return redirect('quan-tri/mau-sac')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Colors::find($id);
        if($row == null){
            return redirect('quan-tri/mau-sac')->with('success','Màu sắc này không tồn tại!');
        }else{
            return view('admin.colors.view',compact('row'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $row = Colors::find($id);
        if($row == null){
            return redirect('quan-tri/mau-sac')->with('success','Màu sắc này không tồn tại!');
        }else{
            return view('admin.colors.edit', ['row' => $row]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateColors $request, $id)
    {
        $row = Colors::find($id);
        $row->update($request->all());
        return redirect('quan-tri/mau-sac')->with('succes', 'Cập nhật màu sắc thành công!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Colors::find($id);
        $checkAllow = ProductDetails::where('color_id', $id)->first();
        if ($row == null) {
            return redirect('quan-tri/mau-sac')->with('errors', 'Màu sắc này không tồn tại!');
        } else if ($checkAllow != null) {
            return redirect('quan-tri/mau-sac')->with('errors', 'Màu sắc này đang liên kết với sản phẩm, không thể xóa!');
        } else {
            $row->delete();
            return redirect('quan-tri/mau-sac')->with('success', 'Xóa màu sắc thành thành công!');
        }
    }

}
