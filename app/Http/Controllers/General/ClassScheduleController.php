<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\AssingClassesStudentLine;
use App\Models\General\Classes;
use App\Models\General\ClassSchedule as GeneralClassSchedule;
use App\Models\General\Skills;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Models\General\ClassSchedule;
use function PHPSTORM_META\type;

class ClassScheduleController extends Controller
{
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
        $this->page = "class-schedule";
        $this->prefix = "class-schedule";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function classScheduleV2()
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        $user =  Auth::user();
        $page = $this->page;
        
        $class_schedule = GeneralClassSchedule::orderBy('semester', 'desc')
            ->orderBy('years', 'desc');
        $class_schedule = $this->services->filterByUser($class_schedule, $user);
        $class_schedule = $class_schedule->get();

        $data = $this->services->GetDateIndexOption(now()); 

        return view ('general.class_schedule_v2',compact('class_schedule'));
    }
    public function classScheduleList($id)
    {
        $headers = DB::table('class_schedule as class_schedule')
        ->select(
                'class_schedule.*',
                'sections.name_2 as section_name',
                'department.name_2 as department_name',
                'skills.name_2 as skill_name'
            )
            ->join('sections', 'class_schedule.sections_code', '=', 'sections.code')
            ->join('department', 'class_schedule.department_code', '=', 'department.code')
            ->join('skills', 'class_schedule.skills_code', '=', 'skills.code')
            ->where('class_schedule.id', $id)
            ->first();

        $records = DB::table('assing_classes')->where('class_schedule_id', $id)->get();

        $days = [];
        $sessions = [];
        if ($records->isNotEmpty()) {
            $days = [];
            $sessions = [];
            $dayCodes = $records->pluck('date_name')->unique()->toArray();
            $days = DB::table('date_name')
                ->whereIn('code', $dayCodes)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();
        
            $sectionCode = $records->first()->sections_code;
            $sessionsRaw = DB::table('session')
                ->where('section_code', $sectionCode)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $sessions = [];
            foreach ($records as $rec) {
                $day = $rec->date_name;
                $sessionKey = $rec->start_time . '-' . $rec->end_time;
                    
                $teacher = DB::table('teachers')
                    ->where('code', $rec->teachers_code)
                    ->select('name_2', 'gender')
                    ->first();

                $sessions[$day][$sessionKey] = [
                    'id' => $rec->id,
                    'teacher_name' => $teacher->name_2 ?? '',
                    'teacher_gender' => $teacher->gender ?? '',
                    'subject_name' => DB::table('subjects')
                        ->where('code', $rec->subjects_code)
                        ->value('name_2'),
                    'room' => $rec->room,
                ];
            }
        }

        $classs = DB::table('classes')->get();
        return view('general.class_schedule_v2_list', compact('records', 'days', 'sessions', 'classs', 'headers'));
    }   
    public function deleteClassSchedule($id)
    {
        $exists = DB::table('assing_classes')
            ->where('class_schedule_id', $id)
            ->where('class_schedule_id', '>', 0)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'មិនអាចលុបបានទេ ព្រោះថ្នាក់នេះបញ្ចូលកាលវិភាគរួចហើយ។'
            ]);
        }

        $deleted = DB::table('class_schedule')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'បានលុបទិន្នន័យដោយជោគជ័យ'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'មិនអាចលុបបានទេ'
            ]);
        }
    }
    public function classScheduleStoreV2view(Request $request)
    {
        $user =  Auth::user();
        $page = $this->page;

        $classes = DB::table('v_class_current')->orderBy('semester', 'desc')
            ->orderBy('years', 'desc');
        $classes = $this->services->filterByUser($classes, $user);
        $classes = $classes->get();

        if(@$request->type){
            $classes = DB::table('v_class_current as vcc')->where('class_code', $request->class_code)
                ->join('department as de','vcc.department_code','=','de.code')
                ->join('sections as se','vcc.sections_code','=','se.code')
                ->join('skills as ski','vcc.skills_code','=','ski.code')
                ->select(
                    'vcc.*',
                    'de.name_2 as department_name',
                    'se.name_2 as section_name',
                    'ski.name_2 as skill_name'
                )
                ->orderBy('semester', 'desc')
                ->orderBy('years', 'desc')
                ->first();
                    
            return response()->json([
                'classes' => $classes
            ]);

        }
        return view('general.class_schedule_v2_create', compact('classes'));
    }
    public function classScheduleStoreV2(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'class_code' => 'required|string',
        ]);

        $classInfo = DB::table('v_class_current')
            ->where('class_code', $request->class_code)
            ->first();

        if (!$classInfo) {
            return response()->json(['success' => false, 'message' => 'រកមិនឃើញថ្នាក់នេះទេ']);
        }
        
        $existing = DB::table('class_schedule')
        ->where('class_code', $request->class_code)
        ->where('years', $classInfo->years)
        ->where('semester', $classInfo->semester)
        ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'ថ្នាក់នេះសម្រាប់ឆ្នាំសិក្សា និងឆមាសនេះបានបង្កើតរួចហើយ!'
            ]);
        }

        $insertedId = DB::table('class_schedule')->insertGetId([
            'class_code' => $request->class_code,
            'session_year_code' => $classInfo->session_year_code,
            'years' => $classInfo->years,
            'semester' => $classInfo->semester,
            'sections_code' => $classInfo->sections_code,
            'skills_code' => $classInfo->skills_code,
            'qualification' => $classInfo->qualification,
            'department_code' => $classInfo->department_code,
            'start_date' => $request->start_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $class_schedule = DB::table('class_schedule')->latest('id')->first();
        return response()->json([
            'class_schedule' => $class_schedule->id,
            'success' => true,  
            'message' => 'បានរក្សាទិន្នន័យដោយជោគជ័យ',
        ]);
    }
    public function getClassData(Request $request)
    {
        $classCode = $request->class_code;
        if (!$classCode) {
            return response()->json(['success' => false, 'message' => 'មិនមានថ្នាក់នេះទេ']);
        }

        $classInfo = DB::table('class_schedule')
            ->where('class_code', $classCode)
            ->orderBy('id', 'desc')
            ->first();

        if (!$classInfo) {
            return response()->json(['success' => false, 'message' => 'ថ្នាក់នេះមិនមាន!']);
        }

        $subjects = DB::table('subjects')
            ->where('year_type', $classInfo->years)
            ->pluck('name','code');

        $sessions = DB::table('session')
            ->where('section_code', $classInfo->sections_code)
            ->select('name', 'start_time', 'end_time')
            ->get();

        $teachers = DB::table('teachers')
            ->select('code', 'name_2')
            ->get();

        $allDays = DB::table('date_name')
            ->orderBy('index', 'asc')
            ->pluck('name_2','code')
            ->toArray();

        $sectionCode = $classInfo->sections_code;
            if ($sectionCode === 'M') {
                $days = array_slice($allDays, 0, 6);
            } elseif ($sectionCode === 'N') {
                $days = array_slice($allDays, 0, 6);
            } elseif ($sectionCode === 'A') {
                $days = array_slice($allDays, 0, 6);
            } else {
                $days = [];
            }

        return response()->json([
            'classInfo' => $classInfo,
            'class_schedule_id' => $classInfo->id,
            'success' => true,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'sessions' => $sessions,
            'days' => $days,
        ]);
    }
    public function storeAssignClassSchedule(Request $request)
    {

        $request->validate([
            'class_code' => 'required|string',
            'teachers_code' => 'required|string',
            'subjects_code' => 'required|string',
            'date_name' => 'required|string',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required|string',
            'sessions_type' => 'required|integer',
            'class_schedule_id' => 'required|integer',
            'years' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        try {

            $counter_add = DB::table('assing_classes')
                ->where('class_code', $request->class_code)
                ->where('teachers_code', $request->teachers_code)
                ->where('subjects_code', $request->subjects_code)
                ->count();

            if ($counter_add >= 2) {
                return response()->json([
                    'success' => false,
                    'conuter' => true,
                    'message' => 'អ្នកមិនអាចបន្ថែមមុខវិជ្ជានេះលើសពី 2 ដងទេ!'
                ]);
            }

            $assing = AssingClasses::latest('id')->first();

            if ($assing) {
                $assing_no = $assing->assing_no + 10;
            } else {
                $assing_no = 10;
            }
            
            DB::table('assing_classes')->insert([
                'class_code' => $request->class_code,
                'teachers_code' => $request->teachers_code,
                'subjects_code' => $request->subjects_code,
                'date_name' => $request->date_name,
                'start_time' => $request->time_start,
                'end_time' => $request->time_end,
                'room' => $request->room,
                'sessions_type' => $request->sessions_type,
                'class_schedule_id' => $request->class_schedule_id,
                'years' => $request->years,
                'session_year_code' => $request->session_year_code,
                'sections_code' => $request->sections_code,
                'department_code' => $request->department_code,
                'skills_code' => $request->skills_code,
                'qualification' => $request->qualification,
                'semester' => $request->semester,
                'status' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'assing_no' => $assing_no,
            ]);

            $records = DB::table('assing_classes')
                ->where('class_schedule_id', $request->class_schedule_id)
                ->select('id', 'teachers_code', 'subjects_code', 'date_name', 'start_time', 'end_time', 'room')
                ->get();
                
            $day = DB::table('date_name')
                ->where('code', $request->date_name)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();

            $days = array_values($day);

            $sessionsRaw = DB::table('session')
                ->where('section_code', $request->sections_code)
                ->select('name', 'start_time', 'end_time')
                ->get();
            $recordsGrouped = $records->groupBy('date_name');   

            return response()->json([
                'success' => true,
                'message' => 'បានរក្សាទិន្នន័យដោយជោគជ័យ',
                'records' => $records,
                'days' => $days,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហា: ' . $e->getMessage(),
            ]);
        }
    }
    public function deleteAssignClassSchedule($id)
    {
        try {
            $deleted = DB::table('assing_classes')->where('id', $id)->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'បានលុបទិន្នន័យដោយជោគជ័យ'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនអាចលុបបានទេ' 
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
            ]);
        }
    }
    public function editAssignClassSchedule($id)
    {
        try {

            $record = DB::table('assing_classes as ac')
                ->where('ac.id', $id)
                ->join('teachers', 'ac.teachers_code', '=', 'teachers.code')
                ->join('subjects', 'ac.subjects_code', '=', 'subjects.code')
                ->join('date_name', 'ac.date_name', '=', 'date_name.code')
                ->select(
                    'ac.id','ac.class_code','ac.teachers_code','teachers.name_2 as teacher_name',
                    'ac.subjects_code','subjects.name as subject_name','ac.date_name',
                    'date_name.name_2 as date_display','ac.start_time','ac.end_time','ac.room','ac.sessions_type'
                )
                ->first();

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនមានទិន្នន័យនេះទេ'
                ]);
            }

            $classInfo = DB::table('class_schedule')
                ->where('class_code', $record->class_code ?? null)
                ->first();

            if (!$classInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនអាចរកឃើញព័ត៌មានថ្នាក់បានទេ'
                ]);
            }

            $subjects = DB::table('subjects')
                ->where('year_type', $classInfo->years)
                ->pluck('name', 'code');

            $sessions = DB::table('session')
                ->where('section_code', $classInfo->sections_code)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $teachers = DB::table('teachers')
                ->select('code', 'name_2')
                ->get();

            $allDays = DB::table('date_name')
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();

            $sectionCode = $classInfo->sections_code;
                if ($sectionCode === 'M') {
                    $days = array_slice($allDays, 0, 5);
                } elseif ($sectionCode === 'N') {
                    $days = array_slice($allDays, 0, 6);
                } elseif ($sectionCode === 'A') {
                    $days = array_slice($allDays, 0, 5);
                } else {
                    $days = [];
                }   

            return response()->json([
                'success'  => true,
                'record'   => $record,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'sessions' => $sessions,
                'days'     => $days
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
            ]);
        }
    }
    public function updateAssignClassSchedule(Request $request, $id)
    {
        try {

            $updated = DB::table('assing_classes')->where('id', $id)->update([
                'class_code' => $request->class_code,
                'teachers_code' => $request->teachers_code,
                'subjects_code' => $request->subjects_code,
                'date_name' => $request->date_name,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'room' => $request->room,
                'sessions_type' => $request->sessions_type,
                'updated_at' => now(),
            ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'បានកែប្រែទិន្នន័យដោយជោគជ័យ'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនមានការផ្លាស់ប្តូរទិន្នន័យ'
                ]);
            }
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
            ]);
        }
    }
    public function classSchedulePrint($id)
    {
        $headers = DB::table('class_schedule as class_schedule')
            ->select(
                    'class_schedule.*',
                    'sections.name_2 as section_name',
                    'department.name_2 as department_name',
                    'skills.name_2 as skill_name'
                )
                ->join('sections', 'class_schedule.sections_code', '=', 'sections.code')
                ->join('department', 'class_schedule.department_code', '=', 'department.code')
                ->join('skills', 'class_schedule.skills_code', '=', 'skills.code')
                ->where('class_schedule.id', $id)
                ->first();
        
        $records = DB::table('assing_classes')->where('class_schedule_id', $id)->get();
        $days = [];
        $sessions = [];

        if ($records->isNotEmpty()) {
            $days = [];
            $sessions = [];
            $dayCodes = $records->pluck('date_name')->unique()->toArray();
            $days = DB::table('date_name')
                ->whereIn('code', $dayCodes)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();
        
            $sectionCode = $records->first()->sections_code;
            $sessionsRaw = DB::table('session')
                ->where('section_code', $sectionCode)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $sessions = [];
            foreach ($records as $rec) {
                $day = $rec->date_name;
                $sessionKey = $rec->start_time . '-' . $rec->end_time;
                    
                $teacher = DB::table('teachers')
                    ->where('code', $rec->teachers_code)
                    ->select('name_2', 'gender')
                    ->first();

                $sessions[$day][$sessionKey] = [
                    'id' => $rec->id,
                    'teacher_name' => $teacher->name_2 ?? '',
                    'teacher_gender' => $teacher->gender ?? '',
                    'subject_name' => DB::table('subjects')
                        ->where('code', $rec->subjects_code)
                        ->value('name_2'),
                    'room' => $rec->room,
                ];
            }
        }
        return view('general.class_schedule_v2_sub_list',compact('records', 'days', 'sessions','headers'));
    }
}
