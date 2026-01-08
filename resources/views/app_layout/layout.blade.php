<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NTTI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Dangrek&family=Moul&family=Moulpali&family=Noto+Sans+Khmer:wght@100..900&display=swap"
        rel="stylesheet">

    <link rel="shortcut icon"
        href="{{ asset('https://nttiportal.com/./uploads/school_content/logo/front_fav_icon-619eeffe4674b6.56720560.png') }}"
        type="image/x-icon">


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>
<style>
    .battambang-thin {
        font-family: "Battambang", system-ui;
        font-weight: 100;
        font-style: normal;
    }

    .battambang-light {
        font-family: "Battambang", system-ui;
        font-weight: 300;
        font-style: normal;
    }

    .battambang {
        font-family: "Battambang", system-ui;
        font-weight: 400;
        font-style: normal;
    }

    .battambang-bold {
        font-family: "Battambang", system-ui;
        font-weight: 700;
        font-style: normal;
    }

    .battambang-black {
        font-family: "Battambang", system-ui;
        font-weight: 900;
        font-style: normal;
    }

    .moul-regular {
        font-family: "Moul", serif;
        font-weight: 400;
        font-style: normal;
    }
</style>

<body class="min-h-screen bg-gray-50 flex flex-col  ">

    <nav class="">
        <div
            class="max-w-full md:max-w-3xl lg:max-w-5xl xl:max-w-6xl 2xl:max-w-[83rem] mx-auto flex flex-wrap items-center justify-between  p-4">
            <a class="flex-none text-xl font-semibold dark:text-white focus:outline-hidden focus:opacity-80"
                href="{{ url('/department-menu') }}" aria-label="Brand">
                <img class="w-62 h-auto" src="{{ asset('asset/NTTI/images/logo.png') }}" alt="logo">
            </a>
            <div class="flex">
                <div class="flex">
                    <?php
                    $user = Auth::user();
                    $picture = App\Models\General\Picture::where('code', $user->id ?? '')
                        ->where('type', 'profile')
                        ->value('picture_ori');
                    ?>
                    @if (isset($picture) && $picture != null)
                    <img class="inline-block size-10 rounded-full" src="{{ $picture }}" alt="Avatar">
                    @else
                    <img class="inline-block size-10 rounded-full"
                        src="{{ asset('asset/NTTI/images/faces/default_User.jpg') }}" alt="Avatar">
                    @endif




                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="hidden hover:bg-gray-200 font-medium text-sm px-2 py-2.5 text-center md:inline-flex items-center cursor-pointer  md:block md:w-auto"
                        type="button">{{ Auth::user()->name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 ">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ url('profile') }}">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('logout') }}">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" y1="12" x2="9" y2="12" />
                                    </svg>
                                    Signout
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
                <button data-collapse-toggle="navbar-dropdown" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="hidden w-full md:hidden" id="navbar-dropdown">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="flex  py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent"
                            aria-current="page"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                <line x1="8" x2="16" y1="21" y2="21" />
                                <line x1="12" x2="12" y1="17" y2="21" />
                            </svg>
                            Department</a>
                    </li>
                    <li>


                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                    </li>

                    <li class="nav-item">
              <div class="nav-link d-flex">

                {{-- <button class="btn btn-sm bg-danger text-white"> Trailing </button> --}}
                {{-- page  for hold  --}}
                 <?php
                        $user = Auth::user();
                        $picture =  App\Models\General\Picture::where('code', $user->id ?? '')->where('type','profile')->value('picture_ori');
                        $sessionYear = App\Models\General\SessionYear::orderBy('code', 'desc')->get();
                    ?>
                <div class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle text-white font-weight-semibold"
                     id="current_session_year" href="#" data-bs-toggle="dropdown" style="font-size: 14px !important;">​ឆ្នាំសិក្សា {{ str_replace('_', '-', Auth::user()->session_year_code ?? '') }}</a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    @foreach ($sessionYear as $record)
                        <a class="dropdown-item" href="#" id="session_year_code" data-code="{{ $record->code ?? '' }}">
                            {{ $record->name ?? '' }}
                        </a>
                    @endforeach
                  </div>
                </div>
                {{-- <a id="systemSettings" class="text-white" href="#"><i class="mdi mdi-settings"></i></a> --}}
              </div>
            </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="w-full bg-[#2194ce] hidden md:block md:w-auto">
        <div class="max-w-full md:max-w-3xl lg:max-w-5xl xl:max-w-6xl 2xl:max-w-[83rem] mx-auto h-15 flex items-center">
            <a href="{{ url('/dashboard') }}"
                class="flex items-center gap-2 px-6 h-15 text-white hover:bg-[#197bb0] transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="2" />
                    <polygon points="16.24,7.76 14.12,14.12 7.76,16.24 9.88,9.88" fill="white" />
                </svg>
                Dashboard
            </a>

            <a href="{{ url('/department-menu') }}"
                class="flex items-center gap-2 px-6 h-15 text-white hover:bg-[#197bb0] transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="3" rx="2" />
                    <line x1="8" x2="16" y1="21" y2="21" />
                    <line x1="12" x2="12" y1="17" y2="21" />
                </svg>
                Department
            </a>
            <div class="flex-1"></div>
            {{-- <a href="{{ url('/menu-reports') }}"
                class="flex items-center gap-2 px-6 h-15 text-white hover:bg-[#197bb0] transition">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
                <i class="mdi mdi-file-document"></i> Report
            </a> --}}
            {{-- <a href="#" class="flex items-center gap-2 px-6 h-15 text-white hover:bg-[#197bb0] transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                        clip-rule="evenodd" />
                </svg>

            </a> --}}
        </div>
    </nav>

    <main class="flex-1 w-full">
        <div
            class="max-w-full md:max-w-3xl lg:max-w-5xl xl:max-w-6xl 2xl:max-w-[83rem] mx-auto md:px-4 py-6 flex-1 w-full">
            @yield('content')
        </div>
    </main>

    <footer class="bg-[#2194ce] text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            <span class="block text-xs">
                Copyright © 2024
                <a href="https://www.ntti.edu.kh/" target="_blank"
                    class="underline text-green-500 hover:text-gray-200">National Technical Training Institute</a>
                <span class="block sm:inline">អាសយដ្ឋាន: មហាវិថី សហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ
                    រាជធានីភ្នំពេញ</span>
                <a href="https://www.facebook.com/panha.say.73" target="_blank"
                    class="underline text-green-500 hover:text-gray-200 ml-2">Developed By</a>
            </span>
        </div>
    </footer>

</body>

</html>