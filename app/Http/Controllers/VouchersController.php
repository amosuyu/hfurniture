<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidateVouchers;
use Illuminate\Http\Request;
use App\Models\Vouchers;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.vouchers.index',['Vouchers'=>Vouchers::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateVouchers $request)
    {
        $row = new Vouchers([
            'description' => $request->description,
            'amount' => $request->amount ?? 0,
            'code' => $request->code ?? "",
            'percent' => $request->percent,
            'end_date' => $request->end_date,
        ]);
        $row->save();
        return redirect('quan-tri/giam-gia')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $row = Vouchers::find($id);
        if($row == null){
            return redirect('giam-gia')->with('success','Voucher này không tồn tại!');
        }else{
            return view('admin.vouchers.edit',compact('row'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateVouchers $request, $id)
    {
        $row = Vouchers::find($id);
        $row->description = $request->description;
        $row->code = $request->code;
        $row->amount = $request->amount;
        $row->percent = $request->percent;
        $row->end_date = $request->end_date;
        $row->save();
        // return redirect()->route('mau-sac.index')->with('succes', 'Cập nhật màu sắc thành công!');
        return redirect('quan-tri/giam-gia')->with('succes', 'Cập nhật Voucher thành công!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Vouchers::find($id);
        $row->delete();
        return redirect('quan-tri/giam-gia')->with('success','Xóa Voucher thành công!');
    }

}
