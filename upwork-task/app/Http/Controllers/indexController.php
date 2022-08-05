<?php

namespace App\Http\Controllers;

use App\Models\setting;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $current_user = auth()->user();
        if($current_user->id == 1){
            return redirect()->route('admin_home');
        }
        $users = null;
        if($current_user->gender == 'Boy'){
            $users = User::where('gender', 'Girl')->get();
        }else{
            $users = User::where('gender', 'Boy')->get();
        }

        return view('users.index',[
            'users' => $users
        ]);
    }


    public function filter(Request $request)
    {
       // Gather all the data 

       $gender = auth()->user()->gender == "Boy" ? "Girl" : "Boy";

       $upload_times_data = null;
       $mangalik_data = null;
       $born_data = null;


       if(!is_null($request->upload_time)){

            if($request->upload_time == 'this_week'){
                $upload_times_data = User::
                where('gender', $gender)
                ->where('created_at', '>', now()->subDays(7)->endOfDay())->get();
            }elseif($request->upload_time == 'all'){
                $upload_times_data = User::
                where('gender', $gender)->get();
            }
       }


       if(!is_null($request->mangalik)){
            if($request->mangalik == 'non_mangalik'){
                $mangalik_data = User::
                where('gender', $gender)
                ->where('mangalik_status', 'Non Mangalik')->get();
            } elseif($request->mangalik == 'anshik'){
                $mangalik_data = User::
                where('gender', $gender)
                ->where('mangalik_status', 'Anshik Mangalik')->get();

            } elseif($request->mangalik == 'dont_know'){
                $mangalik_data = User::
                where('gender', $gender)
                ->where('mangalik_status', "Don't Know Mangal Status")->get();
            }
       }



       if(!is_null($request->born)){

            if($request->born == 'before_1985'){
                $born_data = User::
                where('gender', $gender)
                ->where('year', '<=', '1985')->get();

            }elseif($request->born == '1985_1995'){
                $born_data = User::
                where('gender', $gender)
                ->where('year', '>=', '1985')
                ->where('year', '<=', '1995')
                ->get();

            }elseif($request->born == 'after_1995'){
                $born_data = User::
                where('gender', $gender)
                ->where('year', '>=', '1995')->get();
            }

       }


       // merge into 1 array 

       $mergedArray = [];
       if(!is_null($upload_times_data)){
        foreach ($upload_times_data as $single_upload) {
           array_push($mergedArray, $single_upload);
        }
     }


    if(!is_null($mangalik_data)){
        foreach ($mangalik_data as $single_mangalik) {
            array_push($mergedArray, $single_mangalik);
         }
    }
    
    if(!is_null($born_data)){
        foreach ($born_data as $single_born) {
            array_push($mergedArray, $single_born);
         }
    }

    $users_uniq = array_unique($mergedArray);
       // pass to index as $users
       return view('users.index',[
        'users' => $users_uniq
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



    public function login(Request $request)
    {
        $setting = setting::find(1);


        if($request->email == 'superadmin@gmail.com'){
            $user = User::where([
                'email' => $request->email, 
                'password' => $request->password
            ])->first();
            
            if($user)
            {
                Auth::login($user);
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->withErrors('Credentials Does Not Match');
            }

        }else{
            if($setting->online_status == false){
                return redirect()->route('login')->withErrors('Website Currently Offline');
            }else{
            $user = User::where([
                'email' => $request->email, 
                'password' => $request->password
            ])->first();
            
            if($user)
            {
                Auth::login($user);
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->withErrors('Credentials Does Not Match');
            }
        }

        }


 
}
}
