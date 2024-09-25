<?php

// Created By : Pok puthea
// Created Date : 
// Type : page card & popup 

namespace App\Http\Controllers ;

use App;
use App\Exports\ExportData;
use App\Imports\ImportExcell;
use Exception;
use Pusher\Pusher;
use App\MainSystem\system;
use App\Models\MenuModels;;
use App\Models\TablesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\CssSelector\Node\FunctionNode;


class MenuController extends Controller
{
    protected $system;
    protected $page;
    protected $prefix;
    protected $page_id;
    protected $modal_path;
    protected $page_card_id;
    protected $pusher;
    protected $options;
    protected $blade_path;
    protected $primary_key;
    protected $new_modal;
    protected $pagination;
    function __construct()
    {
        // Global varaible Do not make any change , 
        $this->system = new system();
        $this->page = "Menu";
        $this->prefix = "menu";
        $this->page_id = '1005';
        $this->page_card_id = '1002';
        $this->modal_path = 'App\Models\App\Models\MenuModels';
        $this->blade_path = 'admin.menu_group.menu_group';
        $this->options = array('cluster' => 'ap1', 'encrypted' => true);
        $this->new_modal = new App\Models\MenuModels();
        $this->blade_path = 'admin.menu.menu';
        $this->primary_key =  $this->new_modal->getKeyName();
        $this->pagination =  env('DAFAUIL_PAGINATION');
        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $this->options
        );
    }
    public function index()
    {

        $page = $this->page;
        $tabe_id = $this->page_id;
        $page_id = $this->page_id;
        $prefix = $this->prefix;
        $fields = $this->system->getField($this->page_id);
        $records = App\Models\MenuModels::paginate($this->pagination);
        $param = [
            'page' => $page,
            'tabe_id' => $tabe_id,
            'page_id' => $page_id,
            'prefix' => $prefix,
            'records' => $records,
            'fields' => $fields,
            'primary_key' => $this->primary_key
        ];
        return view($this->blade_path, $param);
    }

    public function createData(Request $request)
    {
        try {
            $modal_size = 'modal-lg';
            $page = $this->page;
            $fields = $this->system->getField($this->page_id);
            $input = $request->all();
           
            if (isset($input['type']) && $input['type'] == 'edit') {
                $record = App\Models\MenuModels::where($this->primary_key, trim(decryptHelper($input['id'])))->first();
                if (!$record) return response()->json(['status' => 'warning', 'msg' =>  'Record not found in dadtabases']);
                $data = [
                    'page' => $page,
                    'modal_size' => $modal_size,
                    'fields' => $fields,
                    'prefix' => $this->prefix,
                    'record' => $record,
                    'primary_key' => $this->primary_key
                ];
            } else {
                $data = [
                    'page' => $page,
                    'modal_size' => $modal_size,
                    'fields' => $fields,
                    'prefix' => $this->prefix,
                ];
            }

            $view = view('admin.component.modal_create_data', $data)->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function submitData(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $fields = $this->system->getField($this->page_id);
            $primary_key  = $this->primary_key;
            $prefix = $this->prefix;
            $record = new App\Models\MenuModels();
            foreach ($fields as $field) {
                $field_name = $field->filed_name;
                if (isset($data[$field_name])) {
                    $record->$field_name = trim($data[$field_name]);
                }
            }
            $record->save();
            DB::commit();
            $this->system->sendNotifiactionPusher($this->prefix,$data,'create');
            $view = view('admin.component.list_record', compact('record', 'fields', 'primary_key', 'prefix'))->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function editData(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $fields = $this->system->getField($this->page_id);
            if (!isset($data['is_code']))   return response()->json(['status' => 'warning', 'msg' => 'Something went wrong !']);
            $record = App\Models\MenuModels::where($this->primary_key, $data['is_code'])->first();
            if (!$record) return response()->json(['status' => 'warning', 'msg' => 'Record not found in databases !']);

            foreach ($fields as $field) {
                $field_name = $field->filed_name;
                if ($field_name == $this->primary_key) continue;
                if (isset($data[$field_name])) {
                    $record->$field_name = trim($data[$field_name]);
                }
            }
            $record->save();
            DB::commit();
            return response()->json(['status' => 'success', 'view' => 'view']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex]);
        }
    }

    public function deleteData(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $record = App\Models\MenuModels::where($this->primary_key, $data['code'])->first();
            if (!$record)   return response()->json(['status' => 'warning', 'msg' => 'Record not found in databases ']);
            $record->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Record Successfully delete !']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex]);
        }
    }

    public function ajaxPagination(Request $request)
    {
        try {
            $data = $request->all();
            $query = $this->system->extractQuery($data, $this->prefix);
            $records = App\Models\MenuModels::whereRaw($query)->paginate($this->pagination);
            $page = $this->page;
            $tabe_id = $this->page_id;
            $page_id = $this->page_id;
            $prefix = $this->prefix;
            $fields = $this->system->getField($this->page_id);

            $param = [
                'page' => $page,
                'page_id' => $page_id,
                'prefix' => $prefix,
                'records' => $records,
                'fields' => $fields,
                'primary_key' => $this->primary_key
            ];

            $view = view('admin.component.table_list', $param)->render();
            // dd($view) ;
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex]);
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $request->all();
            $query = $this->system->extractQuery($data, $this->prefix);
            $records = App\Models\MenuModels::whereRaw($query)->paginate($this->pagination);
            $page = $this->page;
            $tabe_id = $this->page_id;
            $page_id = $this->page_id;
            $prefix = $this->prefix;
            $fields = $this->system->getField($this->page_id);

            $param = [
                'page' => $page,
                'page_id' => $page_id,
                'prefix' => $prefix,
                'records' => $records,
                'fields' => $fields,
                'primary_key' => $this->primary_key
            ];

            $view = view('admin.component.table_list', $param)->render();
            // dd($view) ;
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex]);
        }
    }

    public function downLoadExcel(Request $request, $request_table)
    {
        try {
            $request_data = $request->all();
            $query = $this->system->extractQuery($request_data, $this->prefix);
            $records = App\Models\MenuModels::whereRaw($query)->get();
            $page = $this->page;
            $page_id = $this->page_id;
            $prefix = $this->prefix;
            $fields = $this->system->getField($this->page_id);
            $param = [
                'page' => $page,
                'page_id' => $page_id,
                'prefix' => $prefix,
                'records' => $records,
                'fields' => $fields,
                'primary_key' => $this->primary_key,
                'excel' => true
            ];

            $table = TablesModel::where('table_name', $request_table)->first();
            $token = openssl_random_pseudo_bytes(10); // Random SSL value for generate file name
            $token = bin2hex($token); // convert to hex
            $save_to_path = 'export';
            $file_path = "export/$token-$request_table.xlsx";
            if (!file_exists($save_to_path)) mkdir($save_to_path, 0777, true);
        
            $http = $request->getSchemeAndHttpHost();
            // $domain = \Config::get('app.domain_name');
            $result = Excel::store(new ExportData($param), "$file_path",'local');
            $url =  "$http/app/$file_path";
            if (!$result)   return response()->json(['status' => 'warning', 'msg' => 'Something went wrong']);
            return response()->json(['status' => 'success', 'msg' => 'Successfully export excell', 'path' => $url]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }


    public function printPDF(Request $request,$table){
        try {
            $data = $request->all();
            $query = $this->system->extractQuery($data, $this->prefix);
            $records = App\Models\MenuModels::whereRaw($query)->get();
            $page = $this->page;
            $page_id = $this->page_id;
            $prefix = $this->prefix;
            $fields = $this->system->getField($this->page_id);

            $param = [
                'page' => $page,
                'page_id' => $page_id,
                'prefix' => $prefix,
                'records' => $records,
                'fields' => $fields,
                'primary_key' => $this->primary_key,
                'excel' => true,
                'print' => true
            ];

            $view = view('admin.component.table_list', $param)->render();
            // dd($view) ;
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex]);
        }

    }

    public function ImportExcel(Request $request){
        try{
            $data = $request->all();
            $row = Excel::toArray(new ImportExcell(),$data['uploadExcel']);
            $row_header = end($row);
            $header = $row_header[0];
            $main_data = collect([]);
            for($i = 1 ;$i<sizeof($row_header);$i++){
                 $collect = collect([]);
                  for($j =0; $j < sizeof($header);$j++){
                     $collect[$header[$j]]  = $row_header[$i][$j];
                  }
                  $main_data->push($collect->toArray());
            }
            $i=0;
            foreach($main_data as $sub_collection){
                $insert_record = new App\Models\MenuModels() ;
                 foreach($sub_collection as $key=>$value){
                     if($this->system->hasColumn($this->prefix,$key)) {
                         $insert_record[$key] = $value;
                     }
                 }
            $record_exist = App\Models\MenuModels::where($this->primary_key,$insert_record[$this->primary_key ?? ''])->first();
            if($record_exist){
                foreach ($insert_record->toArray() as $key=>$record) {
                    $record_exist[$key] = $record;
                }
                $record_exist->save();
            }else{
                $insert_record->save();
            }
            
            }
            return response()->json(['status' =>'success','msg' =>'Data Import Successfully']);
        }catch (\Exception $ex) {
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
}
