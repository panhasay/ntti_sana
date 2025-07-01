@extends('app_layout.app_layout')
@section('content')
    <style>
        .english-title {
            font-family: 'Times New Roman';
        }

        .khmer-lanng {
            font-family: 'Times New Roman';
        }

        .khmer-header {
            font-family: "Moul", serif !important;
        }

        @media print {
            .print-page {
                page-break-after: always;
            }

            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            /* body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            } */

            .no-print {
                display: none !important;
            }
        }
    </style>


    <div class="page-head page-head-custom">
        <div class="row">
            <div class="col-md-6 col-sm-6  col-6">
                <div class="page-title page-title-custom">
                    <div class="khmer-header">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        ព្រីន​ សញ្ញាបត្រ័
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header flex-wrap">
        <div class="d-grid d-md-flex header-left justify-content-md-end p-3">
            <a class="btn btn-danger mb-2 mb-md-0 me-2" href="/certificate/D_IT/degree/MD_DE">
                ទំព័រដើម
            </a>
            <button onclick="printCertificate()" id="print_certificate"
                class="btn btn-primary mb-2 mb-md-0 me-2">បោះពុម្ព</button>

        </div>
    </div>

    <div class="print-area" id="print_content">

        @foreach ($students as $student)
            <!-- Content -->
            <div class="print-page">
                @php
                    $data_gender = '';
                    if ($student->gender == 'ស្រី') {
                        $data_gender = 'Female';
                    } else {
                        $data_gender = 'Male';
                    }
                @endphp
                <div style="margin-top: 30px;">
                    <!-- header -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 50px;">
                                <div class=" khmer-header">ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</div>
                                <div class="english-title">MINISTRY OF LABOUR AND VOCATIONAL TRAINING </div>

                                <div class=" khmer-header">វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                                <div class="english-title">NATIONAL TECHNICAL TRAINING INSTITUTE </div>
                                <div class="english-title">លេខ :</div>
                            </div>

                            <div class="col-md-6">
                                <div style="float: right">
                                    <div class=" khmer-header">ព្រះរាជាណាចក្រកម្ពុជា</div>
                                    <div class="english-title">KINGDOM OF CAMBODIA </div>
                                    <div class=" khmer-header">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
                                    <div class="english-title">NATION RELIGION KING</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- main  header -->

                    <div class="mt-2" style="text-align: center">
                        <div class="khmer-header">បរិញ្ញាបនបត្របណ្តោះអាសន្ន</div>
                        <div class="english-title text-uppercase">provisional certificate</div>
                    </div>

                    <!-- content -->
                    <div class=" mt-5 ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="english-title">The Director of National Tchnical Taining Istitute</div>
                            </div>
                            <div class="col-md-6 float-end">
                                <div class="khmer-header">នាយកវិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="english-title">Certficate That</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="khmer-header" style="margin-left:90px">បញ្ញ៉ាក់ថា</div>
                                </div>

                            </div>

                            <div class="col-md-6 mt-4 d-flex">
                                <div class="">Name :</div><strong
                                    class="enlis-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $student->name }}</strong>
                            </div>
                            <div class="col-md-6 mt-4 d-flex">
                                <div class="">និស្សិតឈ្មោះ :</div> <span
                                    class="khmer-header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $student->name_2 }}</span>
                            </div>


                            <div class="col-md-12 mt-2">
                                <div class="row">
                                    <div class="col-3 mt-2"> Sex : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data_gender }}
                                    </div>
                                    <div class="col-3 mt-2"> Nationality :
                                        &nbsp;&nbsp;&nbsp;{{ $student->nationality ?? 'Cambodia' }}</div>
                                    <div class="col-3 mt-2"> ភេទ : &nbsp;&nbsp;&nbsp;{{ $data_gender }}</div>
                                    <div class="col-3 mt-2">សញ្ជាតិ :
                                        &nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $student->nationality_2 ?? 'ខ្មែរ' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2 d-flex ">
                                <div class="english-title">Date of birst :</div>
                                <strong>&nbsp;&nbsp;&nbsp;{{ $student->date_of_birth }}</strong>
                            </div>
                            <div class="col-md-6 d-flex mt-2">
                                <div class="khmer-title">ថ្ងៃខែឆ្នាំកំណើត </div> <strong
                                    class="">&nbsp;&nbsp;&nbsp;{{ $student->date_year_kh }}</strong>
                            </div>

                            <div class="col-md-6 mt-4 d-flex">
                                <div class="english-title">Place of birst :</div>
                                <strong>&nbsp;&nbsp;&nbsp;{{ $student->date_of_birth }}</strong>
                            </div>
                            <div class="col-md-6 mt-4 d-flex">
                                <div class="khmer-title">ទីកន្លែងកំណើត :</div> <span
                                    class="khmer-header">&nbsp;&nbsp;&nbsp;{{ $student->student_address }}</span>
                            </div>

                            <!-- <div class="row mt-4"> -->
                            <div class="col-md-6 mt-4 d-flex">
                                <div class="english-title">Examination Date :</div>
                                <strong>&nbsp;&nbsp;&nbsp;{{ $student->date_of_birth }}</strong>
                            </div>
                            <div class="col-md-6 mt-4 d-flex">
                                <div class="khmer-title">សម័យប្រឡង :</div> <strong
                                    class="">&nbsp;&nbsp;&nbsp;{{ $student->date_year_kh }}</strong>
                            </div>

                            <!-- </div> -->

                            <div class="row mt-5">
                                <div class="col-md-6 d-flex">
                                    <div class="english-title">This certificate is being issued to the bearer for use as
                                        deemed necessary.</div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="english-title">
                                        វិញ្ញាបនប័ត្រនេះបានចេញឱ្យសាមីជនយកទៅប្រើប្រាស់តាមការដែលអាចប្រើបាន។</div>
                                </div>

                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 mt-4" style="text-align: center;">
                                <img src="" width="100px" height="100px" style="border:1px solid #000000">
                            </div>

                            <div class="col-md-6 mt-4">
                                <div class="khmer-lanng" style="text-align: left;">
                                    <span>រាជធានីភ្នំពេញ</span> <span style="width: 100px;"> ថ្ងៃ . . . . . . . </span>
                                    ខែ .
                                    . . . . . . ឆ្នាំ២០២៤<br>
                                </div>
                                <div class="mt-2 english-title">Phnom Penh</div>
                                <div class="mt-2">
                                    <div class="khmer-header" style="text-align: center;">នាយកសាលាវិទ្យាស្ថាន</ស> <br>
                                    </div>
                                    <div class="english-title" style="text-align: center"> Director of Institute</div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div style="height: 100px"></div>

            </div>
        @endforeach

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on('click', "#print_certificate", function() {
            var printContents = document.getElementById("print_content").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });
    </script>
@endsection
