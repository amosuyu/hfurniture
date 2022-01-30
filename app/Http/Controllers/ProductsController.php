<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateProducts;
use App\Models\Categories;
use App\Models\Collections;
use App\Models\Colors;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class ProductsController extends Controller
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::all();
        $collections = Collections::all();
        $params = $request->all();
        if (!isset($params['filterQuantity'])) {
            $params['filterQuantity'] = 10;
        }
        $products = $this->productsRepository->getAll($params)->paginate($params['filterQuantity']);
        return view('admin.products.index', compact('products', 'categories', 'collections', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collections = Collections::all();
        $categories = Categories::all();
        $colors = Colors::all();
        return view('admin.products.create', compact('collections', 'categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateProducts $request)
    {
        $result = $this->productsRepository->create($request);
        if ($result) {
            return redirect('quan-tri/san-pham')->with('success', 'Thêm mới thành công!');
        } else {
            return redirect('quan-tri/san-pham')->with('errors', 'Thêm mới thất bại, hãy thử lại!');
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
        $row = Products::find($id);
        if ($row == null) {
            return redirect('san-pham')->with('success', 'Sản phẩm này không tồn tại!');
        } else {
            return view('admin.products.view', compact('row'));
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
        $collections = Collections::all();
        $categories = Categories::all();
        $colors = Colors::all();
        $product = $this->productsRepository->getById($id);
        if ($product == null) {
            return redirect('quan-tri/san-pham')->with('errors', 'Sản phẩm này không tồn tại');
        } else {
            return view('admin.products.edit', compact('product', 'collections', 'categories', 'colors'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateProducts $request, $id)
    {
        $result = $this->productsRepository->update($id, $request);
        if ($result) {
            return redirect('quan-tri/san-pham')->with('success', 'Lưu thay đổi thành công!');
        } else {
            return redirect('quan-tri/san-pham')->with('errors', 'Lưu thay thất bại, hãy thử lại!');
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
        $row = Products::find($id);
        $row->delete();
        $row2 = ProductDetails::where('product_id', $id)->get();
        foreach($row2 as $r2){
            $r2->delete();
        }
        return redirect('quan-tri/san-pham')->with('success', 'Xóa sản phẩm thành công!');
    }

}
