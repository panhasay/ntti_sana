<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        $attendanceData = [
            [
                'teacher' => 'John Doe',
                'subject' => 'Mathematics',
                'emoji' => '📐',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '09:00 AM',
                'checked' => true,
            ],
            [
                'teacher' => 'Jane Smith', 
                'subject' => 'Science',
                'emoji' => '🔬',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '10:30 AM',
                'checked' => false,
            ],
            [
                'teacher' => 'Michael Chen',
                'subject' => 'Physics',
                'emoji' => '⚡️',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '11:30 AM',
                'checked' => true,
            ],
            [
                'teacher' => 'Sarah Wilson',
                'subject' => 'English Literature',
                'emoji' => '📚',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '01:00 PM',
                'checked' => false,
            ],
            [
                'teacher' => 'Robert Garcia',
                'subject' => 'History',
                'emoji' => '🏛',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '02:15 PM',
                'checked' => true,
            ],
            [
                'teacher' => 'Emily Brown',
                'subject' => 'Chemistry',
                'emoji' => '🧪',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '03:30 PM',
                'checked' => false,
            ],
            [
                'teacher' => 'David Kim',
                'subject' => 'Computer Science',
                'emoji' => '💻',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '04:45 PM',
                'checked' => true,
            ],
            [
                'teacher' => 'Lisa Anderson',
                'subject' => 'Art',
                'emoji' => '🎨',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '09:45 AM',
                'checked' => false,
            ],
            [
                'teacher' => 'James Taylor',
                'subject' => 'Music',
                'emoji' => '🎵',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '02:45 PM',
                'checked' => true,
            ],
            [
                'teacher' => 'Maria Rodriguez',
                'subject' => 'Spanish',
                'emoji' => '🌎',
                'avatarUrl' => 'path/to/avatar.jpg',
                'time' => '03:15 PM',
                'checked' => false,
            ],
        ];


        return view('dashboard.dashboard_attendance_student', compact('attendanceData'));
    }
}
