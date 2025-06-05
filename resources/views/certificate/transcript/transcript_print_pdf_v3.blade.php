@php
    $path = storage_path('app/public/image/certificate/ntti-bg-offical-transcript.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Official Transcript</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            background-image: url('{{ $base64 }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="px-15 py-15 text-sm leading-relaxed text-black">
    <div class="w-full max-w-4xl mx-auto p-0">
        <div class="flex justify-between items-start">
            <!-- Left Section (Center-aligned text block) -->
            <div class="text-center mt-2">
                <div class="text-lg font-semibold">Ministry of Labour and Vocational Training</div>
                <div class="text-base">National Technical Training Institute</div>
                <div class="italic">Ref: 00002/25 NTTI/IT</div>
            </div>

            <!-- Right Section (Absolutely positioned text block) -->
            <div class="absolute right-15 text-center leading-tight">
                <p class="text-gray-800">Kingdom of Cambodia</p>
                <p class="text-gray-800">Nation - Religion - King</p>
                <img src="{{ public_path('asset/NTTI/images/modules/tactieng_khmer.png') }}" width="90"
                    title="Style Khmer" class="mx-auto mt-2">
            </div>
        </div>
    </div>


    <div class="text-center mb-4">
        <div class="text-lg font-bold uppercase underline">Official Transcript</div>
    </div>

    {{-- <div class="flex justify-between mb-2">
        <div class="text-sm">
            <div><span class="font-bold">Student:</span> KOL THIREACH</div>
            <div><span class="font-bold">Date of Birth:</span> 14/Dec/2006</div>
            <div><span class="font-bold">Place of Birth:</span> Prey Veng Province</div>
        </div>
        <div class="text-sm text-right">
            <div><span class="font-bold">Sex:</span> Male</div>
            <div><span class="font-bold">Nationality:</span> Khmer</div>
            <div><span class="font-bold">Date of Graduation:</span> 14/Dec/2006</div>
        </div>
    </div> --}}
    <table class="w-full font-[Times_New_Roman] text-sm">
        <tr>
            <td class="pr-8">
                <strong class="inline-block w-28">Student</strong>:
                <span class="ml-2">{{ $records_info->name }}</span>
            </td>
            <td>
                <strong class="inline-block w-10">Sex</strong>:
                <span class="ml-2">
                    {{ $records_info->gender == 'ស្រី' ? 'Female' : 'Male' }}
                </span>
                <strong class="inline-block w-28 ml-6">Nationality</strong>:
                <span class="ml-2">Khmer</span>
            </td>
        </tr>
        <tr class="mt-2">
            <td class="pr-8">
                <strong class="inline-block w-28">Date of Birth</strong>:
                <span class="ml-2">{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
            </td>
            <td>
                <strong class="inline-block w-28">Date of Graduation</strong>:
                <span class="ml-2">{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
            </td>
        </tr>
        <tr class="mt-2">
            <td colspan="2">
                <strong class="inline-block w-28">Place of Birth</strong>:
                <span class="ml-2">Prey Veng Province</span>
            </td>
        </tr>
    </table>


    <div class="text-center mb-6">
        Has successfully completed Bachelor of Technology in the field of Information Technology in academic year
        2018–2021
    </div>

    <!-- Table -->
    {{-- <div class="grid grid-cols-2 gap-4 text-xs">
        @php
            $subjects = [
                ['English Education', 60, 60, 'C'],
                ['Windows Servers', 60, 50, 'C'],
                ['Computer Design and Publishing', 60, 78, 'B'],
                ['Microsoft SQL Server', 120, 58, 'C'],
                ['PHP Programming with MySQL', 60, 52, 'C'],
                ['Digital Marketing', 96, 88, 'A'],
                ['IT Project Management', 96, 74.5, 'B'],
                ['Arduino Bootcamp', 96, 67.9, 'C+'],
                ['Mobile Application Framework', 96, 71.5, 'B'],
                ['Cisco Routing and Switching', 144, 83.22, 'B+'],
                ['Cyber Security Analysis', 48, 79.5, 'B'],
            ];
        @endphp

        @foreach ([0, 1] as $col)
            <table class="table-auto border-collapse w-full border border-black">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-black px-1 py-1">N°</th>
                        <th class="border border-black px-1 py-1">Subject</th>
                        <th class="border border-black px-1 py-1 text-center align-middle">
                            <div class="transform rotate-90 writing-vertical text-xs leading-tight origin-center">
                                Hour
                            </div>
                        </th>
                        <th class="border border-black px-1 py-1">Score<br>(100/100)</th>
                        <th class="border border-black px-1 py-1">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $i => $s)
                        @if ($i % 2 === $col)
                            <tr class="text-center">
                                <td class="border border-black px-1 py-1">{{ $i + 1 }}</td>
                                <td class="border border-black px-1 py-1 text-left">{{ $s[0] }}</td>
                                <td class="border border-black px-1 py-1">{{ $s[1] }}</td>
                                <td class="border border-black px-1 py-1">{{ $s[2] }}</td>
                                <td class="border border-black px-1 py-1">{{ $s[3] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div> --}}

    <div class="w-full font-[Times_New_Roman] text-[12px] mt-5">
        <div class="flex">
            <!-- Left Table -->
            <div class="w-1/2 pr-1">
                <table class="w-full border border-black border-collapse">
                    <thead>
                        <tr class="text-center">
                            <th class="border border-black px-1 py-1">Nº</th>
                            <th class="border border-black px-1 py-1">SUBJECT</th>
                            <th class="border border-black px-1 py-1">HOUR</th>
                            <th class="border border-black px-1 py-1">SCORE (100/100)</th>
                            <th class="border border-black px-1 py-1">GRADE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="border border-black">1</td>
                            <td class="border border-black text-left pl-1">English Education</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">60.00</td>
                            <td class="border border-black">C</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">2</td>
                            <td class="border border-black text-left pl-1">Windows Servers</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">50.00</td>
                            <td class="border border-black">C</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">3</td>
                            <td class="border border-black text-left pl-1">Computer Design and Publishing</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">78.00</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">4</td>
                            <td class="border border-black text-left pl-1">Microsoft SQL Server</td>
                            <td class="border border-black">120</td>
                            <td class="border border-black">58.00</td>
                            <td class="border border-black">C</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">5</td>
                            <td class="border border-black text-left pl-1">PHP Programming with MySQL</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">52.00</td>
                            <td class="border border-black">C</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">6</td>
                            <td class="border border-black text-left pl-1">E-Commerce</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">71.50</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">7</td>
                            <td class="border border-black text-left pl-1">Interactive Multimedia Design</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">74.00</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">8</td>
                            <td class="border border-black text-left pl-1">Linux Servers</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">74.00</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">9</td>
                            <td class="border border-black text-left pl-1">Object Oriented Programming</td>
                            <td class="border border-black">60</td>
                            <td class="border border-black">69.00</td>
                            <td class="border border-black">C+</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Right Table -->
            <div class="w-1/2 pl-1">
                <table class="w-full border border-black border-collapse">
                    <thead>
                        <tr class="text-center">
                            <th class="border border-black px-1 py-1">Nº</th>
                            <th class="border border-black px-1 py-1">SUBJECT</th>
                            <th class="border border-black px-1 py-1">HOUR</th>
                            <th class="border border-black px-1 py-1">SCORE (100/100)</th>
                            <th class="border border-black px-1 py-1">GRADE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="border border-black">12</td>
                            <td class="border border-black text-left pl-1">Digital Marketing</td>
                            <td class="border border-black">96</td>
                            <td class="border border-black">88.00</td>
                            <td class="border border-black">A</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">13</td>
                            <td class="border border-black text-left pl-1">IT Project Management</td>
                            <td class="border border-black">96</td>
                            <td class="border border-black">74.50</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">14</td>
                            <td class="border border-black text-left pl-1">Arduino Bootcamp</td>
                            <td class="border border-black">96</td>
                            <td class="border border-black">67.90</td>
                            <td class="border border-black">C+</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">15</td>
                            <td class="border border-black text-left pl-1">Mobile Application Framework</td>
                            <td class="border border-black">96</td>
                            <td class="border border-black">71.50</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">16</td>
                            <td class="border border-black text-left pl-1">Cisco Routing and Switching</td>
                            <td class="border border-black">144</td>
                            <td class="border border-black">83.22</td>
                            <td class="border border-black">B+</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">17</td>
                            <td class="border border-black text-left pl-1">Cyber Security Analysis</td>
                            <td class="border border-black">48</td>
                            <td class="border border-black">79.50</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">18</td>
                            <td class="border border-black text-left pl-1">M2M Communication System</td>
                            <td class="border border-black">48</td>
                            <td class="border border-black">73.00</td>
                            <td class="border border-black">B</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="border border-black font-bold text-left pl-1">Final Thesis:</td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-black">19</td>
                            <td class="border border-black text-left pl-1">POS Management System on Mobile</td>
                            <td class="border border-black">240</td>
                            <td class="border border-black">74.50</td>
                            <td class="border border-black">B</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
