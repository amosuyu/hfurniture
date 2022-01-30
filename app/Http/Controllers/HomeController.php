<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->idgroup != 1) {
            session()->put('status', 'Bạn không có quyền admin!');
            return view('admin.home');
        }else return redirect('quan-tri');
   
    }
}
