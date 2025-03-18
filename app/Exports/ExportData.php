<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportData implements FromView, WithStyles
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
            'header' => $this->header,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Apply styles to the first row (headers)
                'font' => [
                    'name' => 'Kh Battambang',
                    'size' => 14, // Optional: Adjust font size
                    'bold' => true, // Optional: Make headers bold
                ],
            ],
            'A2:Z1000' => [ // Apply styles to the remaining rows
                'font' => [
                    'name' => 'Kh Battambang',
                    'size' => 12,
                ],
            ],
        ];
    }
}
