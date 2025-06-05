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
    </style>
</head>

<body>
    <header>
        <div style="font-size: 11pt;font-weight: bold;">
            <div style="float: right; width: 220px; text-align: center; margin: 0;">KINGDOM OF CAMBODIA</div><br>
            <div style="float: right; width: 220px; text-align: center; margin-top: 5px;">
                Nation Religion King
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
        style="font-family: 'Times New Roman';text-align: center; font-size: 12pt; font-weight: bold; margin-top: 20px;">
        OFFICIAL TRANSCRIPT
    </div>

    <table class="info" style="font-family: 'Times New Roman';">
        <tr>
            <td><strong>Record of :</strong> {{ $records_info->name }}</td>
            <td><strong>Sex :</strong> {{ $records_info->gender == 'ស្រី' ? 'Female' : 'Male' }}</td>
        </tr>
        <tr>
            <td><strong>Degree&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                {{ $records_transcript->first()['full_name'] ?? '' }}</td>
            <td><strong>Date of Birth :</strong>
                {{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</td>
        </tr>
    </table>

    <table class="info" border="1"
        style="font-family: 'Times New Roman'; width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px;">
        <thead>
            <tr>
                <th rowspan="2" width="30" style="border: 1px solid black; padding: 5px; text-align: center;">
                    YEAR</th>
                <th colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;width: 50%;">
                    SEMESTER I</th>
                <th colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;width: 50%;">
                    SEMESTER II</th>
            </tr>
            <tr class="text-center text align-middle">
                <th style="border: 1px solid black; padding: 5px; text-align: center;">Subjects</th>
                <th style="border: 1px solid black; padding: 5px; text-align: center;">Marks<br>(100/100)</th>
                <th style="border: 1px solid black; padding: 5px; text-align: center;">Subjects</th>
                <th style="border: 1px solid black; padding: 5px; text-align: center;">Marks<br>(100/100)</th>
            </tr>
        </thead>
        <tbody>
            @php $yearIndex = 1; @endphp
            @foreach ($records_subjects as $year => $semesters)
                @php
                    $semester1 = $semesters[1] ?? collect();
                    $semester2 = $semesters[2] ?? collect();
                    $maxRows = max($semester1->count(), $semester2->count());
                @endphp

                @for ($i = 0; $i < $maxRows; $i++)
                    <tr>
                        @if ($i === 0)
                            <td rowspan="{{ $maxRows }}" class="score-td">
                                {{ $yearIndex }}
                                <sup>
                                    @if ($yearIndex == 1)
                                        st
                                    @elseif ($yearIndex == 2)
                                        nd
                                    @elseif ($yearIndex == 3)
                                        rd
                                    @else
                                        th
                                    @endif
                                </sup>
                            </td>
                        @endif

                        {{-- Semester I --}}
                        <td height="30" style="padding: 5px;">{{ $semester1[$i]->sub_eng ?? '' }}</td>
                        <td class="score-td">{{ isset($semester1[$i]) ? number_format($semester1[$i]->score, 2) : '' }}
                        </td>

                        {{-- Semester II --}}
                        <td style="padding: 5px;">{{ $semester2[$i]->sub_eng ?? '' }}</td>
                        <td class="score-td">{{ isset($semester2[$i]) ? number_format($semester2[$i]->score, 2) : '' }}
                        </td>
                    </tr>
                @endfor

                @php $yearIndex++; @endphp
            @endforeach

        </tbody>
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
