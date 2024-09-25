<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\JobAttemLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        try{
            return view('admin.auth.pages-login');
        }catch(Exception $ex){

        }
    }
    public function doLogin(Request $request){
        try{
            $data = $request->all();
            $criteria = [
                'email' => $data['email'],
                'password' => $data['password']
            ];
            if(Auth::attempt($criteria)){
                $user = Auth::user() ;
                return redirect('/admin/dashboard');
                
            }
            // dispatch(new JobAttemLogin($criteria));
            return redirect()->back() ;

        }catch(Exception $ex){
            return response()->json(['status' => 'warning' , 'msg' => $ex]) ;
        }
    }
}
