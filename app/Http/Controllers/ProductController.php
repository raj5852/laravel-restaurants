<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

class ProductController extends Controller
{
    //
    function index()
    {
        $id = auth()->user()->connectid;
        $categorys =  Category::select('name')->where(['userid'=>$id,'status'=>'Enable'])->orderBy('id', 'desc')->get();

        return view('product.index', compact('categorys'));
    }
    function getproduct(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {
            $data = Product::where('userid', $userid)->orderBy('id', 'desc')->get();
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
    function create(Request  $request)
    {
        $category = $request->category;
        $name = $request->name;
        $price = $request->price;

        $product = new Product();
        $product->userid = auth()->user()->connectid;
        $product->category = $category;
        $product->name = $name;
        $product->price = $price;
        $product->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Product Created Successfully!'
        ]);
    }
    function status(Request $request){
        $id = $request->id;
        $category = Product::find($id);
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
    function edit(Request $request){
        $id = $request->id;
        $table = Product::find($id);
        return response()->json([
            'data' => $table
        ]);
    }
    function update(Request $request){
        $id = $request->id;
        $category = $request->category;
        $name = $request->name;
        $price = $request->price;
        $product = Product::find($id);
        $product->category = $category;
        $product->name = $name;
        $product->price = $price;
        $product->save();
        return response()->json([
            'status'=>'true'
        ]);

    }
    function delete(Request $request){
        $id = $request->id;
        $delete = Product::find($id);
        $delete->delete();
        return response()->json([
            'data' => 'Data deleted Successfully!'
        ]);
    }
    
}
