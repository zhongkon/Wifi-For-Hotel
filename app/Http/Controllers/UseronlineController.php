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
    public function show()
    {
        //echo config('mt.mt_host');
        //echo config('mt.mt_user');
        //echo config('mt.mt_pass');
        $value=\Config::get('mt.mt_host');
        echo $value; 
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
