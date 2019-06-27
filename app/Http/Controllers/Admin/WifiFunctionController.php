<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response,DB;
use Datatables;
use App\WifiUser;
use App\WifiGroup;
use auth;

class WifiFunctionController extends Controller
{
    public function index()
{
    return view('adminmenu.wifi-function');
}

public function userCreate(Request $request)
{
     //$validatedData = 
     $request->validate([
        'FunctionName'=>'required',
        'username'=> 'required|unique:wifiuser',
        'Password' => 'required',
        'expirydate' => 'required',
        'GroupName' => 'required'
      ]);      

    $wifiuser = new WifiUser();
    $wifiuser -> functionname = $request->FunctionName;
    $wifiuser -> username = trim($request->username);
    $wifiuser -> password = trim($request->Password);
    $wifiuser -> GroupName = $request->GroupName;
    $wifiuser -> qty = $request->qty;
    $wifiuser -> sale = $request->sales;
    $wifiuser -> comment = $request->comment;
    $wifiuser -> functiondate = $request->expirydate;
    $wifiuser -> functionend = $request->expirydate;
    $wifiuser -> createby = Auth::user()->name; //Auth::id();
    $wifiuser -> save();

    DB::connection('mysql4')->table('radcheck')->insert(['username' => trim($request->username) , 'attribute' => 'Cleartext-Password','op' => ':=','value' => trim($request->Password)]);
    DB::connection('mysql4')->table('radcheck')->insert(['username' => trim($request->username) , 'attribute' => 'Expiration','op' => ':=','value' => $request->expirydate]);
    DB::connection('mysql4')->table('radreply')->insert(['username' => trim($request->username) , 'attribute' => 'Port-Limit','op' => ':=','value' => $request->qty]);
    DB::connection('mysql4')->table('radusergroup')->insert(['username' => trim($request->username) , 'groupname' => $request->GroupName,'priority' => '1']);

    return view('adminmenu.close-fancybox');
}

public function getEdit($id)
{
    $wifiuser = WifiUser::find($id);
    $Group = WifiGroup::whereRaw('Status=\'A\' and Type= \'I\'')->get();
    return view('adminmenu.edit-wifi-function',compact('wifiuser'),compact('Group'));
}

public function userEdit(Request $request, $id)
{
    $request->validate([
        'FunctionName'=>'required',
        'Password' => 'required',
        'expirydate' => 'required',
        'GroupName' => 'required'
      ]);   

    DB::connection('mysql4')->table('radreply')->where('username', trim($request->uid))->where('attribute', 'Port-Limit')->update(['value' => trim($request->qty)]);
    DB::connection('mysql4')->table('radusergroup')->where('username', trim($request->uid))->update(['groupname' => trim($request->GroupName)]);
    DB::connection('mysql4')->update("update radcheck set value = '".$request->Password."' where username ='".$request->uid."' and attribute = 'Cleartext-Password'");
    DB::connection('mysql4')->update("update radcheck set value = '".$request->expirydate."' where username ='".$request->uid."' and attribute = 'Expiration'");

    $wifiuser = WifiUser::find($id);
    $wifiuser -> functionname = $request->FunctionName;
    $wifiuser -> password = $request->Password;
    $wifiuser -> GroupName = $request->GroupName;
    $wifiuser -> qty = $request->qty;
    $wifiuser -> sale = $request->sales;
    $wifiuser -> comment = $request->comment;
    $wifiuser -> functionend = $request->expirydate;
    $wifiuser -> updated_by = Auth::user()->name; //Auth::id();
    $wifiuser -> save();

    return view('adminmenu.close-fancybox');
}

public function data()
{
    $wifiuser = DB::table('wifiuser')
    ->join('WifiGroup', 'wifiuser.GroupName', '=', 'WifiGroup.GroupName')
    ->select('wifiuser.id','wifiuser.functionname', 'wifiuser.username', 'wifiuser.password', 'wifiuser.GroupName','WifiGroup.Description','wifiuser.qty','wifiuser.sale')
    ->orderby('wifiuser.updated_at', 'DESC');

    return Datatables()->of($wifiuser)
        ->addColumn('actions','
            <a role="button" class="btn btn-sm btn-primary fancybox" data-fancybox data-type="iframe" data-src="{{{ URL::to(\'admin/wifi-function/\' . $id . \'/edit\' ) }}}" href="javascript:;"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</a>
            <a role="button" id="btnDelete" href="{{{ URL::to(\'admin/wifi-function/\' . $username . \'/delete\' ) }}}" class="btn btn-sm btnDelete btn-danger"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</a>
            ')
        ->rawColumns(['actions'])
        ->make();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$wifiuser = WifiUser::find($id);
        //$wifiuser = WifiUser::where('username', $id)->first();
        //$wifiuser->delete();
        DB::connection('mysql')->table('wifiuser')->where('username', trim($id))->delete();
        DB::connection('mysql4')->table('radreply')->where('username', trim($id))->delete();
        DB::connection('mysql4')->table('radusergroup')->where('username', trim($id))->delete();
        DB::connection('mysql4')->table('radcheck')->where('username', trim($id))->delete();
      
        return redirect('/admin/wifi-function');
    }


public function getCreate()
{
    // Show the page
    $Group = WifiGroup::whereraw('Status=\'A\' and Type= \'I\'')->get();
    
    return view('adminmenu.edit-wifi-function',compact('Group'));    
}

public function getReorder(Request $request) {
//    $list = $request->list;
//    $items = explode(",", $list);
//    $order = 1;
//    foreach ($items as $value) {
//        if ($value != '') {
//            WifiUser::where('id', '=', $value) -> update(array('position' => $order));
//            $order++;
//        }
//    }
//    return $list;
$model = WifiUser::query();

    return Datatables::eloquent($model)
                ->orderColumn('name', '-name $1')
                ->toJson();
}

}