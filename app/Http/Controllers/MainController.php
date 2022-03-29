<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function register(){
        return view('auth.register');
    }

    function save(Request $request){
        // return $request->input();

        // Validate our request
        $request ->validate([
            'name'      =>  'required',
            'email'     =>  'required|email|unique:admins',
            'password'  =>  'required|min:5|max:12'
        ]);

        //Insert Data to Database
        $admin = new Admin;
        $admin -> name = $request->name;
        $admin -> email = $request->email;
        $admin -> password = Hash::make($request->password);
        $save = $admin ->save();

        if($save){
            return back()->with('success','New User has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again later'); 
        }

    }

    function check(Request $request){
        // return $request->input();

        $request ->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:5|max:12'
        ]);

        $userInfo = Admin::where('email','=',$request->email)->first();
        
        if(!$userInfo){
            return back()->with('fail','We do not recognize your emal');
        }else{
            //Check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/admin/dashboard');
                // return $request->input();
            }else{
                return back()->with('fail', 'Incorrect Password');
            }
        }
        // if($request){
        //     return $request->input();
        // }else{
        //     return back()->with('fail','Something went wrong, try again later');
        // }
    }
    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    function dashboard(){
        $data = ['LoggedUserInfo'=>Admin::where('id','=',session('LoggedUser'))->first()];
        return view('admin/dashboard',$data);
    }

    function setting(){
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('admin/setting',$data);
    }

    function profile(){
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('admin/profile',$data);
    }

    function staff(){
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('admin/staff',$data);
    }
}
