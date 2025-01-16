<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public static function getBaseUrl()
    {
        $scheme = request()->getScheme();
        $host = request()->getHost();
        $baseUrl = $scheme . '://' . $host;

        return response()->json(['base_url' => $baseUrl]);
    }

    public function generate(Request $request)
    {
        $baseUrl = $this->getBaseUrl()->getData()->base_url;
        $qrCode = QrCode::size(300)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($baseUrl . '/dashboard-student-account?code=474065');

        return view('debug/qrcode', ['qrCode' => $qrCode]);
    }
    public static function generateCardStudent($stu_code)
    {
        $baseUrl = self::getBaseUrl()->getData()->base_url;
        $qrCode = QrCode::size(60)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($baseUrl . '/dsa?code=' . urlencode($stu_code));

        return $qrCode;
    }
}
