<?php

namespace App\Http\Controllers\Certificates;

use App\Models\User;
use App\Models\StudentModel;
use App\Service\mPDFService;
use Illuminate\Http\Request;
use Mpdf\Config\FontVariables;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Config\ConfigVariables;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\General\AssingClasses;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Certificates\CertificateOfficialTranscript;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf as PdfWriter;

class TestingmPDFController extends Controller
{
    public function generatePDF()
    {
        $data = [];
        $options = [
            'format' => [62, 94],
            'margin_top' => 0,
            'margin_right' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
        ];

        $mPDFService = new mPDFService($options);

        $mPDFService->loadView('pdf/template', $data);
        return $mPDFService->output('khmer-document.pdf');
    }

    public function generateDompdf()
    {
        $pdf = Pdf::loadView('pdf.pdf-02')->setOptions([
            'dpi' => 150,
            'defaultFont' => 'khmerosbattambang'
        ]);

        return $pdf->stream('khmer-pdf.pdf');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'created_at']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="#" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function show(Request $request)
    {
        $dept_code = $request->input('dept_code') ?? 'all';
        $class_code = $request->input('class_code') ?? 'all';
        $qualification = $request->input('qualification') ?? 'all';
        $sections_code = $request->input('sections_code') ?? 'all';
        $skills_code = $request->input('skills_code') ?? 'all';
        $search = $request->input('search');

        $query = StudentModel::query()
            ->select([
                'student.*',
                'dept.name_2 as dept',
                'cls.name as class',
                'cls.level as level',
                'sk.name_2 as skill',
                DB::raw('(SELECT stu.name_2 FROM sections AS stu WHERE stu.code = cls.sections_code LIMIT 1) as section_type'),
                DB::raw('(SELECT stu.status FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as status_print'),
                DB::raw('(SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1) as stu_photo'),
                DB::raw('(SELECT stu.print_code FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as print_code')
            ])
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($dept_code, function ($query, $dept_code) {
                if ($dept_code != 'all') {
                    $query->where('cls.department_code', $dept_code);
                }
            })
            ->when($class_code, function ($query, $class_code) {
                if ($class_code != 'all') {
                    $query->where('student.class_code', $class_code);
                }
            })
            ->when($qualification, function ($query, $qualification) {
                if ($qualification != 'all') {
                    $query->where('student.qualification', $qualification);
                }
            })
            ->when($sections_code, function ($query, $sections_code) {
                if ($sections_code != 'all') {
                    $query->where('cls.sections_code', $sections_code);
                }
            })
            ->when($skills_code, function ($query, $skills_code) {
                if ($skills_code != 'all') {
                    $query->where('cls.skills_code', $skills_code);
                }
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('student.code', 'LIKE', "%{$search}%")
                        ->orWhere('student.name', 'LIKE', "%{$search}%")
                        ->orWhere('student.name_2', 'LIKE', "%{$search}%");
                });
            });

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('photo_status', function ($student) {
                $filePath = public_path('uploads/student/' . $student->stu_photo);
                return $student->stu_photo && file_exists($filePath) ? true : false;
            })
            ->addColumn('keyword', function ($student) {
                return secured_encrypt($student->code);
            })
            ->addColumn('record_assign_no', function ($student) {
                return AssingClasses::where('class_code', $student->class_code)
                    ->orderByDesc('session_year_code')
                    ->first();
            })
            ->addColumn('record_print', function ($student) {
                return CertificateOfficialTranscript::where('stu_code', $student->code)
                    ->where('class_code', $student->class_code)
                    ->orderByDesc('id')
                    ->first();
            })
            ->rawColumns(['photo_status', 'keyword', 'record_assign_no', 'record_print'])
            ->make(true);
    }

    public function generateSpatiePdf()
    {

        return Pdf::view('certificate.transcript.transcript-pdf', ['invoice' => 'sgsgsg'])
            ->format('a4')
            ->name('your-invoice.pdf');
    }

    public function exportPdf()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Sample data
        $sheet->setCellValue('A1', 'Hello World from Excel to PDF!');

        // Set PDF renderer
        $className = \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf::class;
        \PhpOffice\PhpSpreadsheet\IOFactory::registerWriter('Pdf', $className);

        // Generate and stream PDF
        $writer = new PdfWriter($spreadsheet);

        // Set headers
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'export.pdf');
    }

    public function downloadPdf()
    {
        $html = View::make('certificate.transcript.transcript-pdf', [
            'invoiceId' => 123,
            'invoice' => 'Any data you want to pass',
            'customer' => 'Jane Doe',
            'total' => 199.99
        ])->render();

        $pdfContent = Browsershot::html($html)
            ->format('A4')
            ->pdf();

        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice.pdf"');
    }
}
