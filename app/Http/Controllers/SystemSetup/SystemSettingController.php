<?php

namespace App\Http\Controllers\SystemSetup;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\General\Classes;
use App\Models\General\Skills;
use App\Models\General\StudentRegistration;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Service\service;
use Illuminate\Support\Facades\Auth;

class SystemSettingController extends Controller
{
    public $service;
    public $page;
    public $page_id;
    function __construct()
    {
        $this->service = new service();
    }
    public function pageSearch(Request $request)
    {
        $input = $request->all();
        $strings = explode(" ", strtoupper($input['string']));
        $search_value = '';
        if (count($strings) > 0) {
            if ($strings[0] == 'NEW' || $strings[0] == 'OPEN') {
                if (count($strings) > 2) {
                    for ($i = 1; $i < count($strings) - 1; $i++) {
                        $search_value .= $strings[$i] . " ";
                    }
                } else {
                    if (count($strings) == 2) {
                        $search_value = $strings[1];
                    }
                }
                $search_value = rtrim($search_value, " ");
                $menus = DB::table('page')->where('title', 'like', $search_value . "%")->where('url_link', '<>', null)->get();

                if (count($menus) > 0) {
                    foreach ($menus as $menu) {
                        if ($strings[0] == 'OPEN' && count($strings) > 2) {
                            $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
                        }
                        $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
                    }
                }
            } else {
                for ($i = 0; $i < count($strings); $i++) {
                    $search_value .= $strings[$i] . " ";
                }
                $search_value = rtrim($search_value, " ");
                $menus = DB::table('page')->where('title', 'like', $search_value . "%")->where('url_link', '<>', null)->get();
            }
            if (count($menus) > 0) {
                return view('system.menu_search_list', compact('menus'));
            }
        }
        return 'none';
    }
    public function AvanceSearch(Request $request, $page)
    {
        try {
            $class_record = null;
            $data = $request->all();
            if ($page == 'student') $page = 'student';
            if ($page == 'users') $page = 'users';
            if ($page == 'location') $page = 'location';
            $extract_query = $this->service->extractQuery($data);

            $link_record = null;
            $total_records = null;
            $total_student_have_class = null;
            switch ($page) {
                case 'student':
                    if ($data['class_code'] != null) {
                        $records = Student::where('class_code', $data['class_code'])->paginate(1000);
                    }
                    $records = Student::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.student_list';
                    break;
                case 'department':
                    $records = Department::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                    break;
                case 'skills':
                    $records = Skills::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.skills_lists';
                    break;
                case 'subjects':
                    $records = Subjects::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.subjects_lists';
                    break;
                case 'teachers':
                    $records = Teachers::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.teachers_lists';
                    break;
                case 'student_registration':
                    $records = StudentRegistration::with(['session_year'])->whereRaw($extract_query)->paginate(1000);
                    $total_records = StudentRegistration::selectRaw(
                        DB::raw('COUNT(name) AS total_count'),
                    )->where('study_type', 'new student')
                        ->whereRaw($extract_query)
                        ->get();
                    $total_student_have_class = Student::select(
                        DB::raw('COUNT(name) AS total_count'),
                    )->where('study_type', 'new student')
                        ->whereRaw($extract_query)
                        ->whereNotNull('class_code')
                        ->get();
                    $blade_file_record = 'general.student_register_lists';
                    break;
                case 'class-new':
                    $records = Classes::whereRaw($extract_query)->paginate(1000);
                    $updated_query = $extract_query;
                    if (!empty($data['code'])) {
                        $updated_query = preg_replace("/code=('.*?')/", "class_code=$1", $extract_query);
                    }
                    if (!empty($data['level'])) {
                        $updated_query = preg_replace("/level=('.*?')/", "qualification=$1", $extract_query);
                    }
                    $total_records = Student::selectRaw('COUNT(DISTINCT code) AS total_count')
                        ->where('study_type', 'new student')

                        ->whereRaw($updated_query);
                    // ->groupBy('code');
                    if (!empty($updated_query)) {
                        $total_records = $total_records->whereRaw($updated_query);
                    }

                    $total_records = $total_records->get();


                    $blade_file_record = 'general.divided_new_classes_lists';
                    break;
                case 'warehouses':
                    // $records = WarehouseModel::whereRaw($extract_query)->paginate(15);
                    break;
                case 'student_registration_remaining':

                    $records = StudentRegistration::whereRaw($extract_query)->where('study_type', 'new student')
                        ->whereNull('class_code')
                        ->paginate(1000);
                    $blade_file_record = 'general.student_register_remaining_lists';
                    break;
                case 'scholarship':
                    $records = Student::whereRaw($extract_query)->where('study_type', 'new student')
                        ->whereNotNull('scholarship')
                        ->paginate(10000);
                    $blade_file_record = 'general.student_scholarship_lists';
                    break;
                default:
                    break;
            }
            $view = view($blade_file_record, compact('records', 'class_record', 'total_records', 'total_student_have_class'))->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            $this->service->telegram($ex->getMessage(), $page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function LiveSearch(Request $request, $page)
    {
        $input = $request->all();
        $strings = explode(" ", strtoupper($input['string']));
        $search_value = '';
        $user = Auth::user();
        if (count($strings) > 0) {
            if ($strings[0] == 'NEW' || $strings[0] == 'OPEN') {
                if (count($strings) > 2) {
                    for ($i = 1; $i < count($strings) - 1; $i++) {
                        $search_value .= $strings[$i] . " ";
                    }
                } else {
                    if (count($strings) == 2) {
                        $search_value = $strings[1];
                    }
                }
                $search_value = rtrim($search_value, " ");
                // check page
                if ($page == 'student') {
                    $menus = DB::table('student')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('class_code', '<>', null)->get();
                    $blade_file_record = 'general.student_list';
                } else if ($page == 'department') {
                    $menus = DB::table('department')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('id', '<>', null)->get();
                    $blade_file_record = 'department.department_list';
                } else if ($page == 'classes') {
                    $menus = Skills::where('name_2', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.classes_lists';
                } else if ($page == 'skills') {
                    $menus = Skills::where('name_2', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.skills_lists';
                } else if ($page == 'subjects') {
                    $menus = Subjects::where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.subjects_lists';
                } else if ($page == 'teachers') {
                    $menus = Teachers::where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.teachers_lists';
                } else if ($page == 'student_registration') {
                    $menus = StudentRegistration::where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('department_code', Auth::user()->department_code)
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.student_register_lists';
                } else if ($page == 'class-new') {
                    $menus = Classes::where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('department_code', Auth::user()->department_code)
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.divided_new_classes_lists';
                } else if ($page == 'scholarship') {
                    $menus = Student::where(function ($query) use ($search_value) {
                        $query->where('name', 'like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%");
                    })
                        ->whereNotNull('scholarship')
                        ->whereNotNull('code')
                        ->get();

                    $blade_file_record = 'general.student_scholarship_lists';
                }

                if (count($menus) > 0) {
                    foreach ($menus as $menu) {
                        if ($strings[0] == 'OPEN' && count($strings) > 2) {
                            $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
                        }
                        $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
                    }
                }
            } else {
                for ($i = 0; $i < count($strings); $i++) {
                    $search_value .= $strings[$i] . " ";
                }
                $search_value = rtrim($search_value, " ");
                if ($page == 'student') {
                    $menus = DB::table('student')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('class_code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.student_list';
                } else if ($page == 'department') {
                    $menus = DB::table('department')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('id', '<>', null)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                } else if ($page == 'classes') {
                    $menus = DB::table('classes')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.classes_lists';
                } else if ($page == 'skills') {
                    $menus = Skills::where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.skills_lists';
                } else if ($page == 'subjects') {
                    $menus = DB::table('subjects')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.subjects_lists';
                } else if ($page == 'teachers') {
                    $menus = DB::table('teachers')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.teachers_lists';
                } else if ($page == 'student_registration') {
                    $menus = DB::table('student_registration')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('department_code', Auth::user()->department_code)
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.student_register_lists';
                } else if ($page == 'class-new') {
                    $menus = DB::table('classes')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('department_code', Auth::user()->department_code)
                        ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.divided_new_classes_lists';
                } else if ($page == 'scholarship') {
                    $menus = DB::table('student')
                        ->where(function ($query) use ($search_value) {
                            $query->where('name', 'like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%");
                        })
                        ->whereNotNull('scholarship')
                        ->whereNotNull('code')
                        ->paginate(1000);
                    $blade_file_record = 'general.student_scholarship_lists';
                }
            }

            if (count($menus) > 0) {
                $records = $menus;
            } else {
                if ($page == 'student') {
                    $records = Student::where('department_code', $user->childs)->paginate(10);
                } else if ($page == 'department') {
                    $records = Department::where('code', null)->paginate(1000);
                } else if ($page == 'classes') {
                    $records = DB::table('classes')->where('code', null)->paginate(1000);
                } else if ($page == 'skills') {
                    $records = DB::table('skills')->where('code', null)->paginate(1000);
                } else if ($page == 'subjects') {
                    $records = DB::table('subjects')->where('code', null)->paginate(1000);
                } else if ($page == 'teachers') {
                    $records = Teachers::where('code', null)->paginate(1000);
                } else if ($page == 'student_registration') {
                    $records = StudentRegistration::where('department_code', Auth::user()->department_code)->paginate(1000);
                } else if ($page == 'class-new') {
                    $records = Classes::where('department_code', Auth::user()->department_code)->paginate(1000);
                } else if ($page == 'scholarship') {
                    $records = StudentRegistration::where('department_code', Auth::user()->department_code)->paginate(1000);
                }
            }
            $view = view($blade_file_record, compact('records'))->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        }
        return 'none';
    }
}
