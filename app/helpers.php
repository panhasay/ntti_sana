<?php

use Carbon\Carbon;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Encryption\DecryptException;

if (!function_exists('encryptPagination')) {
    function encryptPagination($data): string
    {
        $secretKey = env('SECRET_KEY');

        return md5($data);
    }
}
if (!function_exists('decryptPagination')) {
    function decryptPagination($data): int|string
    {
        $secretKey = env('SECRET_KEY');
        $encryptedData = $data;

        try {
            return Crypt::decryptString($encryptedData, $secretKey);
        } catch (DecryptException $e) {
            return 404;
        }
    }
}
if (!function_exists('removeQueryParams')) {
    function removeQueryParams($url): string
    {
        $parsedUrl = parse_url($url);

        return isset($parsedUrl['path']) ? ltrim($parsedUrl['path'], '/') : '';
    }
}

if (!function_exists('route_js')) {
    function route_js($name, $parameters = []): Application|string|UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return url(route($name, $parameters));
    }
}
if (!function_exists('formatDateToKhmer')) {
    function formatDateToKhmer($date = null, $language = 'kh'): string
    {
        $date = $date ?? now();

        $carbonDate = Carbon::parse($date);

        $khmerMonths = [
            'មករា',
            'កុម្ភៈ',
            'មិនា',
            'មេសា',
            'ឧសភា',
            'មិថុនា',
            'កក្កដា',
            'សីហា',
            'កញ្ញា',
            'តុលា',
            'វិច្ឆិកា',
            'ធ្នូ'
        ];

        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];

        $englishMonths = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        if ($language === 'kh') {
            // Ensure day is two digits before converting to Khmer numerals
            $day = str_pad($carbonDate->day, 2, '0', STR_PAD_LEFT);
            $dayKhmer = str_replace(range(0, 9), $khmerNumbers, $day);

            // Convert year to Khmer numerals
            $yearKhmer = str_replace(range(0, 9), $khmerNumbers, $carbonDate->year);

            // Get Khmer month name
            $monthKhmer = $khmerMonths[$carbonDate->month - 1];

            return "ថ្ងៃទី{$dayKhmer} ខែ{$monthKhmer} ឆ្នាំ{$yearKhmer}";
        } elseif ($language === 'en') {
            $day = $carbonDate->day;
            $month = $englishMonths[$carbonDate->month - 1];
            $year = $carbonDate->year;

            return "Day {$day}, Month {$month}, Year {$year}";
        } else {
            throw new InvalidArgumentException("Unsupported language: {$language}");
        }
    }
}

if (!function_exists('synoeunDateFormateKhmer')) {
    function synoeunDateFormateKhmer($date = null, $language = 'kh'): string
    {
        $date = $date ?? now();

        $carbonDate = Carbon::parse($date);

        $khmerMonths = [
            'មករា',
            'កុម្ភៈ',
            'មិនា',
            'មេសា',
            'ឧសភា',
            'មិថុនា',
            'កក្កដា',
            'សីហា',
            'កញ្ញា',
            'តុលា',
            'វិច្ឆិកា',
            'ធ្នូ'
        ];

        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];

        $englishMonths = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        if ($language === 'kh') {
            // Ensure day is two digits before converting to Khmer numerals
            $day = str_pad($carbonDate->day, 2, '0', STR_PAD_LEFT);
            $dayKhmer = str_replace(range(0, 9), $khmerNumbers, $day);

            // Convert year to Khmer numerals
            $yearKhmer = str_replace(range(0, 9), $khmerNumbers, $carbonDate->year);

            // Get Khmer month name
            $monthKhmer = $khmerMonths[$carbonDate->month - 1];

            return "ថ្ងៃទី{$dayKhmer} ខែ{$monthKhmer} ឆ្នាំ{$yearKhmer}";
        } elseif ($language === 'en') {
            $day = $carbonDate->day;
            $month = $englishMonths[$carbonDate->month - 1];
            $year = $carbonDate->year;

            return "{$day}, {$month}, {$year}";
        } else {
            throw new InvalidArgumentException("Unsupported language: {$language}");
        }
    }
}

if (!function_exists('KhmerLunarCalendar')) {
    function KhmerLunarCalendar()
    {
        Carbon::setLocale('km');
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->translatedFormat('l d F Y');
        return $formattedDate;
    }
}


if (!function_exists('showDay')) {
    function showDay(): string
    {
        $daysInKhmer = [
            'Sunday' => 'ថ្ងៃអាទិត្យ',
            'Monday' => 'ថ្ងៃចន្ទ',
            'Tuesday' => 'ថ្ងៃអង្គារ',
            'Wednesday' => 'ថ្ងៃពុធ',
            'Thursday' => 'ថ្ងៃព្រហស្បតិ៍',
            'Friday' => 'ថ្ងៃសុក្រ',
            'Saturday' => 'ថ្ងៃសៅរ៍',
        ];
        $currentDay = now()->format('l');

        return $daysInKhmer[$currentDay] ?? 'Unknown Day';
    }
}
if (!function_exists('convertToKhmerNumber')) {
    function convertToKhmerNumber($number): string
    {
        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        $numberString = (string)$number;
        $khmerNumber = '';

        foreach (str_split($numberString) as $digit) {
            $khmerNumber .= $khmerNumbers[$digit];
        }

        return $khmerNumber;
    }
}

