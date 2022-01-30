<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCollections;

use App\Models\Collections;

use App\Models\Products;use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.collections.index', ['collections' => Collections::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCollections $request)
    {
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $img->move('upload/images', $img->getClientOriginalName());
        }
        if ($request->hasFile('image')) {
            $urlHinh = 'upload/images/' . $request->file('image')->getClientOriginalName();
        } else {
            $urlHinh = null;
        }
        $row = new Collections([
            'name_vi' => $request->name_vi,
            'description_vi' => $request->description_vi,
            'name_en' => $request->name_en,
            'description_en' => $request->description_en,
            'image' => $urlHinh,
            'display' => $request->display,
            'slug' => $request->slug ? str_slug($request->slug, "-") : str_slug($request->name_vi, "-"),
        ]);
        $row->save();
        return redirect('quan-tri/bo-suu-tap')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Collections::find($id);
        if ($row == null) {
            return redirect('bo-suu-tap')->with('success', 'Loại sưu tập này không tồn tại!');
        } else {
            return view('admin.collections.view', compact('row'));
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
        $row = Collections::find($id);
        if ($row == null) {
            return redirect('bo-suu-tap')->with('success', 'Bộ sưu tập này không tồn tại!');
        } else {
            return view('admin.collections.edit', compact('row'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCollections $request, $id)
    {
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $img->move('upload/images', $img->getClientOriginalName());
        }
        if ($request->hasFile('image')) {
            $urlHinh = 'upload/images/' . $request->file('image')->getClientOriginalName();
        } else {
            $urlHinh = null;
        }
        $row = Collections::find($id);
        $row->name_vi = $request->name_vi;
        $row->description_vi = $request->description_vi;
        $row->name_en = $request->name_en;
        $row->description_en = $request->description_en;
        $row->image = $urlHinh;
        $row->display = $request->display;
        $row->slug = $request->slug ? str_slug($request->slug, "-") : str_slug($request->name_vi, "-");
        $row->save();
        return redirect('quan-tri/bo-suu-tap')->with('succes', 'Cập nhật bộ sưu tập thành công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Collections::find($id);
        $checkAllow = Products::where('collection_id', $id)->first();
        if ($row == null) {
            return redirect('quan-tri/bo-suu-tap')->with('errors', 'Bộ sưu tập này không tồn tại!');
        } else if ($checkAllow != null) {
            return redirect('quan-tri/bo-suu-tap')->with('errors', 'Bộ sưu tập này đang liên kết với sản phẩm, không thể xóa!');
        } else {
            $row->delete();
            return redirect('quan-tri/bo-suu-tap')->with('success', 'Xóa bộ sưu tập thành thành công!');
        }

    }

}
