<?php

namespace App\Service;

class KhmerDateConverter
{
    public static function convertToKhmerDate($date)
    {
        $ceYear = date('Y', strtotime($date));
        $khmerYear = $ceYear - 543;

        $ceMonth = date('m', strtotime($date));
        $khmerMonth = '';

        switch ($ceMonth) {
            case '01':
                $khmerMonth = 'មករា';
                break;
            case '02':
                $khmerMonth = 'កម្ភៈ';
                break;
            case '03':
                $khmerMonth = 'មិនា';
                break;
            case '04':
                $khmerMonth = 'មេសា';
                break;
            case '05':
                $khmerMonth = 'ឧសភា';
                break;
            case '06':
                $khmerMonth = 'មិថុនា';
                break;
            case '07':
                $khmerMonth = 'កក្កដា';
                break;
            case '08':
                $khmerMonth = 'សីហា';
                break;
            case '09':
                $khmerMonth = 'កញ្ញា';
                break;
            case '10':
                $khmerMonth = 'តុលា';
                break;
            case '11':
                $khmerMonth = 'វិច្ឆិកា';
                break;
            case '12':
                $khmerMonth = 'ធ្នូ';
                break;
        }

        $khmerDay = date('d', strtotime($date));
        return $khmerDay . '-' . $khmerMonth . '-' . $khmerYear;
    }
}
