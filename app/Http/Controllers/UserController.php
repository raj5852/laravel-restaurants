<?php

namespace App\Http\Controllers;

use App\Models\Subuser;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function index()
    {
        return view('user');
    }
    function create(Request $request)
    {
        if ($request->file('file')) {
            $image = $request->file('file');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $subuser = new Subuser();
            $subuser->userid = auth()->user()->connectid;
            $subuser->img = $new_name;
            $subuser->name = $request->name;
            $subuser->contract = $request->contract;
            $subuser->email = $request->email;
            $subuser->password = $request->password;
            $subuser->type = $request->user_type;
            $subuser->createdon = date("Y/m/d");
            $subuser->save();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->user_type;
            $user->connectid = auth()->user()->connectid;
            $user->save();

            return response()->json(['data' => 'success']);
        } else {
            $subuser = new Subuser();
            $subuser->userid = auth()->user()->connectid;
            // $subuser->img = $new_name;
            $subuser->name = $request->name;
            $subuser->contract = $request->contract;
            $subuser->email = $request->email;
            $subuser->password = $request->password;
            $subuser->type = $request->user_type;
            $subuser->createdon = date("Y/m/d");
            $subuser->save();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->user_type;
            $user->connectid = auth()->user()->connectid;
            $user->save();

            $subuser->subuserid = $user->id;
            $subuser->save();


            return response()->json(['data' => 'success']);
        }
    }
    function getuser(Request $request)
    {
        $userid = auth()->user()->connectid;
        if ($request->ajax()) {
            $data = Subuser::where('userid', $userid)->orderBy('id', 'desc')->get();
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
                ->addColumn('image', function ($row) {
                    if ($row->img) {
                        return '<img src="images/' . $row->img . '" style="width:40px" />';
                    } else {
                        return '';
                    }
                })

                ->rawColumns(['action', 'statusAction', 'image'])
                ->make(true);
        }
    }
    function  status(Request $request)
    {
        $id = $request->id;
        $subuser = Subuser::find($id);
        if ($subuser->status == "Enable") {
            $subuser->status = "Disabled";
            $subuser->save();
            return response()->json([
                'message' => 'true'
            ]);
        } else {
            $subuser->status = "Enable";
            $subuser->save();
            return response()->json([
                'message' => 'true'
            ]);
        }
    }
    function useredit(Request $request)
    {
        $id = $request->id;
        $tax = Subuser::find($id);
        return response()->json([
            'data' => $tax
        ]);
    }

    function update(Request $request)
    {

        $subuser = Subuser::find($request->UPhiddenId);
        if ($request->UPfile) {
            $image = $request->file('UPfile');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $subuser->img = $new_name;
            $subuser->name = $request->UPname;
            $subuser->contract = $request->UPcontract;
            $subuser->email = $request->UPemail;
            $subuser->password = $request->UPpassword;
            $subuser->type = $request->UPuser_type;
            $subuser->save();

            $user = User::find($subuser->subuserid);
            $user->name = $request->UPname;
            $user->email = $request->UPemail;
            $user->password = $request->UPpassword;
            $user->type = $request->UPuser_type;
            $user->save();


            return response()->json(['data' => 'success']);
        } else {
            $subuser->name = $request->UPname;
            $subuser->contract = $request->UPcontract;
            $subuser->email = $request->UPemail;
            $subuser->password = $request->UPpassword;
            $subuser->type = $request->UPuser_type;
            $subuser->save();

            $user = User::find($subuser->subuserid);
            $user->name = $request->UPname;
            $user->email = $request->UPemail;
            $user->password = $request->UPpassword;
            $user->type = $request->UPuser_type;
            $user->save();
            

            return response()->json(['data' => 'success']);
        }
    }
    function delete(Request  $request)
    {
        $id = $request->id;
        $subuser = Subuser::find($id);
        $subuser->delete();
        return response()->json([
            'data' => 'Data deleted Successfully!'
        ]);
    }
}
