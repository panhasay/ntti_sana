
<style>
    .menu-list ul li a{
     color: #2194ce;
    }
    .titl-main-name{
        font-size: 15px;
        font-family: 'Khmer M1';
    }
    .general-data > th{
        background: #ded9d9;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="welcome-section">
            <h5 class="welcome-title" style="font-size: 20px; color: #2c3e50; margin-bottom: 1rem;">
                <i class="mdi mdi-school me-2" style="color: #3498db;"></i>
                សូមស្វាគមន៍មកកាន់ផ្ទាំងគ្រប់គ្រងគ្រូបង្រៀន
            </h5>
            <hr class="welcome-divider" style="border-color: #3498db; opacity: 0.5; margin: 1rem 0;">
            <h4 class="greeting" style="font-size: 1.2rem; color: #34495e;">
                <span class="text-success" style="font-weight: bold;">ជំរាបសួរស្ដី 
                    @if($record->gender == "ប្រុស")
                        លោកគ្រូ
                    @else
                        អ្នកគ្រូ
                    @endif ,</span> 
                <span style="color: #2980b9; font-weight: 500;">{{ $record ->name_2 ?? $record->name }}</span>
                <span class="wave-emoji" style="font-size: 1.8rem; animation: wave 2s infinite;">👋</span>
            </h4>
        </div>
        <div class="date-time text-end" style="color: #7f8c8d;">
            <div id="currentDate" style="font-size: 1.1rem;"></div>
            <div id="currentTime" style="font-size: 1rem;"></div>
        </div>
    </div>
    <!-- Teacher Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <?php $teacher_code = $record->code; ?>
            <a href="{{ url('/teacher-management-class?code='.$record->code ?? '' ) }}" style="text-decoration: none;">
                <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-body position-relative" style="background: linear-gradient(45deg, #43b1e9, #edbd9d); padding: 1.5rem;">
                        <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                            <i class="mdi mdi-teach" style="font-size: 2.5rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 1rem;">ចំនួនថ្នាក់ដែលត្រូវបង្រៀន</h5>
                        <h2 class="card-text mb-1" style="font-size: 2.5rem; font-weight: bold;">{{ $total_class ?? '' }}</h2>
                        <small class="text-white-50">ឆមាសនេះ</small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="card-body position-relative" style="background: linear-gradient(45deg, #77c5ed, #0083B0); padding: 1.5rem;">
                    <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                        <i class="mdi mdi-calendar-today" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 1rem;">ថ្នាក់ត្រូវបង្រៀនថ្ងៃនេះ</h5>
                    <h2 class="card-text mb-1" style="font-size: 2.5rem; font-weight: bold;">{{ count($assignedClasses) ?? '0'}} 
                        @foreach($assignedClasses as $record)
                            <span style="font-size: 18px;"> 
                                <a  href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}" style="color: #ffff;">{{ $record->class_code }}</a>
                                {{-- <span style="font-size: 12px;">{{ $record->subject->name ?? '' }}</span> --}}
                            </span>
                        @endforeach
                    </h2>
                    <small class="text-white-50">នៅថ្ងៃនេះ</small>
                </div>
            </div>
        </div>

       
        <div class="col-md-3">
            <a href="{{ url('/teacher-management-class?type=schedule&code='.$teacher_code ?? '' ) }}" style="text-decoration: none;">
                <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-body position-relative" style="background: linear-gradient(45deg, #43b1e9, #edbd9d); padding: 1.5rem;">
                        <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                            <i class="mdi mdi-teach" style="font-size: 2.5rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 1rem;">កាលវិភាគបង្រៀន</h5>
                        <div class="card-text mb-1" style="font-size: 25px; font-weight: bold;">
                            @php
                            $khmerDays = [
                                  'sunday' => 'អាទិត្យ',
                                  'monday' => 'ចន្ទ',
                                  'tuesday' => 'អង្គារ',
                                  'wednesday' => 'ពុធ',
                                  'thursday' => 'ព្រហស្បតិ៍',
                                  'friday' => 'សុក្រ',
                                  'saturday' => 'សៅរ៍',
                              ];
                          @endphp
                          @if(count($assignedClasses) > 0)
                            @foreach($assignedClasses as $record)
                                ថ្ងៃ : {{ $khmerDays[strtolower($record->date_name)] ?? $record->date_name }} ...
                            @endforeach
                          @else
                                ថ្ងៃ : ចន្ទ...
                          @endif
                        </div>
                        <small class="text-white-50">ឆមាសនេះ</small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
             <a href="{{ url('/exam-schedule') }}" style="text-decoration: none;">
                <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-body position-relative" style="background: linear-gradient(45deg, #77c5ed, #0083B0); padding: 1.5rem;">
                        <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                            <i class="mdi mdi-calendar-today" style="font-size: 2.5rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 1rem;">កាលវិភាគ កាប្រឡង</h5>
                        <h2 class="card-text mb-1" style="font-size: 2.5rem; font-weight: bold;">{{ count($assignedClasses) ?? '0'}} 
                            @foreach($assignedClasses as $record)
                                <span style="font-size: 18px;"> 
                                    <a  href="{{ url('/exam-schedule') }}" style="color: #ffff;">{{ $record->class_code }}</a>
                                    {{-- <span style="font-size: 12px;">{{ $record->subject->name ?? '' }}</span> --}}
                                </span>
                            @endforeach
                        </h2>
                        <small class="text-white-50">ឆមាសនេះ</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <table>
            <thead class="table table-striped">
               <thead>
                    <tr class="general-data">
                        <th class="text-center" colspan="2">ចន្ទ</th>
                        <th class="text-center" colspan="2">អង្គា</th>
                        <th class="text-center" colspan="2">ពុធ</th>
                        <th class="text-center" colspan="2">ព្រហស្បត៏</th>
                        <th class="text-center" colspan="2">សុក្រ</th>
                        <th class="text-center" colspan="2">សៅរ៏</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-4 col-6">
            <div class="titl-main-name">
            <i class="mdi mdi-format-list-bulleted"></i>
                ការគ្រប់គ្រងការបង្រៀន
            </div>
            <div class="container menu-list">
                <ul>
                    <li><a href="{{ url('manage-academic-work') }}">ប្រព័ន្ធគ្រប់គ្រង កាសិក្សា</a></li>
                    <li><a href="{{ url('attendance/dashboards-attendance') }}">Attendance-អវត្តមាន</a></li>
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
                    <li><a href="{{ url('student/registration') }}">បញ្ជីរាយនាមនិស្សិតដែរចុះឈ្មោះ</a></li>
                    <li><a href="{{ url('student/scholarship') }}">បញ្ជីរាយនាមនិស្សិតអាហារូបករណ៏</a></li>
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
                    <li><a href="{{ url('class-new') }}">និស្សឹតតាម​ ក្រុម</a></li>
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
                    <li><a href="{{ url('report-first-year-student-registration') }}">របាយការក្រុម ដែរលោកគ្រូបង្រៀន</a></li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Class Filter -->
    {{-- <div class="mb-4">
        <div>
            <form class="row align-items-center">
                <div class="col-md-4">
                    <label for="class_select" class="form-label">
                        <i class="mdi mdi-teach me-3"></i>ជ្រើសរើសក្រុម:
                    </label>
                    <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($Classes_history as $record)
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                                {{ isset($record->class_code) ? $record->class_code : '' }} ឆ្នាំទី{{ isset($record->years) ? $record->years : '' }} ឆមាសទី{{ isset($record->semester) ? $record->semester : '' }} មុខវិជ្ជា{{ isset($record->subject->name) ? $record->subject->name : '' }} {{ isset($record->qualification) ? $record->qualification : '' }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end" style="margin-top: 2.3pc;">
                    <button type="button" class="btn btn-primary " onclick="filterTeacherClasses()">
                        <i class="mdi mdi-filter"></i> ស្វែងរក
                    </button>
                </div>
            </form>
        </div>
    </div> --}}
    <!-- Semester and Year Info Card -->
    {{-- <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <div class="card-body position-relative" style="background: linear-gradient(45deg, #FF512F, #DD2476); padding: 1.5rem;">
                    <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                        <i class="mdi mdi-calendar-text" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <h2 class="card-text mb-1" style="font-size: 2rem; font-weight: bold;">ឆមាសទី២</h2>
                    <small class="text-white-50">ឆ្នាំសិក្សាបច្ចុប្បន្ន</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="card-body position-relative" style="background: linear-gradient(45deg, #4B79A1, #283E51); padding: 1.5rem;">
                    <div class="position-absolute" style="top: 0; right: 0; padding: 1rem;">
                        <i class="mdi mdi-calendar-clock" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <h2 class="card-text mb-1" style="font-size: 2rem; font-weight: bold;">ឆ្នាំទី៤</h2>
                    <small class="text-white-50">ឆ្នាំសិក្សាបច្ចុប្បន្ន</small>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Main Content Area -->
    {{-- <div class="row" style="height: calc(100vh - 200px); overflow-y: auto;">
        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-account-group me-2"></i>
                        សិស្សក្នុងថ្នាក់ IT07a
                    </h5>
                    <div class="d-flex align-items-center">
                        <span class="me-3">
                            <i class="mdi mdi-account-multiple"></i>
                            សរុប: 35 នាក់
                        </span>
                        <a href="{{ url('/student') }}" class="btn btn-sm btn-light">
                            <i class="mdi mdi-eye"></i> មើលបញ្ជីសិស្សសរុប
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-star text-warning"></i>
                            សិស្សពូកែប្រចាំថ្នាក់ (Top 5)
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">គោត្តនាម និងនាម</th>
                                    <th scope="col">ភេទ</th>
                                    <th scope="col" class="text-end">ពិន្ទុ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-warning">1</span></td>
                                    <td>សុខ សុខា</td>
                                    <td><span class="badge bg-info"><i class="mdi mdi-gender-male me-1"></i>ប្រុស</span></td>
                                    <td class="text-end"><span class="badge bg-success">98</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">2</span></td>
                                    <td>ស្រី សុភា</td>
                                    <td><span class="badge bg-info"><i class="mdi mdi-gender-female me-1"></i>ស្រី</span></td>
                                    <td class="text-end"><span class="badge bg-success">95</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">3</span></td>
                                    <td>គង់ សុវណ្ណ</td>
                                    <td><span class="badge bg-info"><i class="mdi mdi-gender-male me-1"></i>ប្រុស</span></td>
                                    <td class="text-end"><span class="badge bg-success">93</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">4</span></td>
                                    <td>ឈិន សុខហេង</td>
                                    <td><span class="badge bg-info"><i class="mdi mdi-gender-male me-1"></i>ប្រុស</span></td>
                                    <td class="text-end"><span class="badge bg-success">91</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">5</span></td>
                                    <td>ម៉ៅ សុខលី</td>
                                    <td><span class="badge bg-info"><i class="mdi mdi-gender-female me-1"></i>ស្រី</span></td>
                                    <td class="text-end"><span class="badge bg-success">90</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h6 class="card-subtitle mb-3 text-muted">គណៈកម្មការថ្នាក់</h6>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="mdi mdi-account-star text-warning me-2"></i>
                                    <span>មេប្រធានថ្នាក់</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-3">សុខ សុខា</span>
                                    <span class="badge bg-info"><i class="mdi mdi-gender-male me-1"></i>ប្រុស</span>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="mdi mdi-account-star-outline text-info me-2"></i>
                                    <span>អនុប្រធានថ្នាក់ទី១</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-3">ស្រី សុភា</span>
                                    <span class="badge bg-info"><i class="mdi mdi-gender-female me-1"></i>ស្រី</span>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="mdi mdi-account-star-outline text-info me-2"></i>
                                    <span>អនុប្រធានថ្នាក់ទី២</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-3">គង់ សុវណ្ណ</span>
                                    <span class="badge bg-info"><i class="mdi mdi-gender-male me-1"></i>ប្រុស</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Example -->
        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-calendar me-2"></i>
                        កាលវិភាគប្រឡង
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-link text-white dropdown-toggle" type="button" id="examTypeDropdown" data-bs-toggle="dropdown">
                            <i class="mdi mdi-filter"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-exam-type="all">ទាំងអស់</a></li>
                            <li><a class="dropdown-item" href="#" data-exam-type="semester">ប្រឡងឆមាស</a></li>
                            <li><a class="dropdown-item" href="#" data-exam-type="final">ប្រឡងបញ្ចប់</a></li>
                            <li><a class="dropdown-item" href="#" data-exam-type="monthly">ប្រឡងប្រចាំខែ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <!-- All Exams -->
                    <div id="allExams" class="exam-schedule">
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-primary">Network (ឆមាសទី២)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 201
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី១៥ ខែមករា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-primary px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    7:30 - 9:30
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-danger">C Programming (ប្រឡងបញ្ចប់)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 202
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី២០ ខែមីនា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-danger px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    8:00 - 11:00
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-success">Python (ប្រចាំខែ)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 203
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី៣០ ខែមករា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-success px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    9:00 - 10:00
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Semester Exams -->
                    <div id="semesterExams" class="exam-schedule" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-primary">Network (ឆមាសទី២)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 201
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី១៥ ខែមករា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-primary px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    7:30 - 9:30
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Final Exams -->
                    <div id="finalExams" class="exam-schedule" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-danger">C Programming (ប្រឡងបញ្ចប់)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 202
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី២០ ខែមីនា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-danger px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    8:00 - 11:00
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Exams -->
                    <div id="monthlyExams" class="exam-schedule" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow" style="transition: all 0.3s ease;">
                            <div>
                                <h6 class="mb-1 text-success">Python (ប្រចាំខែ)</h6>
                                <small class="text-muted">
                                    <i class="mdi mdi-door me-1"></i>បន្ទប់៖ 203
                                </small><br>
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar me-1"></i>ថ្ងៃទី៣០ ខែមករា ២០២៤
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-success px-3 py-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    9:00 - 10:00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<script>

    function updateTime() {
        const now = new Date();

        const day = String(now.getDate()).padStart(2, '0');
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const month = monthNames[now.getMonth()];
        const year = now.getFullYear();

        let hour = now.getHours();
        const ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12;
        hour = hour ? hour : 12;
        const minute = String(now.getMinutes()).padStart(2, '0');
        const second = String(now.getSeconds()).padStart(2, '0');

        const formatted = `${day} - ${month} - ${year} ${hour}:${minute}:${second} ${ampm}`;

        $('#realtime').text(formatted);
    }

    $(document).ready(function() {
        updateTime(); 
        setInterval(updateTime, 1000); 
    });
function filterTeacherClasses() {
    const classCode = document.getElementById('class_select').value;
    
    // Make AJAX call to get filtered data
    fetch(`/api/teacher-classes/${classCode}`)
        .then(response => response.json())
        .then(data => {
            updateScheduleDisplay(data.schedule);
            updateTopStudents(data.topStudents);
            updatePendingAssignments(data.pendingAssignments);
        });
}

function updateScheduleDisplay(schedule) {
    const scheduleContainer = document.getElementById('teacherSchedule');
    scheduleContainer.innerHTML = schedule.length ? 
        schedule.map(item => `
            <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded hover-shadow">
                <div>
                    <h6 class="mb-1 text-primary">${item.course_name}</h6>
                    <small class="text-muted">
                        <i class="mdi mdi-door me-1"></i>បន្ទប់៖ ${item.room_no || 'N/A'}
                    </small>
                </div>
                <div class="text-end">
                    <div class="badge bg-primary px-3 py-2">
                        <i class="mdi mdi-clock-outline me-1"></i>
                        ${item.start_time} - ${item.end_time}
                    </div>
                </div>
            </div>
        `).join('') :
        '<div class="alert alert-info m-3" role="alert"><i class="mdi mdi-information me-2"></i>មិនមានថ្នាក់រៀននៅថ្ងៃនេះទេ</div>';
}

// Add event listener to class select
document.getElementById('class_select').addEventListener('change', filterTeacherClasses);
</script>

@include('system.modal_comfrim_delet')
@endsection
