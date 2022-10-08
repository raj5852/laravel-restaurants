<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    function index()
    {
        return view('category');
    }
    public function getCategory(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {

            $data = Category::where('userid', $userid)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#updateModal" onclick="edit(' . $row->id . ')" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm">Delete</a>';
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
    function delete(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Data deleted Successfully!']);
    }
    function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'false',
                'data' => $validator->errors()
            ]);
        }

        $category = new Category();
        $category->userid = auth()->user()->connectid;
        // $category->name = auth()->user()->id;
        $category->name = $request->category;
        $category->save();
        return response()->json([
            'message' => 'true',
            'data' => 'Category created successfully!'
        ]);
    }
    function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'false',
                'data' => $validator->errors()
            ]);
        }
        $category = Category::find($id);
        $category->name = $request->category;
        $category->save();

        return response()->json([
            'message' => 'true',
            'data' => 'Category Updated successfully!'
        ]);
    }
    function editrequest(Request  $request)
    {
        $id = $request->id;
        $category = Category::find($id)->name;
        return response()->json([
            'data' => $category
        ]);
    }
    function status(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
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