if (!function_exists('showLunarDay')) {
    function showLunarDay(): string
    {
        // Get the current day of the lunar cycle (1-30)
        $currentLunarDay = (now()->day % 30) ?: 30; // Simulate a lunar day cycle

        // Determine if it is កើត or រោច
        $phase = $currentLunarDay <= 15 ? 'កើត' : 'រោច';

        // Calculate the day number in the phase
        $dayInPhase = $currentLunarDay <= 15 ? $currentLunarDay : $currentLunarDay - 15;

        // Construct the result (e.g., "៧ កើត" or "៧ រោច")
        return convertToKhmerNumber($dayInPhase) . " $phase";
    }
}

if (!function_exists('showLunarInfo')) {
    function showLunarInfo()
    {
        $currentYear = now()->year;
        $khmerMonths = [
            'មិគសិរ',
            'បុស្ស',
            'មាឃ',
            'ផល្គុន',
            'ចេត្រ',
            'វិសាខ',
            'ជេស្ឋ',
            'អាសាឍ',
            'ស្រាពណ៍',
            'ភទ្របទ',
            'អស្សុជ',
            'កក្ដិក'
        ];

        $currentMonthIndex = (now()->month + 1) % 12;
        $khmerMonth = $khmerMonths[$currentMonthIndex - 1];

        $khmerYears = [
            'ជូត',
            'ឆ្លូវ',
            'ខាល',
            'ថោះ',
            'រោង',
            'ម្សាញ់',
            'មមី',
            'មមែ',
            'វក',
            'រកា',
            'ច',
            'កុរ'
        ];
        $baseYear = 2023;
        $yearDifference = $currentYear - $baseYear;
        $khmerYear = $khmerYears[($yearDifference % 12 + 12) % 12];
        $buddhistEra = $currentYear + 543;

        $cyclicYears = ['សំរាត', 'ចន្ទស័ក', 'អាចារ្យ', 'ឆស័ក', 'ត្រីស័ក', 'ចត្វាស័ក', 'បញ្ចស័ក', 'ឆេស័ក', 'នវស័ក', 'ទសស័ក'];
        $cyclicYear = $cyclicYears[$yearDifference % 10];

        return "ខែ$khmerMonth ឆ្នាំ$yearDifference";
    }
}
if (!function_exists('secured_encrypt')) {
    function secured_encrypt($data, $key = null)
    {
        try {
            $key ?? env('SECURE_KEY');
            $cipher = 'AES-256-CBC';
            $iv = random_bytes(openssl_cipher_iv_length($cipher));
            $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
            return base64_encode($iv . '::' . $encrypted);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

if (!function_exists('secured_decrypt')) {
    function secured_decrypt($encryptedData, $key = null)
    {
        try {
            $key ?? env('SECURE_KEY');
            $cipher = 'AES-256-CBC';
            $data = base64_decode($encryptedData);
            list($iv, $encrypted) = explode('::', $data, 2);
            return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

if (!function_exists('ordinalSup')) {
    function ordinalSup($number, $lang = 'en')
    {
        // Convert number with leading zero
        $formatted = str_pad($number, 2, '0', STR_PAD_LEFT);

        // Optional: Khmer digit map
        $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];

        // Convert formatted number to Khmer if needed
        if ($lang === 'kh') {
            $formatted = collect(str_split($formatted))
                ->map(fn($digit) => $khmerDigits[$digit])
                ->implode('');
        }

        // Determine ordinal suffix (always in English unless localized)
        $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        $suffix = 'th';

        if (($number % 100) < 11 || ($number % 100) > 13) {
            $suffix = $suffixes[$number % 10];
        }

        if ($lang == 'en') {
            $sup = '<sup>' . $suffix . '</sup>';
        } else {
            $sup = '';
        }

        return $formatted . $sup;
    }
}

if (!function_exists('leadingZero')) {
    function leadingZero($number, $lang = 'en')
    {
        $formatted = str_pad($number, 2, '0', STR_PAD_LEFT); // adds leading zero
        $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        if ($lang === 'kh') {
            $formatted = collect(str_split($formatted))
                ->map(fn($digit) => $khmerDigits[$digit])
                ->implode('');
        }
        return $formatted;
    }
}

if (!function_exists('extractAcademicYear')) {
    function extractAcademicYear($text, $lang = 'en')
    {
        // Match the first YYYY-YYYY pattern
        if (preg_match('/\d{4}-\d{4}/', $text, $matches)) {
            $yearRange = $matches[0];

            if ($lang === 'kh') {
                // Map to Khmer digits
                $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
                $yearRange = strtr($yearRange, [
                    '0' => $khmerDigits[0],
                    '1' => $khmerDigits[1],
                    '2' => $khmerDigits[2],
                    '3' => $khmerDigits[3],
                    '4' => $khmerDigits[4],
                    '5' => $khmerDigits[5],
                    '6' => $khmerDigits[6],
                    '7' => $khmerDigits[7],
                    '8' => $khmerDigits[8],
                    '9' => $khmerDigits[9],
                ]);
            }

            return $yearRange;
        }

        return null; // Or original text
    }
}
