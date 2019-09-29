<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response,DB;
use Datatables;
use auth;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;
use App\Ipbinding;

class IpbindingsController extends Controller
{
    public function index()
    {
        if(auth()->user()->isAdmin()) {
            return view('adminmenu.ip-bindings');
        }elseif(auth()->user()->isUser()){
            return redirect('/dashboard');
        } else {
            return redirect('/home');
        }
    }

    public function data()
    {
    $mac = DB::table('Ipbindings')
    ->select('id','MacAddress', 'Holder', 'model','info', 'created_at','Create_by')
    ->orderby('updated_at', 'DESC');
    return Datatables()->of($mac)
        ->addColumn('actions','
            <a role="button" id="btnDelete" href="{{{ URL::to(\'admin/ip-binding/\' . $MacAddress . \'/delete\' ) }}}" class="btn btn-sm btnDelete btn-danger"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</a>
            ')
        ->rawColumns(['actions'])
        ->make();
    }

    public function getCreate()
    {
        return view('adminmenu.edit-ip-binding');    
    }

public function macCreate(Request $request)
{
     //$validatedData = 
     $request->validate([
        'MacAddress'=>'required|unique:Ipbindings,MacAddress|regex:/^([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})$/',
        'Holder'=> 'required',
      ]);      

      $macA = new Ipbinding();
      $macA -> MacAddress = strtoupper($request->MacAddress);
      $macA -> Holder = $request->Holder;
      $macA -> model = $request->Device;
      //$macA -> GroupName = $request->GroupName;
      //$macA -> Expire = $request->expirydate;
      $macA -> Create_by = Auth::user()->name; 
      $macA -> save();

      $config =
      (new Config())
        ->set('host', \Config::get('mt.mt_host'))
        ->set('port', 8728)
        ->set('pass',  \Config::get('mt.mt_pass'))
        ->set('user', \Config::get('mt.mt_user'));
      // Initiate client with config object
      $client = new Client($config);
          // Build query
$query =
(new Query('/ip/hotspot/ip-binding/add'))
    ->equal('mac-address', strtoupper($request->MacAddress))
    ->equal('type', 'bypassed')
    ->equal('comment', $request->Holder);
// Add user
$out = $client->query($query)->read();
print_r($out);

    return view('adminmenu.close-fancybox');
}

public function destroy($id)
{
    //$macA = Ipbinding::find($id);
    //$macA->delete();
    DB::connection('mysql')->table('Ipbindings')->where('MacAddress', trim($id))->delete();

    $config =
    (new Config())
        ->set('host', \Config::get('mt.mt_host'))
        ->set('port', 8728)
        ->set('pass',  \Config::get('mt.mt_pass'))
        ->set('user', \Config::get('mt.mt_user'));
    // Initiate client with config object
    $client = new Client($config);

        // Remove user
    $query =
    (new Query('/ip/hotspot/ip-binding/print'))
        ->where('mac-address', $id);
    // Get user from RouterOS by query
    $user = $client->query($query)->read();
    if (!empty($user[0]['.id'])) {
    $userId     = $user[0]['.id'];
    // Remove MACa address
    $query =
        (new Query('/ip/hotspot/ip-binding/remove'))
            ->equal('.id', $userId);
    // Remove user from RouterOS
    $removeUser = $client->query($query)->read();
    print_r($removeUser);
    }

    return redirect('/admin/ip-binding');
}
}