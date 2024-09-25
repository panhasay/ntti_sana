<?php
class KhmerDateConverter {
    public static function convertToKhmerDate($date) {
        $ceYear = date('Y', strtotime($date));
        $khmerYear = $ceYear - 543;

        $ceMonth = date('m', strtotime($date));
        $khmerMonth = '';

        switch ($ceMonth) {
            case '01':
                $khmerMonth = 'មករា'; // January
                break;
            case '02':
                $khmerMonth = 'កម្ភៈ'; // February
                break;
            case '03':
                $khmerMonth = 'មិនា'; // March
                break;
            case '04':
                $khmerMonth = 'មេសា'; // April
                break;
            case '05':
                $khmerMonth = 'ឧសភា'; // May
                break;
            case '06':
                $khmerMonth = 'មិថុនា'; // June
                break;
            case '07':
                $khmerMonth = 'កក្កដា'; // July
                break;
            case '08':
                $khmerMonth = 'សីហា'; // August
                break;
            case '09':
                $khmerMonth = 'កញ្ញា'; // September
                break;
            case '10':
                $khmerMonth = 'តុលា'; // October
                break;
            case '11':
                $khmerMonth = 'វិច្ឆិកា'; // November
                break;
            case '12':
                $khmerMonth = 'ធ្នូ'; // December
                break;
            default:
                $khmerMonth = '';
                break;
        }

        $khmerDay = date('d', strtotime($date));

        $khmerDate = $khmerDay . '-' . $khmerMonth . '-' . $khmerYear;

        return $khmerDate;
    }
}

