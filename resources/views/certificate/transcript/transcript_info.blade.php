<style>
    .btn-kh {
        font-family: "Khmer OS Battambang" !important;
    }

    .btn-eng {
        font-family: "Khmer OS Battambang" !important;
    }
</style>
@extends('app_layout.app_layout')

@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => 'ព័ត៌មានលម្អិត'],
        ['route' => 'department-menu', 'title' => 'Official Transcript'],
    ]" />

    <style>
        @page {
            size: A4 portrait;
            margin: 0mm;
        }

        .a4-preview {
            width: 240mm;
            height: 339mm;
            border: 1px solid #aaa8a8;
            padding: 20px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            background: url('/asset/NTTI/images/modules/ntti-bg-offical-transcript.svg') no-repeat center center;
            background-size: 100%;
            background-position: center;
            background-position-y: 0px;
        }

        .container-fluid {
            position: relative;
            background-color: #ffffff !important;
        }

        .text-start,
        .text-end {
            line-height: 1.2;
        }

        .double-border-table th,
        .double-border-table td {
            border: 1.5px solid black;
            text-align: center;
            padding: 8px;
            background-color: transparent !important;
        }

        .double-border-table thead {
            background-color: transparent !important;
            font-weight: bold;
        }

        .double-border-table>thead>tr {
            border: 3px solid #000;
            border-left: 3px #000;
        }

        .style-header {
            font-family: 'Times New Roman', Times, serif;
        }


        .solid-border-table {
            border: 3px solid #000;
            border-collapse: collapse;
        }

        .solid-border-table th,
        .solid-border-table td {
            border: 2px double #000;
            padding: 5px;
            background-color: transparent !important;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
                margin-top: -20px !important;
            }

            body {
                margin: 0 !important;
                padding: 0;
                color: #000;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                image-rendering: high-quality;
            }

            .no-print {
                display: none !important;
            }

            .container-fluid {
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                box-shadow: none !important;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                -webkit-filter: none;
                filter: none;
            }
        }
    </style>

    <div class="card bg-white mb-5">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-black mb-0" style="font-family: Khmer OS Battambang;font-size:17px;">មើលវិញ្ញាបនប័ត្រជាមុន
                </h4>
                <div>
                    <button
                        class="btn btn-kh {{ optional($record)->status == 1 ? 'btn-success' : 'btn-danger' }} btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                        id="btn_open_print_date">
                        {!! optional($record)->status == 1
                            ? '<i class="mdi mdi-check-decagram"></i> បានផ្តល់ជូនបេក្ខជន'
                            : '<i class="mdi mdi-close-octagon"></i> មិនទាន់បានផ្តល់ជូនបេក្ខជន' !!}</button>
                    <button type="button" id="prints" name="prints"
                        class="btn btn-kh btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                        <i class="mdi mdi-printer btn-icon-append"></i> បោះពុម្ភ
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid a4-preview background">
                <div class="row style-header mt-5" style="font-family: 'Times New Roman', Times, serif;">
                    <div class="col-md-7 text-md-start text-md-center d-flex flex-column mt-5 ps-0">
                        <h4 class="fw-bold">Ministry of Labour and Vocational
                            Training
                        </h4>
                        <h4>National Technical Training Institute</h4>
                        <p class="mb-0">Ref:
                            {{ $record->reference_code ?? '...OS/24... NTTI/IT' }}</p>
                    </div>
                    <div class="col-md-5 text-md-end text-md-center d-flex flex-column">
                        <h4 class="fw-bold">KINGDOM OF CAMBODIA</h4>
                        <h4 class="fw-bold mt-0">Nation Religion King</h4>
                        <div class="text-md-center mt-0" style="margin-top: -10px !important; ">
                            <img src="{{ asset('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view"
                                width="90" title="Style Khmer">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <h4 class="fw-bold">OFFICIAL TRANSCRIPT</h4>
                </div>

                <div class="row ps-5 pe-5">
                    <div class="col-8">
                        <p><strong>Record
                                of{!! str_repeat('&nbsp;', 3) !!}:{!! str_repeat('&nbsp;', 3) !!}</strong>
                            {{ $records_info->name }}</p>
                        <p><strong>Degree{!! str_repeat('&nbsp;', 8) !!}:{!! str_repeat('&nbsp;', 3) !!}</strong>
                            {{ $records_transcript->first()['full_name'] ?? '' }}
                        </p>
                    </div>
                    <div class="col-4 text-end">
                        <p><strong>Sex{!! str_repeat('&nbsp;', 3) !!}:{!! str_repeat('&nbsp;', 3) !!}</strong>
                            {{ $records_info->gender }}{!! str_repeat('&nbsp;', 10) !!}
                        </p>
                        <p><strong>Date of
                                Birth{!! str_repeat('&nbsp;', 3) !!}:{!! str_repeat('&nbsp;', 3) !!}</strong>{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}
                        </p>
                    </div>
                </div>
                <!-- Academic Record Table -->
                <div class="mt-2 ps-5 pe-5">
                    <table class="table table-sm double-border-table p-3" style="border: 5px double;">
                        <thead>
                            <tr>
                                <th class="text-center text align-middle fw-bold" rowspan="2">YEAR</th>
                                <th class="text-center fw-bold" colspan="2" style="border: 3px solid #000;">SEMESTER I
                                </th>
                                <th class="text-center fw-bold" colspan="2" style="border: 3px solid #000;">SEMESTER II
                                </th>
                            </tr>
                            <tr class="text-center text align-middle">
                                <th class="fw-bold" style="border: 3px solid #000;">Subjects</th>
                                <th class="fw-bold" style="border: 3px solid #000;">Marks<br>(100/100)</th>
                                <th class="fw-bold" style="border: 3px solid #000;">Subjects</th>
                                <th class="fw-bold" style="border: 3px solid #000;">Marks<br>(100/100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="8" class="text-center text align-middle"
                                    style="border-right: 3px solid #000;">1<sup>st</sup></td>
                                <td>Soft Skill</td>
                                <td>91.00</td>
                                <td>English Education</td>
                                <td>90.00</td>
                            </tr>
                            <tr>
                                <td>Social Science</td>
                                <td>77.00</td>
                                <td>PC Troubleshooting and Maintenances</td>
                                <td>80.00</td>
                            </tr>
                            <tr>
                                <td>English Education</td>
                                <td>80.00</td>
                                <td>Beginner Web Programming</td>
                                <td>96.00</td>
                            </tr>
                            <tr>
                                <td>Mathematics for Computing</td>
                                <td>74.00</td>
                                <td>Microsoft SQL Server</td>
                                <td>84.00</td>
                            </tr>
                            <tr>
                                <td>PC Troubleshooting and Maintenances</td>
                                <td>66.00</td>
                                <td>Computer Design and Publishing</td>
                                <td>70.00</td>
                            </tr>
                            <tr>
                                <td>Microsoft Office Administration</td>
                                <td>88.00</td>
                                <td>Mathematics for Computing</td>
                                <td>82.00</td>
                            </tr>
                            <tr>
                                <td>Structured Programming</td>
                                <td>62.00</td>
                                <td>Structured Programming</td>
                                <td>72.00</td>
                            </tr>
                            <tr>
                                <td>Beginner Web Programming</td>
                                <td>94.00</td>
                                <td>Object Oriented Programming</td>
                                <td>96.00</td>
                            </tr>
                            <tr>
                                <td rowspan="8" class="text-center text align-middle"
                                    style="border-right: 3px solid #000;">2<sup>nd</sup></td>
                                <td>Interactive Multimedia Design</td>
                                <td>86.00</td>
                                <td>Interactive Multimedia Design</td>
                                <td>88.00</td>
                            </tr>
                            <tr>
                                <td>Object Oriented Programming</td>
                                <td>91.00</td>
                                <td>Dynamic Web Programming</td>
                                <td>79.00</td>
                            </tr>
                            <tr>
                                <td>Data Structure and Algorithm</td>
                                <td>73.00</td>
                                <td>Microsoft SQL Server</td>
                                <td>93.00</td>
                            </tr>
                            <tr>
                                <td>Dynamic Web Programming</td>
                                <td>93.00</td>
                                <td>Computer Networking</td>
                                <td>79.00</td>
                            </tr>
                            <tr>
                                <td>Computer Networking</td>
                                <td>87.00</td>
                                <td>Mikrotik and Unit</td>
                                <td>85.00</td>
                            </tr>
                            <tr>
                                <td>Computer Design and Publishing</td>
                                <td>71.00</td>
                                <td>Computer Design and Publishing</td>
                                <td>58.00</td>
                            </tr>
                            <tr>
                                <td>Microsoft SQL Server</td>
                                <td>88.00</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Remarks Table -->
                <div class="container-sm row style-header ps-5 pe-5 mt-4">
                    <div class="col-7 text-start d-flex flex-column gap-2 mt-0" style="padding-left: 75px;">
                        <h4 class="text-left mb-0">REMARKS:</h4>
                        <table class="table solid-border-table text-center">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="border: 2px solid #000;">Mark Obtained</th>
                                    <th class="fw-bold" style="border: 2px solid #000;">Grade</th>
                                    <th class="fw-bold" style="border: 2px solid #000;">Meaning</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>85–100</td>
                                    <td>A</td>
                                    <td>Excellent</td>
                                </tr>
                                <tr>
                                    <td>80–84</td>
                                    <td>B⁺</td>
                                    <td>Very good</td>
                                </tr>
                                <tr>
                                    <td>70–79</td>
                                    <td>B</td>
                                    <td>Good</td>
                                </tr>
                                <tr>
                                    <td>65–69</td>
                                    <td>C⁺</td>
                                    <td>Fairly Good</td>
                                </tr>
                                <tr>
                                    <td>50–64</td>
                                    <td>C</td>
                                    <td>Fair</td>
                                </tr>
                                <tr>
                                    <td>Less than 50</td>
                                    <td>:</td>
                                    <td>Fail</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5 text-end d-flex flex-column gap-2 ">
                        <h4 class="text-left mb-0">Phnom Penh Date:........</h4>
                        {{-- <img class="stamp" alt="QR code"
                            src="{{ asset('asset/NTTI/images/modules/Simple Email Signature with Picture.svg') }}"> --}}
                    </div>
                </div>


                <div class="container mt-5 text-center">
                    <p class="align-items-center" style="font-size: 5.5pt;">
                        <span class="certificate-info ps-2">ISO 9001:2015 / Cert No:
                            720466/NTTI/DDAP/PR-012/FR-004<br>National Technical Training Institute (NTTI), along Russian
                            Federation Blvd, Teuk Thlar Commune, Sen Sok
                            District, Phnom Penh, Cambodia. Phone/Fax: (855) 23 991 039, website: www.ntti.edu.kh, E-mail:
                            info@ntti.edu.kh</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
