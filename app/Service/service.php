<?php
namespace App\Service;
use App\Models\SystemSetup\TableField;
use App\Models\TableFieldModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Symfony\Component\CssSelector\Node\FunctionNode;

class service{
    public function telegram($exception,$page,$line) {
        $text = " ";
        $bot_api = "https://api.telegram.org";

        $telegram_id = "5773722510";
        $telegram_token = "6554895672:AAHK0heN3rKeo0nIJB8ovW4MgNq9_09XS1o";

        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
        $text .= "Error Line Number: ".$line;
        // $text .= "\nFrom User : " .Auth::user()->email ?? '';
        $text .= "\nFrom Url : ".request()->path();
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
    public function telegramSendUserLog($email,$role, $department, $ip, $userAgent, $city, $type) {
        $text = " ";
        $bot_api = "https://api.telegram.org";

        $telegram_id = "-4557828405";
        $telegram_token = "7286298295:AAG9-EFlyITzikQWsr1xz1URTez7vLrRaTc";

        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
        $text .= "\n" ."====== User Log NTTI Portal=======";
        $text .= "\nLog Type : " .$type ?? '';
        $text .= "\nUser : " .$email ?? '';
        $text .= "\nUrl : ".request()->path();
        $text .= "\nRole : ".$role;
        $text .= "\nBy Department : ".$department ?? '';
        $text .= "\nBy Ip : ".$ip ?? '';
        $text .= "\nBy Ip : ".$userAgent ?? '';
        $text .= "\nBy Address : ".$city ?? ''; 
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
    public static function Encr_string($string,$param='AES-128-ECB',$password = 'per_hast_Cehck'){
        $encrypted_string=openssl_encrypt($string,'AES-128-ECB',"per_hast_Cehck");
        return $encrypted_string;
    }
    public static function Decr_string($string,$param='AES-128-ECB',$password = 'per_hast_Cehck'){
        $table_id_2 = str_replace(' ','+',$string);
        $decrypted_string=openssl_decrypt($table_id_2,'AES-128-ECB',"per_hast_Cehck");
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
    public static function getField($table_id){
        $record = TableField::where('table_id',$table_id)
            ->where('email',Auth::user()->email)
            ->where('hide','<>','yes')
            ->get();
        return $record;
    }
    public static function getFieldCustom($table_id){
        $record = TableField::where('table_id',$table_id)
            ->where('email',Auth::user()->email)
            ->get();
        return $record;
    }
    public static function exportExcell ($request,$page_id){
        
    }
    // param $table_id as array
    public static function getFieldJoin ($table_id){
        $record = TableField::whereIn('table_id',$table_id)
            ->where('email',Auth::user()->email)
            ->where('hide','<>','yes')
            ->get();
        return $record;
    }
    public static function extractQuery($data){
        $creterial= '1=1 and ';
        foreach($data as $key => $value){
             if($value != ""){
                $creterial .=  $key."="."'".$value."' and ";
             }
        }
        $creterial.='1=1';
    return $creterial;
    }
    public static function HasColumn($table,$column){
        if(Schema::hasColumn($table, $column)){
            return true;
        }else{
            return false;
        }
    }
    public static function convertToKhmerDate($date) {
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

        $khmerDate = $khmerDay . '-' . $khmerMonth . 'ឆ្នាំ' . $khmerYear;

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
        $khmerMonths = ["មិគសិរ", "មាឃ", "ផល្គុន", "ចេត្រ", "ពិសាខ", "ជេស្ឋ", "អាសាឍ", "ស្រាពណ៏", "ភទ្របទ", "អស្សុជ", "កត្កិក", "បុស្ស"];
        $nameYear = ["ឆ្នាំជូត", "ឆ្នាំឆ្លួរ", "ឆ្នាំខាល", "ឆ្នាំថោះ", "ឆ្នាំរោង", "ឆ្នាំម្សាញ់", "ឆ្នាំមមី", "ឆ្នាំមមែ", "ឆ្នាំវក", "ឆ្នាំរកា", "ឆ្នាំច", "ឆ្នាំកុរ"];

        // Convert Gregorian year to Buddhist year
        $buddhistYear = self::convertToKhmerNumerals((int) $date->format('Y') + 544);

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
        $year = $nameYear[(($date->format('Y') - 4) % 12)];

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
            '0' => $khmerNumbers[0], '1' => $khmerNumbers[1], '2' => $khmerNumbers[2],
            '3' => $khmerNumbers[3], '4' => $khmerNumbers[4], '5' => $khmerNumbers[5],
            '6' => $khmerNumbers[6], '7' => $khmerNumbers[7], '8' => $khmerNumbers[8],
            '9' => $khmerNumbers[9],
        ]);
    }
    // end  format day khmer 
















    

}

?>
