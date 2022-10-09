<?php

namespace App\Http\Controllers;

// use App\Models\Bill;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //
    function index()
    {
        $today = Order::where('userid', auth()->user()->connectid)->whereDate('created_at', Carbon::today())->sum('amount');
        $yesterday = Order::where('userid', auth()->user()->connectid)->whereDate('created_at', Carbon::yesterday())->sum('amount');
        $sevendays  = Order::where('userid', auth()->user()->connectid)->where('created_at', '>', Carbon::now()->subDays(7))->sum('amount');
        $all = Order::where('userid', auth()->user()->connectid)->sum('amount');

        return view('home',compact('today','yesterday','sevendays','all'));
    }
}
