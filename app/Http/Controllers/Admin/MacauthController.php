<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response,DB;
use Datatables;
use auth;
use App\MacAuth;
use App\WifiGroup;

class MacauthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminmenu.mac-auth');
    }

    public function data()
{
    $mac = DB::table('MacAuth')
    ->select('MacAuth.id','MacAuth.MacAddress', 'MacAuth.Holder', 'MacAuth.model','WifiGroup.Description', 'MacAuth.Expire','MacAuth.created_at','MacAuth.Create_by')
    ->join('WifiGroup', 'MacAuth.GroupName', '=', 'WifiGroup.GroupName')
    ->orderby('MacAuth.updated_at', 'DESC');
    return Datatables()->of($mac)
        ->addColumn('actions','
            <a role="button" class="btn btn-sm btn-primary fancybox" data-fancybox data-type="iframe" data-src="{{{ URL::to(\'admin/mac-auth/\' . $id . \'/edit\' ) }}}" href="javascript:;"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</a>
            <a role="button" id="btnDelete" href="{{{ URL::to(\'admin/mac-auth/\' . $MacAddress . \'/delete\' ) }}}" class="btn btn-sm btnDelete btn-danger"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</a>
            ')
        ->rawColumns(['actions'])
        ->make();
}

public function getCreate()
{
    // Show the page
    $Group = WifiGroup::whereraw('Status=\'A\' and Type= \'I\'')->get();
    
    return view('adminmenu.edit-mac-auth',compact('Group'));    
}

public function macCreate(Request $request)
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
      $macA -> save();

    DB::connection('mysql4')->table('radcheck')->insert(['username' => $request->MacAddress , 'attribute' => 'Cleartext-Password','op' => '==','value' => $request->MacAddress]);
    DB::connection('mysql4')->table('radcheck')->insert(['username' => $request->MacAddress , 'attribute' => 'Expiration','op' => ':=','value' => $request->expirydate]);
    DB::connection('mysql4')->table('radreply')->insert(['username' => $request->MacAddress , 'attribute' => 'Port-Limit','op' => ':=','value' => '1']);
    DB::connection('mysql4')->table('radusergroup')->insert(['username' => $request->MacAddress , 'groupname' => $request->GroupName]);

    return view('adminmenu.close-fancybox');
}


public function getEdit($id)
{
    $mac = MacAuth::find($id);
    $Group = WifiGroup::whereRaw('Status=\'A\' and Type= \'I\'')->get();
    return view('adminmenu.edit-mac-auth',compact('mac'),compact('Group'));
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

    DB::connection('mysql4')->table('radreply')->where('username', trim($request->uid))->where('attribute', 'Port-Limit')->update(['value' => trim($request->qty)]);
    DB::connection('mysql4')->table('radusergroup')->where('username', trim($request->uid))->update(['groupname' => trim($request->GroupName)]);
    DB::connection('mysql4')->update("update radcheck set value = '".$request->Password."' where username ='".$request->uid."' and attribute = 'Cleartext-Password'");
    DB::connection('mysql4')->update("update radcheck set value = '".$request->expirydate."' where username ='".$request->uid."' and attribute = 'Expiration'");


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
        //$macA = MacAuth::find($id);
        //$macA->delete();
        
        DB::connection('mysql')->table('MacAuth')->where('MacAddress', trim($id))->delete();
        DB::connection('mysql4')->table('radreply')->where('username', trim($id))->delete();
        DB::connection('mysql4')->table('radusergroup')->where('username', trim($id))->delete();
        DB::connection('mysql4')->table('radcheck')->where('username', trim($id))->delete();

        return redirect('/admin/mac-auth');
    }

}
