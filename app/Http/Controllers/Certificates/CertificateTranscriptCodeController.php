<?php

namespace App\Http\Controllers\Certificates;

use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\General\Qualifications;
use App\Models\Certificates\CertStudentOfficialTranscriptCode;

class CertificateTranscriptCodeController extends Controller
{
    public $deptCode;
    public $deptName;
    public $module;
    public $qualification;
    public $skills;

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->deptCode = $request->query('dept_code');
        $this->deptName = $request->query('dept_n');
        $this->module = $request->query('module');

        $this->qualification = Qualifications::whereNotNull('name_3')->get();
        $this->skills = Skills::get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sch_level' => 'required|string',
            'sch_skill' => 'required|string',
            'sch_code'  => 'required|string|unique:cert_student_official_transcript_code,code',
        ]);

        CertStudentOfficialTranscriptCode::updateOrCreate(
            ['code' => $validated['sch_code']],
            [
                'qualification_code' => $validated['sch_level'],
                'skills_code' => $validated['sch_skill'],
                'code'       => $validated['sch_code'],
                'active'       => 1,
            ]
        );

        return response()->json(['success' => true]);
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'transcript_id' => 'required|integer',
            'sch_ucode'      => 'required|string|unique:cert_student_official_transcript_code,code',
        ]);

        CertStudentOfficialTranscriptCode::where('id', $validated['transcript_id'])->update([
            'code'  => $validated['sch_ucode'],
            'active' => 1,
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
    public function updateInactive(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        CertStudentOfficialTranscriptCode::where('id', $validated['id'])->update([
            'active' => 0,
            'inactived_by' => Auth::id(),
            'inactived_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function show(Request $request)
    {
        try {
            $search = $request->input('search');
            $status = $request->input('status');
            $records_data = CertStudentOfficialTranscriptCode::with(['qualification', 'skill'])
                ->when($status != '', function ($query) use ($status) {
                    $query->where('active', $status);
                })
                ->when($search != '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('code', 'LIKE', "%{$search}%")
                            ->orWhereHas('qualification', function ($q2) use ($search) {
                                $q2->where('name_3', 'LIKE', "%{$search}%");
                            })
                            ->orWhereHas('skill', function ($q3) use ($search) {
                                $q3->where('name_2', 'LIKE', "%{$search}%");
                            });
                    });
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'code' => $item->code,
                        'lv_eng' => $item->qualification->name ?? null,
                        'lv_kh' => $item->qualification->name_2 ?? null,
                        'lv_full' => $item->qualification->name_3 ?? null,
                        'sk_eng' => $item->skill->name ?? null,
                        'sk_kh' => $item->skill->name_2 ?? null,
                        'active' => $item->active,
                    ];
                });

            return response()->json([
                'records_data' => $records_data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showFirst(Request $request)
    {
        try {
            $id = $request->input('id');
            $records_data = CertStudentOfficialTranscriptCode::where('id', $id)
                ->where('active', 1)
                ->first();

            return response()->json([
                'records_data' => $records_data ?? []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function showFirstFull(Request $request)
    {
        try {
            $id = $request->input('id');
            $records_data = CertStudentOfficialTranscriptCode::with(['qualification', 'skill'])->where('id', $id)
                ->where('active', 1)
                ->first();

            return response()->json([
                'records_data' => $records_data ?? []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        return view('certificate.transcript.transcript-form-create-code', [
            'deptCode' => $this->deptCode,
            'deptName' => $this->deptName,
            'module'   => $this->module,
            'qualification' => $this->qualification,
            'skills' => $this->skills,
        ])->render();
    }
}
