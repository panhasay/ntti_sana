<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\ClassSchedule;
use App\Models\General\AssingClasses;
use App\Models\General\student_score;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use PDF;

class AttendanceController extends Controller
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
        $this->page = "attendance";
        $this->prefix = "attendance";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    //
    private function getTimeSection($time)
    {
        if (!$time) return null;

        $hour = (int) substr($time, 0, 2);

        // Define time ranges for each section
        if ($hour >= 6 && $hour <= 13) {
            return 'Morning';
        } else if ($hour > 13 && $hour < 17) {
            return 'Evening';
        } else {
            return 'Night';  // For hours >= 17 or < 6
        }
    }

    private function getCurrentSection()
    {
        $currentHour = (int) now()->format('H');

        if ($currentHour >= 6 && $currentHour < 13) {
            return 'Morning';
        } else if ($currentHour >= 13 && $currentHour < 18) {
            return 'Evening';
        } else if ($currentHour >= 18 && $currentHour < 21) {
            return 'Night';
        } else {
            return 'Night'; // Or return 'None' if you want to handle outside these ranges differently
        }
    }

    private function extractSectionName($section)
    {
        if (!$section) return null;

        // First decode HTML entities
        $decodedSection = html_entity_decode($section);

        try {
            // Try to parse as JSON
            $sectionData = json_decode($decodedSection, true);
            if (is_array($sectionData) && isset($sectionData['name'])) {
                return $sectionData['name'];
            }
        } catch (\Exception $e) {
            // If JSON parsing fails, return the original section
        }

        return $section;
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        
        $today = $request->date; 
        $sections_code = $request->sections_code; 
        $carbonDate = Carbon::parse($today);
        $nameDay = strtolower($carbonDate->format('l'));

        
        $records = AssingClasses::where('date_name', $nameDay)->where('sections_code', $sections_code)->get();

        $assignNumbers = $records->pluck('assing_no'); // collection of assign numbers
        $studentAtt = student_score::whereIn('assign_line_no', $assignNumbers)
                        ->where('att_date', $today)
                        ->get();
        return view('dashboard.dashboard_attendance_student', compact('records', 'today', 'studentAtt'));
    }

    public function SumbitDocumentByDate(Request $request)
    {
        try {
            $assign_no = $request->input('assing_no');
            $att_date = $request->input('att_date');
            $att_date = Carbon::parse($att_date)->format('Y-m-d');
            $students = student_score::where('assign_line_no', $assign_no)
                ->where('att_date', $att_date)
                ->get();
            // 2. Fetch related class assignment data
            $record = AssingClasses::with(['teacher', 'subject', 'section'])
                ->where('assing_no', $assign_no)
                ->first();

            // 3. Get class info or default to 'N/A'
            $classCode    = $record->class_code ?? 'N/A';
            $teacherName  = $record->teacher->name_2 ?? 'N/A';
            $subjectName  = $record->subject->name ?? 'N/A';
            $sectionName  = $record->section->name_2 ?? 'N/A';

            // 4. Count student statuses
            $total        = $students->count();
            $present      = $students->where('status', 'present')->count();
            $absent       = $students->where('status', 'absent')->count();
            $permission   = $students->where('status', 'permission')->count();
            $late         = $students->where('status', 'late')->count();

            // 5. Compose message
            $message  = "📋 របាយការណ៍អវត្តមានប្រចាំថ្ងៃ ក្រុម $classCode\n";
            $message .= "🕒 ម៉ោងលោកគ្រូ: $teacherName\n";
            $message .= "📚 មុខវិជ្ជា: $subjectName\n";
            $message .= "🕘 វេន: $sectionName\n";
            $message .= "🗓️ ថ្ងៃទី: " . $att_date . "\n";
            $message .= "📝 សរុប: $total\n";
            $message .= "✅ វត្តមាន: $present\n";
            $message .= "❌ អវត្តមាន: $absent\n";
            $message .= "📄 ច្បាប់: $permission\n";
            $message .= "⏰ យឺត: $late\n";
            $message .= "👤 អ្នកហៅអវត្តមាន: " . Auth()->user()->name . "\n";

            $telegramId = "8201275268";
            $telegramToken = "8401740280:AAGDlGSuSNf5xGrw0w0XsRjCuxwjsBnb4BA";

            Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                'chat_id' => $telegramId,
                'text' => $message,
            ]);
            return response()->json([
                'status' => 'success',
                'msg' => 'បានបញ្ជូន PDF និងព័ត៌មានទៅ Telegram',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => $ex->getMessage()
            ]);
        }
    }

    public function SumbitDocumentByDatePDF(Request $request)
    {
        try {
            // 1. Input
            $assign_no = $request->input('assing_no');
            $att_date  = Carbon::parse($request->input('att_date'))->format('Y-m-d');

            // 2. Get students
            $students = student_score::where('assign_line_no', $assign_no)
                ->where('att_date', $att_date)
                ->orderBy('student_code')
                ->get();

            if ($students->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'មិនមានទិន្នន័យអវត្តមាន'
                ]);
            }

            // 3. Class info
            $record = AssingClasses::with(['teacher', 'subject', 'section'])
                ->where('assing_no', $assign_no)
                ->first();

            $data = [
                'students'     => $students,
                'record'       => $record,
                'att_date'     => $att_date,
                'teacherName'  => $record->teacher->name_2 ?? 'N/A',
                'subjectName'  => $record->subject->name ?? 'N/A',
                'sectionName'  => $record->section->name_2 ?? 'N/A',
                'classCode'    => $record->class_code ?? 'N/A',
                'generatedBy'  => auth()->user()->name,
            ];

            // 4. Generate PDF
            $pdf = Pdf::loadView('pdf.attendance-official', $data)
                ->setPaper('A4', 'portrait');

            $fileName = "Attendance_{$assign_no}_{$att_date}.pdf";
            $path = storage_path("app/{$fileName}");
            $pdf->save($path);

            // 5. Send to Telegram
            Http::attach(
                'document',
                file_get_contents($path),
                $fileName
            )->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendDocument", [
                'chat_id' => env('TELEGRAM_CHAT_ID'),
                'caption' => "📋 របាយការណ៍អវត្តមានផ្លូវការ\n📅 ថ្ងៃទី {$att_date}\n👨‍🏫 {$data['teacherName']}",
            ]);

            // 6. Delete file
            @unlink($path);

            return response()->json([
                'status' => 'success',
                'msg' => 'បានផ្ញើរបាយការណ៍ PDF ទៅ Telegram ដោយជោគជ័យ'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    public function getKhmerHolidays()
    {
        $year = Carbon::now()->year;

        $start = Carbon::createFromDate($year, 1, 1)->toIso8601String();
        $end = Carbon::createFromDate($year, 12, 31)->toIso8601String();

        $apiKey = 'AIzaSyBAfyblJkSCHQ0NbhtHgMZAVvYDxs0tO-o';
        $calendarId = 'en.kh%23holiday@group.v.calendar.google.com';

        $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events";

        $response = Http::get($url, [
            'key' => $apiKey,
            'timeMin' => $start,
            'timeMax' => $end,
            'orderBy' => 'startTime',
            'singleEvents' => 'true'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Unable to fetch holidays'];
    }

    public function updateAttendance(Request $request)
    {
        $scoreMap = [
            'present'    => 1,
            'absent'     => 0,
            'permission' => 0.5,
            'late'       => 0.5,
        ];
        $student = student_score::where('student_code', $request->student_code)
            ->where('assign_line_no', $request->assign_no)
            ->where('att_date', $request->att_date)
            ->first();
        if (!$student) {
            $student = new student_score();
            $student->student_code   = $request->student_code;
            $student->assign_line_no = $request->assign_no;
            $student->att_date       = $request->att_date;
        }
        $student->status    = $request->status;
        $student->att_score = $scoreMap[$request->status] ?? 0;
        $student->save();

        $recordsAtt = student_score::where('assign_line_no', $request->assign_no)
            ->where('att_date', $request->att_date)
            ->get();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Attendance saved successfully',
            'att_score' => $student->att_score,
            'records'   => $recordsAtt, // all attendance for that day
        ]);
    }

    public function removeStudent(Request $request)
    {
        $request->validate([
            'assign_no' => 'required',
            'att_date'  => 'required|date',
        ]);

        $query = student_score::where('assign_line_no', $request->assign_no)
            ->where('att_date', $request->att_date);

        if (!$query->exists()) {
            return response()->json(['status' => 'error','msg' => 'រកមិនឃើញទិន្នន័យសិស្ស'], 404);
        }

        $query->delete();
        return response()->json(['status' => 'success','msg'    => 'លុបទិន្នន័យសិស្សបានជោគជ័យ']);
    }
}
