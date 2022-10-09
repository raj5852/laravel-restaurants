<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use PDF;
use DataTables;

class BillController extends Controller
{

    function index()
    {
        return view('bill');
    }
    function order(Request $request)
    {

        $tableid = $request->id;
        $gettable = Table::find($tableid);
        $tablename = $gettable->name;

        $bill = new Bill();
        $bill->tablename = $tablename;
        $bill->userid = auth()->user()->connectid;
        $bill->ordernumber = time();
        $bill->orderdate = date('Y');
        $bill->save();
        $billid = $bill->id;


        $order = Order::where(['tableid' => $tableid, 'paystatus' => 'notpay'])->update(['billid' => $billid, 'paystatus' => 'pay']);


        return response()->json(['status' => $billid]);
    }

    function pdf(Request $request)
    {

        if ($request->id) {

            $bb = Bill::findOrFail($request->id);
            $bills = Order::where('billid', $request->id)->get();
            $moneySum = Order::where('billid', $request->id)->sum('amount');

            $data = json_decode(json_encode($bills), true);
            $bbs = json_decode(json_encode($bb), true);
            view()->share('employee', $data);
            view()->share('bill', $bbs);
            view()->share('sum', $moneySum);

            $pdf = PDF::loadView('invoice', $data);
            return $pdf->stream();
        }
    }

    function billget(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {

            $data = Bill::where('userid', $userid)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="pdf?id=' . $row->id . '"  class="edit btn btn-success btn-sm">Invoice</a> ';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
