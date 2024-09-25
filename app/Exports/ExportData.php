<?php
namespace App\Exports;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
class ExportData implements FromView
{
    protected $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function view(): View
    {
        return view('reports.report_list_of_student_list',$this->data);
    } 
}

 