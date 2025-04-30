<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\ClassSchedule;
use App\Models\General\AssingClasses;
use App\Models\SystemSetup\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private function getTimeSection($time) {
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

    private function getCurrentSection() {
        $currentHour = (int) now()->format('H');
        
        if ($currentHour >= 6 && $currentHour <= 13) {
            return 'Morning';
        } else if ($currentHour > 13 && $currentHour < 17) {
            return 'Evening';
        } else {
            return 'Night';
        }
    }

    private function extractSectionName($section) {
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
        $classCode = $request->query('class_code');
        $selectedDate = $request->query('date') ? Carbon::parse($request->query('date')) : Carbon::now();
        $selectedDepartment = $request->query('department', 'All Departments');
        
        // Set default section based on current time if not specified in request
        $selectedSection = $request->query('section') ?? $this->getCurrentSection();
        
        // If class code is provided, get the assignment record first
        if ($classCode) {
            $assignment = AssingClasses::where('class_code', $classCode)
                ->first();
                
            if ($assignment) {
                return redirect()->to('/get-attendant-student?assing_no=' . $assignment->assing_no);
            }
        }

        // Get the selected day name in lowercase
        $selectedDay = strtolower($selectedDate->format('l'));
        
        // Get the class schedules and related assignments for the selected date
        $schedules = ClassSchedule::with(['section', 'subject'])
            ->whereDate('start_date', '<=', $selectedDate)
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($schedule) use ($selectedDay, $selectedDepartment, $selectedSection) {
                // Get assignments for this schedule that match selected day
                $assignments = AssingClasses::where('class_schedule_id', $schedule->id)
                    ->where('date_name', $selectedDay)
                    ->with(['teacher', 'subject', 'department'])
                    ->when($selectedDepartment !== 'All Departments', function ($query) use ($selectedDepartment) {
                        $query->whereHas('department', function($q) use ($selectedDepartment) {
                            $q->where('name', $selectedDepartment);
                        });
                    })
                    ->get()
                    ->filter(function ($assignment) use ($selectedSection) {
                        if ($selectedSection === 'All') {
                            return true; // Show all sections
                        }
                        
                        $sectionName = $this->extractSectionName($assignment->section);
                        return strtolower($sectionName) === strtolower($selectedSection);
                    });

                // Split assignments into separate schedule items if multiple exist for same time
                $scheduleItems = collect();
                
                $assignments->each(function($assignment) use ($scheduleItems) {
                    $sectionName = $this->extractSectionName($assignment->section);
                    
                    $scheduleItems->push([
                        'teacher' => $assignment->teacher->name_2 ?? '',
                        'subject' => $assignment->subject->name ?? '',
                        'time' => $assignment->start_time . ' - ' . $assignment->end_time,
                        'room' => $assignment->room,
                        'checked' => (bool) $assignment->status,
                        'assing_no' => $assignment->assing_no,
                        'section' => $sectionName
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

        // Get list of departments
        $departments = Department::pluck('name')->toArray();
        array_unshift($departments, 'All Departments');

        return view('dashboard.dashboard_attendance_student', compact('schedules', 'selectedDate', 'selectedDepartment', 'selectedSection', 'departments'));
    }
    
}
