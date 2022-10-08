<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use DataTables;

class TaxController extends Controller
{
    //
    function index()
    {
        return view('tax');
    }
    function create(Request $request)
    {
        $name = $request->name;
        $percentage = $request->percentage;

        $tax = new Tax();
        $tax->userid = auth()->user()->connectid;
        $tax->name = $name;
        $tax->percentage = $percentage;
        $tax->save();
        return response()->json([
            'status' => 'true',
            'message' => 'Data Created successfully!'
        ]);
    }

    function taxget(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {
            $data = Tax::where('userid', $userid)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"  onclick="edit(' . $row->id . ')" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('statusAction', function ($row) {

                    if ($row->status == 'Enable') {
                        $actionstatus = '<a href="javascript:void(0)" onclick="status(' . $row->id . ')" class="edit btn btn-primary btn-sm">' . $row->status . '</a> ';
                        return $actionstatus;
                    } else {
                        $actionstatus = '<a href="javascript:void(0)" onclick="status(' . $row->id . ')" class="edit btn btn-danger btn-sm">' . $row->status . '</a> ';
                        return $actionstatus;
                    }
                })
                ->rawColumns(['action', 'statusAction'])
                ->make(true);
        }
    }
    function edit(Request $request)
    {
        $id = $request->id;
        $tax = Tax::find($id);
        return response()->json([
            'data' => $tax
        ]);
    }
    function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $percentage = $request->percentage;

        $tax = Tax::find($id);
        $tax->name = $name;
        $tax->percentage = $percentage;
        $tax->save();
        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        $tax = Tax::find($id);
        $tax->delete();
        return response()->json([
            'data' => 'Data deleted Successfully!'
        ]);
    }
    function status(Request $request)
    {
        $id = $request->id;
        $Tax = Tax::find($id);
        if ($Tax->status == "Enable") {
            $Tax->status = "Disabled";
            $Tax->save();
            return response()->json([
                'message' => 'true'
            ]);
        } else {
            $Tax->status = "Enable";
            $Tax->save();
            return response()->json([
                'message' => 'true'
            ]);
        }
    }
}
