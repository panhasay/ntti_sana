<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\ClassSchedule;
use App\Models\General\AssingClasses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classCode = $request->query('class_code');
        
        // If class code is provided, get the assignment record first
        if ($classCode) {
            $assignment = AssingClasses::where('class_code', $classCode)
                ->first();
                
            if ($assignment) {
                return redirect()->to('/get-attendant-student?assing_no=' . $assignment->assing_no);
            }
        }

        // Get today's day name in lowercase
        $today = strtolower(Carbon::now()->format('l'));
        
        // Get the class schedules and related assignments for today
        $schedules = ClassSchedule::with(['section', 'subject'])
            ->whereDate('start_date', '<=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($schedule) use ($today) {
                // Get assignments for this schedule that match today
                $assignments = AssingClasses::where('class_schedule_id', $schedule->id)
                    ->where('date_name', $today)
                    ->with(['teacher', 'subject'])
                    ->get();

                // Split assignments into separate schedule items if multiple exist for same time
                $scheduleItems = collect();
                
                $assignments->each(function($assignment) use ($scheduleItems) {
                    $scheduleItems->push([
                        'teacher' => $assignment->teacher->name_2 ?? '',
                        'subject' => $assignment->subject->name ?? '',
                        'time' => $assignment->start_time . ' - ' . $assignment->end_time,
                        'room' => $assignment->room,
                        'checked' => (bool) $assignment->status,
                        'assing_no' => $assignment->assing_no
                    ]);
                });

                // Format the schedule data
                return [
                    'class_code' => $schedule->class_code,
                    'section' => $schedule->section->name ?? '',
                    'start_date' => $schedule->start_date,
                    'schedule_items' => $scheduleItems->toArray()
                ];
            })
            ->filter(function ($schedule) {
                return !empty($schedule['schedule_items']);
            })
            ->values();

        return view('dashboard.dashboard_attendance_student', compact('schedules'));
    }
}
