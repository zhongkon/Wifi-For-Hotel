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
        ->selectRaw('radpostauth.authdate,radpostauth.username, mid(radpostauth.pass,1,40) as pass, radpostauth.reply')
        ->orderby('radpostauth.authdate', 'DESC')
        ->take(10000);
        return Datatables()->of($posauth)->make();
    }



}
