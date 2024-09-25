<?php
namespace App\Service;
use App\Models\SystemSetup\TableField;
use App\Models\TableFieldModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
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

}

?>
