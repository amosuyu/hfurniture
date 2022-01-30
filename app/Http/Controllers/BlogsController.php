<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateBlogs;
use App\Models\Blogs;
use App\Models\BlogTypes;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Repositories\BlogsRepository;
Paginator::useBootstrap();

class BlogsController extends Controller
{
    private $blogsRepository;

    public function __construct(BlogsRepository $blogsRepository)
    {
        $this->blogsRepository = $blogsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if (!isset($params['filterQuantity'])) {
            $params['filterQuantity'] = 10;
        }
        $blogTypes = BlogTypes::all();
        $Blogs = $this->blogsRepository->getAll($params)->paginate($params['filterQuantity']);
        return view('admin.blogs.index', compact('Blogs', 'blogTypes', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create', ['Blogtypes' => BlogTypes::GetAll()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateBlogs $request)
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
        $row = new Blogs([
            'title' => $request->title,
            'image' => $urlHinh,
            'description' => $request->description,
            'content' => $request->content,
            'display' => $request->display,
            'hot' => $request->hot,
            'slug' => $request->slug ? str_slug($request->slug) : str_slug($request->title),
            'blog_type_id' => $request->blog_type_id,
        ]);
        $row->save();
        return redirect('quan-tri/blog')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Blogs::find($id);
        if ($row == null) {
            return redirect('blog')->with('success', 'Loại blog này không tồn tại!');
        } else {
            return view('admin.blogs.view', compact('row'));
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
        $row = Blogs::find($id);
        $blogTypes = BlogTypes::GetAll();
        if ($row == null) {
            return redirect('blog')->with('success', 'Loại blog này không tồn tại!');
        } else {
            return view('admin.blogs.edit', compact('row', 'blogTypes'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateBlogs $request, $id)
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
        $row = Blogs::find($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->display = $request->display;
        $row->image = $urlHinh;
        $row->slug = $request->slug ? str_slug($request->slug) : str_slug($request->title);
        $row->save();
        return redirect('quan-tri/blog')->with('succes', 'Cập nhật loại blog thành công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Blogs::find($id);
        $row->delete();
        return redirect('quan-tri/blog')->with('success', 'Xóa blog thành công!');
    }

}
