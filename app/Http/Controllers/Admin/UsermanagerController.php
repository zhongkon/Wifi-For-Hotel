<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Datatables;

class UsermanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('adminmenu.user');
    }


    public function Data()
    {
        $users = User::select(['id','name','email','type','created_at','updated_at']);

        return Datatables()->of($users)
        ->addColumn('actions','
        <a role="button" class="btn btn-sm btn-primary" data-fancybox data-type="iframe" data-src="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" href="javascript:;"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</a>
        <a role="button" id="btnDelete" href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btnDelete btn-danger"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</a>
        ')
        ->editColumn('type', function($data) {
            return ($data->type == 1) ? "Sys Admin": "Front Office";
          })
        ->rawColumns(['actions'])
        ->make();
    }

    public function getCreate()
{
    // Show the page
    //$Group = WifiGroup::whereraw('Status=\'A\' and Type= \'I\'')->get();
    
    return view('adminmenu.edit-user');    
}

public function userCreate(Request $request)
{
     //$validatedData = 
     $request->validate([
        'MacAddress'=>'required|unique:MacAuth|regex:/^([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})$/',
        'Holder'=> 'required',
        'expirydate' => 'required',
        'GroupName' => 'required'
      ]);      

      $macA = new MacAuth();
      $macA -> MacAddress = $request->MacAddress;
      $macA -> Holder = $request->Holder;
      $macA -> model = $request->Device;
      $macA -> GroupName = $request->GroupName;
      $macA -> Expire = $request->expirydate;
      $macA -> Create_by = Auth::user()->name; 

//    $wifiuser = new WifiUser([
//        'functionname' => $request->FunctionName,
//        'username' => $request->username,
//        'password' => $request->Password,
//        'GroupName' => $request->GroupName,
//        'qty' => $request->qty,
//        'sale' => $request->sales,
//        'comment' => $request->comment,
        //'functiondate' => $request->functiondate;
//        'functionend' => $request->expirydate,
//        'createby' => Auth::id()
//        ]);
    $macA -> save();

    //DBL::table('radcheck')->insert(['username' => $request->usernameinput , 'attribute' => 'User-Password','op' => '==','value' => $request->passwordinput]);
    //DBL::table('radcheck')->insert(['username' => $request->usernameinput , 'attribute' => 'Simultaneous-Use','op' => ':=','value' => $request->qty]);
    //DBL::table('radcheck')->insert(['username' => $request->usernameinput , 'attribute' => 'Expiration','op' => ':=','value' => $request->functionend]);
    //DBL::table('radusergroup')->insert(['username' => $request->usernameinput , 'groupname' => $request->wifigroup]);
    return view('adminmenu.close-fancybox');
}

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('adminmenu.edit-user',compact('user'));
    }

    public function saveEdit(Request $request, $id)
    {
        $macA = MacAuth::find($id);
        //$macA -> MacAddress = $request->MacAddress;
        $macA -> Holder = $request->Holder;
        $macA -> model = $request->Device;
        $macA -> GroupName = $request->GroupName;
        $macA -> Expire = $request->expirydate;
        $macA -> Create_by = Auth::user()->name; 
        $macA -> save();

        //DBL::table('radcheck')
        //    ->where('username', trim($request->usernameinput))
        //    ->where('attribute', 'User-Password')
        //    ->update(['value' => trim($request->passwordinput)]);

        //DBL::table('radcheck')
        //    ->where('username', trim($request->usernameinput))
        //    ->where('attribute', 'Expiration')
        //    ->update(['value' => trim($request->functionend)]);

        //DBL::table('radusergroup')
        //    ->where('username', trim($request->usernameinput))
        //    ->update(['groupname' => trim($request->wifigroup)]);

        return view('adminmenu.close-fancybox');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
