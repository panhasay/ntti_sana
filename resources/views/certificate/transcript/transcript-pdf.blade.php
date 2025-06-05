<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Official Transcript</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }
    </style>
</head>

<body class="px-16 py-10 text-sm leading-relaxed text-black">

    <div class="text-center mb-4">
        <div class="text-lg font-semibold">Ministry of Labour and Vocational Training</div>
        <div class="text-base">National Technical Training Institute</div>
        <div class="italic">Ref: 00002/25 NTTI/IT</div>
    </div>

    <div class="text-center mb-4">
        <div class="text-lg font-bold uppercase underline">Official Transcript</div>
    </div>

    <div class="flex justify-between mb-2">
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
    </div>

    <div class="text-center mb-6">
        Has successfully completed Bachelor of Technology in the field of Information Technology in academic year
        2018–2021
    </div>

    <!-- Table -->
    <div class="grid grid-cols-2 gap-4 text-xs">
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
    </div>
</body>

</html>
