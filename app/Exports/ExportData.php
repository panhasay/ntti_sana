<?php
namespace App\Exports;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
class ExportData implements FromView
{
    protected $data;
    protected $blade_download;
    protected $department;
    protected $skills;
    protected $sections;
    protected $qualification;
    protected $header;

    public function __construct($data, $blade_download, $department, $skills, $sections, $qualification, $header)
    {
        $this->data = $data;
        $this->blade_download = $blade_download;
        $this->department = $department;
        $this->skills = $skills;
        $this->sections = $sections;
        $this->qualification = $qualification;
        $this->header = $header;
    }

    public function view(): View
    {
        return view($this->blade_download, [
            'records' => $this->data,
            'department' => $this->department,
            'skills' => $this->skills,
            'sections' => $this->sections,
            'qualification' => $this->qualification,
            'header' =>  $this->header,
        ]);
    }
}


 