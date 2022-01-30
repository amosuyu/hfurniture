<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidateSpaces;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Spaces;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class SpacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.spaces.index',['spaces'=>Spaces::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spaces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateSpaces $request)
    {
        $data = $request->all();
        $data['slug'] = is_null($data['slug']) ? str_slug($request->name_vi) : str_slug($request->slug);
        Spaces::create($data);
        return redirect('quan-tri/khong-gian')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Spaces::find($id);
        if($row == null){
            return redirect('khong-gian')->with('success','Loại blog này không tồn tại!');
        }else{
            return view('admin.spaces.view',compact('row'));
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
        $row = Spaces::find($id);
        if($row == null){
            return redirect('khong-gian')->with('success','Không gian này không tồn tại!');
        }else{
            return view('admin.spaces.edit',compact('row'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateSpaces $request, $id)
    {
        $result = Spaces::find($id);
        if ($result) {
            $data = $request->all();
            $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name_vi']);
            $result->update($data);
            return redirect('quan-tri/khong-gian')->with('succes', 'Cập nhật không gian thành công!');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Spaces::find($id);
        $checkAllow = Categories::where('space_id', $id)->first();
        if ($row == null) {
            return redirect('quan-tri/khong-gian')->with('errors', 'Không gian này không tồn tại!');
        } else if ($checkAllow != null) {
            return redirect('quan-tri/khong-gian')->with('errors', 'Không gian này đang liên kết với loại sản phẩm, không thể xóa!');
        } else {
            $row->delete();
            return redirect('quan-tri/khong-gian')->with('success','Xóa không gian thành công!');
        }
       
    }

}
