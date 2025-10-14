<?php

namespace App\Http\Controllers\SystemSetup;

use App\Http\Controllers\Controller;
use App\Models\General\Picture;
use App\Models\General\Role;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Validator;
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
        $page_title = $this->page;
    }
    public function index()
    {
        $records = User::with('roles')->paginate(10);
        // dd($records);
        $page_title = $this->page;
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
        $type = "ed";
        $records = "";
        $department = DB::table('department')->where('is_active', 'yes')->get();
        $role = Role::all();
        try {
            $params = ['records', 'type', 'page', 'page_url', 'department', 'role'];
            if ($type == 'cr') return view('system_setup.users_card', compact($params));
            if (isset($_GET['code'])) {
                $records = DB::table('users')->where('id', $this->services->Decr_string($_GET['code']))->first();
            }
            return view('system_setup.users_card', compact($params));
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

            $this->services->telegramSendChangeUserPassword($user, $value, $password);

            DB::commit();

            return response()->json(['status' => 'success', 'msg' => 'ពាក្យសម្ងាត់បាន Update រូចរាល់']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json(['status' => 'warning', 'msg' => "មានបញ្ហាក្នុងការកែប្រែពាក្យសម្ងាត់។ សូមព្យាយាមម្ដងទៀត!"]);
        }
    }

    public function store(Request $request)
    {
        // 1. Validate the request
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'department_code' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'សូមបំពេញឈ្មោះ',
            'email.required' => 'សូមបំពេញអ៊ីមែល',
            'email.email' => 'អ៊ីមែលមិនត្រឹមត្រូវទេ',
            'department_code.required' => 'សូមជ្រើសរើសនាយកដ្ឋាន',
            'role.required' => 'សូមជ្រើសរើសតួនាទី',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors()->first(),
            ]);
        }

        // 2. Use try-catch to handle exceptions
        $exit = user::where('email', $request->email)->first();
        if ($exit) {
            return response()->json([
                'status' => 'error',
                'msg' => 'អ៊ីមែលនេះត្រូវបានប្រើរួចហើយ។ សូមប្រើអ៊ីមែលផ្សេងទៀត។'
            ]);
        }
        try {
            $records = new User();
            $records->name = $request->name;
            $records->email = $request->email;
            $records->department_code = $request->department_code;
            $records->role = $request->role;
            $records->password = Hash::make('123456');

            $records->save();

            return response()->json([
                'store' => 'yes',
                'msg' => 'អ្នកប្រើប្រាស់បានបង្កើតដោយជោគជ័យ',
            ]);
        } catch (\Exception $ex) {
            DB::rollBack(); // Only call this if you've started a transaction
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage()
            ]);
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

    public function update(Request $request)
{
    // 1. Validate the request
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        // 'department_code' => 'required',
        'role' => 'required',
    ], [
        'name.required' => 'សូមបំពេញឈ្មោះ',
        'email.required' => 'សូមបំពេញអ៊ីមែល',
        'email.email' => 'អ៊ីមែលមិនត្រឹមត្រូវទេ',
        // 'department_code.required' => 'សូមជ្រើសរើសនាយកដ្ឋាន',
        'role.required' => 'សូមជ្រើសរើសតួនាទី',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'msg' => $validator->errors()->first(),
        ]);
    }

    // 2. Get the record being updated
    $records = User::where('email', $request->email)->first();

    if (!$records) {
        return response()->json([
            'status' => 'error',
            'msg' => 'រកមិនឃើញអ្នកប្រើប្រាស់នោះទេ!',
        ]);
    }

    try {
        // ✅ Check if current authenticated user is the one being updated
        $currentUser = Auth::user();
        $isSelfUpdate = $currentUser && $currentUser->id === $records->id;

        // ✅ Check if email is changed
        $emailChanged = $records->email !== $request->email;

        // 3. Update fields
        $records->name = $request->name;
        $records->email = $request->email;
        $records->department_code = $request->department_code;
        $records->role = $request->role;
        $records->password = Hash::make('123456'); // Only if you want to reset password
        $records->update();

        // ✅ If the user updated their own email → logout
        if ($isSelfUpdate && $emailChanged) {
            Auth::logout();
            return response()->json([
                'status' => 'logout',
                'msg' => 'អ៊ីមែលត្រូវបានផ្លាស់ប្តូរ។ សូមចូលឡើងវិញ។',
                'redirect' => route('login') // redirect URL to login
            ]);
        }

        return response()->json([
            'status' => 'success',
            'store' => 'no',
            'msg' => 'អ្នកប្រើប្រាស់បានកែប្រែដោយជោគជ័យ',
        ]);
    } catch (\Exception $ex) {
        DB::rollBack(); // Only call this if you're inside a transaction
        $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
        return response()->json([
            'status' => 'warning',
            'msg' => $ex->getMessage()
        ]);
    }
}

}
