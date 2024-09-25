<?php

// Created By : pokputhea2@gmail.com
// Created Date : 2024-22-02
// Type : page card & popup 

namespace App\Http\Controllers;

use App;
use Exception;
use Pusher\Pusher;
use App\Models\Tables;
use App\MainSystem\system;
use App\Models\TablesModel;
use Illuminate\Http\Request;
use App\Models\TableFieldModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TablesController extends Controller
{
    protected $system;
    protected $page ;
    protected $prefix ;
    protected $page_id ;
    protected $modal_path ;
    protected $page_card_id ;
    protected $pusher ;
    protected $options;
    function __construct()
    {
        // Global varaible Do not make any change , 
        $this->system = new system() ;
        $this->page = "Tables" ;
        $this->prefix = "tables";
        $this->page_id = '1001';
        $this->page_card_id = '1002';
        $this->modal_path = 'App\Models\Tables';
        $this->options = array('cluster' => 'ap1','encrypted' => true);
        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $this->options
        );

    }
    public function index(){
 
        $page = "Tables" ;
        $tabe_id = '1001' ;
        $page_id = '1001' ;
        $prefix = 'tables';
        $records = Tables::get();
        $param =[
            'page' => $page ,
            'tabe_id' => $tabe_id,
            'page_id' => $page_id ,
            'prefix' => $prefix,
            'records' => $records
        ];
        return view('admin.tables.tables',$param) ;
    }

    public function createData(Request $request){
        try{
            $modal_size = 'modal-lg' ;
            $page = $this->page ;
            $fields = $this->system->getField($this->page_id) ;
            $data = [
                'page' => $page,
                'modal_size' => $modal_size,
                'fields' => $fields ,
                'prefix' => $this->prefix 
            ];
            $view = view('admin.component.modal_create_data', $data)->render();
            return response()->json(['status' => 'success' ,'view' => $view]);
        }catch(Exception $ex){
          
        }
    }

    public function build(Request $request){
        DB::beginTransaction();
        try{
            $data = $request->all();
            $decode = $this->system->Decr_string($data['code'],null,null) ;
            $record = TablesModel::where('id',$decode)->first();
            $exist = TableFieldModel::where('table_name',$record->table_name)->first();
            $column = DB::getSchemaBuilder()->getColumnListing($record->table_name);
            $i = 1;
            if($exist){
                TableFieldModel::where('table_name',$record->table_name)->delete();
                foreach($column as $col){
                    $new = new TableFieldModel();
                    $new->table_id = $record->table_id;
                    $new->table_name = $record->table_name;
                    
                    $new->filed_name = $col;
                    $new->field_id = $record->table_id + $i;
                    $new->on_validate = 'no';
                    $new->max_lenght = 255;
                    $new->hide = 'no';
                    if($col == 'code')   $new->on_validate  = 'yes';
                    if(in_array($col,['created_at','updated_at','deleted_at','id'])) $new->hide = 'yes';
                    $new->email = '';
                    $new->list_order = $i;
                    $i +=1;
                    $new->field_type = 'text';
                    $new->save();
                }

            }else{
                foreach($column as $col){
                    $new = new TableFieldModel();
                    $new->table_id = $record->table_id;
                    $new->table_name = $record->table_name;
                    $new->filed_name = $col;
                    $new->field_id = $record->table_id + $i;
                    $new->on_validate = 'no';
                    $new->max_lenght = 255;
                    $new->hide = 'no';
                    if($col == 'code')   $new->on_validate  = 'yes';
                    if(in_array($col,['created_at','updated_at','deleted_at','id'])) $new->hide = 'yes';
                    $new->email = '';
                    $new->list_order = $i;
                    $new->field_type = 'text';
                    $i +=1;
                    $new->save();
                   
                }
            }
            DB::commit();
            $view = '';
            return response()->json(['status'=>'success','msg' =>'Table Build Successfuly','view'=>$view]);
        }catch(Exception $ex){
            DB::rollBack();
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }

    public function submitData(Request $request){
        DB::beginTransaction();
        try{
            $data = $request->all() ;
            $fields = $this->system->getField($this->page_id) ;
            // $record =  App::make($this->modal_path);
            $record = new Tables() ;
            foreach($fields as $field){
                $field_name = $field->filed_name ;
                if(isset($data[$field_name])){
                    $record->$field_name = trim($data[$field_name]) ;
                }
            }
            $record->save() ;
            DB::commit();
            return response()->json(['status' => 'success' ,'view' => 'view']);
        }catch(Exception $ex){
            DB::rollBack();
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
}   