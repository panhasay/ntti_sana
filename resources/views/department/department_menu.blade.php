<style>
    .menu-list ul li a{
     color: #2194ce;
    }
    .titl-main-name{
        font-size: 15px;
        font-family: 'Khmer M1';
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="container">
  <div class="row mt-4">
    <div class="column">
        <div class="effect-9">
            <div class="effect-img">
            <a href="{{ url('/manage-academic-work') }}">
                <img src="https://img.freepik.com/free-vector/online-certification_23-2148576444.jpg?w=740&t=st=1699537366~exp=1699537966~hmac=2900c823bc05a965b57d348773d8c7d7b4c22ceb8fab35ae33afa7302cd12b90" alt="Team Image">
            </a>
            </div>
            <div class="title-department">ប្រព័ន្ធគ្រប់គ្រង កាសិក្សា</div>
        </div>
    </div>
    <div class="column">
        <div class="effect-9">
            <div class="effect-img">
                <a href="{{ url('/class-schedule') }}">
                    <img src="https://img.freepik.com/free-vector/organic-flat-people-business-training-illustration_23-2148901755.jpg?w=996&t=st=1699538720~exp=1699539320~hmac=e469da26591c37b7556bdd7e17fce39370c0b43b3e9cd9a5b61afd38d58a7246" alt="Team Image">
                </a>
            </div>
            <div class="title-department">តារាងបែងចែកម៉ោងបង្រៀន</div>
        </div>
    </div>
    <div class="column">
        <div class="effect-9">
            <div class="effect-img">
                <a href="{{ url('/class-schedule') }}">
                    <img src="https://img.freepik.com/free-vector/secondary-school-isometric-concept-poster_1284-5675.jpg?t=st=1713584493~exp=1713588093~hmac=939546580d44ee53383348f3fd5a4fe12a3e64b162f7883b1c04a47ac0cbe99b&w=740" alt="Team Image">
                </a>
            </div>
            <div class="title-department">ប្រព័ន្ធគ្រប់គ្រងសាលា</div>
        </div>
    </div>
    <div class="column">
        <div class="effect-9">
            <div class="effect-img">
            <a href="{{ url('/class-schedule') }}">
                <img src="https://img.freepik.com/free-vector/flat-hand-drawn-multitask-business-woman_23-2148845328.jpg?t=st=1713584703~exp=1713588303~hmac=4927f2f41e3767ac90324d547bb191a2cce8817ce5d7bdc673974ee266553686&w=996" alt="Team Image">
            </a>
            </div>
            <div class="title-department">ប្រព័ន្ធគ្រប់គ្រងបុគ្គិល</div>
        </div>
    </div>
    <div class="column">
        <div class="effect-9">
            <div class="effect-img">
                <a href="{{ url('/menu-reports') }}">
                     <img src="https://img.freepik.com/free-photo/front-view-graphics-schedules-getting-checked-by-young-lady_140725-16046.jpg?w=996" alt="Team Image">
                </a>
            </div>
            <div class="title-department">ប្រព័ន្ធគ្រប់គ្រងរបាយការណ៍</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-4 col-6">
        <div class="titl-main-name">
        <i class="mdi mdi-format-list-bulleted"></i>
            ការគ្រប់គ្រងទូទៅ
        </div>
        <div class="container menu-list">
            <ul>
                <li><a href="{{ url('department-setup') }}">Department - ដេប៉ាតឺម៉ង់</a></li>
                <li><a href="{{ url('student') }}">Student -សិស្សនិស្សិត</a></li>
                <li><a href="{{ url('users') }}">User Management - អ្នកប្រើប្រាស់</a></li>
                <li><a href="{{ url('classes') }}">Class-ថ្នាក់ / ក្រុម</a></li>
                <li><a href="{{ url('skills') }}">skills-ជំនាញ</a></li>
                <li><a href="{{ url('subject') }}">Subject-មុខវិជ្ជា</a></li>
                <li><a href="{{ url('teachers') }}">Teachers-សាស្ត្រាចារ្យ លោកគ្រូអ្នកគ្រូ</a></li>
                <li><a href="{{ url('attendance') }}">Attendance-អវត្តមាន</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
        <div class="titl-main-name">
        <i class="mdi mdi-format-list-bulleted"></i>
            ព័ត៌មាននិស្សិត
        </div>
        <div class="container menu-list">
            <ul>
                <li><a href="{{ url('student/registration') }}">បញ្ជីរាយនាមនិស្សិតដែរចុះឈ្មោះឆ្នាំទី១</a></li>
                <li><a href="{{ url('student/registration/transaction?type=cr') }}">ចុះឈ្មោះចូលរៀនឆ្នាំទី១</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
        <div class="">
        <i class="mdi mdi-format-list-bulleted"></i>
            គ្រប់គ្រងការសិក្សា
        </div>
        <div class="container menu-list">
            <ul>
                <li><a href="{{ url('class-new') }}">បែងចែកថ្នាក់ថ្មី</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
        <div class="bold">
        <i class="mdi mdi-format-list-bulleted"></i>
            Reports
        </div>
        <div class="container menu-list">
            <ul>
                <li><a href="{{ url('report-first-year-student-registration') }}">ស្ថិតិសិស្សដាក់ពាក្យចុះឈ្មោះចូលរៀនឆ្នាំទី១</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
