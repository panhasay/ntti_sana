<?php
namespace App\Http\Controllers\SystemSetup;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\SystemSetup\Table;
use App\Models\SystemSetup\TableField;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public $service;
    public $page;
    public $page_id;
    function __construct() {
        $this->service = new service();
        $this->page = "Table";
        $this->page_id = "10001";
    }
    public function index(){
        $tables = DB::select('SHOW TABLES');
        $records = Table::paginate(10);
        return view('system_setup.table',compact('tables','records'));
    }
    public  function table_filed(Request $request){
        $data = $request->all();
        $decode = $this->service->Decr_string($data['code'],null,null);
        $record = Table::where('id',$decode)->first();
        $records = TableField::where('table_name',$record->table_name)->get();
        $column = DB::getSchemaBuilder()->getColumnListing('table_field');
        return view('system_setup.table_field',compact('records','column'));
    }
    public function build(Request $request){
        try{
            $data = $request->all();
            $decode = $this->service->Decr_string($data['code'],null,null) ;
            $record = Table::where('id',$decode)->first();
            $exist = TableField::where('table_name',$record->table_name)->first();
            $column = DB::getSchemaBuilder()->getColumnListing($record->table_name);
            $i = 1;
            if($exist){
                TableField::where('table_name',$record->table_name)->delete();
                foreach($column as $col){
                    $str_replace = ucwords(str_replace("_", " ", $col));
                    $new = new TableField();
                    $new->table_id = $record->table_id;
                    $new->table_name = $record->table_name;
                    $new->field_name = $col;
                    $new->field_id = $record->table_id + $i;
                    $new->on_validate = 'no';
                    $new->max_lenght = 255;
                    $new->hide = 'no';
                    if($col == 'code')   $new->on_validate  = 'yes';
                    if(in_array($col,['created_at','updated_at','deleted_at','id'])) $new->hide = 'yes';
                    $new->email = Auth::user()->email;
                    $new->list_order = $i;
                    $i +=1;
                    $new->field_type = 'text';
                    $new->field_description = $str_replace;
                    $new->save();
                }
            }else{
                foreach($column as $col){
                    $str_replace = ucwords(str_replace("_", " ", $col));
                    $new = new TableField();
                    $new->table_id = $record->table_id;
                    $new->table_name = $record->table_name;
                    $new->field_name = $col;
                    $new->field_id = $record->table_id + $i;
                    $new->on_validate = 'no';
                    $new->max_lenght = 255;
                    $new->hide = 'no';
                    if($col == 'code')   $new->on_validate  = 'yes';
                    if(in_array($col,['created_at','updated_at','deleted_at','id'])) $new->hide = 'yes';
                    $new->email = Auth::user()->email;
                    $new->list_order = $i;
                    $new->field_type = 'text';
                    $i +=1;
                    $new->field_description = $str_replace;
                    $new->save();
                }
            }
            $records = TableField::where('table_name',$record->table_name)->paginate(10);
            $view = view('system_setup.table_field',compact('records','column'))->render();
            return response()->json(['status'=>'success','msg' =>'Table Build Successfuly','view'=>$view]);
        }catch(Exception $ex){
            DB::rollBack();
            $this->service->telegram($ex->getMessage(),$this->page,$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
}





