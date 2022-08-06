<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Imports\UsersImport;
use App\Models\setting;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\Promise\settle;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        $setting = setting::find(1);
        return view('admin.users',[
            'users' => $users,
            'setting' => $setting
        ]);
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
    public function store(userRequest $request)
    {
        Excel::import(new UsersImport, $request->csv);
        return redirect()->route('admin_home')->with('success', 'Users Imported Successfully');
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
    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if($request->id != 1){
            User::findOrFail($request->user_id)->delete();
        }
        return redirect()->route('admin_home')->with('success', 'Users Deleted Successfully');
    }


    public function change_status(Request $request)
    {
        $setting  = setting::find(1);
       if(!is_null($request->status)){
            $setting->online_status = true;
            $setting->save();
            return redirect()->route('admin_home')->with('success', 'Website update Successfully');
       }else{
        $setting->online_status = false;
        $setting->save();
        return redirect()->route('admin_home')->with('success', 'Website update Successfully');
       }
    }
}
