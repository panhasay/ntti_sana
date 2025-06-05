<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Transcript</title>
    <style>
        @page {
            background: url('asset/NTTI/images/modules/ntti-bg-offical-transcript.svg') no-repeat center center;
            background-size: cover;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
            font-family: 'Times New Roman';
            font-size: 10pt;
        }

        .ministry {
            position: absolute;
            flex: 2;
            text-align: center;
            align-self: flex-start;
            float: left;
            margin-left: -390px;
            font-size: 11pt;
            margin-top: -35px;
        }

        .ministry p {
            margin: 0;
            margin-bottom: 10px;
        }

        .ref {
            margin-top: 10px;
            font-style: italic;
        }


        .info {
            width: 100%;
            margin-top: 20px;
            font-size: 14px;
        }

        .info td {
            padding: 5px 0px 0px 0px;
        }

        .score-td {
            text-align: center;
            vertical-align: middle;
        }

        .container-remark {
            font-family: 'Times New Roman';
            padding-left: 55px;
            padding-top: 20px;
        }

        .remark-title {
            font-family: 'Times New Roman';
            font-size: 10pt;
            width: 100%;
            margin-bottom: 10px;
        }

        .remark-table {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: middle;
            font-family: 'Times New Roman';
            font-size: 10pt;
        }

        .vertical-text-rotated {
            position: fixed;
            rotate: -90;
        }

        .tbl-border {
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <div style="font-size: 11pt;font-weight: bold;">
            <div style="float: right; width: 220px; text-align: center; margin: 0;">Kingdom of Cambodia</div><br>
            <div style="float: right; width: 220px; text-align: center; margin-top: 5px;">
                Nation&nbsp;&nbsp;-&nbsp;&nbsp;Religion&nbsp;&nbsp;-&nbsp;&nbsp;King
            </div>
            <br>
            <div style="float: right; width: 220px; text-align: center; margin: 0;">
                <img src="asset/NTTI/images/modules/tactieng_khmer.png" width="90" title="Style Khmer">
            </div>
        </div>
        <div class="ministry">
            <p style="font-weight: bold;">Ministry of Labour and Vocational Training</p>
            <p>National Technical Training Institute</p>
            <p class="ref">Ref: {{ $record->reference_code ?? '...OS/24... NTTI/IT' }}</p>
        </div>
    </header>

    <div
        style="font-family: 'Times New Roman';text-align: center; font-size: 14pt; font-weight: bold; margin-top: -20px; text-decoration: underline">
        OFFICIAL TRANSCRIPT
    </div>

    <table class="info" style="font-family: 'Times New Roman';">
        <tr>
            <td><strong>{!! str_replace(' ', '&nbsp;', str_pad('Student', 20)) !!}:{!! str_replace(' ', '&nbsp;', str_pad('', 4)) !!}</strong>{{ $records_info->name }}</td>
            <td><strong>Sex:{!! str_replace(' ', '&nbsp;', str_pad('', 4)) !!}</strong>
                {{ $records_info->gender == 'ស្រី' ? 'Female' : 'Male' }}<strong>{!! str_replace(' ', '&nbsp;', str_pad('', 15)) !!}Nationality:{!! str_replace(' ', '&nbsp;', str_pad('', 4)) !!}</strong>
                Khmer</td>
        </tr>
        <tr>
            <td><strong>Date of Birth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</strong>
                {{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</td>
            <td><strong>Date of Graduation:{!! str_replace(' ', '&nbsp;', str_pad('', 4)) !!}</strong>
                {{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</td>

        </tr>
        <tr>
            <td><strong>Place of Birth&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</strong>
                Prey Veng Province</td>

        </tr>
    </table>

    <div style="font-family: 'Times New Roman';text-align: center; font-size: 9.5pt; margin-top: 5px;">
        Has successfully completed Bachelor of Technology in the field of Information Technology in academic year
        2018-2021
    </div>

    <table border="1"
        style="font-family: 'Times New Roman'; width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                    <tr>
                        <th class="tbl-border">Nº</th>
                        <th class="tbl-border">SUBJECT</th>
                        <th class="tbl-border">HOUR</th>
                        <th class="tbl-border">SCORE (100/100)</th>
                        <th class="tbl-border">GRADE</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>English Education</td>
                        <td>60</td>
                        <td>60.00</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Windows Servers</td>
                        <td>60</td>
                        <td>50.00</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Computer Design and Publishing</td>
                        <td>60</td>
                        <td>78.00</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Microsoft SQL Server</td>
                        <td>120</td>
                        <td>58.00</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>PHP Programming with MySQL</td>
                        <td>60</td>
                        <td>52.00</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>E-Commerce</td>
                        <td>60</td>
                        <td>71.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Interactive Multimedia Design</td>
                        <td>60</td>
                        <td>74.00</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Linux Servers</td>
                        <td>60</td>
                        <td>74.00</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Object Oriented Programming</td>
                        <td>60</td>
                        <td>69.00</td>
                        <td>C+</td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                    <tr>
                        <th class="tbl-border">Nº</th>
                        <th class="tbl-border">SUBJECT</th>
                        <th class="tbl-border">HOUR</th>
                        <th class="tbl-border">SCORE (100/100)</th>
                        <th class="tbl-border">GRADE</th>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Digital Marketing</td>
                        <td>96</td>
                        <td>88.00</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>IT Project Management</td>
                        <td>96</td>
                        <td>74.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Arduino Bootcamp</td>
                        <td>96</td>
                        <td>67.90</td>
                        <td>C+</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Mobile Application Framework</td>
                        <td>96</td>
                        <td>71.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Cisco Routing and Switching</td>
                        <td>144</td>
                        <td>83.22</td>
                        <td>B+</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Cyber Security Analysis</td>
                        <td>48</td>
                        <td>79.50</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>M2M Communication System</td>
                        <td>48</td>
                        <td>73.00</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold;">Final Thesis:</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>POS Management System on Mobile</td>
                        <td>240</td>
                        <td>74.50</td>
                        <td>B</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <div class="container-remark">
        <!-- Header row using table for layout -->
        <table class="remark-title">
            <tr>
                <td style="text-align: left; font-weight: bold;">
                    REMARKS
                </td>
                <td style="text-align: right; font-weight: bold;">
                    Phnom Penh, Date:
                    {{ $record_print == null ? '.................' : \Carbon\Carbon::parse($record_print->print_date)->format('j/M/Y') }}
                </td>
            </tr>
        </table>
        <table style="border-collapse: collapse; width: 50%; text-align: center;">
            <thead>
                <tr>
                    <th class="remark-table">Mark Obtained</th>
                    <th class="remark-table">Grade</th>
                    <th class="remark-table">Meaning</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="remark-table">85–100</td>
                    <td class="remark-table">A</td>
                    <td class="remark-table">Excellent</td>
                </tr>
                <tr>
                    <td class="remark-table">80–84</td>
                    <td class="remark-table">B⁺</td>
                    <td class="remark-table">Very good</td>
                </tr>
                <tr>
                    <td class="remark-table">70–79</td>
                    <td class="remark-table">B</td>
                    <td class="remark-table">Good</td>
                </tr>
                <tr>
                    <td class="remark-table">65–69</td>
                    <td class="remark-table">C⁺</td>
                    <td class="remark-table">Fairly Good</td>
                </tr>
                <tr>
                    <td class="remark-table">50–64</td>
                    <td class="remark-table">C</td>
                    <td class="remark-table">Fair</td>
                </tr>
                <tr>
                    <td class="remark-table">Less than 50</td>
                    <td class="remark-table">:</td>
                    <td class="remark-table">Fail</td>
                </tr>
            </tbody>
        </table>

        <div style="text-align: right; margin-top: -200px;">
            <img src="asset/NTTI/images/modules/pos-signature.png" width="190" alt="Signature">
        </div>
    </div>

    <htmlpagefooter name="myFooter">
        <div style="text-align: center; font-size: 5.5pt; line-height: 1.3;">
            ISO 9001:2015 / Cert No: 720466/NTTI/DDAP/PR-012/FR-004<br>
            National Technical Training Institute (NTTI), Russian Federation Blvd, Teuk Thlar, Sen Sok, Phnom Penh,
            Cambodia
            Phone/Fax: (855) 23 991 039 | www.ntti.edu.kh | info@ntti.edu.kh
        </div>
    </htmlpagefooter>

    <sethtmlpagefooter name="myFooter" value="on" />


</body>

</html>
