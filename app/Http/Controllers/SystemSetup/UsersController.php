<?php

namespace App\Http\Controllers\SystemSetup;

use App\Http\Controllers\Controller;
use App\Models\General\Picture;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service\service;
use Illuminate\Support\Facades\Hash;

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
    public function index()
    {
        $records = User::paginate(10);
        return view('system_setup.users', compact('records', 'page_title'));
    }
    public function Profile()
    {
        $user = Auth::user();
        $records = User::where('id', $user->id)->first();

        $page_title = $this->page;
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('general.profile', compact('records'));
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
            $records = DB::table('department')->where('id', $id);
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'File has been delete']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function ResetPassword(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction(); 

        try {
            if (empty($data['password'])) {
                return response()->json(['status' => 'error', 'msg' => "សូមបំពេញ ពាក្យសម្ងាត់ចាស់"]);
            }
            if (empty($data['new_value'])) {
                return response()->json(['status' => 'error', 'msg' => "សូមបំពេញ ពាក្យសម្ងាត់ថ្មី"]);
            }

            $user = User::where('id', $data['code'])->first();

            if (!$user) {
                return response()->json(['status' => 'error', 'msg' => "គណនីមិនមានទេ"]);
            }
            $value = $data['new_value'];
            $password = $data['password'];

            if (!Hash::check($data['password'], $user->password)) {
                return response()->json(['status' => 'error', 'msg' => "ពាក្យសម្ងាត់ចាស់ មិនត្រឹមត្រូវ"]);
            }

            $user->password = Hash::make($data['new_value']);
            $user->save();

            $this->services->telegramSendChangeUserPassword($user, $value,$password);

            DB::commit(); 

            return response()->json(['status' => 'success', 'msg' => 'ពាក្យសម្ងាត់បាន Update រូចរាល់']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json(['status' => 'warning', 'msg' => "មានបញ្ហាក្នុងការកែប្រែពាក្យសម្ងាត់។ សូមព្យាយាមម្ដងទៀត!"]);
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

    public function UpdateProfile(request $request)
    {
        $data = $request->all();

        $records = User::where('id', $data['code'])->first();
        if (!$data['code']) {
            return response()->json(['status' => 'error', 'msg' => 'Data Not found !']);
        }
        try {
            $records->name = $data['name'];
            $records->gender = $data['gender'];
            $records->date_of_birth = $data['date_of_birth'];
            $records->phone = $data['phone'];
            $records->save();
            return response()->json(['store' => 'yes', 'msg' => 'Succesfully !']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function UploadImages(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'code' => 'required'
            ]);

            $code = $request->code;
            $uploadPath = public_path('upload/profile');
            $existingImage = Picture::where('code', $code)->first();

            if ($existingImage) {
                $oldFilePath = str_replace(url('/'), public_path(), $existingImage->picture_ori);
                $existingImage->delete();
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $file = $request->file('file');
            $fileName = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $filePath = url("upload/profile/$fileName");
            Picture::create([
                'picture_ori' => $filePath,
                'code' => $code,
                'type' => 'profile'
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'រូបថតបានរក្សាទុក', 'path' => $filePath]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

}
