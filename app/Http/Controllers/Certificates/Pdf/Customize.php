<?php

namespace App\Http\Controllers\Certificates\Pdf;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class Customize extends Controller
{
    public function downloadPdf()
    {
        $html = View::make('certificate.pdf.custom', ['name' => 'John Doe'])->render();
        $filePath = storage_path('app/public/print/output.pdf');
        $filename = 'YTM-' . Carbon::now()->format('Y-m-d') . '-' . Str::random(8) . '.pdf';

        Browsershot::html($html)
            ->setChromePath('C:\Users\DEV-404\.cache\puppeteer\chrome\win64-137.0.7151.55\chrome-win64\chrome.exe')
            ->setCustomTempPath(storage_path('app/private/livewire-tmp'))
            ->format('A3')
            ->margins(15, 10, 15, 10)
            ->landscape()
            ->savePdf($filePath);
        return response()->stream(function () use ($filePath) {
            readfile($filePath);
            unlink($filePath);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
