<?php
namespace App\MainSystem;

use App\Models\NotificationModel;
use App\Models\TableFieldModel;
use App\Models\TablesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Pusher\Pusher;

class system{
    public function telegram($exception,$page) {
        $text = " ";
        $bot_api = "https://api.telegram.org";
        $telegram_id = env('TELEGRAM_ERROR_ID');
        $telegram_token = env('TELEGRAM_ERROR_TOKEN');

        $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'sendMessage');
                $text .= "Error Line Number: ".$exception->getLines();
                $text .= "\nFrom User : " .Auth::user()->email;
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
    public static function getField($table_id){
       
        $record = TableFieldModel::where('table_id',$table_id)
        // ->where('email',Auth::user()->email)
        ->where('hide','<>','yes')
        ->orderBy('list_order')
        ->get();
        return $record;
    }
    // param $table_id as array
    public static function getFieldJoin($table_id){
        $record = TableFieldModel::whereIn('table_id',$table_id)
        ->where('email',Auth::user()->email)
        ->where('hide','<>','yes')
        ->get();
        return $record;
    }
    public static function extractQuery($data,$table){
        $creterial= '1=1 and ';
        foreach($data as $key => $value){
            if(!self::hasColumn($table,$key)) continue ;
            if($value != ""){
                if(strpos($value,'||') === false){
                    $creterial .=  $key."="."'".$value."' and ";
                }else{
                    $expload = explode('||',$value);
                    $string = '' ;
                    foreach($expload as $_key =>$_value){
                        $trim_value = trim($_value) ;
                        $string .= "'$trim_value'," ;
                    }
                    $trim_string = rtrim($string, ",");
                    $creterial .=  $key." in "."($trim_string) and ";
                }
                
            } 
        }
        $creterial.='1=1';
    return $creterial;
    }

    public static function hasColumn($table,$column){
        if(Schema::hasColumn($table, $column)){
            return true;
        }else{
            return false;
        }
    }

    public static function sendNotifiactionPusher($table,$record,$action){
        $table = TablesModel::where('table_name',$table)->first() ;
      
        $options = array('cluster' => 'ap1', 'encrypted' => true);
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $record = new NotificationModel();
        $total_record = $record->countRecord() ;
        $record->table_id = $table->table_id;
        $record->description = "New record has been create from table $table->table_name" ;
        $record->record = json_encode($record);
        $record->is_read = 'no' ;
        $record->action = $action ;
        $record->save() ;
        $data = [
            'table' => $table,
            'record' => $record,
            'total_record' => $total_record + 1,
        ];
        $pusher->trigger("init_realtime_data", 'realtime', $data);
    }
}
?>
