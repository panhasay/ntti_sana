<style>
    .menu-list ul li a {
        color: #2194ce;
    }

    .dashboard-stat {
        height: 110px;
        border-radius: 7px;
    }

    .ColumnChart {
        margin-bottom: 100px;
    }

    .titl-main-name {
        font-size: 15px;
        font-family: 'Khmer OS Battambang', Arial, sans-serif;
    }

    .nav {
        font-weight: bold;
        font-size: 18px;
        font-family: 'Khmer Moul', Arial, sans-serif;
    }

    .card-counter {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 10px;
        color: #fff;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 10px 10px 0px 0px;
        transition: .3s linear all;
    }

    .card-counter:hover {
        box-shadow: 4px 4px 20px #DADADA;
        transition: .3s linear all;
    }

    .card-counter i {
        font-size: 10px !important;
        opacity: 0.2 !important;
        position: absolute !important;
        color: #ffffff !important;
        top: 20px !important;
        right: 20px !important;
    }

    .card-counter .count-numbers {
        font-size: 24px !important;
        font-weight: bold !important;
        margin-bottom: 10px !important;
        display: block !important;
    }

    .card-counter .count-name {
        font-size: 20px !important;
        margin-top: 5px;
    }

    .card-counter.primary {
        background-color: #007bff;
        /* Blue */
    }

    .card-counter.danger {
        background-color: #ff5f5f;
        /* Red */
    }

    .card-counter.success {
        background-color: #28a745;
        /* Green */
    }

    .card-counter.info {
        background-color: #17a2b8;
        /* Cyan */
    }

    .table th,
    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
        line-height: 1;
        white-space: nowrap;
        font-family: 'Khmer OS Battambang';
        padding: 5px;
    }

    .count-numbers a {
        text-decoration: none !important;
        color: #fff !important;
    }

    .card-counter a {
        text-decoration: none !important;
    }

    .menu-list ul li a {
        color: #2194ce;
    }

    .titl-main-name {
        font-size: 15px;
        font-family: 'Khmer M1';
    }

    .about-section {
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .section-title {
        color: #2194ce;
        font-size: 24px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #2194ce;
    }

    .sub-title {
        color: #2c3e50;
        font-size: 20px;
        margin: 20px 0 15px 0;
    }

    .content-text {
        color: #34495e;
        line-height: 1.6;
        text-align: justify;
    }

    .objective-list {
        list-style: none;
        padding-left: 20px;
    }

    .objective-list li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
    }

    .objective-list li:before {
        content: "♦";
        position: absolute;
        left: 0;
        color: #2194ce;
    }

    .banner-section {
        position: relative;
        width: 100%;
        height: 300px;
        margin-bottom: 30px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 20px;
    }

    .stat-item {
        transition: all 0.3s ease;
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-item h4 {
        color: #2194ce;
        font-size: 24px;
        font-weight: bold;
    }

    .stat-item small {
        color: #666;
        font-size: 14px;
    }

    .campus-image-container {
        transition: all 0.3s ease;
    }

    .campus-image-container:hover {
        transform: scale(1.02);
    }

    /* Hero Banner */
    .hero-banner {
        height: 500px;
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 40px;
    }

    .hero-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 20px;
    }

    /* Quick Stats */
    .quick-stats {
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2194ce;
        margin-bottom: 10px;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
    }

    /* Content Sections */
    .content-section {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        color: #2194ce;
        font-size: 1.8rem;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #2194ce;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 10px;
        font-size: 24px;
    }

    /* Contact Info */
    .contact-info {
        background: linear-gradient(45deg, #2194ce, #43b1e9);
        color: white;
        border-radius: 20px;
        padding: 30px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(5px);
    }

    .contact-item i {
        font-size: 24px;
        margin-right: 15px;
    }

    /* Facilities Grid */
    .facility-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .facility-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .facility-item:hover {
        background: #e9ecef;
        transform: translateY(-3px);
    }

    .staff-chart {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-top: 30px;
    }

    .staff-chart img {
        transition: transform 0.3s ease;
    }

    .staff-chart img:hover {
        transform: scale(1.02);
    }

    .staff-chart h4 {
        color: #2194ce;
        font-weight: 600;
    }

    .org-chart {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin: 30px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .org-chart img {
        transition: transform 0.3s ease;
        max-width: 100%;
        height: auto;
    }

    .org-chart img:hover {
        transform: scale(1.02);
    }

    .org-chart h4 {
        color: #2194ce;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .vision-image {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .vision-image img {
        transition: transform 0.3s ease;
        max-width: 100%;
        height: auto;
    }

    .vision-image img:hover {
        transform: scale(1.02);
    }

    .objectives-container {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .objective-list {
        list-style: none;
        padding-left: 0;
    }

    .objective-list li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .objective-list li:before {
        content: "♦";
        position: absolute;
        left: 0;
        color: #2194ce;
    }

    .mission-container {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .mission-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .mission-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        align-items: flex-start;
        transition: all 0.3s ease;
    }

    .mission-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .mission-icon {
        font-size: 24px;
        color: #2194ce;
        margin-right: 15px;
        margin-top: 3px;
    }

    .mission-statement {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 10px;
        margin-top: 20px;
        border-left: 4px solid #2194ce;
    }

    .mission-statement p {
        color: #34495e;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .sub-title {
        color: #2194ce;
        font-size: 1.5rem;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(33, 148, 206, 0.1);
    }

    .leadership-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .leadership-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .leadership-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border: 4px solid #2194ce;
        transition: all 0.3s ease;
    }

    .leadership-image-sm {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 3px solid #2194ce;
        transition: all 0.3s ease;
    }

    .leadership-info {
        padding: 15px;
    }

    .contact-details {
        font-size: 0.9rem;
        color: #666;
    }

    .contact-details i {
        color: #2194ce;
    }

    /* Slideshow styles */
    .slideshow-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .slide {
        position: absolute;
        width: 100%;
        height: 100%;
        transition: transform 0.8s ease-in-out;
        display: none;
    }

    .slide.active {
        display: block;
    }

    .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Slide animations */
    .slide-left {
        transform: translateX(-100%);
    }

    .slide-right {
        transform: translateX(100%);
    }

    .slide-center {
        transform: translateX(0);
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: auto;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 24px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        background-color: rgba(0, 0, 0, 0.3);
        text-decoration: none;
        z-index: 2;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Dots/circles */
    .dots-container {
        position: absolute;
        bottom: 20px;
        width: 100%;
        text-align: center;
        z-index: 2;
    }

    .dot {
        cursor: pointer;
        height: 12px;
        width: 12px;
        margin: 0 4px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }
</style>

@extends('app_layout.app_layout')
@section('content')
    <section id="tabs" class="project-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="Student-tab" data-toggle="tab" href="#Student"
                                role="tab" aria-controls="Student" aria-selected="true">ព័ត៌មានអំពី និស្សិត
                            </a>
                            {{-- <a class="nav-item nav-link" id="info-teacher-tab" data-toggle="tab" href="#info-teacher"
                                role="tab" aria-controls="info-teacher" aria-selected="false">ព័ត៍មាន​ សាស្រ្តាចារ្យ
                            </a> --}}
                            <a class="nav-item nav-link" id="info-schools-tab" data-toggle="tab" href="#info-schools"
                                role="tab" aria-controls="info-schools" aria-selected="false">ព័ត៌មានអំពី
                                វិទ្យាស្ថាន</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="Student" role="tabpanel" aria-labelledby="Student-tab">
                            <div class="row">
                                <div class="container">
                                    <div class="row" style="--bs-gutter-x: -5px;">
                                        <div class="col-md-3">
                                            <div class="card-counter primary">
                                                <i class="fa fa-code-fork"></i>
                                                <span class="count-numbers">វេន សិក្សា</span>
                                                @foreach ($sections as $datas)
                                                    <span class="count-name">{{ $datas->name_2 ?? '' }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-counter danger">
                                                <a href="{{ url('skills') }}">
                                                    <i class="fa fa-ticket"></i>
                                                    <span class="count-numbers">
                                                        {{ \App\Service\Service::convertToKhmerNumber($total_skill ?? '') }}
                                                    </span>
                                                    <span class="count-name">ជំនាញ</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-counter success">
                                                <a href="{{ url('/classes') }}">
                                                    <i class="fa fa-home"></i>
                                                    <span class="count-numbers">
                                                        {{ \App\Service\Service::convertToKhmerNumber($total_class ?? '') }}
                                                    </span>
                                                    <span class="count-name">ថ្នាក់</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-counter info">
                                                <a href="{{ url('/student/registration') }}">
                                                    <i class="fa fa-users"></i>
                                                    <span class="count-numbers">
                                                        {{ \App\Service\Service::convertToKhmerNumber($total_students ?? '') }}
                                                    </span>
                                                    <span class="count-name">សិស្សសរុប</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <!--Department list table -->
                            <div class="row p-2 border">
                                <div class="col-4">
                                    <div class="table-responsive custom-data-table-wrapper2">
                                        <table class="table table-bordered custom-data-table">
                                            <thead class="text-nowrap">
                                                <tr>
                                                    <td class="text-center bold" scope="col">ល.រ</td>
                                                    <td width="5px" class="bold" scope="col">ជំនាញ</td>
                                                    <td class="bold text-right" scope="col">ស្រី</td>
                                                    <td class="bold text-right" scope="col">សរុប</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $index => $result)
                                                    <tr>
                                                        <th class="text-center">{{ $index + 1 }}</th>
                                                        <td>{{ $result->name_2 }}</td>
                                                        <td class="text-right">{{ $result->total_f }}</td>
                                                        <td class="text-right">{{ $result->total_students }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="table-responsive custom-data-table-wrapper2">
                                        <table class="table table-bordered custom-data-table">
                                            <thead class="text-nowrap">
                                                <tr>
                                                    <td class="text-center bold" scope="col">ល.រ</td>
                                                    <td width="5px" class="bold" scope="col">ឆ្នាំសិក្សា</td>
                                                    <td class="bold text-right" scope="col">ស្រី</td>
                                                    <td class="bold text-right" scope="col">សរុប</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($total_students_year as $index => $year)
                                                    <tr>
                                                        <th class="text-center">{{ $index + 1 }}</th>
                                                        <td>{{ $year->year_code }}</td>
                                                        <td class="text-right">{{ $year->total_female_students }}</td>
                                                        <td class="text-right">{{ $year->total_students }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="table-responsive custom-data-table-wrapper2">
                                        <table class="table table-bordered custom-data-table">
                                            <thead class="text-nowrap">
                                                <tr>
                                                    <td class="text-center bold" scope="col">ល.រ</td>
                                                    <td width="5px" class="bold" scope="col">ដេប៉ាតឺម៉ង់</td>
                                                    <td class="bold text-right" scope="col">ស្រី</td>
                                                    <td class="bold text-right" scope="col">សរុប</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $deptIndex = 1; @endphp
                                                @foreach ($total_departments as $department)
                                                    @if ($department->total_students > 0)
                                                        <tr>
                                                            <th class="text-center">{{ $deptIndex++ }}</th>
                                                            <td>{{ $department->department_name }}</td>
                                                            <td class="text-right">{{ $department->total_female_students }}</td>
                                                            <td class="text-right">{{ $department->total_students }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--- Department It --->
                            <div class="row">
                                <div class="col-md-4 border">
                                    <div id="records_student_by_skills" style="width: 500px; height: 400px; ">
                                    </div>
                                </div>
                                <div class="col-md-4 border">
                                    <div id="student_by_year" style="width: 500px; height: 400px; ">
                                    </div>
                                </div>
                                <div class="col-md-4 border">
                                    <div id="student_by_class" style="width: 500px; height: 400px; ">
                                    </div>
                                </div>
                            </div>

                            <br><br>
                            
                             <!--- Chart Province --->
                            <br><br>
                            <div class="ColumnChart mt-2">
                                <div class="row align-items-start">
                                    <div class="col-8 border p-3">
                                        <div id="students_by_province" style="width: auto; height: 400px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="info-schools" role="tabpanel" aria-labelledby="info-schools-tab">
                            {{-- ព័ត៍មាន វិទ្យាស្ថាន --}}
                            <div class="container-fluid py-4">
                                <!-- Hero Banner -->
                                <div class="hero-banner">
                                    <div class="slideshow-container">
                                        <!-- Slides -->
                                        <div class="slide">
                                            <img src="https://www.ntti.edu.kh/assets/images/best_1.jpg"
                                                alt="NTTI Campus 1">
                                        </div>
                                        <div class="slide">
                                            <img src="https://www.ntti.edu.kh/assets/images/best_2.jpg"
                                                alt="NTTI Campus 2">
                                        </div>
                                        <div class="slide">
                                            <img src="https://www.ntti.edu.kh/assets/images/best_3.jpg"
                                                alt="NTTI Campus 3">
                                        </div>
                                        <div class="slide">
                                            <img src="https://www.ntti.edu.kh/assets/images/best_4.jpg"
                                                alt="NTTI Campus 4">
                                        </div>
                                        <div class="slide">
                                            <img src="https://www.ntti.edu.kh/assets/images/best_5.jpg"
                                                alt="NTTI Campus 5">
                                        </div>

                                        <!-- Navigation arrows -->
                                        <a class="prev" onclick="changeSlide(-1)">❮</a>
                                        <a class="next" onclick="changeSlide(1)">❯</a>

                                        <!-- Dots/circles -->
                                        <div class="dots-container">
                                            <span class="dot" onclick="currentSlide(1)"></span>
                                            <span class="dot" onclick="currentSlide(2)"></span>
                                            <span class="dot" onclick="currentSlide(3)"></span>
                                            <span class="dot" onclick="currentSlide(4)"></span>
                                            <span class="dot" onclick="currentSlide(5)"></span>
                                        </div>
                                    </div>
                                    <div class="hero-overlay">
                                        <h1 style="font-size: 3rem; margin-bottom: 1rem;">
                                            វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</h1>
                                        <h2 style="font-size: 2rem;">National Technical Training Institute</h2>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="quick-stats">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="stat-card">
                                                <div class="stat-number">300+</div>
                                                <div class="stat-label">Teacher Trainees</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-card">
                                                <div class="stat-number">1000+</div>
                                                <div class="stat-label">Students</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-card">
                                                <div class="stat-number">116+</div>
                                                <div class="stat-label">Staff Members</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-card">
                                                <div class="stat-number">21+</div>
                                                <div class="stat-label">Departments</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-8">
                                        <!-- About Section -->
                                        <div class="content-section">
                                            <h2 class="section-title">
                                                <i class="mdi mdi-school"></i>
                                                About NTTI
                                            </h2>
                                            <div class="content-text">
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
                                                    (NTTI)
                                                    គឺជាគ្រឹះស្ថានឧត្តមសិក្សាមួយក្នុងចំណោមគ្រឹះស្ថានឧត្តមសិក្សាជាច្រើនរបស់កម្ពុជា
                                                    ដែលផ្តល់ការអប់រំ និងបណ្តុះបណ្តាលបច្ចេកទេស ក្រោមក្រសួងការងារ
                                                    និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ។ ក្នុងឆ្នាំសិក្សា ២០០៩-២០១០ NTTI
                                                    មានសិក្ខាកាមប្រមាណ ៣០០នាក់ ដែលកំពុងចូលរួមវគ្គបណ្តុះបណ្តាលគ្រូបច្ចេកទេស
                                                    និងសិស្សជាង ១០០០នាក់
                                                    ដែលកំពុងបន្តការសិក្សាថ្នាក់បរិញ្ញាបត្រក្នុងវិស័យវិស្វកម្មសំណង់ស៊ីវិល
                                                    វិស្វកម្មអគ្គិសនី អេឡិចត្រូនិច ស្ថាបត្យកម្ម និងបច្ចេកវិទ្យាព័ត៌មាន។
                                                    ជាងនេះទៅទៀត វាក៏ផ្តល់នូវកម្មវិធីសិក្សាខ្លីៗក្នុង Auto CAD, Surveying,
                                                    Basic Computer និងកម្មវិធីជាច្រើនទៀត។</p>
                                            </div>
                                        </div>
                                        <div class="content-section">
                                            <h2 class="section-title">
                                                <i class="mdi mdi-account-group"></i>
                                                Employee Profile
                                            </h2>
                                            <div class="content-text">
                                                <p>បរិយាកាសកម្លាំងការងារនៅ NTTI គឺជាកន្លែងដែលមានភាពស្វាហាប់ រួមបញ្ចូល
                                                    និងប្រកបដោយភាពច្នៃប្រឌិត ដែលជំរុញកំណើនអាជីព
                                                    និងកិច្ចសហការក្នុងចំណោមបុគ្គលិករបស់ខ្លួន។ NTTI
                                                    ប្តេជ្ញាផ្តល់ឱកាសបណ្តុះបណ្តាល និងអភិវឌ្ឍន៍ដល់បុគ្គលិករបស់ខ្លួន
                                                    ដែលអាចឱ្យពួកគេបន្តទៅមុខក្នុងវិស័យរៀងៗខ្លួន។</p>

                                                <p class="mt-3">NTTI មានបុគ្គលិកពេញម៉ោងចំនួន 116 នាក់ (ស្រី 34 នាក់)
                                                    ជាមួយនឹងភាពខុសគ្នានៃគុណវុឌ្ឍិកម្រិតឧត្តមសិក្សា រួមមាន បណ្ឌិត អនុបណ្ឌិត
                                                    បរិញ្ញាបត្រ និងបរិញ្ញាបត្ររង ហើយត្រូវបានគាំទ្រដោយបុគ្គលិកផ្នែករដ្ឋបាល
                                                    ការថែទាំ និងតាមកិច្ចសន្យា។ ក្រៅពីនេះ
                                                    ពួកគេមួយចំនួនត្រូវបានបញ្ជូនទៅសហរដ្ឋអាមេរិក អូស្ត្រាលី រុស្សី ជប៉ុន ឥណ្ឌា
                                                    ថៃ ឥណ្ឌូនេស៊ី ម៉ាឡេស៊ី ប្រ៊ុយណេ ដារូសាឡឹម សិង្ហបុរី វៀតណាម ឡាវ ហ្វីលីពីន
                                                    និងមីយ៉ាន់ម៉ា ដើម្បីបន្តការសិក្សាថ្នាក់បរិញ្ញាបត្រ
                                                    និងចូលរួមកម្មវិធីវគ្គខ្លី។</p>

                                                <p class="mt-3">លើសពីនេះ
                                                    វិទ្យាស្ថានរក្សាបាននូវបណ្តាញទំនាក់ទំនងយ៉ាងទូលំទូលាយជាមួយក្រុមហ៊ុនសំណង់កម្ពុជា
                                                    និងអន្តរជាតិ ក្រុមហ៊ុនអគ្គិសនី គ្រឹះស្ថានអប់រំឯកជន និងសាធារណៈ
                                                    សាកលវិទ្យាល័យបរទេស និងក្រសួងរដ្ឋាភិបាល។ NTTI ដែលមានផ្ទៃដី១០ហិចតា
                                                    មានទីតាំងនៅតាមបណ្តោយមហាវិថីសហព័ន្ធរុស្សី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ
                                                    រាជធានីភ្នំពេញ និងមានចម្ងាយប្រហែល៦គីឡូម៉ែត្រពីកណ្តាលក្រុងវត្តភ្នំ។</p>

                                                <div class="staff-chart mt-4">
                                                    <h4 class="text-center mb-3">Figure A1: NTTI Full-time Staff
                                                        Qualification (n=116)</h4>
                                                    <div class="text-center">
                                                        <img src="https://www.ntti.edu.kh/assets/images/graph_staff.png"
                                                            alt="NTTI Staff Qualification Chart"
                                                            class="img-fluid rounded shadow-sm"
                                                            style="max-width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Vision, Mission and Objectives -->
                                        <div class="content-section">
                                            <h2 class="section-title">
                                                <i class="mdi mdi-eye"></i>
                                                Vision, Mission & Objectives
                                            </h2>
                                            <div class="content-text">
                                                <!-- Vision Image -->
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <div class="vision-image text-center mb-4">
                                                            <img src="https://www.ntti.edu.kh/assets/images/vmg.png"
                                                                alt="NTTI Vision Mission Goals"
                                                                class="img-fluid rounded shadow-sm">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Mission Statement -->
                                                <div class="mission-container">
                                                    <h3 class="sub-title">Our Mission</h3>
                                                    <div class="mission-content">
                                                        <div class="mission-card">
                                                            <i class="mdi mdi-school-outline mission-icon"></i>
                                                            <p>បង្កើតឱកាសសម្រាប់និស្សិតដោយផ្តល់នូវគុណភាពខ្ពស់ និងសមត្ថភាព
                                                                (ទ្រឹស្តី ការអនុវត្ត និងក្រមសីលធម៌) នៃការអប់រំ
                                                                និងបណ្តុះបណ្តាលបច្ចេកទេសវិជ្ជាជីវៈ</p>
                                                        </div>

                                                        <div class="mission-card">
                                                            <i class="mdi mdi-certificate-outline mission-icon"></i>
                                                            <p>ផ្តល់ការបណ្តុះបណ្តាលបច្ចេកទេស និងវិជ្ជាជីវៈពិសេសមួយ
                                                                ដើម្បីរៀបចំពួកគេឱ្យស្ថិតក្នុងជំនាញបច្ចេកទេស
                                                                ដើម្បីចូលទៅក្នុងតម្រូវការបច្ចុប្បន្ន
                                                                និងអនាគតនៃទីផ្សារការងារ។</p>
                                                        </div>

                                                        <div class="mission-statement">
                                                            <p>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេសបានប្តេជ្ញាចិត្ត
                                                                ការអភិវឌ្ឍបន្ថែមទៀតជាការអប់រំកម្រិតខ្ពស់ឈានមុខគេ
                                                                ស្ថាប័ននៅកម្ពុជាក្នុងការផ្តល់បច្ចេកទេស និង
                                                                ការអប់រំ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ។ វាត្រូវបានប្តេជ្ញាចិត្ត
                                                                ការផ្តល់វគ្គបណ្តុះបណ្តាលប្រកបដោយគុណភាពស្របតាម
                                                                ប្រព័ន្ធបច្ចេកទេសជាតិដែលអាចបត់បែនបាន និងឆ្លើយតប
                                                                ការអប់រំ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ ដើម្បីបំពេញតម្រូវការរបស់
                                                                គ
                                                                ទីផ្សារការងារ បង្កើតកម្មវិធីសិក្សាផ្អែកលើសមត្ថភាព
                                                                សម្រាប់មជ្ឈមណ្ឌលបច្ចេកទេស និងវិជ្ជាជីវៈនៃប្រទេស
                                                                ការបណ្តុះបណ្តាល និងបង្កើនសមត្ថភាពរបស់គ្រូ និង
                                                                បណ្តុះបណ្តាល រចនា និងផលិតការផ្គត់ផ្គង់សមស្រប
                                                                ធនធានបង្រៀន/រៀន និងក្លាយជាមជ្ឈមណ្ឌលនៃ
                                                                ឧត្តមភាពក្នុងការបណ្តុះបណ្តាលគ្រូក្នុងតំបន់។</p>

                                                            <p class="mt-3">ជាពិសេស NTTI រៀបចំសិស្សទៅ
                                                                ក្លាយជាសមាជិកដ៏មានប្រសិទ្ធភាព និងសកម្មនៃសង្គមកម្ពុជា
                                                                ជាមួយនឹងសមត្ថភាពវិជ្ជាជីវៈក្នុងការអនុវត្ត អភិវឌ្ឍ
                                                                និងពង្រឹងសមត្ថភាព
                                                                ដំណើរការបង្រៀន វិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា។</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Objectives -->
                                                <div class="objectives-container mt-5">
                                                    <h3 class="sub-title">
                                                        គោលបំណងនៃក្រុមប្រឹក្សាភិបាលត្រួតពិនិត្យគុណភាពបណ្តុះបណ្តាល</h3>
                                                    <p class="mb-4">ដើម្បីសម្រេចបាននូវគោលបំណងដែលបានកំណត់របស់ខ្លួន
                                                        គុណភាពបណ្តុះបណ្តាល
                                                        ក្រុមប្រឹក្សាភិបាលបានបំពេញភារកិច្ចដូចខាងក្រោមៈ</p>

                                                    <ul class="objective-list">
                                                        <li>ការបញ្ជូនបុគ្គលិកទៅចូលរួមវគ្គបណ្តុះបណ្តាលនៅបរទេស
                                                            ដូចជា ជប៉ុន សិង្ហបុរី ម៉ាឡេស៊ី ប្រ៊ុយណេ ដារូសាឡឹម ថៃ
                                                            ដើម្បីឱ្យពួកគេអាចអនុវត្តរបស់ពួកគេប្រកបដោយវិជ្ជាជីវៈ និង
                                                            របៀបទទួលខុសត្រូវ</li>
                                                        <li>ផ្តល់វគ្គបណ្តុះបណ្តាល ដើម្បីបង្កើនសមត្ថភាពបង្រៀនរបស់
                                                            បុគ្គលិកបង្រៀនរបស់យើង។</li>
                                                        <li>បង្កើតក្រុមគ្រូបង្រៀនជាន់ខ្ពស់ ដើម្បីត្រួតពិនិត្យ និងផ្តល់ឱ្យ
                                                            មតិកែលម្អលើសមត្ថភាពបង្រៀនរបស់បុគ្គលិក</li>
                                                        <li>បង្កើតក្រុមស្រាវជ្រាវ ដើម្បីប្រមូលព័ត៌មានទាក់ទងនឹង
                                                            តម្រូវការទីផ្សារការងារ</li>
                                                        <li>ធ្វើការអង្កេតតាមដាន ដើម្បីប្រមូលទិន្នន័យអំពីបញ្ហា
                                                            និងប្រសិទ្ធភាពនៃកម្មវិធីបណ្តុះបណ្តាលដែលផ្តល់ជូន</li>
                                                        <li>បង្កើតកម្មវិធីសិក្សាដែលអាចឆ្លើយតបប្រកបដោយប្រសិទ្ធភាព
                                                            ការផ្លាស់ប្តូរយ៉ាងឆាប់រហ័សនៃតម្រូវការទីផ្សារការងារ</li>
                                                        <li>រៀបចំសិក្ខាសាលាដែលមានគោលបំណងជួយដល់និស្សិតបញ្ចប់ការសិក្សា
                                                            ការទទួលបានការងារជាឧទាហរណ៍ សិក្ខាសាលាស្តីពី "ជំនាញស្វែងរកការងារ។
                                                            របៀបសរសេរប្រវត្តិរូបសង្ខេប និង Cover Letter"។</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Organization Structure -->
                                        <div class="content-section">
                                            <h2 class="section-title">
                                                <i class="mdi mdi-sitemap"></i>
                                                Organizational Structure
                                            </h2>
                                            <div class="content-text">
                                                <p>រចនាសម្ព័ន្ធអង្គការរបស់វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
                                                    (NTTI) ត្រូវបានរចនាឡើងដើម្បីធានាបាននូវការគ្រប់គ្រង
                                                    និងប្រតិបត្តិការប្រកបដោយប្រសិទ្ធភាព
                                                    នាយកដ្ឋាន និងមុខងារផ្សេងៗ។ ឋានានុក្រមត្រូវបានដឹកនាំដោយ
                                                    ប្រធាន ឯកឧត្តម លោក​បណ្ឌិត យក់ សុធី និង​រួម​មាន​អនុប្រធាន​បួន​រូប​ម្នាក់ៗ
                                                    ត្រួតពិនិត្យផ្នែកជាក់លាក់នៃការទទួលខុសត្រូវ។</p>

                                                <div class="org-chart mt-4">
                                                    <h4 class="text-center mb-3">NTTI's Organizational Structure</h4>
                                                    <div class="text-center">
                                                        <img src="https://www.ntti.edu.kh/assets/images/org.png"
                                                            alt="NTTI Organizational Structure"
                                                            class="img-fluid rounded shadow-sm"
                                                            style="max-width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Facilities Section -->
                                        <div class="content-section">
                                            <h2 class="section-title">
                                                <i class="mdi mdi-domain"></i>
                                                Our Facilities
                                            </h2>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="https://www.ntti.edu.kh/assets/images/best_6.jpg"
                                                        alt="NTTI Facilities" class="img-fluid rounded mb-3">
                                                    <img src="https://ntti.edu.kh/assets/images/hotnews/36_.jpg"
                                                        alt="NTTI Facilities" class="img-fluid rounded mb-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="facility-grid">
                                                        <div class="facility-item">
                                                            <i class="mdi mdi-desk-lamp mdi-24px mb-2"></i>
                                                            <h4>Classrooms</h4>
                                                        </div>
                                                        <div class="facility-item">
                                                            <i class="mdi mdi-tools mdi-24px mb-2"></i>
                                                            <h4>Workshops</h4>
                                                        </div>
                                                        <div class="facility-item">
                                                            <i class="mdi mdi-flask mdi-24px mb-2"></i>
                                                            <h4>Labs</h4>
                                                        </div>
                                                        <div class="facility-item">
                                                            <i class="mdi mdi-library mdi-24px mb-2"></i>
                                                            <h4>Library</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-4">
                                        <!-- Leadership Team -->
                                        <div class="content-section mt-4">
                                            <h2 class="mb-4 text-primary">Leadership Team</h2>
                                            <div class="leadership-grid">
                                                <!-- Director -->
                                                <div class="leadership-card">
                                                    <div class="text-center mb-3">
                                                        <img src="https://www.ntti.edu.kh/assets/images/director1.png"
                                                            alt="Director NTTI"
                                                            class="leadership-image rounded-circle shadow-sm">
                                                    </div>
                                                    <div class="leadership-info text-center">
                                                        <h4 class="mb-1">His Excellency YOK SOTHY, Ph.D.</h4>
                                                        <p class="text-primary mb-2">DIRECTOR OF NTTI</p>
                                                        <div class="contact-details">
                                                            <p><i class="mdi mdi-phone me-2"></i>012 667 753</p>
                                                            <p><i class="mdi mdi-email me-2"></i>yok.sothy@ntti.edu.kh</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Deputy Directors -->
                                                <div class="row mt-4">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="leadership-card">
                                                            <div class="text-center mb-3">
                                                                <img src="https://www.ntti.edu.kh/assets/images/sub_director1.png"
                                                                    alt="Deputy Director"
                                                                    class="leadership-image-sm rounded-circle shadow-sm">
                                                            </div>
                                                            <div class="leadership-info text-center">
                                                                <h5 class="mb-1">Mr. Mom Somach</h5>
                                                                {{-- <p class="text-primary mb-2">Deputy Director of Administration and Finance</p>
                                                                <div class="contact-details">
                                                                    <p><i class="mdi mdi-phone me-2"></i>012 772 828</p>
                                                                    <p><i class="mdi mdi-email me-2"></i>mom_somach@yahoo.com</p>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="leadership-card">
                                                            <div class="text-center mb-3">
                                                                <img src="https://www.ntti.edu.kh/assets/images/sub_director2.png"
                                                                    alt="Deputy Director"
                                                                    class="leadership-image-sm rounded-circle shadow-sm">
                                                            </div>
                                                            <div class="leadership-info text-center">
                                                                <h5 class="mb-1">Mr. Meas Sarith</h5>
                                                                {{-- <p class="text-primary mb-2">Deputy Director of Education</p>
                                                                <div class="contact-details">
                                                                    <p><i class="mdi mdi-phone me-2"></i>012 567 651</p>
                                                                    <p><i class="mdi mdi-email me-2"></i>meas_sarith@ntti.edu.kh</p>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="leadership-card">
                                                            <div class="text-center mb-3">
                                                                <img src="https://www.ntti.edu.kh/assets/images/sub_director3.png"
                                                                    alt="Deputy Director"
                                                                    class="leadership-image-sm rounded-circle shadow-sm">
                                                            </div>
                                                            <div class="leadership-info text-center">
                                                                <h5 class="mb-1">Mr. Ek Phannarann</h5>
                                                                {{-- <p class="text-primary mb-2">Deputy Director</p>
                                                                <div class="contact-details">
                                                                    <p><i class="mdi mdi-phone me-2"></i>012 957 684</p>
                                                                    <p><i class="mdi mdi-email me-2"></i>ek.phannaran@ntti.edu.kh</p>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="leadership-card">
                                                            <div class="text-center mb-3">
                                                                <img src="https://www.ntti.edu.kh/assets/images/sub_director4.png"
                                                                    alt="Deputy Director"
                                                                    class="leadership-image-sm rounded-circle shadow-sm">
                                                            </div>
                                                            <div class="leadership-info text-center">
                                                                <h5 class="mb-1">Ms. Peng Lakhena</h5>
                                                                {{-- <p class="text-primary mb-2">Deputy Director</p>
                                                                <div class="contact-details">
                                                                    <p><i class="mdi mdi-phone me-2"></i>077 675 727</p>
                                                                    <p><i class="mdi mdi-email me-2"></i>peng.lakhena@yahoo.com</p>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contact-info">
                                            <h2 class="mb-4 text-white">Contact Information</h2>
                                            <div class="contact-item">
                                                <i class="mdi mdi-map-marker"></i>
                                                <div>
                                                    <h5 class="mb-1">Address</h5>
                                                    Russian Blvd, Sangkat Teukthla<br>
                                                    Khan Sensok, Phnom Penh<br>
                                                    CAMBODIA
                                                </div>
                                            </div>
                                            <div class="contact-item">
                                                <i class="mdi mdi-phone"></i>
                                                <div>
                                                    <h5 class="mb-1">Phone</h5>
                                                    023 883 039
                                                </div>
                                            </div>
                                            <div class="contact-item">
                                                <i class="mdi mdi-email"></i>
                                                <div>
                                                    <h5 class="mb-1">Email</h5>
                                                    info@ntti.edu.kh
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Map -->
                                        <div class="content-section mt-4">
                                            <div class="map-container">
                                                <div class="mb-3"
                                                    style="height: 300px; border-radius: 10px; overflow: hidden;">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7817.532321653166!2d104.8778723!3d11.5686141!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951bd8ff5ab0f%3A0x14bf178a46f8f969!2sNational%20Technical%20Training%20Institute%20(NTTI)!5e0!3m2!1sen!2skh!4v1743607604963!5m2!1sen!2skh"
                                                        width="100%" height="100%" style="border:0;"
                                                        allowfullscreen="" loading="lazy">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end ព័ត៍មាន វិទ្យាស្ថាន --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="print" style="display: none">
            <div class="print-content">
            </div>
        </div>
        <div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="btnYes" data-code="" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChartStudentBySkill);

        function drawChartStudentBySkill() {
            var data = google.visualization.arrayToDataTable([
                ['Skill', 'និស្សិតសរុប', { role: 'style' }],
                @php
                    $colors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#9C27B0', '#F44336', '#00BCD4', '#FF9800', '#8BC34A', '#607D8B'];
                    $i = 0;
                @endphp
                @foreach ($results as $result)
                    ['{{ $result->name_2 }}', {{ $result->total_students }}, '{{ $colors[$i++ % count($colors)] }}'],
                @endforeach
            ]);

            var options = {
                fontSize: 14,
                title: 'សិស្សសរុបតាមជំនាញ',
                width: 500,
                height: 400,
                fontFamily: 'Khmer OS Battambang',
                bar: { groupWidth: "60%" },
                legend: { position: "none" },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('records_student_by_skills'));
            chart.draw(data, options);
        }
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'និស្សិតសរុប', { role: 'style' }],
                @php
                    $colors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#9C27B0', '#F44336', '#00BCD4', '#FF9800', '#8BC34A', '#607D8B'];
                    $i = 0;
                @endphp
                @foreach ($data as $item)
                    ['{{ $item->label }}', {{ $item->total_students }}, '{{ $colors[$i++ % count($colors)] }}'],
                @endforeach
            ]);

            var options = {
                fontSize: 14,
                title: 'ចំនួននិស្សិតសរុប តាមឆ្នាំសិក្សា',
                width: 500,
                height: 400,
                fontFamily: 'Khmer OS Battambang',
                bar: { groupWidth: "60%" },
                legend: { position: "none" },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('student_by_year'));
            chart.draw(data, options);
        }
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Department', 'និស្សិតសរុប', { role: 'style' }],
                @php
                    $colors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#9C27B0', '#F44336', '#00BCD4', '#FF9800', '#8BC34A', '#607D8B'];
                    $i = 0;
                @endphp
                @foreach ($total_departments as $result)
                    ['{{ $result->department_name }} សរុប {{ $result->total_students }}', {{ $result->total_students }}, '{{ $colors[$i++ % count($colors)] }}'],
                @endforeach
            ]);

            var options = {
                fontSize: 14,
                title: 'ចំនួននិស្សិតសរុប ដេប៉ាតឺម៉ង់',
                width: 500,
                height: 400,
                fontFamily: 'Khmer OS Battambang',
                bar: { groupWidth: "60%" },
                legend: { position: "none" },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('student_by_class'));
            chart.draw(data, options);
        }
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);
        $(document).ready(function() {
            $(document).on('click', '#prints', function() {
                $(".modal-confirmation-text").html('Do you want to Print?');
                $("#btnYes").attr('data-code', $(this).attr('data-type'));
                $("#divConfirmation").modal('show');
            });
        });
        $(document).on('click', '#btnYes', function() {
            var type = $(this).attr('data-code');
            var url = '/dahhboard-student-print?type=' + type;
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.print-content').printThis({});
                    $('.loader').hide();
                    $("#divConfirmation").modal('hide');
                    $('.print-content').html(response);
                },
                error: function(response) {
                    notyf.error('External Server Error');
                }
            });
        });
        // department it
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(department_it);

        function department_it() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Total", {
                    role: "style"
                }],
                ["ឆ្នាំសិក្សា2021-2022", 347, "#b87333"],
                ["ចំនួនក្រុម/ថ្នាក់", 11, "#b87333"],
                ["ឆ្នាំសិក្សា 2022-2023", 697, "gold"],
                ["ចំនួនក្រុម/ថ្នាក់", 13, "gold"],
                ["ឆ្នាំសិក្សា 2023-2024", 397, "#4285f4"],
                ["ចំនួនក្រុម/ថ្នាក់", 8, "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា : តារាងរបារសរុបចំនួននិស្សិត 2021-2024",
                width: 732,
                height: 500,
                fontFamily: "Khmer OS Battambang", // Set the font family
                fontSize: 12, // Set font size
                bar: {
                    groupWidth: "60%"
                }, // Adjust this value to control bar width and spacing
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("department_it"));
            chart.draw(view, options);
        }

        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(department_it_class);

        function department_it_class() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Total", {
                    role: "style"
                }],
                ["ឆ្នាំសិក្សា2021-2022", 1468, "#b87333"],
                ["ចំនួនក្រុម/ថ្នាក់", 36, "#b87333"],

                ["ឆ្នាំសិក្សា 2022-2023", 1177, "gold"],
                ["ចំនួនក្រុម/ថ្នាក់", 22, "gold"],

                ["ឆ្នាំសិក្សា 2023-2024", , "#4285f4"],
                ["ចំនួនក្រុម/ថ្នាក់", , "#4285f4"],
                // ["វេនព្រឹក", 0, "#4285f4"],
                // ["វេនយប់",  0, "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល : តារាងរបារសរុបចំនួននិស្សិត 2021-2024",
                width: 732,
                height: 500,
                fontFamily: "Khmer OS Battambang", // Set the font family
                fontSize: 12, // Set font size
                bar: {
                    groupWidth: "60%"
                }, // Adjust this value to control bar width and spacing
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("department_it_class"));
            chart.draw(view, options);
        }

        // Student_statistics_by_academic_year ស្ថិតិនិស្សិតតាមឆ្នាំសិក្សា
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(Student_statistics_by_academic_year);

        function Student_statistics_by_academic_year() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],

                @foreach ($total_students_year as $student_year)
                    ['{{ $student_year->year_name ?? '' }}', {{ $student_year->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $student_year->total_female_students }}, '#4285f4'],
                @endforeach

                // ["ឆ្នាំសិក្សា 2021-2022", 3108, "#dc3e27"],
                // ["និស្សិតស្រី", 379, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ឆ្នាំសិក្សា 2022-2023", 5202, "#dc3e27"],
                // ["និស្សិតស្រី", 626, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ឆ្នាំសិក្សា 2023-2024", 480, "#dc3e27"],
                // ["និស្សិតស្រី", 107, "#4285f4"],
                // ["", , "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var options = {
                fontSize: 14, // Set font size
                title: "ស្ថិតិនិស្សិតតាមឆ្នាំសិក្សា",
                width: 732,
                height: 600,
                fontFamily: 'Khmer OS Battambang', // Set the font family
                bar: {
                    groupWidth: "10%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById("Student_statistics_by_academic_year"));
            chart.draw(view, options);
        }

        // records_student_by_skills ស្ថិតិនិស្សិតតាមជំនាញ
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(records_student_by_skills_barChart);

        function records_student_by_skills_barChart() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],

                @foreach ($results as $result)
                    ['{{ $result->name_2 ?? '' }}', {{ $result->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $result->total_f }}, '#4285f4'],
                @endforeach

                // ["ជំនាញ បរិក្ខារត្រជាក់", 108, "#dc3e27"],
                // ["និស្សិតស្រី", 0, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ជំនាញ ព័ត៌មានវិទ្យា", 836, "#dc3e27"],
                // ["និស្សិតស្រី", 184, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ជំនាញ សំណង់ស៊ីវិល", 2432, "#dc3e27"],
                // ["និស្សិតស្រី", 265, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ជំនាញ ស្ថាបត្យកម្ម", 275, "#dc3e27"],
                // ["និស្សិតស្រី", 136, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ជំនាញ អគ្គិសនី", 3480, "#dc3e27"],
                // ["និស្សិតស្រី", 302, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ជំនាញ អេឡិចត្រូនិច", 15, "#dc3e27"],
                // ["និស្សិតស្រី", 3, "#4285f4"],
                // ["", , "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var options = {
                fontSize: 14, // Set font size
                title: "ស្ថិតិនិស្សិតតាមជំនាញ",
                width: 732,
                height: 600,
                fontFamily: 'Khmer OS Battambang', // Set the font family
                bar: {
                    groupWidth: "80%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById("records_student_by_skills_barChart"));
            chart.draw(view, options);
        }

        // records_student_by_departmentស្ថិតិនិស្សិតតាមដេម៉ាតដេម៉ង់
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(records_student_by_department_barChart);

        function records_student_by_department_barChart() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],

                @foreach ($total_departments as $departments)
                    ['{{ $departments->department_name ?? '' }}', {{ $departments->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $departments->total_female_students }}, '#4285f4'],
                @endforeach


                // ["ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា", 946, "#dc3e27"],
                // ["និស្សិតស្រី", 179, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល", 3052, "#dc3e27"],
                // ["និស្សិតស្រី", 426, "#4285f4"],
                // ["", , "#4285f4"],
                // ["ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិច", 3411, "#dc3e27"],
                // ["និស្សិតស្រី", 303, "#4285f4"],
                // ["", , "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var options = {
                fontSize: 14, // Set font size
                title: "ស្ថិតិនិស្សិតតាមដេប៉ាតឺម៉ង់",
                width: 732,
                height: 650,
                fontFamily: 'Khmer OS Battambang', // Set the font family
                bar: {
                    groupWidth: "40%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById(
                "records_student_by_department_barChart"));
            chart.draw(view, options);
        }

        //student_Department_Class ស្ថិតិនិស្សិតតាមក្រុម
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(student_Department_Class);

        function student_Department_Class() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],

                @foreach ($total_results as $bb)
                    [
                        "{{ $bb->name_2 }}",
                        {{ $bb->total_studentss }},
                        '#dc3e27'
                    ],
                    ["វេនព្រឹក", {{ $bb->mm_1 }}, '#4285f4'],
                    ["វេនរសៀល", {{ $bb->aa_1 }}, '#4285f4'],
                    ["វេនយប់", {{ $bb->nn_1 }}, '#4285f4'],
                @endforeach
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2]);

            var options = {
                fontSize: 14,
                title: "ស្ថិតិនិស្សិតតាមក្រុម",
                width: 732,
                height: 650,
                fontFamily: 'Khmer OS Battambang',
                bar: {
                    groupWidth: "80%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.BarChart(document.getElementById("student_Department_Class"));
            chart.draw(view, options);
        }

        //Students_by_level ស្ថិតិនិស្សិតតាមកម្រិត
        // google.charts.load("current", {
        //     packages: ['corechart']
        // });
        google.charts.setOnLoadCallback(Students_by_level);

        function Students_by_level() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],
                ["", 385, "#4285f4"],
                ["ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល", 45, "#f7c77c"],
                ["", 100, "#f78900"],
                ["", , "#4285f4"],
                ["", 385, "#4285f4"],
                ["ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិច", 45, "#f7c77c"],
                ["", 100, "#f78900"],
                ["", , "#4285f4"],
                ["", 385, "#4285f4"],
                ["ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា", 45, "#f7c77c"],
                ["", 100, "#f78900"],
                ["", , "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var options = {
                title: "ស្ថិតិនិស្សិតតាមកម្រិត",
                width: 800,
                height: 450,
                fontFamily: 'Khmer OS Battambang', // Set the font family
                fontSize: 11.3, // Set font size
                bar: {
                    groupWidth: "60%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById("Students_by_level"));
            chart.draw(view, options);
        }
        //scholarship_students ចំនួននិស្សិត អាហារូបករណ៍ តាមជំនាញ
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(scholarship_students);

        function scholarship_students() {
            var data = google.visualization.arrayToDataTable([
                ['Session', 'Quantity', {
                    role: 'style'
                }],
                ["ជំនាញបរិក្ខារត្រជាក់", 108, "#333"],
                ["និស្សិតស្រី", 0, "#4285f4"],
                ["", , "#4285f4"],
                ["ជំនាញព័ត៌មានវិទ្យា", 836, "#333"],
                ["និស្សិតស្រី", 184, "#4285f4"],
                ["", , "#4285f4"],
                ["ជំនាញសំណង់ស៊ីវិល", 2432, "#333"],
                ["និស្សិតស្រី", 265, "#4285f4"],
                ["", , "#4285f4"],
                ["ជំនាញស្ថាបត្យកម្ម", 275, "#333"],
                ["និស្សិតស្រី", 136, "#4285f4"],
                ["", , "#4285f4"],
                ["ជំនាញអគ្គិសនី", 3480, "#333"],
                ["និស្សិតស្រី", 302, "#4285f4"],
                ["", , "#4285f4"],
                ["ជំនាញអេឡិចត្រូនិច", 15, "#333"],
                ["និស្សិតស្រី", 3, "#4285f4"],
                ["", , "#4285f4"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var options = {
                title: "ស្ថិតិចំនួននិស្សិត អាហារូបករណ៍ តាមជំនាញ",
                width: 800,
                height: 450,
                fontFamily: 'Khmer OS Battambang', // Set the font family
                fontSize: 11.3, // Set font size
                bar: {
                    groupWidth: "60%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById("scholarship_students"));
            chart.draw(view, options);
        }
        //students_by_province ចំនួននិស្សិត តាមខេត្តនិងរាជធានី
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(students_by_province);

        function students_by_province() {
            var data = google.visualization.arrayToDataTable([
                ['Province', 'Quantity', {
                    role: 'style'
                }],
                @foreach ($total_provinces as $province)
                    ['{{ $province->province }}', {{ $province->total_students }}, '#4285f4'],
                @endforeach
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                fontSize: 14,
                title: "ស្ថិតិ ចំនួននិស្សិត តាមខេត្តនិងរាជធានី",
                width: 1500,
                height: 400,
                fontFamily: 'Khmer OS Battambang',
                bar: {
                    groupWidth: "80%"
                },
                legend: {
                    position: "none"
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("students_by_province"));
            chart.draw(view, options);
        }


        // ព័ត៍មាន វិទ្យាស្ថាន
        // Add this script for the date and time display
        document.addEventListener('DOMContentLoaded', function() {
            function updateDateTime() {
                const now = new Date();
                const dateOptions = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const timeOptions = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', dateOptions);
                document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', timeOptions);
            }

            updateDateTime();
            setInterval(updateDateTime, 3000);
        });

        let slideIndex = 1;
        let slideTimer;
        let sliding = false;

        function showSlides(n, direction = 'right') {
            if (sliding) return;
            sliding = true;

            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");

            // Reset slideIndex if it goes beyond bounds
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }

            // Get current and next slide
            let currentSlide = document.querySelector('.slide.active');
            let nextSlide = slides[slideIndex - 1];

            for (let slide of slides) {
                slide.classList.remove('active', 'slide-left', 'slide-right', 'slide-center');
                slide.style.display = 'none';
            }

            // Set up the transition
            if (currentSlide) {
                currentSlide.style.display = 'block';
                currentSlide.classList.add('active');
                currentSlide.classList.add(direction === 'right' ? 'slide-left' : 'slide-right');
            }

            nextSlide.style.display = 'block';
            nextSlide.classList.add('active');
            nextSlide.classList.add(direction === 'right' ? 'slide-right' : 'slide-left');

            // Trigger the transition
            setTimeout(() => {
                nextSlide.classList.remove('slide-left', 'slide-right');
                nextSlide.classList.add('slide-center');
            }, 50);

            // Update dots
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            dots[slideIndex - 1].className += " active";

            // Reset sliding flag after transition
            setTimeout(() => {
                sliding = false;
                if (currentSlide) {
                    currentSlide.classList.remove('active');
                    currentSlide.style.display = 'none';
                }
            }, 800);
        }

        function changeSlide(n) {
            if (sliding) return;
            clearTimeout(slideTimer);
            showSlides(slideIndex += n, n > 0 ? 'right' : 'left');
            autoSlide();
        }

        function currentSlide(n) {
            if (sliding) return;
            clearTimeout(slideTimer);
            showSlides(slideIndex = n);
            autoSlide();
        }

        function autoSlide() {
            slideTimer = setTimeout(() => {
                changeSlide(1);
            }, 5000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            let firstSlide = document.querySelector('.slide');
            firstSlide.classList.add('active', 'slide-center');
            firstSlide.style.display = 'block';
            autoSlide();
        });
    </script>
    </div>
    </div>
@endsection
