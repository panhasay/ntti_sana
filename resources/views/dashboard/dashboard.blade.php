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
        font-size: 10px;
        opacity: 0.2;
        position: absolute;
        color: #ffffff;
        top: 20px;
        right: 20px;
    }
    
    .card-counter .count-numbers {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }
    
    .card-counter .count-name {
        font-size: 14px;
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
    
    .like-dashboard {
        text-decoration: none;
        color: inherit;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
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
    .count-numbers a{
        text-decoration: none !important;
        color: #fff !important;
    }
    </style>
    @extends('app_layout.app_layout')
    @section('content')
    <div class="content-wrapper pb-0">
        <section id="tabs" class="project-tab">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="Student-tab" data-toggle="tab" href="#Student" role="tab" aria-controls="Student" aria-selected="true">ព័ត៏មាន និស្សិត
                                </a>
                                <a class="nav-item nav-link" id="info-teacher-tab" data-toggle="tab" href="#info-teacher" role="tab" aria-controls="info-teacher" aria-selected="false">ព័ត៏មាន​ សាស្រ្តាចារ្យ 
                                </a>
                                <a class="nav-item nav-link" id="info-schools-tab" data-toggle="tab" href="#info-schools" role="tab" aria-controls="info-schools" aria-selected="false">ព័ត៍មាន វិទ្យាស្ថាន</a>
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
                                                    @foreach($sections as $datas)
                                                        <span class="count-name">{{ $datas->name_2 ?? '' }}@if(!$loop->last), @endif</span>
                                                    @endforeach
                                                </div>
                                            </div>
    
                                            <div class="col-md-3">
                                                <div class="card-counter danger">
                                                    <i class="fa fa-ticket"></i>
    
                                                    <span class="count-numbers">
                                                        <a href="{{ url('skills')}}">{{$total_skill ?? ""}}</a>
                                                    </span>
    
                                                    <span class="count-name">Skills</span>
                                                </div>
                                            </div>
    
                                            <div class="col-md-3">
                                                <div class="card-counter success">
                                                    <i class="fa fa-home"></i>
                                                    <span class="count-numbers">
                                                        <a href="{{ url('/classes')}}">{{$total_class ?? ""}}</a>
                                                    </span>
                                                    <span class="count-name">Class</span>
                                                </div>
                                            </div>
    
                                            <div class="col-md-3">
                                                <div class="card-counter info">
                                                    <i class="fa fa-users"></i>
                                                    <span class="count-numbers">
                                                        <a href="{{url('/student')}}">{{$total_students ?? ""}}</a>
                                                    </span>
                                                    <span class="count-name">Students</span>
                                                </div>
                                            </div>
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
                                            <div style="position: relative;">
                                                <div dir="ltr" style="position: relative; width: 500px; height: 400px;">
                                                    <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="500" height="400" aria-label="A chart." style="overflow: hidden;">
                                                            <defs id="_ABSTRACT_RENDERER_ID_1">
                                                                <filter id="_ABSTRACT_RENDERER_ID_13">
                                                                    <feGaussianBlur in="SourceAlpha" stdDeviation="2"></feGaussianBlur>
                                                                    <feOffset dx="1" dy="1"></feOffset>
                                                                    <feComponentTransfer>
                                                                        <feFuncA type="linear" slope="0.1"></feFuncA>
                                                                    </feComponentTransfer>
                                                                    <feMerge>
                                                                        <feMergeNode></feMergeNode>
                                                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                                                    </feMerge>
                                                                </filter>
                                                            </defs>
                                                            <rect x="0" y="0" width="500" height="400" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                            <g><text text-anchor="start" x="96" y="56.2" font-family="Arial" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ចំនួននិស្សិតសរុប តាមឆ្នាំសិស្សា</text>
                                                                <rect x="96" y="46" width="309" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                            </g>
                                                            <g>
                                                                <rect x="306" y="77" width="99" height="194" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                <g column-id="ឆ្នាំសិក្សា 2021-2022សិស្សសរុប3108នាក់ ស្រី379ប្រុស2729 ">
                                                                    <rect x="306" y="77" width="99" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="87.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា</text><text text-anchor="start" x="323" y="103.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">2021-2022សិស្ស</text><text text-anchor="start" x="323" y="119.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សរុប3108នាក់</text><text text-anchor="start" x="323" y="135.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ស្រី379ប្រុស2…</text>
                                                                        <rect x="323" y="77" width="82" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    </g>
                                                                    <circle cx="312" cy="83" r="6" stroke="none" stroke-width="0" fill="#3366cc"></circle>
                                                                </g>
                                                                <g column-id="ឆ្នាំសិក្សា 2022-2023សិស្សសរុប5202នាក់ ស្រី626ប្រុស4576 ">
                                                                    <rect x="306" y="144" width="99" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="154.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា</text><text text-anchor="start" x="323" y="170.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">2022-2023សិស្ស</text><text text-anchor="start" x="323" y="186.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សរុប5202នាក់</text><text text-anchor="start" x="323" y="202.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ស្រី626ប្រុស4…</text>
                                                                        <rect x="323" y="144" width="82" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    </g>
                                                                    <circle cx="312" cy="150" r="6" stroke="none" stroke-width="0" fill="#dc3912"></circle>
                                                                </g>
                                                                <g column-id="ឆ្នាំសិក្សា 2023-2024សិស្សសរុប480នាក់ ស្រី107ប្រុស373 ">
                                                                    <rect x="306" y="211" width="99" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="221.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា</text><text text-anchor="start" x="323" y="237.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">2023-2024សិស្ស</text><text text-anchor="start" x="323" y="253.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សរុប480នាក់</text><text text-anchor="start" x="323" y="269.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ស្រី107ប្រុស373</text></g>
                                                                    <circle cx="312" cy="217" r="6" stroke="none" stroke-width="0" fill="#ff9900"></circle>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <path d="M192,163L192,106A95,95,0,0,1,267.57992434464256,258.5558427621219L222.23196973785704,224.02233710484876A38,38,0,0,0,192,163" stroke="#ffffff" stroke-width="1" fill="#3366cc"></path><text text-anchor="start" x="233.31116975289854" y="176.31120938682307" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">35.4%</text>
                                                            </g>
                                                            <g>
                                                                <path d="M179.21616959247822,165.21489583483483L160.04042398119557,111.53723958708706A95,95,0,0,1,192,106L192,163A38,38,0,0,0,179.21616959247822,165.21489583483483" stroke="#ffffff" stroke-width="1" fill="#ff9900"></path>
                                                            </g>
                                                            <g>
                                                                <path d="M222.23196973785704,224.02233710484876L267.57992434464256,258.5558427621219A95,95,0,1,1,160.04042398119557,111.53723958708706L179.21616959247822,165.21489583483483A38,38,0,1,0,222.23196973785704,224.02233710484876" stroke="#ffffff" stroke-width="1" fill="#dc3912"></path><text text-anchor="start" x="122.07381173267265" y="243.91384790422637" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">59.2%</text>
                                                            </g>
                                                            <g></g>
                                                        </svg>
                                                        <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Task</th>
                                                                        <th>Hours per Day</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>ឆ្នាំសិក្សា 2021-2022សិស្សសរុប3108នាក់ ស្រី379ប្រុស2729 </td>
                                                                        <td>3,108</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ឆ្នាំសិក្សា 2022-2023សិស្សសរុប5202នាក់ ស្រី626ប្រុស4576 </td>
                                                                        <td>5,202</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ឆ្នាំសិក្សា 2023-2024សិស្សសរុប480នាក់ ស្រី107ប្រុស373 </td>
                                                                        <td>480</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div aria-hidden="true" style="display: none; position: absolute; top: 410px; left: 510px; white-space: nowrap; font-family: Arial; font-size: 12px; font-weight: bold;">3,108 (35.4%)</div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border">
                                        <div id="student_by_class" style="width: 500px; height: 400px; ">
                                            <div style="position: relative;">
                                                <div dir="ltr" style="position: relative; width: 500px; height: 400px;">
                                                    <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="500" height="400" aria-label="A chart." style="overflow: hidden;">
                                                            <defs id="_ABSTRACT_RENDERER_ID_2"></defs>
                                                            <rect x="0" y="0" width="500" height="400" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                            <g><text text-anchor="start" x="96" y="56.2" font-family="Arial" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ចំនួននិស្សិតសរុប ដេប៉ាតឺម៉ង់</text>
                                                                <rect x="96" y="46" width="309" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                            </g>
                                                            <g>
                                                                <rect x="306" y="77" width="99" height="194" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                <g column-id="ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យាសិស្សសរុប 946 ">
                                                                    <rect x="306" y="77" width="99" height="44" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="87.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់</text><text text-anchor="start" x="323" y="103.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ព័ត៌មានវិទ្យា</text><text text-anchor="start" x="323" y="119.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សិស្សសរុប 946</text></g>
                                                                    <circle cx="312" cy="83" r="6" stroke="none" stroke-width="0" fill="#3366cc"></circle>
                                                                </g>
                                                                <g column-id="ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិលសិស្សសរុប 3052 ">
                                                                    <rect x="306" y="128" width="99" height="60" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="138.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់</text><text text-anchor="start" x="323" y="154.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">វិស្វកម្មសំណង់</text><text text-anchor="start" x="323" y="170.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ស៊ីវិលសិស្សសរុប</text><text text-anchor="start" x="323" y="186.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">3052</text></g>
                                                                    <circle cx="312" cy="134" r="6" stroke="none" stroke-width="0" fill="#dc3912"></circle>
                                                                </g>
                                                                <g column-id="ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិចសិស្សសរុប 3411 ">
                                                                    <rect x="306" y="195" width="99" height="76" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g><text text-anchor="start" x="323" y="205.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់</text><text text-anchor="start" x="323" y="221.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">វិស្វកម្មអគ្គិសនី</text><text text-anchor="start" x="323" y="237.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និង</text><text text-anchor="start" x="323" y="253.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">អេឡិចត្រូនិច</text><text text-anchor="start" x="323" y="269.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សិស្សសរុប 3411</text></g>
                                                                    <circle cx="312" cy="201" r="6" stroke="none" stroke-width="0" fill="#ff9900"></circle>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <path d="M192,191.5L192,210.5L260.2977825082159,157.67326189461738L260.2977825082159,138.67326189461738" stroke="#264d99" stroke-width="1" fill="#264d99"></path>
                                                                <path d="M192,191.5L192,115.5A95,76,0,0,1,260.2977825082159,138.67326189461738L192,191.5A0,0,0,0,0,192,191.5" stroke="#3366cc" stroke-width="1" fill="#3366cc"></path><text text-anchor="start" x="201.6426717696624" y="147.261679507349" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">12.8%</text>
                                                            </g>
                                                            <g>
                                                                <path d="M168.5977056501749,265.157945099392L168.5977056501749,284.157945099392A95,76,0,0,1,97,210.5L97,191.5A95,76,0,0,0,168.5977056501749,265.157945099392" stroke="#bf7300" stroke-width="1" fill="#bf7300"></path>
                                                                <path d="M192,191.5L192,210.5L168.5977056501749,284.157945099392L168.5977056501749,265.157945099392" stroke="#bf7300" stroke-width="1" fill="#bf7300"></path>
                                                                <path d="M192,191.5L168.5977056501749,265.157945099392A95,76,0,0,1,192,115.5L192,191.5A0,0,0,0,0,192,191.5" stroke="#ff9900" stroke-width="1" fill="#ff9900"></path><text text-anchor="start" x="110.64788702067219" y="189.0102448004066" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">46%</text>
                                                            </g>
                                                            <g>
                                                                <path d="M287,191.5L287,210.5A95,76,0,0,1,168.5977056501749,284.157945099392L168.5977056501749,265.157945099392A95,76,0,0,0,287,191.5" stroke="#a52b0e" stroke-width="1" fill="#a52b0e"></path>
                                                                <path d="M192,191.5L260.2977825082159,138.67326189461738A95,76,0,0,1,168.5977056501749,265.157945099392L192,191.5A0,0,0,0,0,192,191.5" stroke="#dc3912" stroke-width="1" fill="#dc3912"></path><text text-anchor="start" x="230.68311227907688" y="220.60273987323336" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">41.2%</text>
                                                            </g>
                                                            <g></g>
                                                        </svg>
                                                        <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Task</th>
                                                                        <th>Hours per Day</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យាសិស្សសរុប 946 </td>
                                                                        <td>946</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>និស្សិតស្រី</td>
                                                                        <td>179</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល</td>
                                                                        <td>3,052</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>និស្សិតស្រី</td>
                                                                        <td>426</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិច</td>
                                                                        <td>3,411</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>និស្សិតស្រី</td>
                                                                        <td>303</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div aria-hidden="true" style="display: none; position: absolute; top: 410px; left: 510px; white-space: nowrap; font-family: Arial; font-size: 12px;">សិស្សសរុប 3411</div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!--Department civel -->
                                <div class="row p-2 border">
                                    <div class="col-4">
                                        <div class="table-responsive custom-data-table-wrapper2">
                                            <table class="table table-bordered custom-data-table">
                                                <thead class="text-nowrap">
                                                    <tr>
                                                        <td class="bold" scope="col">
                                                            <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="skill"><i class="mdi mdi-printer btn-icon-append"></i>
                                                            </button>
                                                        </td>
                                                        <td widht="5px" class="bold" scope="col">ជំនាញ</td>
                                                        <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                                        <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                                        <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($results as $index => $result)
                                                        <tr>
                                                            <th class="text-center">{{ $index + 1 }} &nbsp;&nbsp;&nbsp;</th>
                                                            <td>{{ $result->name_2 }}</td>
                                                            <td class="text-right">{{ $result->total_f }}</td>
                                                            <td class="text-right">{{ $result->total_m }}</td>
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
                                                        <td class="bold" scope="col">
                                                            <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="year"><i class="mdi mdi-printer btn-icon-append"></i>
                                                            </button>
                                                        </td>
                                                        <td widht="5px" class="bold" scope="col">ឆ្នាំសិក្សា</td>
                                                        <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                                        <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                                        <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                    @foreach($total_students_year as $index => $year)
                                                        <tr>
                                                            <th class="text-center">{{ $index + 1 }}</th>
                                                            <td>ឆ្នាំសិក្សា {{ $year->year_code }}</td>
                                                            <td class="text-right">{{ $year->total_female_students }}</td>
                                                            <td class="text-right">{{ $year->total_male_students }}</td>
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
                                                        <td class="bold" scope="col">
                                                            <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="department"><i class="mdi mdi-printer btn-icon-append"></i>
                                                            </button>
                                                        </td>
                                                        <td widht="5px" class="bold" scope="col">ដេប៉ាតឺម៉ង់</td>
                                                        <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                                        <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                                        <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($total_departments as $index => $department)
                                                        <tr>
                                                            <th class="text-center">{{ $index + 1 }} &nbsp;&nbsp;&nbsp;</th>
                                                            <td>{{ $department->department_name }}</td>
                                                            <td class="text-right">{{ $department->total_female_students }}</td>
                                                            <td class="text-right">{{ $department->total_male_students }}</td>
                                                            <td class="text-right">{{ $department->total_students }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
    
                                            </table>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="barcharts mt-2">
    
                                </div>
    
                                <div class="ColumnChart mt-2">
                                    <div class="row align-items-start">
                                        <div class="col-12 border p-3">
                                            <div id="students_by_province" style="width: 800px; height: 500px;">
                                             
                                            </div>
                                        </div>
                                        <div class="col-4 border p-3">
                                            <div id="" style="width: 1600px; height: 440px;"></div>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                            <div class="tab-pane fade" id="info-teacher" role="tabpanel" aria-labelledby="info-teacher-tab">
                                <!---info-teacher ---->
                                <h2 class="text-center mt-5">Dashbord Teacher proseccsing !</h2>
                                <!--End info-teacher-->
                            </div>
                            <div class="tab-pane fade" id="info-schools" role="tabpanel" aria-labelledby="info-schools-tab">
                                <h2 class="text-center mt-5">Dashbord schools proseccsing </h2>
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
            <div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-m-header">
                            <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-confirmation-text text-center p-4"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                // Prepare the data for Google Charts
                var data = google.visualization.arrayToDataTable([
                    ['Skill', 'Total Students'],
    
                    @foreach($results as $result)
                        ['{{ $result->name_2 }}', {{ $result->total_students }}],
                    @endforeach
                ]);
    
                // Chart options
                var options = {
                    fontSize: 14,// Set font size
                    title: 'សិស្សសរុបតាមជំនាញ',
                    pieHole: 0.4,
                };
    
                // Create the pie chart
                var chart = new google.visualization.PieChart(document.getElementById('records_student_by_skills'));
                chart.draw(data, options);
            }
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawCharts);
    
            function drawCharts() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                @foreach($data as $item)
                    ['{{ $item->label }}', {{ $item->total_students }}],
                @endforeach
            ]);
    
            var options = {
                fontSize: 14,// Set font size
                title: 'ចំនួននិស្សិតសរុប តាមឆ្នាំសិស្សា',
                pieHole: 0.4,
            };
    
            var chart = new google.visualization.PieChart(document.getElementById('student_by_year'));
            chart.draw(data, options);
        }
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);
    
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                @foreach($total_departments as $result)
                    ['{{ $result->department_name }} សិស្សសរុប {{ $result->total_students }}', {{ $result->total_students }}],
                @endforeach
            ]);
    
            var options = {
                fontSize: 14,// Set font size
                title: 'ចំនួននិស្សិតសរុប ដេប៉ាតឺម៉ង់',
                is3D: true,
            };
    
            var chart = new google.visualization.PieChart(document.getElementById('student_by_class'));
            chart.draw(data, options);
        }
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
                        groupWidth: "30%"
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
                        groupWidth: "30%"
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
    
                    @foreach($total_students_year as $student_year)
                    ['{{ $student_year->year_name ?? '' }}', {{ $student_year->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $student_year->total_female_students }}, '#4285f4'],
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
                    fontSize: 14, // Set font size
                    title: "ស្ថិតិនិស្សិតតាមឆ្នាំសិក្សា",
                    width: 732,
                    height: 500,
                    fontFamily: 'Khmer OS Battambang', // Set the font family
                    bar: {
                        groupWidth: "70%"
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
    
                    @foreach($results as $result )
                    ['{{ $result->name_2 ?? '' }}', {{ $result->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $result->total_f}}, '#4285f4'],
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
                    width: 932,
                    height: 510,
                    fontFamily: 'Khmer OS Battambang', // Set the font family
                    bar: {
                        groupWidth: "98%"
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
                    
                    @foreach($total_departments as $departments )
                    ['{{ $departments->department_name ?? '' }}', {{ $departments->total_students }}, '#dc3e27'],
                    ['និស្សិតស្រី', {{ $departments->total_female_students}}, '#4285f4'],
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
                    fontSize: 12, // Set font size
                    title: "ស្ថិតិនិស្សិតតាមដេប៉ាតឺម៉ង់",
                    width: 750,
                    height: 1500,
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
                var chart = new google.visualization.BarChart(document.getElementById("records_student_by_department_barChart"));
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
            
            @foreach($total_results as $bb)
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
            fontSize: 12.5,
            title: "ស្ថិតិនិស្សិតតាមក្រុម",
            width: 900,
            height: 1500,
            fontFamily: 'Khmer OS Battambang',
            bar: {
                groupWidth: "90%"
            },
            legend: {
                position: "none"
            },
            annotations: {
                textStyle: {
                    fontSize: 10,
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
                        groupWidth: "90%"
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
                        groupWidth: "90%"
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
                    ['Session', 'Quantity', {
                        role: 'style'
                    }],
    
                    @foreach($total_provinces as $provinces )
                    ['{{ $provinces->province ?? '' }}', {{ $provinces->total_students }}, '#4285f4'],
                    @endforeach
    
                    // ["ភ្នំពេញ", 6, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កណ្ដាល", 2, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កែប", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កោះកុង", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កំពង់ចាម", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កំពង់ឆ្នាំង", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កំពង់ធំ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កំពង់ស្ពឺ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["កំពត", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ក្រចេះ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["តាកែវ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ត្បូងឃ្មុំ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["បន្ទាយមានជ័យ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["បាត់ដំបង", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ប៉ៃលិន", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ពោធិ៍សាត់", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ព្រៃវែង", 1, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ព្រះវិហារ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ព្រះសីហនុ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["មណ្ឌលគិរី", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["រតនគិរី", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["សៀមរាប", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ស្ទឹងត្រែង", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ស្វាយរៀង", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
                    // ["ឧត្ដរមានជ័យ", 0, "#4285f4"],
                    // // ["និស្សិត", 1, "#dc3912"],
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
                    title: "ស្ថិតិ ចំនួននិស្សិត តាមខេត្តនិងរាជធានី",
                    width: 1600,
                    height: 450,
                    fontFamily: 'Khmer OS Battambang', // Set the font family
                    bar: {
                        groupWidth: "70%"
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
        </script>
    </div>
    </div>
    @endsection