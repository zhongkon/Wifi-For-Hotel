<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response,DB;
use Datatables;
use App\WifiGroup;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()) {
            return view('adminmenu.wifi-group');
        }elseif(auth()->user()->isUser()){
            return redirect('/dashboard');
        } else {
            return redirect('/home');
        }
    }

    public function data()
    {
    $wifigroup = DB::table('WifiGroup')
    ->select('WifiGroup.id','WifiGroup.GroupName', 'WifiGroup.MaxConcurrent', 'WifiGroup.Upload','WifiGroup.Download','WifiGroup.Redirect','WifiGroup.Description','WifiGroup.Status')
    ->orderby('WifiGroup.updated_at', 'DESC');

    return Datatables()->of($wifigroup)
        ->addColumn('actions','{!! ($id > 2)? "<a role=\"button\" class=\"btn btn-sm btn-primary\" data-fancybox data-type=\"iframe\" data-src=\"/admin/group-config/$id/edit\" href=\"javascript:;\"><span class=\"btn-label\"><i class=\"fa fa-pencil\"></i></span>Edit</a>
            <a role=\"button\" id=\"btnDelete\" href=\"/admin/group-config/$GroupName/delete\" class=\"btn btn-sm btnDelete btn-danger\"><span class=\"btn-label\"><i class=\"fa fa-times\"></i></span>Delete</a>":""; !!}')
        ->rawColumns(['actions'])
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcreate()
    {   
        return view('adminmenu.edit-group');    
        //1,048,576 ***************
    }

    public function postCreate(Request $request)
    {
        //$validatedData = 
        $request->validate([
            'GroupName'=>'required|unique:WifiGroup,GroupName',
            'MaxConcurrent'=> 'required',
            'Upload' => 'required',
            'Download' => 'required',
            'Redirect' => 'required',
            'Description' => 'required',
            'Status' => 'required',
            'Type' => 'required',
            'info' => 'required'
        ]);
        if ($request->Type == 'I'){
            $Group = new WifiGroup();
            $Group->GroupName = $request->GroupName;
            $Group->MaxConcurrent = $request->MaxConcurrent;
            $Group->Description = $request->Description;
            $Group->Upload = $request->Upload; 
            $Group->Download = $request->Download; 
            $Group->Redirect = $request->Redirect;
            $Group->Status = $request->Status; 
            $Group->Type = $request->Type;
            $Group->info = $request->info;
            $Group->save();
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Bandwidth-Max-Down','op' => ':=','value' => $request->Download * 1048576]);
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Bandwidth-Max-Up','op' => ':=','value' => $request->Upload * 1048576]);
            #DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'Port-Limit','op' => ':=','value' => $request->MaxConcurrent]);
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Redirection-URL','op' => ':=','value' => $request->Redirect]);
        }

        if ($request->Type == 'G'){
            $Group = new WifiGroup();
            $Group->GroupName = $request->GroupName;
            $Group->MaxConcurrent = $request->MaxConcurrent;
            $Group->Description = $request->Description;
            $Group->Upload = $request->Upload; 
            $Group->Download = $request->Download; 
            $Group->Redirect = $request->Redirect;
            $Group->Status = $request->Status; 
            $Group->Type = $request->Type;
            $Group->info = $request->info;
            $Group->save();
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Bandwidth-Max-Down','op' => ':=','value' => $request->Download * 1048576]);
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Bandwidth-Max-Up','op' => ':=','value' => $request->Upload * 1048576]);
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'Port-Limit','op' => ':=','value' => $request->MaxConcurrent]);
            DB::connection('mysql2')->table('radgroupreply')->insert(['groupname' => $request->GroupName , 'attribute' => 'WISPr-Redirection-URL','op' => ':=','value' => $request->Redirect]);
        }

        return view('adminmenu.close-fancybox');
    }

    public function getEdit($id)
    {
        $Group = DB::table('WifiGroup')->find($id);
        return view('adminmenu.edit-group',compact('Group'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEdit(Request $request, $id)
    {
        $Group = WifiGroup::find($id);
        $Group->Description = $request->Description;
        $Group->MaxConcurrent = $request->MaxConcurrent;
        $Group->Upload = $request->Upload; 
        $Group->Download = $request->Download; 
        $Group ->Redirect = $request->Redirect; 
        $Group->info = $request->info; 
        $Group->save();

        //DB::connection('mysql2')->table('radusergroup')->where('username', trim($request->uid))->update(['groupname' => trim($request->GroupName)]);

        return view('adminmenu.close-fancybox');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::connection('mysql')->table('WifiGroup')->where('GroupName', trim($id))->delete();
        DB::connection('mysql2')->table('radgroupreply')->where('groupname', trim($id))->delete();      

        return redirect('/admin/group-config');
    }
}