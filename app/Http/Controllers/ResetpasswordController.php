<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use auth;
class ResetpasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('resetpassword.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userdata = array(
            "user" => trim($request->input('userName')) ,
            "pass" => trim($request->input('Password')) ,
            "Expiration" => $request->input('datecheckout') ,
        );
    
        $result = DB::connection('mysql')->table('Rooms')
        ->select("Room")
        ->where('Room', trim($request->input('userName')))->first();

        if (isset($result) && ($result!==null)){            
            //echo $result->Room;
        }else{
            return abort(404);
        }
        if (strlen(trim($request->input('Password')))==0){
            return abort(404);
        }
        DB::connection('mysql2')->update("update radcheck set value = '".trim($request->input('Password'))."' where username ='".trim($request->input('userName'))."' and attribute = 'Cleartext-Password'");
        DB::connection('mysql2')->update("update radcheck set value = '".$request->datecheckout."' where username ='".trim($request->input('userName'))."' and attribute = 'Expiration'");

        DB::connection('mysql3')->update("update radcheck set value = '".trim($request->input('Password'))."' where username ='".trim($request->input('userName'))."' and attribute = 'Cleartext-Password'");
        DB::connection('mysql3')->update("update radcheck set value = '".$request->datecheckout."' where username ='".trim($request->input('userName'))."' and attribute = 'Expiration'");

        DB::connection('mysql')->insert('insert into history(hdate, doer, room, password, checkout, created_at,dtCI,dtCO,updated_at)VALUES (\'' . date("Y-m-d H:i:s") .'\', \''. Auth::user()->name .'\', \''. $request->input('userName') .'\', \''.$request->input('Password').'\', \''.str_replace(",","",$request->input('datecheckout')).'\', \''. date("Y-m-d H:i:s")  .'\', \''. date("Y-m-d H:i:s")  .'\', \''. date("Y-m-d H:i:s")  .'\', \''. date("Y-m-d H:i:s") .'\');');
    

        return redirect('/audit-trail');
    }

}
