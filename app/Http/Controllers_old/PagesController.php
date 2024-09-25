<?php

namespace App\Http\Controllers;

use Exception;
use Pusher\Pusher;
use App\Models\Pages;
use App\MainSystem\system;
use App\Models\TablesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
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
        $this->page = "Pages" ;
        $this->prefix = "pages";
        $this->page_id = '1003';
        $this->page_card_id = '1002';
        $this->modal_path = 'App\Models\Pages';
        $this->options = array('cluster' => 'ap1','encrypted' => true);
        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $this->options
        );

    }
    public function index(){
 
        $page = $this->page ;
        $page_id = $this->page_id ;
        $prefix = $this->prefix;
        $records = Pages::get();
        $fields = $this->system->getField($this->page_id) ;
        $param =[
            'page' => $page ,
            'page_id' => $page_id ,
            'prefix' => $prefix,
            'records' => $records,
            'fields' => $fields
        ];
        return view('admin.page.page',$param) ;
    }

    public function createData(Request $request){
        try{
            $modal_size = 'modal-xl' ;
            $page = $this->page ;
            $fields = $this->system->getField($this->page_id) ;
            $data = [
                'page' => $page,
                'modal_size' => $modal_size,
                'fields' => $fields ,
                'prefix' => $this->prefix,
                'custome_create_btn' => 'true'
            ];
            $view = view('admin.component.modal_create_data', $data)->render();
            return response()->json(['status' => 'success' ,'view' => $view]);
        }catch(Exception $ex){
          
        }
    }

    public function submitData(Request $request){
        DB::beginTransaction();
        try{
            $data = $request->all() ;
            $fields = $this->system->getField($this->page_id) ;
            $record =  new Pages();
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

    public function crateNewPage(Request $request){
        try{
            $data = $request->all() ;
            $table = TablesModel::where('table_id',$data['table_id'])->first() ;
            if(!$table) return response()->json(['status' => 'warning' ,'msg' => 'Table not setup !']) ;
            $this->createViewComponet($data['page_path'],$table->table_name);
            $this->newRoute($data['routs_path'],$table->table_name,$table->table_name);
            $this->createControllerComponent($data['controller_path'],$table->table_name,$data);
            $this->createModelsComponet($table->table_name);
            $this->generatePageId($data);
            return response()->json(['status' => 'success' ,'msg' => 'Table Create sucessfully ']) ;

        }catch(Exception $ex){
            dd($ex) ;
        }
    }

    public function initRoute($prefix,$table){
        $routes_name = $this->createFileName($table,'controller') ;
        $controller_path = trim("App\Http\Controllers\ ");
        $data = "\nRoute::group(['prefix' => '$prefix'],function(){  
            Route::controller($controller_path$routes_name::class)->group(function(){
                Route::get('','index');
                Route::post('/create-data','createData');
                Route::post('/delete-table','build');
                Route::post('/edit-data','editData');
                Route::post('/submit-data','submitData');
                Route::post('/delete-data','deleteData');
                Route::get('/ajax-paginate','ajaxPagination');
                Route::get('/search','search');
                Route::get('/export-excel/{table}','downLoadExcel');
                Route::get('/print-pdf/{table}','printPDF');
                Route::post('/upload-excel','ImportExcel');
            });
        });" ;




        return $data ;
    }
    public function createFileName($string,$type){
        $new_name =  '' ;
        switch($type) {
            case 'models' :
                $explode = explode('_',$string) ;
                foreach ($explode as $ex){
                    $new_name .= ucfirst($ex) ;
                }
                $new_name = $new_name.'Models';
                break ;
            case 'controller' :
                    $explode = explode('_',$string) ;
                    foreach ($explode as $ex){
                        $new_name .= ucfirst($ex) ;
                    }
                    $new_name = $new_name.'Controller';
                    break ;
            case 'class' :
                        $explode = explode('_',$string) ;
                        foreach ($explode as $ex){
                            $new_name .= ucfirst($ex) ;
                        }
                        $new_name = $new_name;
                        break ;
        }
        return $new_name ;
    }

    protected function newRoute($route_path,$prefix,$table) {

        $fp = fopen($route_path,'a'); 
        fwrite($fp,$this->initRoute($prefix,$table));   
        fclose($fp);
        return true;
    }

    protected function createViewComponet($path,$table_name){
        $view_template = base_path('stubs/view_list_template.stub') ;
        $current_template = file_get_contents($view_template);
        $blade_need_to = $path.'/'.$table_name.'/'.$table_name.'.blade.php';
        if(!is_dir($path.'/'.$table_name)) mkdir($path.'/'.$table_name, 0775, true); // Create Dir
        if(!file_exists($blade_need_to))  $createfile = fopen($blade_need_to, 'x'); // Create blade template 
        $fp = fopen($blade_need_to, 'w');
        fwrite($fp, $current_template);
        fclose($fp);
        chmod($blade_need_to, 0777);
        return true;
    }

    protected function createControllerComponent($path,$table_name,$data){
        $controller_tamplate = base_path('stubs/controller_custome.stub') ;
        $current_template = file_get_contents($controller_tamplate);
        $controller_name = $this->createFileName($table_name,'controller');
        $blade_path =    'admin.'.$table_name.'.'.$table_name;
        $model_name = $this->createFileName($table_name,'models');
        $array_key_need_to_replace = [
            'systemUserCreate' ,
            'systemModels',
            'systemClass',
            'systemPageName',
            'systemPrefix',
            'systemTable',
            'systemgetModel',
            'systemBladePath'
        ];
        $key = [
            'Pok puthea',
            trim('App\Models\ ').$model_name,
            $controller_name,
            $data['title'],
            $table_name,
            $data['table_id'],
            $model_name,
            $blade_path
            
        ];
        $sart_toreplace = str_replace($array_key_need_to_replace,$key,$current_template);
        $controller_path = app_path('Http/Controllers').'/'.$controller_name.'.php';
        fopen($controller_path, 'x');
        $fp = fopen($controller_path, 'w');
        fwrite($fp, $sart_toreplace);
        fclose($fp);
        chmod($controller_path, 0777);
        return true;
    }

    protected function createModelsComponet($table_name){
        $controller_tamplate = base_path('stubs/modals_custome.stub') ;
        $current_template = file_get_contents($controller_tamplate);
        $model_name = $this->createFileName($table_name,'models');
        $array_key_need_to_replace = [
            'modelClass' ,
            'modelTable',
        ];
        $key = [
            $model_name,
            $table_name
        ];
        $sart_toreplace = str_replace($array_key_need_to_replace,$key,$current_template);
        $model_path = app_path('Models').'/'.$model_name.'.php';
        fopen($model_path, 'x');
        $fp = fopen($model_path, 'w');
        fwrite($fp, $sart_toreplace);
        fclose($fp);
        chmod($model_path, 0777);
        return true;
    }

    protected function generatePageId($data){ 
        $page = Pages::max('id') ;
        $next_id = $page+1000 ;
        $record  = new Pages();
        $record->page_id = $next_id ;
        $record->table_name = $data['table_name'] ;
        $record->title = $data['title'] ;
        $record->table_id = $data['table_id'] ;
        $record->page_path = $data['page_path'] ;
        $record->type = $data['type'] ;
        $record->controller_path = $data['controller_path'] ;
        $record->routs_path = $data['routs_path'] ;
        $record->save() ;

    }

    protected function create_blade_path($data){
        
    }
}
