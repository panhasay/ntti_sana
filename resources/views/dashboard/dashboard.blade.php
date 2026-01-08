@extends('app_layout.app_layout')
@section('content')
    <style>
        .dashboard-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card p {
            letter-spacing: 0.5px;
        }

        .dashboard-card h2 {
            font-size: 2rem;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        th,
        td {
            padding: 14px !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('asset/NTTI/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        window.studentCounts = @json($studentCounts);
        window.student_per_department = @json($student_per_department);
        window.student_per_skill = @json($student_per_skill);
        window.student_per_province = @json($student_per_province);
    </script>
    <script src="{{ asset('asset\js\dashboard\statistic.js') }}"></script>
    <script src="{{ asset('asset\js\dashboard\department.js') }}"></script>
    <script src="{{ asset('asset\js\dashboard\skill.js') }}"></script>
    <script src="{{ asset('asset\js\dashboard\province.js') }}"></script>
    <section id="tabs" class="project-tab mb-5">
        <div>
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="Student-tab" data-toggle="tab" href="#Student"
                                role="tab" aria-controls="Student" aria-selected="true">ព័ត៌មានអំពី និស្សិត
                            </a>

                            <a class="nav-item nav-link" id="info-schools-tab" data-toggle="tab" href="#info-schools"
                                role="tab" aria-controls="info-schools" aria-selected="false">ព័ត៌មានអំពី
                                វិទ្យាស្ថាន</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="Student" role="tabpanel" aria-labelledby="Student-tab">
                            <div class="row py-4 g-3">
                                <div class="col-12 col-lg-3">
                                    <a href="#barchart_div" class="text-decoration-none">
                                        <div class="bg-success text-white p-4 text-center rounded shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="mb-0 font-dashboard">និស្សិតសរុប</p>
                                                    <h1 class="text-center">{{ $total_student }}</h1>
                                                </div>
                                                <h1 class="display-1"><i class="bi bi-mortarboard-fill"></i></h1>
                                            </div>
                                            <div class="border border-white"></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <a href="#barchart_department" class="text-decoration-none">
                                        <div class="bg-primary text-white p-4 text-center rounded shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="lead mb-0 font-dashboard">ដេប៉ាតឺម៉ង់</p>
                                                    <h1 class="text-center">{{ $total_departments }}</h1>
                                                </div>
                                                <h1 class="display-1"><i class="bi bi-buildings"></i></h1>
                                            </div>
                                            <div class="border border-white">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <a href="#barchart_div" class="text-decoration-none">
                                        <div class="bg-danger text-white p-4 rounded shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="lead mb-0 font-dashboard">វេន</p>
                                                    @foreach ($total_sections as $record)
                                                        <span class="mb-0 fs-5">{{ $record->name_2 }}</span>
                                                    @endforeach
                                                </div>
                                                <h1 class="display-1"><i class="bi bi-calendar2-week"></i></h1>
                                            </div>
                                            <div class="border border-white">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <a href="#barchart_skill" class="text-decoration-none">
                                        <div class="bg-info text-white p-4 text-center rounded shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="lead mb-0 font-dashboard">ជំនាញ</p>
                                                    <h1 class="text-center">{{ $total_skills }}</h1>
                                                </div>
                                                <h1 class="display-1"><i class="bi bi-lightbulb"></i></h1>
                                            </div>
                                            <div class="border border-white">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <h4 class="mb-2">ស្ថិតិនិស្សិតសរុបតាមឆ្នាំសិក្សាសរុប</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover ">
                                            <thead>
                                                <tr class="text-center fw-bold bg-transparent">
                                                    <td>ឆ្នាំសិក្សា</td>
                                                    <td>និស្សិតសរុប</td>
                                                    <td>ស្រី</td>
                                                    <td>ចុះឈ្មោះថ្មី</td>
                                                    <td>ស្រី</td>
                                                    <td>បញ្ចប់ការសិក្សារ</td>
                                                    <td>ស្រី</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentCounts as $record)
                                                    <tr class="text-center">
                                                        <td>{{ $record->code }}</td>
                                                        <td>{{ $record->total_students }}</td>
                                                        <td>{{ $record->total_female }}</td>
                                                        <td>{{ $record->new_student_registration }}</td>
                                                        <td>{{ $record->new_female_registration }}</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 mt-lg-0 mt-3  ">
                                    <h4 class="mb-2">ស្ថិតិនិស្សិតសរុបតាមជំនាញ</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover ">
                                            <thead>
                                                <tr class="text-center fw-bold bg-transparent">
                                                    <td>ឆ្នាំសិក្សា</td>
                                                    <td>និស្សិតសរុប</td>
                                                    <td>ស្រី</td>
                                                    <td>ចុះឈ្មោះថ្មី</td>
                                                    <td>ស្រី</td>
                                                    <td>បញ្ចប់ការសិក្សារ</td>
                                                    <td>ស្រី</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student_per_skill as $record)
                                                    <tr class="text-center">
                                                        <td>{{ $record->name_2 }}</td>
                                                        <td>{{ $record->total_students }}</td>
                                                        <td>{{ $record->total_female }}</td>
                                                        <td>{{ $record->new_student_registration }}</td>
                                                        <td>{{ $record->new_female_registration }}</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div id="barchart_div" class="w-100" style="height: 400px;"></div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div id="barchart_skill" class="w-100" style="height: 400px;"></div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <h4 class="mb-2">ស្ថិតិនិស្សិតសរុបតាមដេប៉ាតឺម៉ង់</h4>
                                    <div class="table-responsive d-flex align-items-center position-relative mb-0">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr class="text-center fw-bold bg-transparent">
                                                    <td>ដេប៉ាតឺម៉ង់</td>
                                                    <td>និស្សិតសរុប</td>
                                                    <td>ស្រី</td>
                                                    <td>ចុះឈ្មោះថ្មី</td>
                                                    <td>ស្រី</td>
                                                    <td>បញ្ចប់ការសិក្សារ</td>
                                                    <td>ស្រី</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student_per_department as $record)
                                                    <tr>
                                                        <td>{{ $record->department }}</td>
                                                        <td class="text-center">{{ $record->total_students }}</td>
                                                        <td class="text-center">{{ $record->total_female }}</td>
                                                        <td class="text-center">{{ $record->new_student_registration }}
                                                        </td>
                                                        <td class="text-center">{{ $record->new_female_registration }}
                                                        </td>
                                                        <td class="text-center">N/A</td>
                                                        <td class="text-center">N/A</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div id="barchart_department" class="w-100" style="height: 400px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="province_bar_chart" class="w-100" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="info-schools" role="tabpanel" aria-labelledby="info-schools-tab">
                            <div class="py-4">
                                <div class="row">
                                    <div class="col-12 text-center mb-4 leader-ship-card">
                                        <img src="https://www.ntti.edu.kh/assets/images/director1.png" alt="Director NTTI"
                                            class="leadership-image rounded-circle img-fluid">
                                        <h3 class="py-1 mb-0">His Excellency YOK SOTHY, Ph.D.</h3>
                                        <p class="text-primary mb-0 lead">DIRECTOR OF NTTI</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center leader-ship-card">
                                        <img src="https://www.ntti.edu.kh/assets/images/sub_director1.png"
                                            alt="Deputy Director" class="leadership-image-sm rounded-circle img-fluid">
                                        <h3 class="mb-0 py-1">Mr. Mom Somach</h3>
                                        <p class="text-primary lead mb-0">Deputy Director of
                                            Administration and Finance</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center leader-ship-card">
                                        <img src="https://www.ntti.edu.kh/assets/images/sub_director2.png"
                                            alt="Deputy Director" class="leadership-image-sm rounded-circle img-fluid">
                                        <h3 class="mb-0 py-1">Mr. Meas Sarith</h3>
                                        <p class="text-primary lead mb-0">Deputy Director of Education</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center leader-ship-card">
                                        <img src="https://www.ntti.edu.kh/assets/images/sub_director3.png"
                                            alt="Deputy Director" class="leadership-image-sm rounded-circle img-fluid">
                                        <h3 class="mb-0 py-1">Mr. Ek Phannarann</h3>
                                        <p class="text-primary lead mb-0">Deputy Director</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center leader-ship-card">
                                        <img src="https://www.ntti.edu.kh/assets/images/sub_director4.png"
                                            alt="Deputy Director" class="leadership-image-sm rounded-circle img-fluid">
                                        <h3 class="mb-0 py-1">Ms. Peng Lakhena</h3>
                                        <p class="text-primary lead mb-0">Deputy Director</p>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="quick-stats mt-lg-3 mt-2">
                                    <div class="row g-3">
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

                                    <div class="accordion custom-accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button accordion-font" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    About NTTI
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស (NTTI)
                                                    គឺជាគ្រឹះស្ថានឧត្តមសិក្សាមួយក្នុងចំណោមគ្រឹះស្ថានឧត្តមសិក្សាជាច្រើនរបស់កម្ពុជា
                                                    ដែលផ្តល់ការអប់រំ និងបណ្តុះបណ្តាលបច្ចេកទេស ក្រោមក្រសួងការងារ
                                                    និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ។ ក្នុងឆ្នាំសិក្សា ២០០៩-២០១០ NTTI
                                                    មានសិក្ខាកាមប្រមាណ ៣០០នាក់ ដែលកំពុងចូលរួមវគ្គបណ្តុះបណ្តាលគ្រូបច្ចេកទេស
                                                    និងសិស្សជាង ១០០០នាក់
                                                    ដែលកំពុងបន្តការសិក្សាថ្នាក់បរិញ្ញាបត្រក្នុងវិស័យវិស្វកម្មសំណង់ស៊ីវិល
                                                    វិស្វកម្មអគ្គិសនី អេឡិចត្រូនិច ស្ថាបត្យកម្ម និងបច្ចេកវិទ្យាព័ត៌មាន។
                                                    ជាងនេះទៅទៀត វាក៏ផ្តល់នូវកម្មវិធីសិក្សាខ្លីៗក្នុង Auto CAD, Surveying,
                                                    Basic Computer និងកម្មវិធីជាច្រើនទៀត។
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed accordion-font" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Employee Profile
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <p>
                                                                បរិយាកាសកម្លាំងការងារនៅ NTTI គឺជាកន្លែងដែលមានភាពស្វាហាប់
                                                                រួមបញ្ចូល និងប្រកបដោយភាពច្នៃប្រឌិត ដែលជំរុញកំណើនអាជីព
                                                                និងកិច្ចសហការក្នុងចំណោមបុគ្គលិករបស់ខ្លួន។ NTTI
                                                                ប្តេជ្ញាផ្តល់ឱកាសបណ្តុះបណ្តាល
                                                                និងអភិវឌ្ឍន៍ដល់បុគ្គលិករបស់ខ្លួន
                                                                ដែលអាចឱ្យពួកគេបន្តទៅមុខក្នុងវិស័យរៀងៗខ្លួន។
                                                            </p>

                                                            <p>NTTI មានបុគ្គលិកពេញម៉ោងចំនួន 116 នាក់ (ស្រី 34 នាក់)
                                                                ជាមួយនឹងភាពខុសគ្នានៃគុណវុឌ្ឍិកម្រិតឧត្តមសិក្សា រួមមាន បណ្ឌិត
                                                                អនុបណ្ឌិត បរិញ្ញាបត្រ និងបរិញ្ញាបត្ររង
                                                                ហើយត្រូវបានគាំទ្រដោយបុគ្គលិកផ្នែករដ្ឋបាល ការថែទាំ
                                                                និងតាមកិច្ចសន្យា។ ក្រៅពីនេះ
                                                                ពួកគេមួយចំនួនត្រូវបានបញ្ជូនទៅសហរដ្ឋអាមេរិក អូស្ត្រាលី រុស្សី
                                                                ជប៉ុន ឥណ្ឌា ថៃ ឥណ្ឌូនេស៊ី ម៉ាឡេស៊ី ប្រ៊ុយណេ ដារូសាឡឹម
                                                                សិង្ហបុរី
                                                                វៀតណាម ឡាវ ហ្វីលីពីន និងមីយ៉ាន់ម៉ា
                                                                ដើម្បីបន្តការសិក្សាថ្នាក់បរិញ្ញាបត្រ
                                                                និងចូលរួមកម្មវិធីវគ្គខ្លី។</p>

                                                            <p>
                                                                លើសពីនេះ
                                                                វិទ្យាស្ថានរក្សាបាននូវបណ្តាញទំនាក់ទំនងយ៉ាងទូលំទូលាយជាមួយក្រុមហ៊ុនសំណង់កម្ពុជា
                                                                និងអន្តរជាតិ ក្រុមហ៊ុនអគ្គិសនី គ្រឹះស្ថានអប់រំឯកជន
                                                                និងសាធារណៈ
                                                                សាកលវិទ្យាល័យបរទេស និងក្រសួងរដ្ឋាភិបាល។ NTTI
                                                                ដែលមានផ្ទៃដី១០ហិចតា
                                                                មានទីតាំងនៅតាមបណ្តោយមហាវិថីសហព័ន្ធរុស្សី សង្កាត់ទឹកថ្លា
                                                                ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ
                                                                និងមានចម្ងាយប្រហែល៦គីឡូម៉ែត្រពីកណ្តាលក្រុងវត្តភ្នំ។
                                                            </p>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div>
                                                                <img src="https://www.ntti.edu.kh/assets/images/graph_staff.png"
                                                                    alt="" class="w-100 img-fluid">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed accordion-font" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Vision, Mission & Objectives
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <p> បង្កើតឱកាសសម្រាប់និស្សិតដោយផ្តល់នូវគុណភាពខ្ពស់ និងសមត្ថភាព
                                                                (ទ្រឹស្តី
                                                                ការអនុវត្ត និងក្រមសីលធម៌) នៃការអប់រំ
                                                                និងបណ្តុះបណ្តាលបច្ចេកទេសវិជ្ជាជីវៈ។<br></p>


                                                            <p>
                                                                ផ្តល់ការបណ្តុះបណ្តាលបច្ចេកទេស និងវិជ្ជាជីវៈពិសេសមួយ
                                                                ដើម្បីរៀបចំពួកគេឱ្យស្ថិតក្នុងជំនាញបច្ចេកទេស
                                                                ដើម្បីចូលទៅក្នុងតម្រូវការបច្ចុប្បន្ន
                                                                និងអនាគតនៃទីផ្សារការងារ។<br>
                                                            </p>

                                                            <p>
                                                                វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេសបានប្តេជ្ញាចិត្ត
                                                                ការអភិវឌ្ឍបន្ថែមទៀតជាការអប់រំកម្រិតខ្ពស់ឈានមុខគេ
                                                                ស្ថាប័ននៅកម្ពុជាក្នុងការផ្តល់បច្ចេកទេស និង ការអប់រំ
                                                                និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ។ វាត្រូវបានប្តេជ្ញាចិត្ត
                                                                ការផ្តល់វគ្គបណ្តុះបណ្តាលប្រកបដោយគុណភាពស្របតាម
                                                                ប្រព័ន្ធបច្ចេកទេសជាតិដែលអាចបត់បែនបាន និងឆ្លើយតប ការអប់រំ
                                                                និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ ដើម្បីបំពេញតម្រូវការរបស់ គ
                                                                ទីផ្សារការងារ
                                                                បង្កើតកម្មវិធីសិក្សាផ្អែកលើសមត្ថភាព
                                                                សម្រាប់មជ្ឈមណ្ឌលបច្ចេកទេស
                                                                និងវិជ្ជាជីវៈនៃប្រទេស ការបណ្តុះបណ្តាល
                                                                និងបង្កើនសមត្ថភាពរបស់គ្រូ
                                                                និង
                                                                បណ្តុះបណ្តាល រចនា និងផលិតការផ្គត់ផ្គង់សមស្រប ធនធានបង្រៀន/រៀន
                                                                និងក្លាយជាមជ្ឈមណ្ឌលនៃ
                                                                ឧត្តមភាពក្នុងការបណ្តុះបណ្តាលគ្រូក្នុងតំបន់។

                                                                ជាពិសេស NTTI រៀបចំសិស្សទៅ ក្លាយជាសមាជិកដ៏មានប្រសិទ្ធភាព
                                                                និងសកម្មនៃសង្គមកម្ពុជា
                                                                ជាមួយនឹងសមត្ថភាពវិជ្ជាជីវៈក្នុងការអនុវត្ត
                                                                អភិវឌ្ឍ
                                                                និងពង្រឹងសមត្ថភាព ដំណើរការបង្រៀន វិទ្យាសាស្ត្រ
                                                                និងបច្ចេកវិទ្យា។
                                                            </p>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <img src="https://www.ntti.edu.kh/assets/images/vmg.png"
                                                                class="img-fluid w-100 " alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
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
@endsection
