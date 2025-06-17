<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROVISIONAL CERTIFICATE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Hanuman:wght@100..900&family=Moul&family=Noto+Sans+Khmer:wght@100..900&family=Noto+Sans+SC:wght@100..900&family=Noto+Sans+TC:wght@100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        @page {
            background: url('/asset/NTTI/images/modules/ntti-bg-offical-transcript.svg') no-repeat center center;
            background-size: cover;
        }

        .moul-regular {
            font-family: "Moul", serif;
            font-weight: 400;
            font-style: normal;
        }

        .hanuman> {
            font-family: "Hanuman", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .battambang-regular {
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>

<body class="bg-white text-gray-900">
    <div class="mx-auto relative">
        <div class="flex justify-between items-start w-full max-w-5xl mx-auto">
            <!-- Left Block: Centered Text, Left Positioned -->
            <div class="w-fit text-center mt-15">
                <h2 class="text-md font-bold moul-regular">ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h2>
                <p class="text-sm italic">Ministry of Labor and Vocational Training</p>
                <p class="font-semibold mt-1 moul-regular">វិទ្យាស្ថានបណ្ដុះបណ្ដាលបច្ចេកទេសជាតិ</p>
                <p class="text-sm italic">National Technical Training Institute</p>
                <p class="ref battambang-regular">លេខ: {{ $record->reference_code ?? '...OS/24... NTTI/IT' }}</p>
            </div>

            <div class="w-fit text-center ml-auto mt-0">
                <h2 class="font-bold text-lg moul-regular">ព្រះរាជាណាចក្រកម្ពុជា</h2>
                <p class="text-sm italic">KINGDOM OF CAMBODIA</p>
                <p class="text-sm font-medium mt-1 moul-regular">ជាតិ សាសនា ព្រះមហាក្សត្រ</p>
                <p class="text-sm italic">Nation Religion King</p>
            </div>
        </div>



        <!-- Certificate Title -->
        <div class="mt-6 text-center">
            <h1 class="text-xl font-extrabold moul-regular">វិញ្ញាបនបត្របណ្ដោះអាសន្ន</h1>
            <h2 class="text-base font-semibold tracking-wide">PROVISIONAL CERTIFICATE</h2>
        </div>

        <!-- Body -->
        <div class="mt-8 leading-7">
            <div class="flex justify-center gap-8 w-full max-w-5xl mx-auto">
                <!-- Left Column: English -->
                <div class="text-center">
                    <p class="text-sm">The Director of National Technical Training Institute certifies that:</p>
                    <p class="text-sm italic mt-1">Certifies that</p>
                </div>

                <!-- Right Column: Khmer -->
                <div class="text-center">
                    <p class="text-sm moul-regular">នាយកវិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</p>
                    <p class="text-sm moul-regular mt-1">បញ្ជាក់ថា</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mt-4 battambang-regular text-base">
                <!-- English Column -->
                <div class="space-y-1">
                    <div class="flex">
                        <span class="w-40 font-semibold">Name:</span>
                        <span>{{ $records_info->name }}</span>
                    </div>
                    <div class="flex flex-wrap">
                        <span class="w-20 font-semibold">Sex:</span>
                        <span class="w-20">{{ $records_info->gender == 'ស្រី' ? 'Female' : 'Male' }}</span>
                        <span class="w-28 font-semibold">Nationality:</span>
                        <span>Cambodian</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-semibold">Date of Birth:</span>
                        <span>{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-semibold">Place of Birth:</span>
                        <span>{{ $records_info->guardian_address ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Khmer Column -->
                <div class="space-y-1">
                    <div class="flex">
                        <span class="w-40 font-semibold">និស្សិតឈ្មោះ:</span>
                        <span>{{ $records_info->name_2 }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-20 font-semibold">ភេទ:</span>
                        <span class="w-20">{{ $records_info->gender }}</span>
                        <span class="w-28 font-semibold">សញ្ជាតិ:</span>
                        <span>ខ្មែរ</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-semibold">ថ្ងៃខែឆ្នាំកំណើត:</span>
                        <span>{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-semibold">ទីកន្លែងកំណើត:</span>
                        <span>{{ $records_info->guardian_address ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 max-w-5xl mx-auto mt-6 text-base leading-relaxed">
                <!-- English Column -->
                <div>
                    <p>
                        has satisfied the requirements of the National Technical Training Institute for the reward of
                        the
                        degree of <span class="font-semibold">bachelor of Technology</span>.
                    </p>
                    <p class="mt-2"><span class="font-semibold">Major:</span> Information Technology</p>
                    <p><span class="font-semibold">Examination Date:</span> August 16, 2024</p>
                    <p class="mt-2">
                        This certificate is being issued to the bearer for use as deemed necessary.
                    </p>
                </div>

                <!-- Khmer Column -->
                <div class="battambang-regular leading-loose">
                    <p>
                        បានបំពេញគ្រប់លក្ខខណ្ឌរបស់វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចកទេសសម្រាប់ទទួល បរិញ្ញាបត្រ បច្ចេកវិទ្យា
                    </p>
                    <p class="mt-2">
                        ឯកទេស <span class="font-semibold">ព័ត៌មានវិទ្យា</span>
                    </p>
                    <p>សម័យប្រឡង <span class="font-semibold">១៦ សីហា ២០២៤</span></p>
                    <p class="mt-2">
                        វិញ្ញាបនបត្រនេះបានចេញឱ្យសាមីជនយកទៅប្រើប្រាស់តាមការដែលអាចប្រើបាន។
                    </p>
                </div>
            </div>

        </div>


        <!-- Footer (Signature area) -->
        {{-- <div class="mt-20 text-right">
            <p class="font-semibold">Phnom Penh, .................</p>
            <p class="mt-10 font-bold">Director</p>
        </div> --}}
        <div class="flex justify-end mt-8 text-sm leading-relaxed text-center max-w-5xl mx-auto pr-6">
            <div>
                <!-- Khmer Date (first line) -->
                <p class="battambang-regular">ធ្វើនៅថ្ងៃទី ១៦ ខែតុលា ឆ្នាំ ២០២៤</p>

                <!-- Khmer Date with location -->
                <p class="battambang-regular">ទីក្រុងភ្នំពេញ ថ្ងៃទី ១៦ ខែតុលា ឆ្នាំ ២០២៤</p>

                <!-- English Date -->
                <p class="mt-1 italic">Phnom Penh, <span class="font-semibold">October 16, 2024</span></p>

                <!-- Signature title -->
                <p class="mt-6 font-bold moul-regular">នាយកវិទ្យាស្ថាន</p>
            </div>
        </div>



    </div>
</body>

</html>
