<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Student;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Auth::user()->role_id == 2){
            return redirect('classrecord');
        }elseif(Auth::user()->role_id == 1){
            return redirect('student_grades');
        }else{
            return redirect('college_view');
        }
    }

    public function myaccountupdate(Request $request){

        $user = User::findOrFail(Auth::user()->id);
        if($request->name != ''){
            $user->name = $request->name;
        }
        if($request->id_no != ''){
            $user->email = $request->id_no;
        }
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if(Auth::user()->role_id == 1){
            $student = Student::where('id_no', $request->id_no)->update(['access_key'=>$request->password]);
        }

        Session::flash('UpdatedAccount');

        return redirect('home');
        
    }

    public function myaccount(){
        return view('myaccount');
    }
}
