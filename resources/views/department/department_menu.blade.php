<style>
    .menu-list ul li a {
        color: #2194ce;
    }

    .titl-main-name {
        font-size: 15px;
        font-family: 'Khmer M1';
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/manage-academic-work') }}">
                        <img src="https://img.freepik.com/free-vector/online-certification_23-2148576444.jpg?w=740&t=st=1699537366~exp=1699537966~hmac=2900c823bc05a965b57d348773d8c7d7b4c22ceb8fab35ae33afa7302cd12b90"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">ប្រព័ន្ធគ្រប់គ្រង កាសិក្សា</div>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/class-schedule-index') }}">
                        <img src="https://img.freepik.com/free-vector/organic-flat-people-business-training-illustration_23-2148901755.jpg?w=996&t=st=1699538720~exp=1699539320~hmac=e469da26591c37b7556bdd7e17fce39370c0b43b3e9cd9a5b61afd38d58a7246"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">តារាងបែងចែកម៉ោងបង្រៀន</div>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('certificate/dept-menu/D_IT') }}">
                        <img src="https://img.freepik.com/free-photo/group-grads-cap-gown-with-graduation-certificate_53876-75182.jpg?t=st=1732638232~exp=1732641832~hmac=c353e6852e48656e544f36e333cacd24b9689d1b926d88dca320328b814d79ef&w=740"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់</div>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('exam-schedule') }}">
                        <img src="https://img.freepik.com/free-vector/flat-hand-drawn-multitask-business-woman_23-2148845328.jpg?t=st=1713584703~exp=1713588303~hmac=4927f2f41e3767ac90324d547bb191a2cce8817ce5d7bdc673974ee266553686&w=996"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">កាលវិភាគ កាប្រឡង</div>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/menu-reports') }}">
                        <img src="https://img.freepik.com/free-photo/front-view-graphics-schedules-getting-checked-by-young-lady_140725-16046.jpg?w=996"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">ប្រព័ន្ធគ្រប់គ្រងរបាយការណ៍</div>
            </div>
        </div>

        
    </div>
    <div class="row">
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/up-grade-class') }}">
                        <img src="https://img.freepik.com/free-vector/school-education-isometric-concept_1284-11571.jpg?t=st=1761051495~exp=1761055095~hmac=6cc060bf28fabe28083d911e4559143b7031d3f6218e6b57545dc43f27da413d&w=1480"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">Upgrade​​ Class</div>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/exam-results') }}">
                        <img src="https://img.freepik.com/free-vector/realistic-test-paper-composition-with-pencil-stack-students-paperwork-with-marks-correct-answers_1284-54249.jpg?t=st=1761326162~exp=1761329762~hmac=6c28403f8c025aa43c3c3f99ed7071214be9cd47d4a7b3e07bfd731e5d31ab26&w=1480"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">លទ្ធិផលប្រឡងឆមាសទី</div>
            </div>
        </div>
        <div class="col-12 col-md">
             {{-- <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/class-schedule') }}">
                        <img src="https://img.freepik.com/free-vector/organic-flat-people-business-training-illustration_23-2148901755.jpg?w=996&t=st=1699538720~exp=1699539320~hmac=e469da26591c37b7556bdd7e17fce39370c0b43b3e9cd9a5b61afd38d58a7246"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">តារាងបែងចែកម៉ោងបង្រៀន</div>
            </div> --}}
        </div>
        <div class="col-12 col-md">
             {{-- <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/class-schedule') }}">
                        <img src="https://img.freepik.com/free-vector/organic-flat-people-business-training-illustration_23-2148901755.jpg?w=996&t=st=1699538720~exp=1699539320~hmac=e469da26591c37b7556bdd7e17fce39370c0b43b3e9cd9a5b61afd38d58a7246"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">តារាងបែងចែកម៉ោងបង្រៀន</div>
            </div> --}}
        </div>
        <div class="col-12 col-md">
             {{-- <div class="effect-9">
                <div class="effect-img">
                    <a href="{{ url('/class-schedule') }}">
                        <img src="https://img.freepik.com/free-vector/organic-flat-people-business-training-illustration_23-2148901755.jpg?w=996&t=st=1699538720~exp=1699539320~hmac=e469da26591c37b7556bdd7e17fce39370c0b43b3e9cd9a5b61afd38d58a7246"
                            alt="Team Image">
                    </a>
                </div>
                <div class="title-department">តារាងបែងចែកម៉ោងបង្រៀន</div>
            </div> --}}
        </div>
    </div>
    @if(Auth::user()->role == "admin")
        <div class="row">
            <div class="col-md-3 col-sm-4 col-6">
                <div class="titl-main-name">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    ការគ្រប់គ្រងទូទៅ
                </div>
                <div class="container p-0 p-lg-3 menu-list">
                    <ul>
                        <li><a href="{{ url('department-setup') }}">ដេប៉ាតឺម៉ង់</a></li>
                        {{-- <li><a href="{{ url('student') }}">Student -សិស្សនិស្សិត</a></li> --}}
                        <li><a href="{{ url('users') }}">អ្នកប្រើប្រាស់</a></li>
                        <li><a href="{{ url('classes') }}">ថ្នាក់ / ក្រុម</a></li>
                        <li><a href="{{ url('skills') }}">ជំនាញ</a></li>
                        <li><a href="{{ url('subject') }}">មុខវិជ្ជា</a></li>
                        <li><a href="{{ url('teachers') }}">សាស្ត្រាចារ្យ លោកគ្រូអ្នកគ្រូ</a></li>
                        <li><a href="{{ url('attendance/dashboards-attendance') }}">អវត្តមាន</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <div class="titl-main-name">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    ព័ត៌មាននិស្សិត
                </div>
                <div class="container p-0 p-lg-3 menu-list">
                    <ul>
                        <li><a href="{{ url('student/registration/transaction?type=cr') }}">បញ្ជូលទិន្នន័យ​ ព័ត៌មាននិស្សិត</a></li>
                        <li><a href="{{ url('student/registration') }}">បញ្ជីឈ្មោះ ព័ត៌មាននិស្សិត</a></li>
                        <li><a href="{{ url('class-new') }}">ទិន្នន័យ​ និស្សិតតាមក្រុមថ្នាក់</a></li>

                        <li><a href="{{ url('student/scholarship') }}">និស្សិតអាហារូបករណ៏</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <div class="">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    គ្រប់គ្រងការសិក្សា
                </div>
                <div class="container p-0 p-lg-3 menu-list">
                    <ul>
                        <li><a href="{{ url('exam-schedule') }}">កាលវិភាគ កាប្រឡង</a></li>
                        <li><a href="{{ url('transfer') }}">ផ្លាស់ប្ដូរថ្នាក់/ក្រុម</a></li>
                        <li><a href="{{ url('certificate/D_IT/student_card/MD_CARD') }}">ប្រព័ន្ធគ្រប់គ្រងកាតសិស្ស</a></li>
                        <li><a href="{{ url('exam-credit') }}">បញ្ជីរាយនាមវត្តមានប្រចាំខែ</a></li>
                        <li><a href="{{ url('exam-credit/semester-att-list') }}">បញ្ជីរាយនាមវត្តមានប្រចាំឆមាស</a></li>
                        <li><a href="{{ url('retake-exam') }}">បញ្ជីរាយនាមនិស្សិតប្រឡងសង</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <div class="bold">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    របាយការណ៏
                </div>
                <div class="container p-0 p-lg-3 menu-list">
                    <ul>
                        <li><a href="{{ url('/report-first-year-student-registration') }}">របាយការចុះឈ្មោះចូលរៀនឆ្នាំទី១</a>
                        </li>
                        <li><a href="{{ url('/report_list_of_student_class_and_section') }}">របាយការណ៍និស្សិត ក្រុម
                                និងវេនសិក្សា</a></li>
                        <li><a href="{{ url('/report_list_of_student_class_and_section') }}">របាយការណ៍និស្សិត ក្រុម
                                និងវេនសិក្សា</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @else
    <div>
       
    </div>
    @endif
     <br><br><br><br><br><br><br><br><br><br><br><br>
@endsection