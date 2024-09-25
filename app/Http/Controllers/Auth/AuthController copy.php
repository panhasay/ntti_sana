<?php

namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Models\SystemSetting\Table;
use App\Models\SystemSetting\TableField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    //
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('department-menu')
                        ->withSuccess('You have Successfully loggedin');
        }

        // for testb
        // $longitude = 'hello world';
        // $ip = '103.216.50.143'; /* Static IP address */
        // $currentUserInfo = Location::get($ip);
        // // $longitude = Location::get($ip)->longitude;
        // dd($currentUserInfo);
        
        // return dd((Auth::attempt($credentials)));
        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');

        // return DB::getSchemaBuilder()->getColumnListing($table);

        // // OR
        // return Schema::getColumnListing($table);

        return redirect()->back()->with('message','Incorrect Password !');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("department")->withSuccess('Great! You have Successfully loggedin');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function departmentMenu()
    {
        if(Auth::check()){
            return view('department.department_menu');
        }
      
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
