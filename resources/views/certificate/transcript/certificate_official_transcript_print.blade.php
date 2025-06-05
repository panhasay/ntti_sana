<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Transcript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 0mm;
        }

        .a4-preview {
            width: 240mm;
            /* height: 237mm; */
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

            /* Background SVG */
            /* background: url('/asset/NTTI/images/modules/ntti-logo-2025.svg') no-repeat center center;
            background-size: 80%;
            background-position: center;
            background-position-y: 280px; */
        }

        .text-start,
        .text-end {
            line-height: 1.2;
        }

        .table,
        .table th,
        .table td {
            background-color: transparent !important;
            border: 2px solid;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            z-index: 1;
        }

        .style-header {
            font-family: 'Times New Roman', Times, serif;
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
                font-family: Arial, sans-serif;
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
</head>

<body>
    <div class="container-fluid a4-preview background">
        <div class="row style-header mt-5">
            <div class="col-md-7 text-md-start text-md-center d-flex flex-column mt-5 ps-0">
                <h5 class="fw-bold">Ministry of Labour and Vocational Training</h5>
                <h5>National Technical Training Institute</h5>
                <p class="mb-0">Ref: ...OS/24... NTTI/IT</p>
            </div>
            <div class="col-md-5 text-md-end text-md-center d-flex flex-column">
                <h5 class="fw-bold">KINGDOM OF CAMBODIA</h5>
                <h5 class="fw-bold mt-0">Nation Religion King</h5>
                <div class="text-md-center mt-0" style="margin-top: -10px !important; ">
                    <img src="{{ asset('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view"
                        width="90" title="Style Khmer">
                </div>
            </div>
        </div>

        <div class="text-center fw-bold mt-4">
            <h2>OFFICIAL TRANSCRIPT</h2>
        </div>

        <div class="row ps-5 pe-5">
            <div class="col-6">
                <p><strong>Record of :</strong> Heng Synoeun</p>
                <p><strong>Degree :</strong> Bachelor of Information Technology</p>
            </div>
            <div class="col-6 text-end">
                <p><strong>Sex :</strong> Male</p>
                <p><strong>Date of Birth :</strong> 1/Jan/2005</p>
            </div>
        </div>
        <!-- Academic Record Table -->
        <div class="mt-2 ps-5 pe-5">
            <table class="table table-sm table-bordered table-border-primary p-3">
                <thead>
                    <tr>
                        <th class="text-center text align-middle" rowspan="2">YEAR</th>
                        <th class="text-center" colspan="2">SEMESTER I</th>
                        <th class="text-center" colspan="2">SEMESTER II</th>
                    </tr>
                    <tr class="text-center text align-middle">
                        <th>Subjects</th>
                        <th>Marks<br>(100/100)</th>
                        <th>Subjects</th>
                        <th>Marks<br>(100/100)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="8" class="text-center text align-middle">1<sup>st</sup></td>
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
                        <td rowspan="8" class="text-center text align-middle">2<sup>nd</sup></td>
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
        <div class="container-sm row style-header ps-5 pe-5">
            <div class="col-7 text-start d-flex flex-column gap-2 mt-0">
                <h5>REMARKS:</h5>
                <table class="table table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th>Mark Obtained</th>
                            <th>Grade</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>85-100</td>
                            <td>A</td>
                            <td>Excellent</td>
                        </tr>
                        <tr>
                            <td>80-84</td>
                            <td>B+</td>
                            <td>Verygood</td>
                        </tr>
                        <tr>
                            <td>70-79</td>
                            <td>B</td>
                            <td>Good</td>
                        </tr>
                        <tr>
                            <td>65-69</td>
                            <td>C+</td>
                            <td>Fairly Good</td>
                        </tr>
                        <tr>
                            <td>50-64</td>
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
            <div class="col-5 text-end d-flex flex-column gap-2 mt-5">
                <img class="stamp" alt="QR code"
                    src="{{ asset('asset/NTTI/images/modules/Simple Email Signature with Picture.svg') }}">
            </div>
        </div>


        <div class="container mt-5 text-center">
            <p class="align-items-center" style="font-size: 6pt;">
                <span class="certificate-info ps-2">ISO 9001:2015 / Cert No:
                    720466/NTTI/DDAP/PR-012/FR-004<br>National Technical Training Institute (NTTI), along Russian
                    Federation Blvd, Teuk Thlar Commune, Sen Sok
                    District, Phnom Penh, Cambodia. Phone/Fax: (855) 23 991 039, website: www.ntti.edu.kh, E-mail:
                    info@ntti.edu.kh</span>
            </p>
        </div>
    </div>
</body>

</html>
