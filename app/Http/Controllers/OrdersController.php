<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateProducts;
use App\Models\Payments;
use App\Models\Orders;
use App\Models\Products;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class OrdersController extends Controller
{
    private $ordersRepository;

    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
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
        $orders = $this->ordersRepository->getAll($params)->paginate($params['filterQuantity']);
        return view('admin.orders.index', compact('orders', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateProducts $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Orders::with('orderDetails.productDetails.colors', 'orderDetails.productDetails.products')->find($id);
        $status = [
            0 => 'Chờ xác nhận',
            1 => 'Đang chuẩn bị đơn hàng',
            2 => 'Đang giao',
            3 => 'Đã giao',
            4 => 'Đã hủy',
        ];
        $colors = [
            0 => 'text-warning',
            1 => 'text-primary',
            2 => 'text-info',
            3 => 'text-success',
            4 => 'text-danger',
        ];
        if ($order == null) {
            return redirect('quan-tri/don-hang')->with('success', 'Đơn hàng này không tồn tại!');
        } else {
            return view('admin.orders.view', compact('order', 'status', 'colors'));
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
        // $collections = Collections::all();
        // $categories = Categories::all();
        // $colors = Colors::all();
        // $product = $this->ordersRepository->getById($id);
        // if ($product == null) {
        //     return redirect('quan-tri/san-pham')->with('errors', 'đơn hàng này không tồn tại');
        // } else {
        //     return view('admin.products.edit', compact('product', 'collections', 'categories', 'colors'));
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);
        $result = $order->update($request->all());
        if ($result) {
            return redirect()->back()->with('success', 'Lưu thay đổi thành công!');
        } else {
            return redirect('quan-tri/don-hang')->with('errors', 'Lưu thay thất bại, hãy thử lại!');
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
        return redirect('quan-tri/san-pham')->with('success', 'Xóa đơn hàng thành công!');
    }

}
