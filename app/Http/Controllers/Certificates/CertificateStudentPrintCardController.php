<?php

namespace App\Http\Controllers\certificates;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\General\Picture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\CertificateStudentPrintCard;

class CertificateStudentPrintCardController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stu_code' => 'required|string|max:50',
            'class_code' => 'nullable|string|max:50',
            'print_by' => 'nullable|integer',
            'print_by_date' => 'nullable|date',
            'update_by' => 'nullable|integer',
            'update_by_date' => 'nullable|date',
            'status' => 'nullable|integer',
        ]);

        $record = CertificateStudentPrintCard::create($validated);

        return response()->json(['message' => 'Record added successfully', 'data' => $record], 201);
    }
    public function update(Request $request, $id)
    {
        $record = CertificateStudentPrintCard::findOrFail($id);

        $validated = $request->validate([
            'stu_code' => 'nullable|string|max:50',
            'class_code' => 'nullable|string|max:50',
            'print_by' => 'nullable|integer',
            'print_by_date' => 'nullable|date',
            'update_by' => 'nullable|integer',
            'update_by_date' => 'nullable|date',
            'status' => 'nullable|integer',
        ]);
        $record->update($validated);

        return response()->json(['message' => 'Record updated successfully', 'data' => $record], 200);
    }

    public function uploadZip(Request $request)
    {
        $request->validate([
            'zipFile' => 'required|file|mimes:zip|max:20480',
        ]);

        $zipPath = $request->file('zipFile')->store('temp');
        $zipRealPath = storage_path('app/' . $zipPath);

        $zip = new ZipArchive;
        if ($zip->open($zipRealPath) === TRUE) {
            $extractPath = storage_path('app/temp/extracted');
            $zip->extractTo($extractPath);
            $zip->close();

            $files = scandir($extractPath);
            $updatedStudents = [];

            foreach ($files as $file) {
                if (in_array($file, ['.', '..'])) {
                    continue;
                }

                $studentId = pathinfo($file, PATHINFO_FILENAME);
                $student = Picture::where('id', $studentId)->first();

                if ($student && preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
                    $imagePath = $extractPath . '/' . $file;
                    $newPath = 'public/students/' . $file;

                    Storage::put($newPath, file_get_contents($imagePath));
                    $student->photo = $newPath;
                    $student->save();

                    $updatedStudents[] = $student->id;
                }
            }

            Storage::deleteDirectory('temp/extracted');
            Storage::delete($zipPath);

            return response()->json([
                'message' => 'ZIP processed successfully.',
                'updatedStudents' => $updatedStudents,
            ]);
        } else {
            return response()->json(['message' => 'Failed to open ZIP file.'], 500);
        }
    }
}
