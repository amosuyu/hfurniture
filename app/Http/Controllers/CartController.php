<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Products;
use App\Models\Vouchers;
use App\Repositories\OrdersRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\ProductsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

Paginator::useBootstrap();

class CartController extends Controller
{
    private $productsRepository;
    private $ordersRepository;
    private $paymentsRepository;

    public function __construct(ProductsRepository $productsRepository, OrdersRepository $ordersRepository, PaymentsRepository $paymentsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->ordersRepository = $ordersRepository;
        $this->paymentsRepository = $paymentsRepository;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $id, $quantity)
    {
        $product = $this->productsRepository->getByIdDetail($id);
        if ($product != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addToCart($product, $id, $quantity);
            $request->Session()->put('Cart', $newCart);
        }
        return view('client.cart');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteItemCart(Request $request, $id)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);

        if (Count($newCart->products) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
            $request->Session()->forget('Voucher');
        }
        return view('client.cart');
    }

    // return trang giỏ hàng
    public function listCart()
    {
        return view('client.list_cart');
    }

    // xóa sản phẩm khỏi giỏ hàng
    public function deleteItemListCart(Request $request, $id)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);

        if (Count($newCart->products) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
            $request->Session()->forget('Voucher');
        }
        return view('client.list_cart_ajax');
    }

    // Lưu thông tin sản phẩm trong giỏ hàng
    public function saveItemListCart(Request $request, $id, $quantity)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        if ($quantity > 0) {
            $newCart->updateItemCart($id, $quantity);
        } else {
            $newCart->deleteItemCart($id);
        }
        $request->Session()->put('Cart', $newCart);
        return view('client.list_cart_ajax');
    }

    public function cart()
    {
        return view('client.cart');
    }

    // return trang giỏ hàng với Ajax
    public function listCartAjax()
    {
        return view('client.list_cart_ajax');
    }

    // Áp dụng voucher cho giỏ hàng
    public function useVoucher(Request $request, $code)
    {
        $voucher = Vouchers::where('code', $code)->where('end_date', '>=', Carbon::now())->first();
        if ($voucher != null) {
            $request->Session()->put('Voucher', $voucher);
            return 'Sử dụng mã giảm giá ' . $voucher->code . ' thành công';
        } else {
            return 'Voucher không đúng hoặc hết hạn sử dụng!';
        }
    }

    // Lưu tất cả thông tin sản phẩm trong giỏ hàng
    public function saveAllListCart(Request $request)
    {
        foreach ($request->data as $item) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            if ($item['value'] > 0) {
                $newCart->updateItemCart($item['key'], $item['value']);
            } else {
                $newCart->deleteItemCart($item['key']);
            }
            $request->Session()->put('Cart', $newCart);
        }
        return view('client.list_cart_ajax');
    }

    // Xóa tất cả sản phẩm trong giỏ hàng
    public function deleteAllListCart(Request $request)
    {

        foreach ($request->data as $item) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->deleteItemCart($item['key']);
            $request->Session()->put('Cart', $newCart);
        }
        if (Count($newCart->products) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
            $request->Session()->forget('Voucher');
        }
        return view('client.list_cart_ajax');
    }

    // Return trang thanh toán
    public function payment(Request $request)
    {
        if (Auth()->user()) {
            if (Session('Cart')) {
                $jsonCity = file_get_contents(base_path('resources/location/city.json'));
                $cities = json_decode($jsonCity, true);
                return view('client.payment', compact('cities'));
            } else {
                return redirect('/')->with('alert', trans('message.no_products_to_pay'));
            }
        } else {
            return redirect('dang-nhap')->with('alert', trans('message.login_to_pay'));
        }

    }

    // return quận theo thành phố
    public function getDistrict($code)
    {
        $jsonDistrict = file_get_contents(base_path('resources/location/district/' . $code . '.json'));
        $districts = json_decode($jsonDistrict, true);
        return view('client.district', compact('districts'));
    }

    // return phường theo quận
    public function getWard($code)
    {
        $jsonWard = file_get_contents(base_path('resources/location/ward/' . $code . '.json'));
        $wards = json_decode($jsonWard, true);
        return view('client.ward', compact('wards'));
    }

    // return phí ship nếu không phải HCM
    public function getShipFee($code)
    {
        if ($code != 79) {
            $ship = 100000;
        } else {
            $ship = 0;
        }

        return view('client.payment_ajax', compact('ship'));
    }

    // xử lý thanh toán
    public function handlePayment(Request $request)
    {
        $data = $request->data;
        $result = $this->ordersRepository->createOrder($data);
        if ($result) {
            $request->Session()->forget('Cart');
            $request->Session()->forget('Voucher');
            return $result;
        } else {
            return false;
        }
    }

    // return trang hoàn thành mua hàng
    public function completeOrder(Request $request, $id)
    {
        if (Auth()->user()) {
            $order = Orders::with('orderDetails', 'orderDetails.productDetails', 'vouchers')->where('user_id', Auth()->user()->id)->where('id', $id)->get()->toArray();
            foreach ($order as $key => $o) {
                foreach ($o['order_details'] as $key2 => $item) {
                    $arr = $this->productsRepository->getProductForCompleteOrder($item['product_details']['product_id'], $item['product_details']['color_id']);
                    $order[$key]['order_details'][$key2]['info'] = $arr;
                }
            }

            if ($order != null) {
                $order = $order[0];
                foreach ($order['order_details'] as $ord) {
                    $product = Products::find($ord['product_details']['product_id']);
                    $product->sold += $ord['product_details']['quantity'];
                    $product->save();
                }

                $payment = Payments::where('order_id', $id)->first();
                return view('client.completeOrder', compact('order', 'payment'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }

    // return trang thanh toán online
    public function paymentOnline(Request $request)
    {
        $data = $request->query();
        $request->Session()->put('dataOnline', $data);
        $data = ((array) json_decode($data['array']));

        $data['user_id'] = Auth()->user()->id;
        $ship = $data['city'] != 79 ? 100000 : 0;
        if (Session('Voucher')) {
            $data['voucher_id'] = Session('Voucher')->id;
            if (Session('Voucher')->amount > 0) {
                $data['price'] = $ship + Session('Cart')->totalPrice - Session('Voucher')->amount;
            } else {
                $data['price'] = $ship + Session('Cart')->totalPrice - ((Session('Cart')->totalPrice * Session('Voucher')->percent) / 100);
            }
        } else {
            $data['price'] = Session('Cart')->totalPrice + $ship;
        }
        $result = $this->ordersRepository->createOrder($data);
        session(['order_id' => $result]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "UDOPNWS1";
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = $result;
        $vnp_OrderInfo = trans('message.payment_service');
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval($data['price'] * 100);
        $vnp_Locale = Session('website_language') == 'en' ? 'en' : 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    // return trang thông báo thành công or thất bại thanh toán online
    function return (Request $request) {
        if ($request->vnp_ResponseCode == "00") {
            $this->paymentsRepository->createPayment($request->toArray());
            $request->Session()->forget('Cart');
            $request->Session()->forget('Voucher');
            $request->Session()->forget('order_id');
            return redirect()->route('completeOrder', $request->toArray()['vnp_TxnRef'])->with('success', 'Đã thanh toán phí dịch vụ');
        }
        $order = Orders::find(Session('order_id'));
        $order->orderDetails()->delete();
        $order->delete();
        return redirect(Session('url_prev'))->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

}
