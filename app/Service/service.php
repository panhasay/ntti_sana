<?php

namespace App\Service;

use App\Models\General\Classes;
use App\Models\General\Qualifications;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Models\SystemSetup\TableField;
use App\Models\TableFieldModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class service
{
    public function telegram($exception, $page, $line)
    {
        $text = " ";
        $bot_api = "https://api.telegram.org";

        $telegram_id = "5773722510";
        $telegram_token = "6554895672:AAHK0heN3rKeo0nIJB8ovW4MgNq9_09XS1o";

        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
        $text .= "Error Line Number: " . $line;
        $text .= "\nFrom User : " . Auth::user()->email ?? '';
        $text .= "\nFrom Url : " . request()->path();
        $text .= "\nFrom Page : {$page}";
        $text .= "\nError Message: {$exception}";
        $params = [
            'chat_id' => $telegram_id,
            'text' => $text
        ];
        $headers = [
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function telegramSendChangeUserPassword($user, $newPassword, $oldPassword)
    {
        $botApi = "https://api.telegram.org";
        $telegramId = "-4557828405"; // Replace with your actual chat ID
        $telegramToken = "7286298295:AAE5VeNDbrjXIPF2mJNlZMpXa1MhojXHvnQ"; // Replace with your actual bot token

        $apiUri = sprintf('%s/bot%s/sendMessage', $botApi, $telegramToken);

        // Constructing the message text
        $text = "=== User Log NTTI Portal ===\n";
        $text .= "Log Type: Update Password\n";
        $text .= "Email: " . ($user->email ?? 'N/A') . "\n";
        $text .= "Name: " . ($user->name ?? 'N/A') . "\n";
        $text .= "Old Password: " . ($oldPassword ?? 'N/A') . "\n";
        $text .= "New Password: " . ($newPassword ?? 'N/A') . "\n";
        $text .= "Role: " . ($user->role ?? 'N/A') . "\n";
        $text .= "By Department: " . ($user->department->name_2 ?? 'N/A');

        // Setting the request parameters
        $params = [
            'chat_id' => $telegramId,
            'text' => $text
        ];

        // Setting headers
        $headers = [
            'Content-Type: application/json'
        ];

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        // Execute cURL request and handle response
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            // Handle cURL errors
            $result = json_encode(['error' => curl_error($ch)]);
        }
        curl_close($ch);

        return $result;
    }
    public function telegramSendUserLog($email, $role, $department, $ip, $userAgent, $city, $type, $user_name)
    {
        $text = " ";
        $bot_api = "https://api.telegram.org";

        $telegram_id = "-4557828405";
        $telegram_token = "7286298295:AAE5VeNDbrjXIPF2mJNlZMpXa1MhojXHvnQ";

        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
        $text .= "\n" . "=== User Log NTTI Portal===";
        $text .= "\nLog Type : " . $type ?? '';
        $text .= "\nName : " . $user_name ?? '';
        $text .= "\nUser : " . $email ?? '';
        $text .= "\nUrl : " . request()->path();
        $text .= "\nRole : " . $role;
        $text .= "\nBy Department : " . $department ?? '';
        $text .= "\nBy Ip : " . $ip ?? '';
        $text .= "\nBy Ip : " . $userAgent ?? '';
        $text .= "\nBy Address : " . $city ?? '';
        $params = [
            'chat_id' => $telegram_id,
            'text' => $text
        ];
        $headers = [
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function telegramSendDeleteStudent($records, $type)
    {
        // Define the API URL and Telegram details
        $bot_api = "https://api.telegram.org";
        $telegram_id = "-4557828405"; // Replace with your Telegram group/channel/chat ID
        $telegram_token = "7286298295:AAE5VeNDbrjXIPF2mJNlZMpXa1MhojXHvnQ"; // Replace with your bot token

        // Fetch student data
        $data = Student::where('code', '=', $records->code)->first();
        $user = Auth::user();

        if (!$data) {
            return "No student found for the given code.";
        }

        // Start building the message
        $text = "=== User Log NTTI Portal ===";
        $text .= "\nType : " . $type ?? '';
        $text .= "\nEmail : " . $user->email ?? '';
        $text .= "\nName : " . $user->name ?? '';

        foreach ($data->toArray() as $key => $value) {
            $text .= "\n" . ucfirst(str_replace('_', ' ', $key)) . " : " . ($value ?? '');
        }

        // Prepare the API endpoint and payload
        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
        $params = [
            'chat_id' => $telegram_id,
            'text'    => $text
        ];

        // Send request using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        // Execute the request
        $result = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return "cURL Error: $error";
        }

        curl_close($ch);

        return $result;
    }

    public static function Encr_string($string, $param = 'AES-128-ECB', $password = 'per_hast_Cehck')
    {
        $encrypted_string = openssl_encrypt($string, 'AES-128-ECB', "per_hast_Cehck");
        return $encrypted_string;
    }
    public static function Decr_string($string, $param = 'AES-128-ECB', $password = 'per_hast_Cehck')
    {
        $table_id_2 = str_replace(' ', '+', $string);
        $decrypted_string = openssl_decrypt($table_id_2, 'AES-128-ECB', "per_hast_Cehck");
        return $decrypted_string;
    }
    public static function encrypt($string, $key = 5)
    {
        // $result = '';
        // for($i=0, $k= strlen($string); $i<$k; $i++) {
        //     $char = substr($string, $i, 1);
        //     $keychar = substr($key, ($i % strlen($key))-1, 1);
        //     $char = chr(ord($char)+ord($keychar));
        //     $result .= $char;
        // }        
        return base64_encode($string);
    }
    public static function decrypt($string, $key = 5)
    {
        // $result = '';
        // $string = base64_decode($string);
        // for($i=0,$k=strlen($string); $i< $k ; $i++) {
        //     $char = substr($string, $i, 1);
        //     $keychar = substr($key, ($i % strlen($key))-1, 1);
        //     $char = chr(ord($char)-ord($keychar));
        //     $result.=$char;
        // }
        // return $result;
        return base64_decode($string);
    }
    public static function getField($table_id)
    {
        $record = TableField::where('table_id', $table_id)
            ->where('email', Auth::user()->email)
            ->where('hide', '<>', 'yes')
            ->get();
        return $record;
    }
    public static function getFieldCustom($table_id)
    {
        $record = TableField::where('table_id', $table_id)
            ->where('email', Auth::user()->email)
            ->get();
        return $record;
    }
    public static function exportExcell($request, $page_id) {}
    // param $table_id as array
    public static function getFieldJoin($table_id)
    {
        $record = TableField::whereIn('table_id', $table_id)
            ->where('email', Auth::user()->email)
            ->where('hide', '<>', 'yes')
            ->get();
        return $record;
    }
    // public static function extractQuery($data){
    //     $creterial= '1=1 and ';
    //     foreach($data as $key => $value){
    //          if($value != ""){
    //             $creterial .=  $key."="."'".$value."' and ";
    //          }
    //     }
    //     $creterial.='1=1';
    // return $creterial;
    // }

    public static function extractQuery($data)
    {
        $creterial = '1=1 AND ';
        foreach ($data as $key => $value) {
            if ($value != "") {
                $creterial .= $key . " LIKE '%" . $value . "%' AND ";
            }
        }
        $creterial .= '1=1';
        return $creterial;
    }
    // public static function extractQueryRaw($data) {
    //     $creterial = '1=1 AND ';
    //     foreach ($data as $key => $value) {
    //         if ($value != "") {
    //             $creterial .= $key . " LIKE '%" . $value . "%' AND ";
    //         }
    //     }
    //     $creterial .= '1=1';
    //     return $creterial;
    // }

    public static function extractQueryRaw($data)
    {
        $creterial = '1=1 and ';
        foreach ($data as $key => $value) {
            if ($value != "") {
                $creterial .=  $key . "=" . "'" . $value . "' and ";
            }
        }
        $creterial .= '1=1';
        return $creterial;
    }
    public static function HasColumn($table, $column)
    {
        if (Schema::hasColumn($table, $column)) {
            return true;
        } else {
            return false;
        }
    }
    public static function convertToKhmerDate($date)
    {
        $ceYear = date('Y', strtotime($date));
        $khmerYear = $ceYear;
        $ceMonth = date('m', strtotime($date));
        $khmerMonth = '';

        switch ($ceMonth) {
            case '01':
                $khmerMonth = 'មករា'; // January
                break;
            case '02':
                $khmerMonth = 'កម្ភៈ'; // February
                break;
            case '03':
                $khmerMonth = 'មិនា'; // March
                break;
            case '04':
                $khmerMonth = 'មេសា'; // April
                break;
            case '05':
                $khmerMonth = 'ឧសភា'; // May
                break;
            case '06':
                $khmerMonth = 'មិថុនា'; // June
                break;
            case '07':
                $khmerMonth = 'កក្កដា'; // July
                break;
            case '08':
                $khmerMonth = 'សីហា'; // August
                break;
            case '09':
                $khmerMonth = 'កញ្ញា'; // September
                break;
            case '10':
                $khmerMonth = 'តុលា'; // October
                break;
            case '11':
                $khmerMonth = 'វិច្ឆិកា'; // November
                break;
            case '12':
                $khmerMonth = 'ធ្នូ'; // December
                break;
            default:
                $khmerMonth = '';
                break;
        }

        $khmerDay = date('d', strtotime($date));

        $khmerDate = $khmerDay . '-' . $khmerMonth . '-' . 'ឆ្នាំ' . $khmerYear;

        return $khmerDate;
    }
    public static function DateYearKH($date)
    {
        // Define the Khmer months
        $khmerMonths = [
            '01' => 'មករា',
            '02' => 'កុម្ភៈ',
            '03' => 'មីនា',
            '04' => 'មេសា',
            '05' => 'ឧសភា',
            '06' => 'មិថុនា',
            '07' => 'កក្កដា',
            '08' => 'សីហា',
            '09' => 'កញ្ញា',
            '10' => 'តុលា',
            '11' => 'វិច្ឆិកា',
            '12' => 'ធ្នូ',
        ];

        // Convert the date to a Carbon instance
        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

        // Extract the day, month, and year
        $day = $carbonDate->format('d');
        $month = $carbonDate->format('m');
        $year = $carbonDate->format('Y');

        // Convert to Khmer numerals
        $toKhmerNumerals = function ($number) {
            $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
            return str_replace(range(0, 9), $khmerDigits, $number);
        };

        // Build the Khmer date format
        $khmerDate = $toKhmerNumerals($day) . ' ' . $khmerMonths[$month] . ' ' . $toKhmerNumerals($year);

        return $khmerDate;
    }

    public static function calculateDateDifference($postingDate)
    {
        $currentDate = Carbon::now()->toDateString();
        $startDate = Carbon::createFromDate($postingDate);
        $endDate = Carbon::createFromDate($currentDate);
        $year_student = $startDate->diffInYears($endDate) + 1;
        return $year_student;
    }

    // format day khmer 
    public static function updateDateTime()
    {
        $now = new DateTime('now', new DateTimeZone('Asia/Phnom_Penh'));
        $dayOfWeek = self::getDayOfWeekKhmer($now->format('w'));
        $dayOfMonth = self::convertToKhmerNumerals($now->format('d'));
        $month = self::getMonthKhmer($now->format('n') - 1); // PHP months are 1-based
        $year = self::convertToKhmerNumerals($now->format('Y'));
        $hours = self::convertToKhmerNumerals(str_pad($now->format('H'), 2, '0', STR_PAD_LEFT));
        $minutes = self::convertToKhmerNumerals(str_pad($now->format('i'), 2, '0', STR_PAD_LEFT));
        $seconds = self::convertToKhmerNumerals(str_pad($now->format('s'), 2, '0', STR_PAD_LEFT));
        $formattedTime = "{$hours}:{$minutes}:{$seconds}";
        $prefix = self::getKhmerDatePrefix($now);

        return "{$prefix} {$dayOfMonth} ខែ{$month} ឆ្នាំ{$year}";
    }

    public static function getKhmerDatePrefix($date)
    {
        $khmerDays = ["ថ្ងៃអាទិត្យ", "ថ្ងៃចន្ទ", "ថ្ងៃអង្គារ", "ថ្ងៃពុធ", "ថ្ងៃព្រហស្បតិ៍", "ថ្ងៃសុក្រ", "ថ្ងៃសៅរ៍"];
        $khmerMonths = ["បុស្ស", "មាឃ", "ផល្គុន", "ចេត្រ", "ពិសាខ", "ជេស្ឋ", "អាសាឍ", "ស្រាពណ៏", "ភទ្របទ", "អស្សុជ", "កត្កិក", "បុស្ស"];
        $nameYear = ["ឆ្នាំជូត", "ឆ្នាំឆ្លួរ", "ឆ្នាំខាល", "ឆ្នាំថោះ", "ឆ្នាំរោង", "ឆ្នាំម្សាញ់", "ឆ្នាំមមី", "ឆ្នាំមមែ", "ឆ្នាំវក", "ឆ្នាំរកា", "ឆ្នាំច", "ឆ្នាំកុរ"];

        // Convert Gregorian year to Buddhist year
        $buddhistYear = self::convertToKhmerNumerals((int) $date->format('Y') + 543);

        // Calculate lunar date based on a reference date
        $referenceDate = new DateTime('2024-01-07');
        $interval = $date->diff($referenceDate);
        $daysSinceReference = (int) $interval->format('%a');
        $lunarMonthLength = 30; // Approximate length of a lunar month
        $lunarDay = ($daysSinceReference % $lunarMonthLength) + 1;
        $lunarPhase = $lunarDay <= 15 ? 'កើត' : 'រោច';
        $dayInLunarPhase = $lunarDay <= 15 ? $lunarDay : $lunarDay - 15;
        $khmerDayInLunarPhase = self::convertToKhmerNumerals(strval($dayInLunarPhase));

        $dayOfWeek = $khmerDays[$date->format('w')];
        $month = $khmerMonths[$date->format('n') - 1];
        $year = $nameYear[(($date->format('Y') - 5) % 12)];

        return "{$dayOfWeek} {$khmerDayInLunarPhase} {$lunarPhase} ខែ{$month} {$year} ឆស័ក ពុទ្ធសករាជ {$buddhistYear} ត្រូវនឹង ថ្ងៃ";
    }

    public static function getDayOfWeekKhmer($dayOfWeek)
    {
        $days = ["អាទិត្យ", "ចន្ទ", "អង្គារ", "ពុធ", "ព្រហស្បតិ៍", "សុក្រ", "សៅរ៍"];
        return isset($days[$dayOfWeek]) ? $days[$dayOfWeek] : "";
    }

    public static function getMonthKhmer($month)
    {
        $months = ["មករា", "កុម្ភៈ", "មិនា", "មេសា", "ឧសភា", "មិថុនា", "កក្កដា", "សីហា", "កញ្ញា", "តុលា", "វិច្ឆិកា", "ធ្នូ"];
        return isset($months[$month]) ? $months[$month] : "";
    }

    public static function convertToKhmerNumerals($number)
    {
        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        return strtr($number, [
            '0' => $khmerNumbers[0],
            '1' => $khmerNumbers[1],
            '2' => $khmerNumbers[2],
            '3' => $khmerNumbers[3],
            '4' => $khmerNumbers[4],
            '5' => $khmerNumbers[5],
            '6' => $khmerNumbers[6],
            '7' => $khmerNumbers[7],
            '8' => $khmerNumbers[8],
            '9' => $khmerNumbers[9],
        ]);
    }
    public static function convertKhmerToEnglishNumber($khmerNumber)
    {
        $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($khmerDigits, $englishDigits, $khmerNumber);
    }
    // end  format day khmer 
    public static function DateFormartKhmer($date)
    {
        // Define Khmer numerals
        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];

        // Convert the input date to a DateTime object
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        // Check if the date conversion was successful
        if (!$dateTime) {
            // Return a meaningful error message or handle the invalid input
            return "មិនមាន​ ថ្ងៃ ខែ ឆ្នាំ";
        }

        // Format the date as dd.mm.yyyy
        $formattedDate = $dateTime->format('d.m.Y');

        // Replace English numbers with Khmer numbers
        $khmerDate = str_replace(range(0, 9), $khmerNumbers, $formattedDate);

        return $khmerDate;
    }

    public static function GetDateIndexOption($data)
    {
        $sessionYearCode = Auth::user()->session_year_code ?? null;
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $qualifications = Qualifications::get();
        $classs = Classes::where('is_active', 'yes')
        ->WhereRaw(self::getRrecordsByDepartment());
        if (!empty($sessionYearCode)) {
            $classs = $classs->where('school_year_code', $sessionYearCode);
        }
        $classs = $classs->get();
        $skillCode = $classs->pluck('skills_code');

        $skills = DB::table('skills')->get();
        if (!empty(Auth::user()->department_code)) {
            $skills = DB::table('skills')->whereIN('code', $skillCode)->get();
        }

        $teachers = Teachers::WhitQueryPermission()->orderByRaw("name_2 COLLATE utf8mb4_general_ci")->get();

        return compact('sections', 'department', 'skills', 'qualifications', 'classs', 'teachers');
    }

    public static function CheckLogin($data)
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        return;
    }
    public static function convertToKhmerNumber($number)
    {
        return strtr($number, ['0' => '០', '1' => '១', '2' => '២', '3' => '៣', '4' => '៤', '5' => '៥', '6' => '៦', '7' => '៧', '8' => '៨', '9' => '៩']);
    }

    public static function getRrecordsByDepartment()
    {
        $code = Auth::user()->department_code;

        if (empty($code)) {
            return "1=1";
        }
        return "1=1 and department_code = '" . addslashes($code) . "'";
    }
    public static function formatSessionYearToKhmer($yearRange){
        $yearRange = str_replace('_', '-', $yearRange);

        $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        $westernDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($westernDigits, $khmerDigits, $yearRange);
    }
    public static function removeDotFromCode($classCode)
    {
        return str_replace('.', '', $classCode);
    }
    public static function filterByUser($query, $user)
    {
        if (!empty($user->session_year_code)) {
            $query = $query->where('session_year_code', $user->session_year_code);
        }

        if (!empty($user->department_code)) {
            $query = $query->where('department_code', $user->department_code);
        }

        return $query;
    }
}
