<?php

namespace App\Http\Controllers;
use Exception;
use App\MainSystem\system;
use App\Models\TablesModel;
use Illuminate\Http\Request;
use App\Models\UseSetupModel;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SystemController extends Controller
{
    public $system ;
    function __construct(){
        $this->system = new system();
    }
    public function selec2LiveSearch(Request $request){
        try{
            $data = $request->all();
            $table_name = $data['table'] ;
            $primary_field = $data['primary_field'];
            $description_field = $data['description_field'] ;
            $records = null;
            $condition = isset($data['value']) ? trim($data['value']) : '' ;
            switch($table_name) {
                case 'system_table' :
                    $use_table = TablesModel::pluck('table_name')->toArray() ;
                    $records = DB::select('SHOW TABLES');
                    collect($records)->transform(function ($row){
                            $row->no = $row->Tables_in_ks_01;
                            $row->description = $row->Tables_in_ks_01;
                            return $row ;
                        });
                    break;
                case 'system_path_view' :
                    $records = $this->getSubDirectories(resource_path('views/*'));
                     $records = collect($records)
                        ->map(fn ($value, $key) => [
                            'no' => $value ,
                            'description' => ''
                        ]);
                    break;
                case 'system_path_modal' :
                        $records = $this->getSubDirectories(app_path('Models/*'));
                         $records = collect($records)
                            ->map(fn ($value, $key) => [
                                'no' => $value ,
                                'description' => ''
                            ]);
                        break;
                case 'system_controller' :
                            $records = $this->getSubDirectories(app_path('Http/Controllers/*'));
                             $records = collect($records)
                                ->map(fn ($value, $key) => [
                                    'no' => $value ,
                                    'description' => ''
                                ]);
                        break;
                case 'system_routs' :
                            $records = $this->getFileInFolder(base_path('routes/*'));
                             $records = collect($records)
                                ->map(fn ($value, $key) => [
                                    'no' => $value ,
                                    'description' => ''
                                ]);
                            break;
                case 'table' :
                    $records = TablesModel::selectRaw("$primary_field as no ,$description_field as description")
                                    ->where(function($query) use ($condition,$primary_field,$description_field){
                                        $query->where("$primary_field", 'LIKE','%'.$condition.'%')
                                        ->orWhere("$description_field", 'LIKE','%'.$condition.'%');
                                    })->get();
                    break;
                
            }
            return  response()->json($records);

        }catch(Exception $ex){
            return response()->json(['status'=> 'error' ,'msg' => $ex->getMessage()]);
        }
    }

    public function getSubDirectories($dir)
    {
        $subDir = [];
        $directories = array_filter(glob($dir), 'is_dir');
        foreach ($directories as $directory) {
            array_push($subDir,$directory);
            if($this->getSubDirectories($directory.'/*')) {
                array_push($subDir, $this->getSubDirectories($directory.'/*'));
            }
        }
        
        $finalArrays = array_flatten($subDir);
        return $finalArrays;
    }

    public function getFileInFolder($dir) {
        return glob($dir);
    }

    public function showNotification(){
        try{
            $records = NotificationModel::where('is_read','no')->orderBy('created_at')->limit(20)->get();
            $view = view('admin.component.notification_list',compact('records'))->render() ;    
            return response()->json(['status' => 'success' ,'view' => $view]);
        }catch(Exception $ex){
            return response()->json(['status' => 'warning', 'msg' => $ex]) ;
        }
    }

    public function getTelegramID(Request $request){
        try{
            $bot_api = "https://api.telegram.org";
            $telegram_token = env('TELEGRAM_ERROR_TOKEN');
            $ch = curl_init();
            $apiUri = sprintf('%s/bot%s/%s', $bot_api, $telegram_token, 'getUpdates?offset=-1');
            $headers = [
                'Content-Type: application/json'
            ];

            curl_setopt($ch, CURLOPT_URL, $apiUri);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            $json_result = json_decode($result) ;
            $id = end($json_result->result);
            return response()->json(['status' => 'success','telegratem' => $id->message->from->id  ]);
        }catch(Exception $ex){
            return response()->json(['status' => 'warning', 'msg' => $ex]) ;
        }
    }

    public function update2FA(Request $request){
        try{
            $data = $request->all() ;
            $type = $data['type'];
            if($type == 'no') $type = 'yes' ;
            else $type = 'no' ; 
            $record = UseSetupModel::where('email',Auth::user()->email)->first()    ;
            $record->two_authentiacation= $type;
            $record->save() ;
            return response()->json(['status' =>'success' ,'msg' => '']) ;
        }catch(Exception $ex){
            return response()->json(['status' => 'warning', 'msg' => $ex]) ;
        }
    }

}
