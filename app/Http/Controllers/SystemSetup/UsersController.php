<?php

namespace App\Http\Controllers\SystemSetup;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service\service;

class UsersController extends Controller
{
    //
    public $services;
    public $page_id;
    public $page;
    public $prefix;
    public $table_id;
    public $arrayJoin = [];

    function __construct()
    {
        $this->services = new service();
        $this->page_id = "10001";
        $this->page = "ការគ្រប់គ្រងអ្នកប្រើប្រាស់";
        $this->prefix = "users";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index(){
        $records = User::paginate(10);
        $page_title = $this->page;
        if(!Auth::check()){
            return redirect("login")->withSuccess('Opps! You do not have access');
        }   
        return view('system_setup.users', compact('records', 'page_title'));	
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = ucwords(str_replace("_", " ", $this->page));
        $page_url = $this->page;
        $records = null;
        $category_record = DB::table('categories')->get();
        $class_record = DB::table('classes')->get();
        try {
            $params = ['records', 'class_record', 'category_record', 'type'];
            if ($type == 'cr') return view('department.department_card', compact($params));
            if (isset($_GET['code'])) {
                $records = DB::table('department')->where('id', $this->services->Decr_string($_GET['code']))->first();
            }
            return view('department.department_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        $id = $request->code;
        try {
            $records = DB::table('department')->where('id',$id);
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'File has been delete']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $id = $input['type'];
        try {
            $records = User::find($id);
            if ($records) {
                $records->department_name = $request->department_name;
                $records->is_active = $request->is_active;
                $records->update();
            }
            return response()->json(['status' => 'success', 'msg' => 'Data Update Success !', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function store(request $request)
    {
        $input = $request->all();
        $records = new User();
        if (!$input['department_name']) {
            return response()->json(['status' => 'error', 'msg' => 'Field request form server!']);
        }
        try {
            $records->department_name = $request->department_name;
            $records->is_active = $request->is_active;
            $records->save();
            return response()->json(['store' => 'yes', 'msg' => 'Records Add Succesfully !!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
