<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Config;
use RouterOS\Client;
use RouterOS\Query;
use Datatables;

class UseronlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('useronline.home');
    }

    public function data()
    {
        $mt_host = \Config::get('mt.mt_host');
        $mt_user = \Config::get('mt.mt_user');
        $mt_pass = \Config::get('mt.mt_pass');
        $mthost =
        (new Config())
            ->set('host', $mt_host)
            ->set('user', $mt_user)
            ->set('pass', $mt_pass);

        // Initiate client with config object
        $client = new Client($mthost);
        $response =$client->wr('/ip/hotspot/active/print');  
        $alldata = response;

        //var_dump($request);

        return Datatables()->of($alldata)->make();
    }

    public function data2()
    {
        $lobby_host = \Config::get('mt.mt_host');
        $lobby_user = \Config::get('mt.mt_user');
        $lobby_pass = \Config::get('mt.mt_pass');
        $lobby =
        (new Config())
            ->set('host', $lobby_host)
            ->set('user', $lobby_user)
            ->set('pass', $lobby_pass);

        // Initiate client with config object
        $client = new Client($lobby);
        $response =$client->wr('/ip/hotspot/active/print');
        $lobbyclient =  $response;

            $room_host = \Config::get('mt.mt_host2');
            $room_user = \Config::get('mt.mt_user2');
            $room_pass = \Config::get('mt.mt_pass2');
            $room =
            (new Config())
                ->set('host', $room_host)
                ->set('user', $room_user)
                ->set('pass', $room_pass);
        // Initiate client with config object
        $client = new Client($room);
        $response =$client->wr('/ip/hotspot/active/print');
        $roomclient =  $response;

        $alldata = array_merge($lobbyclient,$roomclient);


        //var_dump($request);

        return Datatables()->of($alldata)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/admin/useronline');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //echo config('mt.mt_host');
        //echo config('mt.mt_user');
        //echo config('mt.mt_pass');
        $value=\Config::get('mt.mt_host');
        echo $value; 
    }

}
