<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Card Auto Download</title>
    <style>

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background: #f0f0f0; */
        }

        .id-card {
            width: 555px;
            height: 900px;
            padding: 10px 23px 0px 21px;
            text-align: center;
            font-size: 14px;
            font-family: "Khmer OS Battambang", sans-serif;
            border-radius: 12px;
            box-shadow: 0 6px 28px rgba(0, 0, 0, .25);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .card-content {
            position: relative;
            z-index: 2;
        }

        .card-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center center;
            z-index: 1;
        }

        .card_background {
            background: url('asset/NTTI/images/modules/ntti_background_03.png') no-repeat center center;
            background-size: cover;
        }

        .id-card .flag {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            /* font-family: "Khmer OS Battambang" !important; */
        }

        .id-card>.profile {
            position: absolute;
            width: 5cm;
            height: 237px;
            top: -12px !important;
            margin-top: 28px;
            margin-bottom: -6px;
            position: relative;
            text-align: center;
            margin-left: 3px;
            border-radius: 2px !important;
        }

        .id-card-left {
            text-align: left;
            font-weight: bold;
            color: rgb(0, 18, 138);
            font-size: 26.5px !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-card-left span .name_2 {
            text-align: left;
            font-weight: 900;
            color: rgb(0, 18, 138);
            font-size: 10px !important;
            font-family: "Arial" !important;
        }

        .id-card-left span .name_1 {
            text-align: left;
            font-weight: 900;
            color: rgb(0, 18, 138);
            font-size: 10px !important;
            font-family: "Arial" !important;
        }

        .id-card-left label {
            text-align: left;
            font-weight: 900;
            color: rgb(0, 18, 138);
            font-size: 26px !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-card-date-khmer {
            color: rgb(0, 18, 138);
            text-align: right;
            margin-left: 2px !important;
            margin-top: 10.5px;
            font-size: 23px !important;
            font-weight: 600 !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-card-date-khmer-pp {
            float: right;
            color: rgb(0, 18, 138);
            font-size: 24px !important;
            padding-right: 32px !important;
            font-weight: 600 !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-card-center {
            text-align: center;
            margin-left: -15px;
            font-size: 23px !important;
            font-family: "Arial" !important;
            margin-bottom: -5px !important;
        }

        .id-card-center label {
            text-align: center;
            margin-left: -15px;
            font-size: 25px !important;
            font-weight: bold !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-signature>.stamp {
            height: 180px;
            margin-right: -252px;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-qr-code {
            /* height: 70px;
            width: 70px; */
            margin-top: 15px;
        }

        .student-card-view>.card-body .id,
        .card-body .phone,
        .card-body .info {
            font-size: 14px;
            margin-bottom: 0px;
            font-family: "Khmer OS Battambang" !important;
        }

        .ps-1 {
            padding-left: 0.28rem !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .ps-3 {
            padding-left: 23px!important;
            font-family: "Khmer OS Battambang" !important;
            font-size: 10px !important;
        }

        .ps-4 {
            padding-left: 3.49rem !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .ps-5 {
            padding-left: 5.5rem !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-card-left>.pull-right {
            float: right;
            font-weight: bold !important;
            font-family: "Khmer OS Battambang" !important;
        }

        .id-signature>.pull-left {
            float: left;
            position: absolute;
            left: 18px;
            /* top: 251px; */
            bottom: 36px;
        }

        .id-signature>.signature_leader {
            float: right !important;
            padding-right: 2.90rem !important;
            font-family: "Khmer OS Battambang" !important;
        }


        .card-students {

            border-radius: 15px;
            text-align: center;
            padding: 25px 20px 0px;
            position: relative;
            font-family: "Khmer OS Battambang" !important;
        }

        .stu-card-header {
            color: rgb(0, 18, 138);
            font-size: 12px;
            font-family: 'Khmer OS Muol Light', sans-serif;
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            font-weight: bold !important;
        }

        .stu-card-header span {
            display: block;
        }

        .stu-card-header-sub {
            color: rgb(0, 18, 138);
            font-size: 9.5px;
            font-family: 'Khmer OS Muol Light';
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            font-weight: bold !important;
        }

        .stu-card-header-sub span {
            display: block;
        }

        .card-students .logo {
            position: absolute;
            top: 0px;
            right: 14px;
            bottom: 10px !important;
        }

        .card-students .footer {
            position: absolute;
            bottom: -118px;
            left: 0;
            right: 0;
            background: #ffdd00;
            font-size: 8px;
            color: #000;
            text-align: left;
            display: block;
            padding-left: 20px;
            padding-top: 1px;
            padding-bottom: 10px;
            border-top: 2px solid #f61616;
            font-family: "Khmer OS Battambang" !important;
        }

        .card-students .footer a {
            color: #0a0a0a;
            text-decoration: none;
            display: block;
            font-family: "Khmer OS Battambang" !important;
            font-weight: bold !important;
        }

        .card-students .footer a:hover {
            text-decoration: underline;
            font-family: "Khmer OS Battambang" !important;
        }

        .card-body {
            text-align: center;
            /*margin-bottom: 20px;*/
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 113px;
            line-height: 30px;
            font-family: "Khmer OS Battambang" !important;
        }

        .card-body span {
            font-size: 12px;
            color: #d9534f;
            margin: 0;
            font-family: "Khmer OS Battambang" !important;
        }

        .card-body .card-personal {
            font-family: "Khmer OS Muol Light" !important;
            font-size: 14px;
        }

        .card-body .card-personal_eng {
            font-size: 10px;
            font-family: 'Khmer OS Muol Light' !important;
            font-weight: bold !important;
        }

        .details {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="card_background" id="studentCard">
        <div class="id-card" id="cardBg">
            <!-- Background will be set by JS -->
            <img alt="Portrait of a person in an orange robe" class="profile"
                src="{{ $record->stu_photo == true ? '/uploads/student/' . $record->stu_photo : '/asset/NTTI/images/faces/default_User.jpg' }}" width="120">

            <div class="details">
                <div class="id-card-center">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;អត្តលេខ</label>
                    <span style="font-weight: 900; font-family: 'Arial' !important; font-size: 25px !important;">
                        <b>{{ $record->code ??'' }}</b>
                    </span>
                </div>

                <div class="id-card-left">
                    គោត្តនាម-នាម <label class="ps-1 name_1">{{ $record->name_2 ??'' }}</label> <span class="pull-right">ភេទ
                        {{ $record->gender ?? '' }}</span>
                </div>
                <div class="id-card-left">
                    អក្សរឡាតាំង <span class="ps-3 name_2" style="font-size: 24px !important;">{{ $record->name ??'' }}</span>
                </div>
                <div class="id-card-left">
                    ថ្ងៃខែឆ្នាំកំណើត<span class="ps-1">{{ App\Service\service::DateYearKH($record->date_of_birth) }}</span>
                </div>
                <div class="id-card-left">
                    ជំនាញ<span class="ps-3"></span><span class="ps-4">&nbsp; {{ $record->skill->name_2 ?? '' }}</span>
                </div>
                <div class="id-card-left">
                    កម្រិត<span class="ps-5">&nbsp;&nbsp;{{ $record->qualification ?? '' }}</span>
                </div>
                <br>
                @php 
                   $date_khmer = DB::table('cert_student_print_card_session')
                        ->orderBy('session_code', 'desc')
                        ->first();
                @endphp
                <div class="id-card-date-khmer">
                    {{  $date_khmer->print_khmer_lunar ?? '' }} 
                </div>
                
                <div class="id-card-date-khmer-pp">
                    {{ $date_khmer->print_date_due ?? '' }}
                </div>
            </div>
            <div class="id-signature">
                <div class="id-qr-code pull-left" >
                     {{ App\Http\Controllers\QrCodeController::generateCardStudentImg($record->code) }}
                </div>
                <img class="stamp" alt="QR code" src="/asset/NTTI/images/modules/Simple Email Signature with Picture.svg">
            </div>
        </div>
    </div>
    <!-- html2canvas CDN -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        window.addEventListener('load', function () {
            const card = document.getElementById('studentCard');
            setTimeout(() => {
                html2canvas(card, { scale: 2 }).then(canvas => {
                    canvas.toBlob(function(blob) {

                        const link = document.createElement('a');
                        link.download = 'card_{{ $record->name_2 }}.jpg';
                        link.href = URL.createObjectURL(blob);

                        document.body.appendChild(link); // important
                        link.click();
                        document.body.removeChild(link);
                       

                    }, 'image/jpeg', 0.95);
                });
            }, 500);
        });
    </script>
</body>
</html>