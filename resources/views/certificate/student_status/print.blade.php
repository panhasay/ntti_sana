<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certification Of Student Status</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Gideon+Roman&family=Hanuman:wght@100..900&family=Moul&family=Noto+Sans+Khmer:wght@100..900&family=Noto+Sans+SC:wght@100..900&family=Noto+Sans+TC:wght@100..900&display=swap"
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

        .time-roman-regular {
            font-family: "Times New Roman", serif;
        }

        .time-roman-bold {
            font-family: "Times New Roman", serif;
            font-weight: 900;
            font-size: 16px;
        }
    </style>
</head>

<body class="bg-white text-gray-900">
    <div class="mx-auto relative">
        <div class="flex justify-between items-start w-full max-w-5xl mx-auto">
            <!-- Left Block: Centered Text, Left Positioned -->
            <div class="w-fit text-center mt-15 pl-8">
                <h2 class="text-md font-bold moul-regular">ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h2>
                <p class="text-sm time-roman-bold">Ministry of Labor and Vocational Training</p>
                <p class="font-semibold mt-1 moul-regular">វិទ្យាស្ថានបណ្ដុះបណ្ដាលបច្ចេកទេសជាតិ</p>
                <p class="text-sm time-roman-bold">National Technical Training Institute</p>
                <p class="ref battambang-regular">លេខ:
                    {{ $record->reference_code ?? '........................ វ.ជ.ប.ប' }}</p>
                <div>
                    <img src="{{ public_path('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view"
                        width="50" title="Style Khmer" class="block mx-auto">
                </div>
            </div>

            <div class="w-fit text-center ml-auto mt-0 pr-8">
                <h2 class="font-bold text-lg moul-regular">ព្រះរាជាណាចក្រកម្ពុជា</h2>
                <p class="text-sm time-roman-bold">KINGDOM OF CAMBODIA</p>
                <p class="text-sm font-medium mt-1 moul-regular">ជាតិ សាសនា ព្រះមហាក្សត្រ</p>
                <p class="text-sm time-roman-bold">Nation Religion King</p>
                <div>
                    <img src="{{ public_path('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view"
                        width="50" title="Style Khmer" class="block mx-auto">
                </div>
            </div>
        </div>



        <!-- Certificate Title -->
        <div class="mt-6 text-center">
            <h1 class="text-xl font-extrabold moul-regular">លិខិតបញ្ជាក់ការសិក្សា</h1>
            <h2 class="text-base font-semibold tracking-wide uppercase time-roman-bold">Certification Of Student Status
            </h2>
        </div>

        <!-- Body -->
        <div class="mt-8 leading-7">
            <div class="flex justify-center gap-8 w-full max-w-5xl mx-auto">
                <!-- Left Column: English -->
                <div class="text-center time-roman-regular">
                    <p class="text-sm font-semibold">The Director of National Technical Training Institute certifies
                        that:</p>
                    <p class="text-sm font-semibold mt-1">Certifies that</p>
                </div>

                <!-- Right Column: Khmer -->
                <div class="text-center">
                    <p class="text-sm moul-regular">នាយកវិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</p>
                    <p class="text-sm moul-regular mt-1">បញ្ជាក់ថា</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mt-4 text-base">
                <!-- English Column -->
                <div class="space-y-1 time-roman-regular">
                    <div class="flex flex-wrap">
                        <span>Name:</span>
                        <span class="font-semibold pl-2">{{ $records_info->name }}</span>

                        <span class="ml-auto">Sex:</span>
                        <span
                            class="font-semibold pl-2">{{ $records_info->gender == 'ស្រី' ? 'Female' : 'Male' }}</span>
                    </div>
                    <div class="flex">
                        <span>Date of Birth:</span>
                        <span
                            class="font-semibold pl-2">{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
                    </div>
                    <div class="flex">
                        <span>Place of Birth:</span>
                        <span class="font-semibold pl-2">{{ $records_info->guardian_address ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Khmer Column -->
                <div class="space-y-1 battambang-regular">
                    <div class="flex">
                        <span>និស្សិតឈ្មោះ៖</span>
                        <span class="font-semibold pl-2">{{ $records_info->name_2 }}</span>

                        <span class="ml-auto">ភេទ៖</span>
                        <span class="font-semibold pl-2">{{ $records_info->gender }}</span>
                    </div>
                    <div class="flex">
                        <span>ថ្ងៃខែឆ្នាំកំណើត៖</span>
                        <span
                            class="font-semibold pl-2">{{ \Carbon\Carbon::parse($records_info->date_of_birth)->format('j/M/Y') }}</span>
                    </div>
                    <div class="flex">
                        <span>ទីកន្លែងកំណើត៖</span>
                        <span class="font-semibold pl-2">{{ $records_info->guardian_address ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 max-w-5xl mx-auto mt-6 text-base leading-relaxed">
                <!-- English Column -->
                <div>
                    <p class="time-roman-regular">
                        Is the 01 year, semester 02 student of <span class="font-semibold">Diploma</span> level at the
                        <span class="font-semibold">National Technical Trainning Institute</span>
                        in the academic year 2024-2025 in the field of <span class="font-semibold">Information
                            Technology</span>... Group<span class="font-semibold">IT07B</span>...
                    </p>
                    <p class="mt-10">
                        This certificate is issued to the bearer for any offical purpose it my serve.
                    </p>
                </div>

                <!-- Khmer Column -->
                <div class="battambang-regular leading-loose">
                    <p>
                        ជានិស្សិតឆ្នាំទី<span class="font-semibold moul-regular">០១</span> ឆមាសទី<span
                            class="font-semibold moul-regular">០២</span> ថ្នាក់<span
                            class="font-semibold moul-regular">បរិញ្ញាបត្រជាន់ខ្ពស់</span>
                        ក្រុម<span class="font-semibold">IT07B</span> មុខជំនាញ <span
                            class="font-semibold moul-regular">ព័ត៏មានវិទ្យា</span>
                        នៅវិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស​ ក្នុងឆ្នាំសិក្សា ២០២៤-២០២៥ ពិតប្រាកដមែន។
                    </p>
                    <p class="mt-3">
                        លិខិតនេះបានចេញឱ្យសាមីខ្លួនយកទៅប្រើប្រាស់តាមការដែលអាចប្រើបាន។
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
