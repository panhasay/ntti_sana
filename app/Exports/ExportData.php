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
    public function __construct($data, $blade_download, $department, $skills, $sections, $qualification)
    {
        $this->data = $data;
        $this->blade_download = $blade_download;
        $this->department = $department;
        $this->skills = $skills;
        $this->sections = $sections;
        $this->qualification = $qualification;
    }

    public function view(): View
    {
        $this->data['department'] = $this->department;
        $this->data['skills'] = $this->skills;
        $this->data['sections'] = $this->sections;
        $this->data['qualification'] = $this->qualification;
        // Use the instance property $this->blade_download
        return view($this->blade_download, $this->data);
    } 
}


 