<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCategories;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Spaces;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', ['Categories' => Categories::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', ['Spaces' => Spaces::GetAll()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCategories $request)
    {
        $row = new Categories([
            'name_vi' => $request->name_vi,
            'name_en' => $request->name_en,
            'description_vi' => $request->description_vi,
            'description_en' => $request->description_en,
            'slug' => $request->slug ? str_slug($request->slug) : str_slug($request->name_vi),
            'space_id' => $request->space_id,
            'display' => $request->display,
        ]);
        $row->save();
        return redirect('quan-tri/loai-san-pham')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Categories::find($id);
        if ($row == null) {
            return redirect('loai-san-pham')->with('success', 'Loại sản phẩm này không tồn tại!');
        } else {
            return view('admin.categories.view', compact('row'));
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
        $row = Categories::find($id);
        $Spaces = Spaces::GetAll();
        if ($row == null) {
            return redirect('loai-san-pham')->with('success', 'Loại sản phẩm này không tồn tại!');
        } else {
            return view('admin.categories.edit', compact('row', 'Spaces'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCategories $request, $id)
    {
        $row = Categories::find($id);
        $row->name_vi = $request->name_vi;
        $row->name_en = $request->name_en;
        $row->description_vi = $request->description_vi;
        $row->description_en = $request->description_en;
        $row->space_id = $request->space_id;
        $row->display = $request->display;
        $row->slug = $request->slug ? str_slug($request->slug) : str_slug($request->name_vi);
        $row->save();
        return redirect('quan-tri/loai-san-pham')->with('succes', 'Cập nhật loại sản phẩm thành công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Categories::find($id);
        $checkAllow = Products::where('category_id', $id)->first();
        if ($row == null) {
            return redirect('quan-tri/loai-san-pham')->with('errors', 'Loại sản phẩm này không tồn tại!');
        } else if ($checkAllow != null) {
            return redirect('quan-tri/loai-san-pham')->with('errors', 'Loại sản phẩm này đang liên kết với sản phẩm, không thể xóa!');
        } else {
            $row->delete();
            return redirect('quan-tri/loai-san-pham')->with('success', 'Xóa loại sản phẩm thành thành công!');
        }
    }

}
