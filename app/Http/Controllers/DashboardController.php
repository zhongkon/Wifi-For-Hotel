<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use DB;
use RouterOS\Config;
use RouterOS\Client;
use RouterOS\Query;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginsuccess = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $loginfail = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $loginstat =  DB::connection('mysql3')->select('select DISTINCT MONTH(authdate) as m, count(*) as c from radpostauth where reply = \'Access-Reject\' AND YEAR(authdate) =YEAR(NOW()) group by MONTH(authdate)');

        foreach ($loginstat as $a):
            $loginfail[$a->m] = $a->c; 
        endforeach;
        $loginstatfail = implode(",",$loginfail);

        $loginstat =  DB::connection('mysql3')->select('select DISTINCT MONTH(authdate) as m, count(*) as c from radpostauth where reply = \'Access-Accept\' AND YEAR(authdate) =YEAR(NOW()) group by MONTH(authdate)');

        foreach ($loginstat as $a):
            $loginsuccess[$a->m] = $a->c; 
        endforeach;
        $loginstatdone = implode(",",$loginsuccess);

////////////////////////////////////////////////////////////////////////////////////////////////
//$lobby_host = \Config::get('mt.mt_host');
//$lobby_user = \Config::get('mt.mt_user');
//$lobby_pass = \Config::get('mt.mt_pass');
//        $lobby =
//        (new Config())
//        ->set('host', $lobby_host)
//        ->set('user', $lobby_user)
//        ->set('pass', $lobby_pass);

        // Initiate client with config object
//        $client = new Client($lobby);
//        $response =$client->wr('/ip/hotspot/active/print');
//        $lobbyclient =  $response;

//        $room_host = \Config::get('mt.mt_host2');
//        $room_user = \Config::get('mt.mt_user2');
//        $room_pass = \Config::get('mt.mt_pass2');

//            $room =
//            (new Config())
//                ->set('host', $room_host)
//                ->set('user', $room_user)
//                ->set('pass', $room_pass);
//        // Initiate client with config object
//        $client = new Client($room);
//        $response =$client->wr('/ip/hotspot/active/print');
//        $roomclient =  $response;

//        $alldata = array_merge($lobbyclient,$roomclient);

        $useronline = 500;//count($alldata);
////////////////////////////////////////////////////////////////////////////////////////////////////

        $result =  DB::connection('mysql')->select('select COUNT(*) as today from history WHERE DATE_FORMAT(hdate,\'%Y-%m-%d\') = DATE_FORMAT(NOW(),\'%Y-%m-%d\');');

        foreach ($result as $a):
            $today_gen_password = $a->today; 
        endforeach;

        return view('dashboard.home')
        ->with('loginstatfail', $loginstatfail)
        ->with('loginstatdone', $loginstatdone)
        ->with('useronline',$useronline)
        ->with('today_gen_password',$today_gen_password);
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
