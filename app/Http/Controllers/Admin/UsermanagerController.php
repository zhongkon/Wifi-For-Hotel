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
        return view('adminmenu.edit-user');    
    }

public function userCreate(Request $request)
{
     //$validatedData = 
     $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'type' => 'required'
      ]);

      $usr = new User();
      $usr -> name = $request->name;
      $usr -> email = $request->email;
      $usr -> password = Hash::make($request->password);
      $usr -> type = $request->usertype;
      $usr -> save();

    return view('adminmenu.close-fancybox');
}

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('adminmenu.edit-user',compact('user'));
    }

    public function saveEdit(Request $request, $id)
    {
        $usr = User::find($id);
        $usr -> name = $request->name;
        //$usr -> email = $request->email;
        $usr -> password = $request->password;
        $usr -> type = $request->usertype;
        $usr -> save();

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
        DB::connection('mysql')->table('users')->where('id', trim($id))->delete();
        return redirect('/admin/users');
    }
}
