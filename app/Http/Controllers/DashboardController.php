<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Products, Orders, User
};
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;
class DashboardController extends Controller
{

        private $productsRepository;
        private $ordersRepository;
        public function __construct(ProductsRepository $productsRepository, OrdersRepository $ordersRepository)
        {
            $this->productsRepository = $productsRepository;
            $this->ordersRepository = $ordersRepository;
        }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $year = $request->query('datepicker');
        $productQty = Products::statistical();
        $totalRevenue = Orders::statistical();
        $users = User::statistical();
        $top5 = $this->productsRepository->getTop5();
        $ordersPending = $this->ordersRepository->ordersPending();
        $revenue = $this->ordersRepository->getRevenue($year);
        return view('admin.dashboard', compact('productQty', 'totalRevenue', 'ordersPending', 'users', 'top5','revenue','year'));
    }

    public function changeYearOfRevenue($year)
    {
        $revenue = $this->ordersRepository->getRevenue($year);
        return response()->json($revenue);
    }
}
