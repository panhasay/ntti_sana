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
                                    <div class="row align-items-start">
                                        <div class="col-6 border p-3">
                                            <div id="Student_statistics_by_academic_year" style="width: 900px; height: 500px;">
                                                <div style="position: relative;">
                                                    <div dir="ltr" style="position: relative; width: 732px; height: 500px;">
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="732" height="500" aria-label="A chart." style="overflow: hidden;">
                                                                <defs id="_ABSTRACT_RENDERER_ID_3">
                                                                    <clipPath id="_ABSTRACT_RENDERER_ID_4">
                                                                        <rect x="140" y="96" width="452" height="309"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect x="0" y="0" width="732" height="500" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                                <g><text text-anchor="start" x="140" y="75.2" font-family="Arial" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ស្ថិតិនិស្សិតតាមឆ្នាំសិក្សា</text>
                                                                    <rect x="140" y="65" width="452" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="140" y="96" width="452" height="309" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g clip-path="url(https://reports.nttiportal.com/dashboard#_ABSTRACT_RENDERER_ID_4)">
                                                                        <g>
                                                                            <rect x="140" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="290" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="441" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="591" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="215" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="366" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="516" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="141" y="102" width="233" height="24" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="141" y="136" width="27" height="24" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="141" y="204" width="390" height="24" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="141" y="239" width="46" height="23" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="141" y="307" width="35" height="24" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="141" y="341" width="7" height="24" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="140" y="96" width="1" height="309" stroke="none" stroke-width="0" fill="#333333"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="374" y="114" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="168" y="148" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="531" y="216" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="187" y="250" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="176" y="319" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="148" y="353" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                        </g>
                                                                    </g>
                                                                    <g></g>
                                                                    <g>
                                                                        <g><text text-anchor="middle" x="140.5" y="422.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">0</text></g>
                                                                        <g><text text-anchor="middle" x="290.8333" y="422.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">2,000</text></g>
                                                                        <g><text text-anchor="middle" x="441.1667" y="422.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">4,000</text></g>
                                                                        <g><text text-anchor="middle" x="591.5" y="422.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">6,000</text></g>
                                                                        <g><text text-anchor="end" x="128" y="117.81111111111112" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា 2021-2022</text></g>
                                                                        <g><text text-anchor="end" x="128" y="152.0333333333333" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="128" y="220.47777777777776" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា 2022-2023</text></g>
                                                                        <g><text text-anchor="end" x="128" y="254.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="128" y="323.14444444444445" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ឆ្នាំសិក្សា 2023-2024</text></g>
                                                                        <g><text text-anchor="end" x="128" y="357.3666666666667" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                    </g>
                                                                    <g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="370" y="118.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">3,108</text>
                                                                                <rect x="340" y="108" width="30" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="164" y="152.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">379</text>
                                                                                <rect x="144" y="142" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="527" y="220.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">5,202</text>
                                                                                <rect x="497" y="210" width="30" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="183" y="254.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">626</text>
                                                                                <rect x="163" y="244" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="172" y="323.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">480</text>
                                                                                <rect x="152" y="313" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="157.5" y="346.5" width="26" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="160" y="357.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">107</text><text text-anchor="start" x="160" y="357.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">107</text></g>
                                                                                <rect x="160" y="347" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g></g>
                                                            </svg>
                                                            <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Session</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>ឆ្នាំសិក្សា 2021-2022</td>
                                                                            <td>3,108</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>379</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ឆ្នាំសិក្សា 2022-2023</td>
                                                                            <td>5,202</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>626</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ឆ្នាំសិក្សា 2023-2024</td>
                                                                            <td>480</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>107</td>
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
                                                    <div aria-hidden="true" style="display: none; position: absolute; top: 510px; left: 742px; white-space: nowrap; font-family: Arial; font-size: 12px; font-weight: bold;">ស្ថិតិនិស្សិតតាមឆ្នាំសិក្សា</div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-6 border p-3">
                                            <div id="records_student_by_skills_barChart" style="width: 900px; height: 500px;">
                                                <div style="position: relative;">
                                                    <div dir="ltr" style="position: relative; width: 932px; height: 510px;">
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="932" height="510" aria-label="A chart." style="overflow: hidden;">
                                                                <defs id="_ABSTRACT_RENDERER_ID_5">
                                                                    <clipPath id="_ABSTRACT_RENDERER_ID_6">
                                                                        <rect x="165" y="98" width="603" height="315"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect x="0" y="0" width="932" height="510" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                                <g><text text-anchor="start" x="165" y="77.2" font-family="Arial" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ស្ថិតិនិស្សិតតាមជំនាញ</text>
                                                                    <rect x="165" y="67" width="603" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="165" y="98" width="603" height="315" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g clip-path="url(https://reports.nttiportal.com/dashboard#_ABSTRACT_RENDERER_ID_6)">
                                                                        <g>
                                                                            <rect x="165" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="251" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="337" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="423" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="509" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="595" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="681" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="767" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="208" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="294" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="380" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="466" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="552" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="638" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="724" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="166" y="99" width="18" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="165" y="116" width="0.5" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="166" y="151" width="143" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="166" y="168" width="31" height="18" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="166" y="203" width="417" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="166" y="221" width="45" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="166" y="256" width="46" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="166" y="273" width="22" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="166" y="308" width="598" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="166" y="325" width="51" height="18" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="166" y="360" width="2" height="17" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="165.6032" y="378" width="0.5" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="165" y="98" width="1" height="315" stroke="none" stroke-width="0" fill="#333333"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="184" y="107" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="165.5" y="124" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="309" y="159" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="197" y="177" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="583" y="211" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="211" y="229" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="212" y="264" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="188" y="281" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="764" y="316" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="217" y="334" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="168" y="368" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="166.1032" y="386" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                        </g>
                                                                    </g>
                                                                    <g></g>
                                                                    <g>
                                                                        <g><text text-anchor="middle" x="165.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">0</text></g>
                                                                        <g><text text-anchor="middle" x="251.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">500</text></g>
                                                                        <g><text text-anchor="middle" x="337.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">1,000</text></g>
                                                                        <g><text text-anchor="middle" x="423.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">1,500</text></g>
                                                                        <g><text text-anchor="middle" x="509.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">2,000</text></g>
                                                                        <g><text text-anchor="middle" x="595.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">2,500</text></g>
                                                                        <g><text text-anchor="middle" x="681.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">3,000</text></g>
                                                                        <g><text text-anchor="middle" x="767.5" y="430.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">3,500</text></g>
                                                                        <g><text text-anchor="end" x="153" y="111.42222222222223" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ បរិក្ខារត្រជាក់</text></g>
                                                                        <g><text text-anchor="end" x="153" y="128.86666666666665" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="163.75555555555553" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ ព័ត៌មានវិទ្យា</text></g>
                                                                        <g><text text-anchor="end" x="153" y="181.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="216.08888888888887" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ សំណង់ស៊ីវិល</text></g>
                                                                        <g><text text-anchor="end" x="153" y="233.5333333333333" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="268.42222222222216" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ ស្ថាបត្យកម្ម</text></g>
                                                                        <g><text text-anchor="end" x="153" y="285.8666666666666" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="320.75555555555553" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ អគ្គិសនី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="338.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="153" y="373.08888888888885" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ជំនាញ អេឡិចត្រូនិច</text></g>
                                                                        <g><text text-anchor="end" x="153" y="390.5333333333333" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                    </g>
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="193.5" y="100.5" width="26" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="196" y="111.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#9a2b1b" aria-hidden="true">108</text><text text-anchor="start" x="196" y="111.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#9a2b1b">108</text></g>
                                                                                <rect x="196" y="101" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="175.5" y="117.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="177.5" y="128.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="start" x="177.5" y="128.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="177.5" y="118" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="305" y="163.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">836</text>
                                                                                <rect x="285" y="153" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="193" y="181.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">184</text>
                                                                                <rect x="173" y="171" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="579" y="215.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">2,432</text>
                                                                                <rect x="549" y="205" width="30" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="207" y="233.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">265</text>
                                                                                <rect x="187" y="223" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="208" y="268.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">275</text>
                                                                                <rect x="188" y="258" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="197.5" y="274.5" width="26" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="200" y="285.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">136</text><text text-anchor="start" x="200" y="285.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">136</text></g>
                                                                                <rect x="200" y="275" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="760" y="320.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">3,480</text>
                                                                                <rect x="730" y="310" width="30" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="213" y="338.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">302</text>
                                                                                <rect x="193" y="328" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="177.5" y="361.5" width="19" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="180" y="372.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#9a2b1b" aria-hidden="true">15</text><text text-anchor="start" x="180" y="372.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#9a2b1b">15</text></g>
                                                                                <rect x="180" y="362" width="13" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="176.5" y="379.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="178.1032" y="390.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">3</text><text text-anchor="start" x="178.1032" y="390.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">3</text></g>
                                                                                <rect x="178.1032" y="380" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g></g>
                                                            </svg>
                                                            <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Session</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>ជំនាញ បរិក្ខារត្រជាក់</td>
                                                                            <td>108</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ជំនាញ ព័ត៌មានវិទ្យា</td>
                                                                            <td>836</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>184</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ជំនាញ សំណង់ស៊ីវិល</td>
                                                                            <td>2,432</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>265</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ជំនាញ ស្ថាបត្យកម្ម</td>
                                                                            <td>275</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>136</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ជំនាញ អគ្គិសនី</td>
                                                                            <td>3,480</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>302</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ជំនាញ អេឡិចត្រូនិច</td>
                                                                            <td>15</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>និស្សិតស្រី</td>
                                                                            <td>3</td>
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
                                                    <div aria-hidden="true" style="display: none; position: absolute; top: 520px; left: 942px; white-space: nowrap; font-family: Arial; font-size: 12px; font-weight: bold;">ស្ថិតិនិស្សិតតាមជំនាញ</div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="barcharts mt-2">
                                    <div class="row align-items-start">
                                        <div class="col-6 border p-3">
                                            <div id="records_student_by_department_barChart" style="width: 900px; height: 800px;">
                                                <div style="position: relative;">
                                                    <div dir="ltr" style="position: relative; width: 732px; height: 400px;">
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="732" height="400" aria-label="A chart." style="overflow: hidden;">
                                                                <defs id="_ABSTRACT_RENDERER_ID_7">
                                                                    <clipPath id="_ABSTRACT_RENDERER_ID_8">
                                                                        <rect x="129" y="77" width="474" height="247"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect x="0" y="0" width="732" height="400" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                                <g><text text-anchor="start" x="129" y="56.2" font-family="Arial" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ស្ថិតិនិស្សិតតាមដេប៉ាតឺម៉ង់</text>
                                                                    <rect x="129" y="46" width="474" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="129" y="77" width="474" height="247" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g clip-path="url(https://reports.nttiportal.com/dashboard#_ABSTRACT_RENDERER_ID_8)">
                                                                        <g>
                                                                            <rect x="129" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="247" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="366" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="484" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="602" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="188" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="306" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="425" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="543" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="130" y="80" width="111" height="22" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="130" y="108" width="20" height="21" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="130" y="162" width="360" height="22" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="130" y="190" width="49" height="21" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="130" y="244" width="402" height="22" stroke="#dc3e27" stroke-width="1" fill="#dc3e27"></rect>
                                                                            <rect x="130" y="272" width="35" height="21" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="129" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#333333"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="241" y="91" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150" y="118" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="490" y="173" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="179" y="200" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="532" y="255" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="165" y="282" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                        </g>
                                                                    </g>
                                                                    <g></g>
                                                                    <g>
                                                                        <g><text text-anchor="middle" x="129.5" y="341.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">0</text></g>
                                                                        <g><text text-anchor="middle" x="247.75" y="341.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">1,000</text></g>
                                                                        <g><text text-anchor="middle" x="366" y="341.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">2,000</text></g>
                                                                        <g><text text-anchor="middle" x="484.25" y="341.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">3,000</text></g>
                                                                        <g><text text-anchor="middle" x="602.5" y="341.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">4,000</text></g>
                                                                        <g><text text-anchor="end" x="127" y="95.36666666666667" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា</text></g>
                                                                        <g><text text-anchor="end" x="127" y="122.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="127" y="169.36666666666665" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់វិស្វកម្ម</text><text text-anchor="end" x="127" y="185.36666666666665" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">សំណង់ស៊ីវិល</text></g>
                                                                        <g><text text-anchor="end" x="127" y="204.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">និស្សិតស្រី</text></g>
                                                                        <g><text text-anchor="end" x="127" y="243.36666666666665" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់វិស្វកម្ម</text><text text-anchor="end" x="127" y="259.3666666666667" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">អគ្គិសនី និង</text><text text-anchor="end" x="127" y="275.3666666666666" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">អេឡិចត្រូនិច</text></g>
                                                                    </g>
                                                                    <g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="237" y="95.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">946</text>
                                                                                <rect x="217" y="85" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="159.5" y="111.5" width="26" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162" y="122.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">179</text><text text-anchor="start" x="162" y="122.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">179</text></g>
                                                                                <rect x="162" y="112" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="486" y="177.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">3,052</text>
                                                                                <rect x="456" y="167" width="30" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="175" y="204.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">426</text>
                                                                                <rect x="155" y="194" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="528" y="259.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">3,411</text>
                                                                                <rect x="499" y="249" width="29" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="161" y="286.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">303</text>
                                                                                <rect x="141" y="276" width="20" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g></g>
                                                            </svg>
                                                            <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div aria-hidden="true" style="display: none; position: absolute; top: 410px; left: 742px; white-space: nowrap; font-family: Arial; font-size: 12px; font-weight: bold;">ស្ថិតិនិស្សិតតាមដេប៉ាតឺម៉ង់</div>
                                                    <div></div>
                                                </div>
                                            </div>
                                            
                                        </div>
    
                                        <div class="col-6 border p-3">
                                            <div id="student_Department_Class" style="width: 1600px; height: 1200px;">
                                                <div style="position: relative;">
                                                    <div dir="ltr" style="position: relative; width: 900px; height: 450px;">
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="900" height="450" aria-label="A chart." style="overflow: hidden;">
                                                                <defs id="_ABSTRACT_RENDERER_ID_9">
                                                                    <clipPath id="_ABSTRACT_RENDERER_ID_10">
                                                                        <rect x="150" y="86" width="600" height="278"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect x="0" y="0" width="900" height="450" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                                <g><text text-anchor="start" x="150" y="66.305" font-family="Arial" font-size="11.3" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ស្ថិតិនិស្សិតតាមក្រុម</text>
                                                                    <rect x="150" y="56.7" width="600" height="11.299999999999997" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                </g>
                                                                <!-- <g>
                                                                    <rect x="150" y="86" width="600" height="278" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g clip-path="url(https://reports.nttiportal.com/dashboard#_ABSTRACT_RENDERER_ID_10)">
                                                                        <g>
                                                                            <rect x="150" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="236" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="321" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="407" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="492" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="578" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="663" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="749" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="193" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="278" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="364" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="450" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="535" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="621" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="706" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="151" y="87" width="589" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="150" y="106" width="0.5" height="17" stroke="#f7c77c" stroke-width="1" fill="#f7c77c"></rect>
                                                                            <rect x="150" y="124" width="0.5" height="17" stroke="#f78900" stroke-width="1" fill="#f78900"></rect>
                                                                            <rect x="151" y="143" width="230" height="16" stroke="#2d427e" stroke-width="1" fill="#2d427e"></rect>
                                                                            <rect x="151" y="180" width="495" height="16" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="150" y="198" width="0.5" height="17" stroke="#f7c77c" stroke-width="1" fill="#f7c77c"></rect>
                                                                            <rect x="150" y="217" width="0.5" height="16" stroke="#f78900" stroke-width="1" fill="#f78900"></rect>
                                                                            <rect x="151" y="235" width="256" height="17" stroke="#2d427e" stroke-width="1" fill="#2d427e"></rect>
                                                                            <rect x="151" y="272" width="204" height="17" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="150" y="291" width="0.5" height="16" stroke="#f7c77c" stroke-width="1" fill="#f7c77c"></rect>
                                                                            <rect x="150" y="309" width="0.5" height="17" stroke="#f78900" stroke-width="1" fill="#f78900"></rect>
                                                                            <rect x="151" y="327" width="59" height="17" stroke="#2d427e" stroke-width="1" fill="#2d427e"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="150" y="86" width="1" height="278" stroke="none" stroke-width="0" fill="#333333"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="740" y="95" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="114" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="132" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="381" y="151" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="646" y="188" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="206" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="225" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="407" y="243" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="355" y="280" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="299" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="150.5" y="317" width="12" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="210" y="335" width="0" height="1" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                        </g>
                                                                    </g>
                                                                    <g></g>
                                                                    <g>
                                                                        <g><text text-anchor="middle" x="150.5" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">0</text></g>
                                                                        <g><text text-anchor="middle" x="236.0714" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">10</text></g>
                                                                        <g><text text-anchor="middle" x="321.6429" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">20</text></g>
                                                                        <g><text text-anchor="middle" x="407.2143" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">30</text></g>
                                                                        <g><text text-anchor="middle" x="492.7857" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">40</text></g>
                                                                        <g><text text-anchor="middle" x="578.3571" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">50</text></g>
                                                                        <g><text text-anchor="middle" x="663.9286" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">60</text></g>
                                                                        <g><text text-anchor="middle" x="749.5" y="380.605" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">70</text></g>
                                                                        <g><text text-anchor="end" x="148" y="99.68833333333333" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល</text></g>
                                                                        <g><text text-anchor="end" x="148" y="118.15499999999999" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនព្រឹក</text></g>
                                                                        <g><text text-anchor="end" x="148" y="136.62166666666667" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនរសៀល</text></g>
                                                                        <g><text text-anchor="end" x="148" y="155.08833333333334" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនយប់</text></g>
                                                                        <g><text text-anchor="end" x="148" y="184.87166666666667" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី</text><text text-anchor="end" x="148" y="199.17166666666668" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">និងអេឡិចត្រូនិច</text></g>
                                                                        <g><text text-anchor="end" x="148" y="228.955" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនរសៀល</text></g>
                                                                        <g><text text-anchor="end" x="148" y="247.42166666666665" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនយប់</text></g>
                                                                        <g><text text-anchor="end" x="148" y="284.35499999999996" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា</text></g>
                                                                        <g><text text-anchor="end" x="148" y="302.82166666666666" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនព្រឹក</text></g>
                                                                        <g><text text-anchor="end" x="148" y="321.2883333333333" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនរសៀល</text></g>
                                                                        <g><text text-anchor="end" x="148" y="339.75499999999994" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#222222">វេនយប់</text></g>
                                                                    </g>
                                                                    <g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="736" y="98.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">69</text>
                                                                                <rect x="725" y="90" width="11" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="108.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="117.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad8b57" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="117.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad8b57">0</text></g>
                                                                                <rect x="162.5" y="109" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="126.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="135.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad6000" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="135.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad6000">0</text></g>
                                                                                <rect x="162.5" y="127" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="377" y="154.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">27</text>
                                                                                <rect x="366" y="146" width="11" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="642" y="191.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">58</text>
                                                                                <rect x="631" y="183" width="11" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="200.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="209.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad8b57" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="209.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad8b57">0</text></g>
                                                                                <rect x="162.5" y="201" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="219.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="228.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad6000" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="228.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad6000">0</text></g>
                                                                                <rect x="162.5" y="220" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="403" y="246.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">30</text>
                                                                                <rect x="392" y="238" width="11" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="351" y="283.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">24</text>
                                                                                <rect x="340" y="275" width="11" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="293.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="302.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad8b57" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="302.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad8b57">0</text></g>
                                                                                <rect x="162.5" y="294" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="160.5" y="311.5" width="11" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="start" x="162.5" y="320.5" font-family="Arial" font-size="10" stroke="#ffffff" stroke-width="3" fill="#ad6000" aria-hidden="true">0</text><text text-anchor="start" x="162.5" y="320.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ad6000">0</text></g>
                                                                                <rect x="162.5" y="312" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="end" x="206" y="338.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">7</text>
                                                                                <rect x="200" y="330" width="6" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g> -->
                                                                <g></g>
                                                            </svg>
                                                            <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Session</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- <tbody>
                                                                        <tr>
                                                                            <td>ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល</td>
                                                                            <td>69</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនព្រឹក</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនរសៀល</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនយប់</td>
                                                                            <td>27</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិច</td>
                                                                            <td>58</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនព្រឹក</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនរសៀល</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនយប់</td>
                                                                            <td>30</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា</td>
                                                                            <td>24</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនព្រឹក</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនរសៀល</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>វេនយប់</td>
                                                                            <td>7</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody> -->
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div aria-hidden="true" style="display: none; position: absolute; top: 460px; left: 910px; white-space: nowrap; font-family: Arial; font-size: 11.3px; font-weight: bold;">ស្ថិតិនិស្សិតតាមក្រុម</div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="barcharts mt-2">
    
                                </div>
    
                                <div class="ColumnChart mt-2">
                                    <div class="row align-items-start">
                                        <div class="col-8 border p-3">
                                            <div id="students_by_province" style="width: 900px; height: 800px;">
                                                <div style="position: relative;">
                                                    <div dir="ltr" style="position: relative; width: 1240px; height: 450px;">
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="1240" height="450" aria-label="A chart." style="overflow: hidden;">
                                                                <defs id="_ABSTRACT_RENDERER_ID_11">
                                                                    <clipPath id="_ABSTRACT_RENDERER_ID_12">
                                                                        <rect x="172" y="86" width="897" height="278"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect x="0" y="0" width="1240" height="450" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                                <g><text text-anchor="start" x="172" y="66.305" font-family="Arial" font-size="11.3" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">ស្ថិតិ ចំនួននិស្សិត តាមខេត្តនិងរាជធានី</text>
                                                                    <rect x="172" y="56.7" width="897" height="11.299999999999997" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="172" y="86" width="897" height="278" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                    <g clip-path="url(https://reports.nttiportal.com/dashboard#_ABSTRACT_RENDERER_ID_12)">
                                                                        <g>
                                                                            <rect x="172" y="363" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="317" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="271" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="225" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="178" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="132" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="86" width="897" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                                                                            <rect x="172" y="340" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="172" y="294" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="172" y="248" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="172" y="201" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="172" y="155" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                            <rect x="172" y="109" width="897" height="1" stroke="none" stroke-width="0" fill="#ebebeb"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="178" y="87" width="25" height="276" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="214" y="272" width="25" height="91" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="250" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="285" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="321" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="357" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="393" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="429" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="465" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="500" y="363" width="26" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="536" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="572" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="608" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="644" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="680" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="715" y="363" width="26" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="751" y="318" width="25" height="45" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="787" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="823" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="859" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="895" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="931" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="966" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="1002" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                            <rect x="1038" y="363" width="25" height="0.5" stroke="#4285f4" stroke-width="1" fill="#4285f4"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="172" y="363" width="897" height="1" stroke="none" stroke-width="0" fill="#333333"></rect>
                                                                        </g>
                                                                        <g>
                                                                            <rect x="190" y="87" width="1" height="0" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="226" y="272" width="1" height="0" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="262" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="297" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="333" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="369" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="405" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="441" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="477" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="513" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="548" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="584" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="620" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="656" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="692" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="728" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="763" y="318" width="1" height="0" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="799" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="835" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="871" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="907" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="943" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="978" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="1014" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                            <rect x="1050" y="351" width="1" height="12" stroke="none" stroke-width="0" fill="#999999"></rect>
                                                                        </g>
                                                                    </g>
                                                                    <g></g>
                                                                    <g>
                                                                        <g><text text-anchor="end" x="192.3975" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 192.3975 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ភ្នំពេញ</text></g>
                                                                        <g><text text-anchor="end" x="228.23749999999998" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 228.23749999999998 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កណ្ដាល</text></g>
                                                                        <g><text text-anchor="end" x="264.07750000000004" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 264.07750000000004 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កែប</text></g>
                                                                        <g><text text-anchor="end" x="299.9175" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 299.9175 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កោះកុង</text></g>
                                                                        <g><text text-anchor="end" x="335.75750000000005" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 335.75750000000005 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កំពង់ចាម</text></g>
                                                                        <g><text text-anchor="end" x="371.5975" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 371.5975 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កំពង់ឆ្នាំង</text></g>
                                                                        <g><text text-anchor="end" x="407.43750000000006" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 407.43750000000006 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កំពង់ធំ</text></g>
                                                                        <g><text text-anchor="end" x="443.27750000000003" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 443.27750000000003 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កំពង់ស្ពឺ</text></g>
                                                                        <g><text text-anchor="end" x="479.11750000000006" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 479.11750000000006 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">កំពត</text></g>
                                                                        <g><text text-anchor="end" x="514.9575" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 514.9575 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ក្រចេះ</text></g>
                                                                        <g><text text-anchor="end" x="550.7975" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 550.7975 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">តាកែវ</text></g>
                                                                        <g><text text-anchor="end" x="586.6375" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 586.6375 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ត្បូងឃ្មុំ</text></g>
                                                                        <g><text text-anchor="end" x="622.4775" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 622.4775 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">បន្ទាយមានជ័យ</text></g>
                                                                        <g><text text-anchor="end" x="658.3175" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 658.3175 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">បាត់ដំបង</text></g>
                                                                        <g><text text-anchor="end" x="694.1575" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 694.1575 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ប៉ៃលិន</text></g>
                                                                        <g><text text-anchor="end" x="729.9975000000001" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 729.9975000000001 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ពោធិ៍សាត់</text></g>
                                                                        <g><text text-anchor="end" x="765.8375" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 765.8375 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ព្រៃវែង</text></g>
                                                                        <g><text text-anchor="end" x="801.6775" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 801.6775 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ព្រះវិហារ</text></g>
                                                                        <g><text text-anchor="end" x="837.5175" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 837.5175 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ព្រះសីហនុ</text></g>
                                                                        <g><text text-anchor="end" x="873.3575000000001" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 873.3575000000001 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">មណ្ឌលគិរី</text></g>
                                                                        <g><text text-anchor="end" x="909.1975" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 909.1975 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">រតនគិរី</text></g>
                                                                        <g><text text-anchor="end" x="945.0375" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 945.0375 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">សៀមរាប</text></g>
                                                                        <g><text text-anchor="end" x="980.8775" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 980.8775 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ស្ទឹងត្រែង</text></g>
                                                                        <g><text text-anchor="end" x="1016.7175000000001" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 1016.7175000000001 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ស្វាយរៀង</text></g>
                                                                        <g><text text-anchor="end" x="1052.5575" y="380.07513047196744" font-family="Arial" font-size="11.3" transform="rotate(-30 1052.5575 380.07513047196744)" stroke="none" stroke-width="0" fill="#222222">ឧត្ដរមានជ័យ</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="367.455" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">0</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="321.2883" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">1</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="275.1217" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">2</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="228.955" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">3</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="182.78830000000002" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">4</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="136.6217" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">5</text></g>
                                                                        <g><text text-anchor="end" x="160.70000000000002" y="90.455" font-family="Arial" font-size="11.3" stroke="none" stroke-width="0" fill="#444444">6</text></g>
                                                                    </g>
                                                                    <g>
                                                                        <g>
                                                                            <g><text text-anchor="middle" x="190" y="99.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">6</text>
                                                                                <rect x="186.5" y="89" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="middle" x="226" y="284.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">2</text>
                                                                                <rect x="222.5" y="274" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="256.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="262" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="262" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="258.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="291.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="297" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="297" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="293.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="327.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="333" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="333" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="329.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="363.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="369" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="369" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="365.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="399.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="405" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="405" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="401.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="435.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="441" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="441" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="437.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="471.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="477" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="477" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="473.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="507.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="513" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="513" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="509.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="542.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="548" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="548" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="544.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="578.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="584" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="584" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="580.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="614.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="620" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="620" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="616.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="650.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="656" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="656" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="652.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="686.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="692" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="692" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="688.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="722.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="728" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="728" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="724.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g><text text-anchor="middle" x="763" y="330.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff">1</text>
                                                                                <rect x="759.5" y="320" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="793.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="799" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="799" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="795.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="829.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="835" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="835" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="831.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="865.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="871" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="871" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="867.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="901.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="907" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="907" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="903.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="937.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="943" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="943" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="939.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="972.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="978" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="978" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="974.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="1008.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="1014" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="1014" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="1010.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <g>
                                                                                <rect x="1044.5" y="338.5" width="12" height="14" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                                <g><text text-anchor="middle" x="1050" y="349.2" font-family="Arial" font-size="12" stroke="#ffffff" stroke-width="3" fill="#2e5dab" aria-hidden="true">0</text><text text-anchor="middle" x="1050" y="349.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#2e5dab">0</text></g>
                                                                                <rect x="1046.5" y="339" width="7" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g></g>
                                                            </svg>
                                                            <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Session</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>ភ្នំពេញ</td>
                                                                            <td>6</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កណ្ដាល</td>
                                                                            <td>2</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កែប</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កោះកុង</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កំពង់ចាម</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កំពង់ឆ្នាំង</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កំពង់ធំ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កំពង់ស្ពឺ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>កំពត</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ក្រចេះ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>តាកែវ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ត្បូងឃ្មុំ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>បន្ទាយមានជ័យ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>បាត់ដំបង</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ប៉ៃលិន</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ពោធិ៍សាត់</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ព្រៃវែង</td>
                                                                            <td>1</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ព្រះវិហារ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ព្រះសីហនុ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>មណ្ឌលគិរី</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>រតនគិរី</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>សៀមរាប</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ស្ទឹងត្រែង</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ស្វាយរៀង</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>ឧត្ដរមានជ័យ</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div aria-hidden="true" style="display: none; position: absolute; top: 460px; left: 1250px; white-space: nowrap; font-family: Arial; font-size: 11.3px; font-weight: bold;">ស្ថិតិ ចំនួននិស្សិត តាមខេត្តនិងរាជធានី</div>
                                                    <div></div>
                                                </div>
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