<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateBlogtypes;

use App\Models\Blogs;

use App\Models\BlogTypes;use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class BlogtypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogtypes.index', ['Blogtypes' => BlogTypes::GetAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateBlogtypes $request)
    {
        $row = new Blogtypes([
            'title' => $request->title,
            'description' => $request->description,
            'display' => $request->display,
            'slug' => $request->slug ? str_slug($request->slug) : str_slug($request->title),
        ]);
        $row->save();
        return redirect('quan-tri/loai-blog')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Blogtypes::find($id);
        if ($row == null) {
            return redirect('loai-blog')->with('success', 'Loại blog này không tồn tại!');
        } else {
            return view('admin.blogtypes.view', compact('row'));
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
        $row = Blogtypes::find($id);
        if ($row == null) {
            return redirect('loai-blog')->with('success', 'Loại blog này không tồn tại!');
        } else {
            return view('admin.blogtypes.edit', compact('row'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateBlogtypes $request, $id)
    {
        $row = Blogtypes::find($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->display = $request->display;
        $row->slug = $request->slug ? str_slug($request->slug) : str_slug($request->title);
        $row->save();
        // return redirect()->route('loai-blog.index')->with('succes', 'Cập nhật màu sắc thành công!');
        return redirect('quan-tri/loai-blog')->with('succes', 'Cập nhật loại blog thành công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogType = Blogtypes::find($id);
        $blog = Blogs::where('blog_type_id', $id)->first();
        if ($blogType == null) {
            return redirect('quan-tri/loai-blog')->with('errors', 'Loại tin này không tồn tại!');
        } else if ($blog != null) {
            return redirect('quan-tri/loai-blog')->with('errors', 'Loại tin này đang liên kết với tin tức, Không thể xóa!');
        } else {
            $blogType->delete();
        }
        return redirect('quan-tri/loai-blog')->with('success', 'Đã xóa thành công');
    }

}
