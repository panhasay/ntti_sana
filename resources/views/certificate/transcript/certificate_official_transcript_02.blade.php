<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Transcript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Angkor&family=Battambang:wght@100;300;400;700;900&family=Bayon&family=Bokor&family=Dangrek&family=Hanuman:wght@100;300;400;700;900&family=Koulen&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Moul&family=Noto+Sans+Khmer:wght@100..900&family=Noto+Serif+Khmer:wght@100..900&family=Preahvihear&display=swap"
        rel="stylesheet">
    <style>
        @page {
            size: A3 portrait;
            margin: 0mm;
        }

        @font-face {
            font-family: 'khmerostesting';
            src: url('fonts/Battambang-Bold.ttf') format('truetype');
        }

        .moul-regular {
            font-family: "Moul", serif;
            font-weight: 400;
            font-style: normal;
        }

        .battambang-bold {
            font-family: "Battambang", system-ui;
            font-weight: 700;
            font-style: normal;
        }

        @media print {
            @page {
                size: A3 portrait;
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

        .a4-preview {
            width: 297mm;
            height: 420mm;
            border: 1px solid #aaa8a8;
            padding: 20px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            background: url('/asset/NTTI/images/modules/ntti-bg-offical-transcript-A3.svg') no-repeat center center;
            background-size: cover;
            background-position: center;
        }

        .container-fluid {
            position: relative;
            background-color: #ffffff !important;
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


        .vertical-text-rotated {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }

        footer {
            width: 100%;
            text-align: center;
            padding: 69px;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .footer table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer .footer-text {
            font-size: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid a4-preview background">
        <div class="row style-header mt-5">
            <div class="col-md-7 text-md-center d-flex flex-column mt-5 ps-0">
                <h5 class="fw-bold">Ministry of Labour and Vocational Training</h5>
                <h5>National Technical Training Institute</h5>
                <p class="mb-0">Ref: ...OS/24... NTTI/IT</p>
            </div>
            <div class="col-md-5 text-md-end text-md-center d-flex flex-column">
                <h5 class="fw-bold">KINGDOM OF CAMBODIA</h5>
                <h5 class="fw-bold mt-0">Nation-Religion-King</h5>
                <div class="text-md-center mt-0" style="margin-top: -10px !important; ">
                    <img src="{{ asset('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view"
                        width="90" title="Style Khmer">
                </div>
            </div>
        </div>

        <div class="text-center text-decoration-underline fw-bold mt-1">
            <h2 class="battambang-bold">OFFICIAL TRANSCRIPT</h2>
            <p class="moul-regular">សួស្តី! នេះជាឯកសារ PDF ភាសាខ្មែរ។</p>
        </div>

        <div class="row ps-5 pe-5">
            <div class="col-6">
                <p><strong>Student
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Heng Synoeun</p>
                <p><strong>Date of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1/Jan/2005</p>
                <p><strong>Place of Birth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prey Veng Province</p>
            </div>
            <div class="col-6">
                <p><strong>Sex :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nationality :</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khmer</p>

                <p><strong>Date of Graduation :</strong> 1/Jan/2005</p>
            </div>
        </div>
        <p class="text-center ps-5 pe-5">
            Has successfully completed Bachelor of Technology in the field of Information Technology in academic
            year 2018-2021
        </p>
        <!-- Academic Record Table -->
        <div class="mt-2 ps-5 pe-5">
            <table class="table table-sm table-bordered table-border-primary p-3">
                <thead class="text-center text align-middle">
                    <tr>
                        <th>No</th>
                        <th>Subject</th>
                        <th class="vertical-text-rotated">Hour</th>
                        <th width="10">Score (100/100)</th>
                        <th>Grade</th>
                        <th>No</th>
                        <th>Subject</th>
                        <th class="vertical-text-rotated">Hour</th>
                        <th width="10">Score (100/100)</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>English Education</td>
                        <td>60</td>
                        <td>60.00</td>
                        <td>C</td>
                        <td>12</td>
                        <td>Digital Marketing</td>
                        <td>96</td>
                        <td>88.00</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Windows Servers</td>
                        <td>60</td>
                        <td>50.00</td>
                        <td>C</td>
                        <td>13</td>
                        <td>IT Project Management</td>
                        <td>96</td>
                        <td>74.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Computer Design and Publishing</td>
                        <td>60</td>
                        <td>78.00</td>
                        <td>B</td>
                        <td>14</td>
                        <td>Arduino Bootcamp</td>
                        <td>96</td>
                        <td>67.90</td>
                        <td>C+</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Microsoft SQL Server</td>
                        <td>120</td>
                        <td>58.00</td>
                        <td>C</td>
                        <td>15</td>
                        <td>Mobile Application Framework</td>
                        <td>96</td>
                        <td>71.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>PHP Programming with MySQL</td>
                        <td>60</td>
                        <td>52.00</td>
                        <td>C</td>
                        <td>16</td>
                        <td>Cisco Routing and Switching</td>
                        <td>144</td>
                        <td>83.22</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>E-Commerce</td>
                        <td>60</td>
                        <td>71.50</td>
                        <td>B</td>
                        <td>17</td>
                        <td>Cyber Security Analysis</td>
                        <td>48</td>
                        <td>79.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Interactive Multimedia Design</td>
                        <td>60</td>
                        <td>70.00</td>
                        <td>B</td>
                        <td>18</td>
                        <td>M2M Communication System</td>
                        <td>48</td>
                        <td>73.00</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Linux Servers</td>
                        <td>60</td>
                        <td>73.50</td>
                        <td>B</td>
                        <td>19</td>
                        <td>POS Management System on Mobile App</td>
                        <td>360</td>
                        <td>74.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Object Oriented Programming</td>
                        <td>60</td>
                        <td>69.00</td>
                        <td>C+</td>
                        <td></td>
                        <td class="text-center align-middle fw-bold">Final Thesis :<br>POS Management System School</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Information Security and Privacy</td>
                        <td>60</td>
                        <td>81.21</td>
                        <td>B+</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Research Methodology</td>
                        <td>30</td>
                        <td>71.00</td>
                        <td>B</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                            <th>Grade Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>85-100</td>
                            <td>A</td>
                            <td>Excellent</td>
                            <td>4.00</td>
                        </tr>
                        <tr>
                            <td>80-84</td>
                            <td>B+</td>
                            <td>Verygood</td>
                            <td>3.50</td>
                        </tr>
                        <tr>
                            <td>70-79</td>
                            <td>B</td>
                            <td>Good</td>
                            <td>3.00</td>
                        </tr>
                        <tr>
                            <td>65-69</td>
                            <td>C+</td>
                            <td>Fairly Good</td>
                            <td>2.50</td>
                        </tr>
                        <tr>
                            <td>50-64</td>
                            <td>C</td>
                            <td>Fair</td>
                            <td>2.00</td>
                        </tr>
                        <tr>
                            <td>Less than 50</td>
                            <td>:</td>
                            <td>Fail</td>
                            <td>1.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-5 text-end d-flex flex-column gap-2 mt-5">
                {{-- <img class="stamp" alt="QR code"
                    src="{{ asset('asset/NTTI/images/modules/Simple Email Signature with Picture.svg') }}"> --}}
            </div>
        </div>
        <div class="container mt-5 text-center">
            <div class="wrapper">
                <footer class="footer decorative-border">
                    <table class="table footer-table">
                        <tr>
                            <td>ISO 9001 : 2015/Cert No. 720466</td>
                            <td>លេខ ១NTTI/DIT/PR-006/FR-003</td>
                            <td>លេខឯកសារ លេខ ០៥</td>
                        </tr>
                        <tr>
                            <td>ថ្ងៃបោះពុម្ព: August 29, 2014</td>
                            <td>ថ្ងៃដាក់បញ្ចូល: August 24, 2017</td>
                            <td>ទំព័រ: 1 of 1</td>
                        </tr>
                    </table>
                    <div class="footer-text">
                        National Technical Training Institute (NTTI), along Russian Federation BLVD, Teuk Thlar Commune,
                        Sen
                        Sok District, Phnom Penh, Cambodia, Phone/Fax: (855)23 883 039, website: www.ntti.edu.kh,
                        E-mail:
                        info@ntti.edu.kh
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
