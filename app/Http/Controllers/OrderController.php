<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    function index()
    {
        $tables = Table::with('order')->where(['userid' => auth()->user()->connectid, 'status' => 'Enable'])->get();
        $categorys  = Category::select('name')->where(['userid'=> auth()->user()->connectid,'status' => 'Enable'])->get();

        return view('order', compact('tables', 'categorys'));
    }
    function product(Request $request)
    {

        $X =  Product::select('*')->where(['userid' => auth()->user()->connectid, 'category' => $request->val])->get();
        return response()->json(['status' => $X]);
    }
    function tablesubmit(Request $request)
    {
        $productid = $request->productid;
        $product = Product::find($productid);
        $productname = $product->name;
        $quantity = $request->quantity;
        $tableid = $request->tableid;
        $amount = $product->price * $quantity;

        

        $order = new Order();
        $order->userid = auth()->user()->connectid;
        $order->tableid = $tableid;
        $order->itemname = $productname;
        $order->quantity = $quantity;
        $order->rate = $product->price;
        $order->amount = $amount;
        $order->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    function ordercall(Request $request)
    {
        $id = $request->id;
        $selectorder = Order::select('*')->where(['userid' => auth()->user()->connectid, 'tableid' => $id,'paystatus'=>'notpay'])->get();
        return response()->json([
            'data' => $selectorder
        ]);
    }

    function callTable()
    {
        $data =  Table::with('order')->where(['userid' => auth()->user()->connectid, 'status' => 'Enable'])->get();
        return response()->json(['data' => $data]);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        $name = Order::find($id);
        $name->delete();
        return response()->json([
            'status' => 'Delete success'
        ]);
    }
}
