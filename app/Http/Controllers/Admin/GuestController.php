<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response,DB;
use Datatables;
use auth;
use App\Room;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminmenu.room-config');
    }

    public function data()
    {
        $mac = DB::table('Rooms')
        ->select('Rooms.id','Room', 'RoomType','Description','created_by', 'Rooms.updated_by','Rooms.updated_at')
        ->join('WifiGroup', 'Rooms.GroupName', '=', 'WifiGroup.GroupName')
        ->orderby('updated_at', 'DESC');

        return Datatables()->of($mac)
            ->addColumn('actions','
                <a role="button" class="btn btn-sm btn-primary" data-fancybox data-type="iframe" data-src="{{{ URL::to(\'admin/guest-config/\' . $id . \'/edit\' ) }}}" href="javascript:;"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</a>
                <a role="button" id="btnDelete" href="{{{ URL::to(\'admin/guest-config/\' . $Room . \'/delete\' ) }}}" class="btn btn-sm btnDelete btn-danger"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</a>
                ')
            ->rawColumns(['actions'])
            ->make();
    }

    public function getEdit($id)
    {
        $room = DB::table('Rooms')->find($id);
        $Group = DB::table('WifiGroup')->whereRaw('Status=\'A\' and Type= \'G\'')->get();
        return view('adminmenu.edit-rooms',compact('room'),compact('Group'));
    }

    public function saveEdit(Request $request, $id)
    {
        $room = Room::find($id);
        $room -> RoomType = $request->RoomType;
        $room -> GroupName = $request->GroupName;
        $room -> updated_by = Auth::user()->name; 
        $room -> save();
        //DB::table('Rooms')
        //->where('id', trim($id))
        //->update(
        //    ['groupname' => trim($request->GroupName),
        //    'RoomType' =>$request->RoomType,
        //    'updated_by'=>Auth::user()->name]
        //);

        DB::connection('mysql2')->table('radusergroup')->where('username', trim($request->uid))->update(['groupname' => trim($request->GroupName)]);

        return view('adminmenu.close-fancybox');
    }


    public function getCreate()
    {
        // Show the page
        $Group = DB::table('WifiGroup')->whereRaw('Status=\'A\' and Type= \'G\'')->get();
        
        return view('adminmenu.edit-rooms',compact('Group'));    
    }

    public function postCreate(Request $request)
    {
        //$validatedData = 
        $request->validate([
            'Room'=>'required|unique:Rooms',
            'RoomType'=> 'required',
            'GroupName' => 'required'
        ]);      

        $rn = new Room();
        $rn->Room = $request->Room;
        $rn->RoomType = $request->RoomType;
        $rn->GroupName = $request->GroupName;
        $rn->created_by = Auth::user()->name; 
        $rn->save();

        DB::connection('mysql2')->table('radcheck')->insert(['username' => $request->Room , 'attribute' => 'Cleartext-Password','op' => ':=','value' => $request->Room]);
        DB::connection('mysql2')->table('radcheck')->insert(['username' => $request->Room , 'attribute' => 'Expiration','op' => ':=','value' => '6 Apr, 1977 20:12:23']);
        DB::connection('mysql2')->table('radusergroup')->insert(['username' => $request->Room , 'groupname' => $request->GroupName]);

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
        DB::connection('mysql')->table('Rooms')->where('Room', trim($id))->delete();
        DB::connection('mysql2')->table('radcheck')->where('username', trim($id))->delete();
        DB::connection('mysql2')->table('radreply')->where('username', trim($id))->delete();
        DB::connection('mysql2')->table('radusergroup')->where('username', trim($id))->delete();        

        return redirect('/admin/guest-config');
    }
}
