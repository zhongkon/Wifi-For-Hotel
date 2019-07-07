<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
class WhatwrongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('whatwrong.home');
    }

    public function datapap()
    {
        $posauth = DB::connection('mysql2')->table('radpostauth')
        ->selectRaw('radpostauth.authdate,radpostauth.username, mid(radpostauth.pass,1,17) as pass, radpostauth.reply')
        ->orderby('radpostauth.authdate', 'DESC')
        ->take(10000);


    return Datatables()->of($posauth)
        //->edit_column('icon', '{!! ($icon!="")? "<img style=\"max-width: 30px; max-height: 30px;\" src=\"../images/language/$id/$icon\">":""; !!}')
            ->make();
    }

    public function datavlan()
    {
        $posauth = DB::connection('mysql3')->table('radpostauth')
        ->select('radpostauth.authdate','radpostauth.username', 'radpostauth.pass', 'radpostauth.reply')
        ->orderby('radpostauth.authdate', 'DESC')
        ->take(10000);


    return Datatables()->of($posauth)
        //->edit_column('icon', '{!! ($icon!="")? "<img style=\"max-width: 30px; max-height: 30px;\" src=\"../images/language/$id/$icon\">":""; !!}')
            ->make();
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
