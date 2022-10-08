<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use DataTables;

class TableController extends Controller
{
    //
    function index()
    {
        return view('table');
    }
    function tableget(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {
            $data = Table::where('userid', $userid)->orderBy('id', 'desc')->get();
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
    function tablecreate(Request $request)
    {
        $name = $request->name;
        $capacity = $request->capacity;
        $table = new Table();
        $table->userid = auth()->user()->connectid;
        $table->name = $name;
        $table->capacity = $capacity;
        $table->save();
        return response()->json([
            'status' => 'true',
            'data' => 'Table Created Successfully!'
        ]);
    }
    function tablerequest(Request $request)
    {
        $id = $request->id;
        $table = Table::find($id);
        return response()->json([
            'data' => $table
        ]);
    }
    function tableupdate(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $capacity = $request->capacity;

        $table = Table::find($id);
        $table->name = $name;
        $table->capacity = $capacity;
        $table->save();
        return response()->json([
            'data' => 'Data Updated Successfully!'
        ]);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        $delete = Table::find($id);
        $delete->delete();
        return response()->json([
            'data' => 'Data deleted Successfully!'
        ]);
    }
    function status(Request $request){
        $id = $request->id;
        $category = Table::find($id);
        if ($category->status == "Enable") {
            $category->status = "Disabled";
            $category->save();
            return response()->json([
                'message' => 'true'
            ]);
        } else {
            $category->status = "Enable";
            $category->save();
            return response()->json([
                'message' => 'true'
            ]);
        }
    }
}
