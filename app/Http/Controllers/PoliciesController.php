<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePolicies;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.policies.index', ['policies' => Policies::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.policies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePolicies $request)
    {
        $data = $request->all();
        $data['slug'] = is_null($data['slug']) ? str_slug($request->name) : str_slug($request->name);
        $policy = Policies::create($data);
        if ($policy) {
            return redirect('quan-tri/chinh-sach')->with('success', 'Thêm mới thành công!');
        } else {
            return redirect('quan-tri/chinh-sach')->with('errors', 'Thêm mới thất bại!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Policies::find($id);
        if ($row == null) {
            return redirect('chinh-sach')->with('success', 'Loại blog này không tồn tại!');
        } else {
            return view('admin.policies.view', compact('row'));
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
        $row = Policies::find($id);
        if ($row == null) {
            return redirect('chinh-sach')->with('success', 'chính sách này không tồn tại!');
        } else {
            return view('admin.policies.edit', compact('row'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePolicies $request, $id)
    {
        $result = Policies::find($id);
        if ($result) {
            $data = $request->all();
            $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name']);
            $result->update($data);
            return redirect('quan-tri/chinh-sach')->with('succes', 'Cập nhật chính sách thành công!');
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
        $row = Policies::find($id);
        $row->delete();
        return redirect('quan-tri/chinh-sach')->with('success', 'Xóa chính sách thành công!');
    }

}
