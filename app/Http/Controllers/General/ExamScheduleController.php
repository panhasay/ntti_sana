<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\DailyDate;
use App\Models\General\AssingClasses;
use App\Models\General\Classes;
use App\Models\General\ClassSchedule as GeneralClassSchedule;
use App\Models\General\ExamSchedule;
use App\Models\General\ExamScheduleLine;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\General\ExamDateKhmer;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Models\General\ClassSchedule;

class ExamScheduleController extends Controller
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
        $this->page = "exam-schedule";
        $this->prefix = "exam-schedule";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index()
    {
        $page = $this->page;
        $records = ExamSchedule::orderBy('session_year_code', 'asc')->paginate(20);
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('general.exam_schedule', compact('records', 'page'));
    }


    public function transaction(Request $request)
    {
        try {
            $data = $request->all();
            $type = $data['type'];
            $page = $this->page;
            $records = null;
            $examScheduleId = null;
            $record_sub_lines = ExamScheduleLine::where('id', '')->get();

            $record_sub_lines = AssingClasses::where('class_code', $data['type'])->get();
            $classs = Classes::orderBy('code', 'desc')->get();

            // Get the next ID for exam_schedule
            $lastId = DB::table('exam_schedule')->max('id') ?? 0;
            $nextId = $lastId + 1;

            $sections = DB::table('sections')->get();
            $department = Department::get();
            $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
            $skills = DB::table('skills')->get();
            $study_years = StudyYears::get();
            $teachers = Teachers::orderBy('code', 'asc')->get();
            $subjects = Subjects::orderBy('code', 'asc')->get();
            $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
            $days = $date_name->pluck('name')->toArray();



            if (isset($_GET['code'])) {
                $examScheduleId = $this->services->Decr_string($_GET['code']);
                $records = ExamSchedule::where('id', $examScheduleId)->first();
                if ($records) {
                    $record_sub_lines = ExamScheduleLine::with(['teacher', 'coTeacher', 'coTeacher1', 'subject'])
                        ->where('exam_schedule_id', $records->id)
                        ->get()
                        ->filter(function ($item) {
                            return $item->dayOfWeek >= 1 && $item->dayOfWeek <= 6;
                        })
                        ->sortBy('dayOfWeek');
                } else {
                    $record_sub_lines = [];
                }
                // dd($examScheduleId);
            }



            // Pass necessary data to the view
            $params = compact(
                'records',
                'type',
                'page',
                'sections',
                'department',
                'school_years',
                'skills',
                'classs',
                'study_years',
                'teachers',
                'subjects',
                'record_sub_lines',
                'date_name',
                'days',
                'examScheduleId',
                'nextId' // Add nextId to the view
            );

            return view('general.exam_schedule_card', $params);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }




    public function store(Request $request)
    {
        $input = $request->all();
        $requiredFields = [
            'start_date' => 'ចាប់ផ្តើមអនុវត្ត ត្រូវបំពេញ!',
            'class_code' => 'ថា្នក់/ក្រុម​ ត្រូវបំពេញ!',
            'sections_code' => 'វេន ត្រូវបំពេញ!',
            'skills_code' => 'ជំនាញ ត្រូវបំពេញ!',
            'department_code' => 'ដេប៉ាតឺម៉ង់ ត្រូវបំពេញ!',
            'school_year_code' => 'ឆ្នាំសិក្សា ត្រូវបំពេញ!',
            'level' => 'Level is ត្រូវបំពេញ!',
            'semester' => 'Semester is ត្រូវបំពេញ!',
            'years' => 'ត្រូវបំពេញ បរិញាប័ត្រ ឆ្នាំ !'
        ];

        foreach ($requiredFields as $field => $message) {
            if (empty($input[$field])) {
                return response()->json(['status' => 'error', 'msg' => $message]);
            }
        }

        try {
            DB::beginTransaction();

            // Get the next ID
            $lastId = DB::table('exam_schedule')->max('id') ?? 0;
            $nextId = $lastId + 1;

            // Create new record with explicit ID
            $records = new ExamSchedule();
            $records->id = $nextId;
            $records->start_date = $request->start_date;
            $records->sections_code = $request->sections_code;
            $records->skills_code = $request->skills_code;
            $records->department_code = $request->department_code;
            $records->session_year_code = $request->school_year_code;
            $records->qualification = $request->level;
            $records->semester = $request->semester;
            $records->class_code = $request->class_code;
            $records->years = $request->years;
            $records->save();

            $encryptedCode = \App\Service\service::Encr_string($nextId);
            $url = "/exam-schedule/transaction?type=ed&code=" . $encryptedCode;

            DB::commit();
            return response()->json(['store' => 'yes', 'url' => $url, 'msg' => 'Records Add Succesfully !!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }





    public function saveExamSchedule(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            // Decode schedule if it's a JSON string
            if (isset($data['schedule']) && is_string($data['schedule'])) {
                $data['schedule'] = json_decode($data['schedule'], true);
            }

            // Validate the data structure
            if (empty($data['exam_schedule_id']) || empty($data['schedule']) || !is_array($data['schedule'])) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'ទិន្នន័យមិនគ្រប់គ្រាន់ ឬមិនត្រឹមត្រូវ'
                ]);
            }

            $exam_schedule_id = $data['exam_schedule_id'];

            // First, get all existing records for this exam schedule
            $existingRecords = ExamScheduleLine::where('exam_schedule_id', $exam_schedule_id)->get();

            // Create a map of existing records by their IDs
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record->id] = $record;
            }

            foreach ($data['schedule'] as $schedule) {
                // Only process if we have the required data
                if (empty($schedule['date'])) {
                    continue;
                }

                // Get the day name from the date
                $dayOfWeek = strtolower(date('l', strtotime($schedule['date'])));

                // If date_name_code is not provided, use the day name
                if (empty($schedule['date_name_code'])) {
                    $schedule['date_name_code'] = $dayOfWeek;
                }

                // Prepare the data array for update or create
                $scheduleData = [
                    'exam_schedule_id' => $exam_schedule_id,
                    'date' => $schedule['date'],
                    'date_name_code' => strtolower($schedule['date_name_code']),
                    'teacher_code' => $schedule['teacher_code'] ?? null,
                    'subjects_code' => $schedule['subjects_code'] ?? null,
                    'start_time' => $schedule['start_time'] ?? null,
                    'end_time' => $schedule['end_time'] ?? null,
                    'room' => $schedule['room'] ?? null,
                    'co_teacher_code' => isset($schedule['co_teacher_code']) && $schedule['co_teacher_code'] !== 'null' ? $schedule['co_teacher_code'] : null,
                    'co_teacher_code1' => isset($schedule['co_teacher_code1']) && $schedule['co_teacher_code1'] !== 'null' ? $schedule['co_teacher_code1'] : null,
                    'is_second_schedule' => $schedule['is_second_schedule'] ?? 0
                ];

                if (!empty($schedule['id'])) {
                    // Update existing record
                    $existingRecord = $existingRecordsMap[$schedule['id']] ?? null;
                    if ($existingRecord) {
                        $existingRecord->update($scheduleData);
                        // Remove from map to track which records were updated
                        unset($existingRecordsMap[$schedule['id']]);
                    }
                } else {
                    // Create new record
                    ExamScheduleLine::create($scheduleData);
                }
            }

            // Delete any remaining records that weren't updated (they were removed from the UI)
            foreach ($existingRecordsMap as $record) {
                $record->delete();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'msg' => 'កាលវិភាគត្រូវបានរក្សាទុក'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving exam schedule: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'msg' => 'មានបញ្ហាក្នុងការរក្សាទុក: ' . $e->getMessage()
            ]);
        }
    }







    public function update(Request $request)
    {
        $input = $request->all();
        $code = $input['type'];
        $record = ExamSchedule::where('id', $code)->first();
        if (!$record) return response()->json(['status' => 'error', 'msg' => "មិនអាចកែប្រ លេខកូដ!"]);
        try {
            $records = ExamSchedule::where('id', $code)->first();
            if ($records) {
                $records->start_date = $request->start_date;
                $records->sections_code = $request->sections_code;
                $records->skills_code = $request->skills_code;
                $records->department_code = $request->department_code;
                $records->session_year_code = $request->school_year_code;
                $records->qualification = $request->level;
                $records->semester = $request->semester;
                $records->class_code = $request->class_code;
                $records->years = $request->years;
                $records->update();
            }
            return response()->json(['status' => 'success', 'msg' => 'បច្ចុប្បន្នភាព ទិន្នន័យជោគជ័យ!', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    private function convertToKhmerNumber($number)
    {
        $khmerNumbers = [
            '0' => '០',
            '1' => '១',
            '2' => '២',
            '3' => '៣',
            '4' => '៤',
            '5' => '៥',
            '6' => '៦',
            '7' => '៧',
            '8' => '៨',
            '9' => '៩'
        ];

        return strtr($number, $khmerNumbers);
    }

    public function printLine(Request $request)
    {
        $is_print = "yes";
        try {
            $examScheduleId = $this->services->Decr_string($_GET['code']);
            $record = ExamSchedule::with(['section', 'subject', 'department'])->findOrFail($examScheduleId);

            // Get exam schedule lines with relationships
            $record_sub_lines = ExamScheduleLine::where('exam_schedule_id', $record->id)
                ->with(['subject', 'teacher', 'coTeacher', 'coTeacher1'])
                ->orderBy('date')
                ->orderBy('is_second_schedule')
                ->get();

            $class = DB::table('classes')->where('code', $record->class_code)->first();

            // Get unique dates from exam schedule lines
            $scheduleDates = $record_sub_lines->pluck('date')->unique()->filter();

            // Get date_name and map dates to it
            $date_name = DB::table('date_name')
                ->orderBy('index', 'asc')
                ->get()
                ->map(function ($day) use ($record_sub_lines) {
                    // Find schedules for this day
                    $schedules = $record_sub_lines->filter(function ($line) use ($day) {
                        return strtolower($line->date_name_code) === strtolower($day->code);
                    });

                    // Get the date from the first schedule (they should all have the same date)
                    $day->schedule_date = $schedules->first() ? $schedules->first()->date : null;
                    return $day;
                });

            $days = $date_name->pluck('name')->toArray();

            // Get the required variables for the view header
            $semesters = [$this->convertToKhmerNumber($record->semester)];
            $years = collect([$this->convertToKhmerNumber($record->years)]);
            $skills = collect([$record->skill]);
            $session_years_imploded = DB::table('session_year')
                ->where('code', $record->session_year_code)
                ->value('name') ?? '';

            // Convert to Khmer number if not empty
            $session_years_imploded = $session_years_imploded ? $this->convertToKhmerNumber($session_years_imploded) : '';

            // Get records for multiple data display
            $records = collect([$record]);

            return view('general.exams_schedule_print', compact(
                'record',
                'record_sub_lines',
                'is_print',
                'date_name',
                'days',
                'class',
                'semesters',
                'years',
                'skills',
                'session_years_imploded',
                'records'
            ));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }





    public function printMultiple(Request $request)
    {
        $is_print = "yes";

        try {
            // Get the selected exam schedule IDs from the request
            $examScheduleIds = $request->input('examScheduleIds');

            if (empty($examScheduleIds)) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'សូមជ្រើសរើសយ៉ាងហោចណាស់មួយដើម្បីបោះពុម្ព'
                ]);
            }

            // Fetch multiple ExamSchedule records with relationships
            $records = ExamSchedule::with([
                'section',  // Make sure section is included
                'subject',
                'qualification',
                'department',
                'session_year',
                'study_years'
            ])
                ->whereIn('id', $examScheduleIds)
                ->get();

            if ($records->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'មិនមានទិន្នន័យត្រូវបានរកឃើញ'
                ]);
            }

            // Get unique semesters and ensure it's an array
            // $semesters = $records->pluck('semester')->filter()->unique()->values()->toArray();
            // Convert semesters to Khmer numbers
            $semesters = $records->pluck('semester')
                ->filter()
                ->unique()
                ->map(fn($s) => $this->convertToKhmerNumber($s)) // Convert each semester
                ->values()
                ->toArray();

            // Get unique years and ensure it's a collection
            // $years = collect($records->pluck('years')->filter()->unique()->values());
            // Convert years to Khmer numbers
            $years = collect($records->pluck('years'))
                ->filter()
                ->unique()
                ->map(fn($y) => $this->convertToKhmerNumber($y)) // Convert each year
                ->values();


            // Get unique departments with name_2
            $departments = Department::whereIn('code', $records->pluck('department_code')->unique())->get();

            // Get unique timestudys and ensure it's an array of strings
            $timestudys = $records->pluck('timestudy')
                ->filter()
                ->map(function ($item) {
                    if (strpos($item, '[') !== false || strpos($item, ']') !== false) {
                        $decoded = json_decode($item, true);
                        return is_array($decoded) ? $decoded : [$item];
                    } elseif (strpos($item, ',') !== false) {
                        return array_map('trim', explode(',', $item));
                    }
                    return [$item];
                })
                ->flatten()
                ->unique()
                ->values()
                ->toArray();

            // Get session years imploded, with null check
            $session_years_imploded = DB::table('session_year')
                ->whereIn('code', $records->pluck('session_year_code')->filter())
                ->pluck('name')
                ->filter()
                ->unique()
                ->implode(', ') ?: '';

            // Convert to Khmer number if not empty
            if (!empty($session_years_imploded)) {
                $session_years_imploded = $this->convertToKhmerNumber($session_years_imploded);
            }

            // Get the first record as header
            $header = $records->first();

            // Fetch related exam schedule lines
            $record_sub_lines = ExamScheduleLine::whereIn('exam_schedule_id', $examScheduleIds)
                ->with(['subject', 'teacher', 'coTeacher', 'coTeacher1'])
                ->get();

            // Fetch the date names
            $date_name = DB::table('date_name')
                ->orderBy('index', 'asc')
                ->get();

            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            // Group records
            $groupedRecords = $records->groupBy('class_code');

            // Group lines
            $groupedLines = $record_sub_lines->groupBy('exam_schedule_id');

            // Fetch classes
            $classes = DB::table('classes')
                ->whereIn('code', $records->pluck('class_code'))
                ->get()
                ->keyBy('code');

            // Add dates to date_name
            foreach ($date_name as $dataZ) {
                $examSchedule = $record_sub_lines
                    ->where('date_name_code', strtolower(trim($dataZ->code)))
                    ->first();
                $dataZ->date = $examSchedule ? $examSchedule->date : 'N/A';
            }


            try {
                // Render the view with all required variables
                $html = view('general.exams_schedule_print_multiple', compact(
                    'groupedRecords',
                    'groupedLines',
                    'is_print',
                    'date_name',
                    'days',
                    'classes',
                    'semesters',
                    'years',
                    'departments',
                    'timestudys',
                    'session_years_imploded',
                    'header',
                    'records'
                ))->render();

                return response()->json(['status' => 'success', 'html' => $html]);
            } catch (\Exception $viewEx) {
                throw $viewEx;
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'មានបញ្ហាក្នុងការបោះពុម្ព សូមព្យាយាមម្តងទៀត'
            ]);
        }
    }














    public function uploadDocument(Request $request)
    {
        $code = $request->query('code');

        $request->validate([
            'document_exam' => 'required|mimes:pdf|max:10240',
        ]);

        $record = ExamScheduleLine::find($code);

        if (!$record) {
            return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
        }

        try {
            if (!empty($record->document_exam) && file_exists(public_path('storage/' . $record->document_exam))) {
                unlink(public_path('storage/' . $record->document_exam));
            }
            if ($request->hasFile('document_exam') && $request->file('document_exam')->isValid()) {
                $file = $request->file('document_exam');
                $directory = public_path('storage/documents/exam');
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($directory, $filename);
                $filePath = 'documents/exam/' . $filename;
                $record->document_exam = $filePath;
                $record->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'File uploaded successfully',
                    'path' => $filePath,
                ]);
            }
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during file upload. Please try again.',
            ], 500);
        }
    }








    public function getSchedule($id)
    {
        try {
            $scheduleLines = ExamScheduleLine::with([
                'teacher',
                'coTeacher',
                'coTeacher1',
                'subject'
            ])
                ->where('exam_schedule_id', $id)
                ->orderBy('date')
                ->orderBy('is_second_schedule')
                ->get();

            if ($scheduleLines->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'data' => []
                ]);
            }

            // Group schedules by date
            $groupedSchedules = $scheduleLines->groupBy('date')->map(function ($dateGroup) {
                return $dateGroup->groupBy('is_second_schedule');
            });

            $formattedSchedules = [];
            foreach ($groupedSchedules as $date => $sessions) {
                // First session
                if (isset($sessions[0])) {
                    $firstSession = $sessions[0]->first();
                    $formattedSchedules[] = [
                        'date' => $date,
                        'teacher_code' => $firstSession->teacher_code,
                        'co_teacher_code' => $firstSession->co_teacher_code,
                        'co_teacher_code1' => $firstSession->co_teacher_code1,
                        'subjects_code' => $firstSession->subjects_code,
                        'date_name_code' => $firstSession->date_name_code,
                        'start_time' => $firstSession->start_time,
                        'end_time' => $firstSession->end_time,
                        'room' => $firstSession->room,
                        'is_second_schedule' => 0
                    ];
                }

                // Second session
                if (isset($sessions[1])) {
                    $secondSession = $sessions[1]->first();
                    $formattedSchedules[] = [
                        'date' => $date,
                        'teacher_code' => $secondSession->teacher_code,
                        'co_teacher_code' => $secondSession->co_teacher_code,
                        'co_teacher_code1' => $secondSession->co_teacher_code1,
                        'subjects_code' => $secondSession->subjects_code,
                        'date_name_code' => $secondSession->date_name_code,
                        'start_time' => $secondSession->start_time,
                        'end_time' => $secondSession->end_time,
                        'room' => $secondSession->room,
                        'is_second_schedule' => 1
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $formattedSchedules
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getSchedule: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get schedule data'
            ], 500);
        }
    }


    public function getAssignedTeachersAndSubjects($classCode, $year, $sessionYear, $sectionCode, $semester, $level, $skills_code, $department_code)
    {
        try {
            // Get all teachers and subjects assigned to the class
            $query = DB::table('assing_classes as ac')
                ->select(
                    'ac.subjects_code',
                    'ac.teachers_code',
                    's.name AS subject_name',
                    's.name_2 AS subject_name_2',
                    't.name AS teacher_name',
                    't.name_2 AS teacher_name_2'
                )
                ->join('subjects as s', 'ac.subjects_code', '=', 's.code')
                ->join('teachers as t', 'ac.teachers_code', '=', 't.code')
                ->where('ac.class_code', $classCode)
                ->where('ac.years', $year)
                ->where('ac.session_year_code', $sessionYear)
                ->where('ac.sections_code', $sectionCode)
                ->where('ac.semester', $semester)
                ->where('ac.qualification', $level)
                ->where('ac.skills_code', $skills_code)
                ->where('ac.department_code', $department_code)
                ->whereNotNull('ac.subjects_code')
                ->distinct();

            $assignments = $query->get();

            // Format the response
            $formattedData = $assignments->map(function ($item) {
                return [
                    'teachers_code' => $item->teachers_code,
                    'teacher_name' => $item->teacher_name_2 ?? $item->teacher_name,
                    'subjects_code' => $item->subjects_code,
                    'subject_name' => $item->subject_name_2 ?? $item->subject_name
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $formattedData
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getAssignedTeachersAndSubjects', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to load assigned teachers and subjects: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveExamDateKhmer(Request $request)
    {
        try {
            DB::beginTransaction();

            // if (empty($request->date_khmer)) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Date in Khmer is required'
            //     ]);
            // }

            $examScheduleId = $this->services->Decr_string($request->code);

            if (!$examScheduleId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid exam schedule code'
                ]);
            }

            $examDateKhmer = ExamDateKhmer::updateOrCreate(
                ['exam_schedule_id' => $examScheduleId],
                [
                    'date_khmer' => $request->date_khmer,
                    'updated_at' => now()
                ]
            );

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Exam date in Khmer saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving exam date in Khmer: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save exam date in Khmer: ' . $e->getMessage()
            ]);
        }
    }

    public function saveExamDateKhmerMultiple(Request $request)
    {
        try {
            DB::beginTransaction();

            $examScheduleIds = $request->input('examScheduleIds');
            $dateKhmer = $request->input('date_khmer_multiple');

            if (empty($examScheduleIds)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No exam schedules selected'
                ]);
            }

            // Update or create exam date khmer records for each schedule
            foreach ($examScheduleIds as $examScheduleId) {
                ExamDateKhmer::updateOrCreate(
                    ['exam_schedule_id' => $examScheduleId],
                    [
                        'date_khmer' => $dateKhmer,
                        'updated_at' => now()
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Exam dates in Khmer saved successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving exam dates in Khmer: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save exam dates in Khmer: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteSession(Request $request)
    {
        try {
            $examScheduleId = $request->exam_schedule_id;
            $dateNameCode = $request->date_name_code;
            $isSecondSchedule = $request->is_second_schedule;

            Log::info('Attempting to delete schedule:', [
                'exam_schedule_id' => $examScheduleId,
                'date_name_code' => $dateNameCode,
                'is_second_schedule' => $isSecondSchedule
            ]);

            // Find and delete the specific schedule
            $schedule = ExamScheduleLine::where('exam_schedule_id', $examScheduleId)
                ->where('date_name_code', strtolower($dateNameCode))
                ->where('is_second_schedule', $isSecondSchedule)
                ->first();

            if ($schedule) {
                Log::info('Found schedule to delete:', ['schedule_id' => $schedule->id]);
                $schedule->delete();
                return response()->json(['status' => 'success']);
            }

            Log::warning('Schedule not found for deletion with criteria:', [
                'exam_schedule_id' => $examScheduleId,
                'date_name_code' => $dateNameCode,
                'is_second_schedule' => $isSecondSchedule
            ]);

            return response()->json(['status' => 'error', 'message' => 'Schedule not found']);
        } catch (\Exception $e) {
            Log::error('Delete session error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function deleteBothSessions(Request $request)
    {
        try {
            DB::beginTransaction();

            $examScheduleId = $request->exam_schedule_id;
            $date = $request->date;

            // Delete both first and second sessions for this date
            ExamScheduleLine::where('exam_schedule_id', $examScheduleId)
                ->where('date', $date)
                ->delete();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // public function delete(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $code = $request->code;
    //         $check = Classes::where('code', $code)->first();
    //         if ($check) {
    //             return response()->json(['status' => 'error', 'msg' => 'មិនអាចលុប ថ្នាក់/ក្រុមនេះបានទេមាន ព៍តមានរូចហើយ !']);
    //         }

    //         $records = ExamSchedule::where('code', $code);
    //         $records->delete();

    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         return response()->json(['status' => 'error', 'msg' => $ex->getMessage()]);
    //     }
    // }

    public function getAllTeachers()
    {
        try {
            $subjects = Subjects::select('code', 'name', 'name_2')
                ->orderBy('code', 'asc')
                ->get();
            $teachers = Teachers::select('code', 'name', 'name_2')
                ->orderBy('code', 'asc')
                ->get()
                ->map(function ($teacher) {
                    return [
                        'code' => $teacher->code,
                        'name' => $teacher->name_2 ?? $teacher->name
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data' => $teachers,
                'subjects' => $subjects
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to load teachers data'
            ], 500);
        }
    }
}
