<?php
namespace App\Repositories;

use App\Models\OrderDetails;
use App\Models\Orders;
use Exception;
use Illuminate\Support\Facades\DB;

class OrdersRepository
{
    public function getAll($params)
    {
        $query = Orders::with('orderDetails.productDetails.colors', 'orderDetails.productDetails.products', 'payments');
        if (isset($params['filterMethod']) && $params['filterMethod'] == 1) {
            $query->where('method', $params['filterMethod']);
        }else if(isset($params['filterMethod']) && $params['filterMethod'] == 2){
            $query->where('method', $params['filterMethod'])->whereHas('payments');
        }else{
            $query->where(function ($q) {
                $q->where('method', 1)->orWhere(function ($q) {
                    $q->where('method', 2)->whereHas('payments');
                });
            });
        }
        if (isset($params['filterStatus'])) {
            $query->where('status', $params['filterStatus']);
        }
        $query->orderBy('created_at', 'DESC');
        return $query;
    }

    public function createOrder($params)
    {
        $params['user_id'] = Auth()->user()->id;
        $ship = $params['city'] != 79 ? 100000 : 0;
        if (Session('Voucher')) {
            $params['voucher_id'] = Session('Voucher')->id;
            if (Session('Voucher')->amount > 0) {
                $params['price'] = $ship + Session('Cart')->totalPrice - Session('Voucher')->amount;
            } else {
                $params['price'] = $ship + Session('Cart')->totalPrice - ((Session('Cart')->totalPrice * Session('Voucher')->percent) / 100);
            }
        } else {
            $params['price'] = Session('Cart')->totalPrice + $ship;
        }
        $jsonCity = json_decode(file_get_contents(resource_path() . "/location/city.json"), true);
        $jsonDistrict = json_decode(file_get_contents(resource_path() . "/location/district/${params['city']}.json"), true);
        $jsonWard = json_decode(file_get_contents(resource_path() . "/location/ward/${params['district']}.json"), true);
        $params['city'] = $jsonCity[$params['city']]['name'];
        $params['district'] = $jsonDistrict[$params['district']]['name'];
        $params['ward'] = $jsonWard[$params['ward']]['name'];
        DB::beginTransaction();
        try {
            $resultOrders = Orders::create($params);
            foreach (Session('Cart')->products as $item) {
                $params = [
                    'order_id' => $resultOrders->id,
                    'product_detail_id' => $item['productInfo']['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
                $resultOrderDetails = OrderDetails::create($params);
            }

            DB::commit();
            return $resultOrders->id;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getRevenue($year)
    {
        $query = Orders::select(DB::raw('SUM(price) as `revenue`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->where('status', 3)
            ->inYear($year)
            ->groupBy('year', 'month')->orderBy('month', 'asc')
            ->get();
        return $query;
    }

    public function ordersPending()
    {
        return Orders::where('status', 0)->count();
    }
}
