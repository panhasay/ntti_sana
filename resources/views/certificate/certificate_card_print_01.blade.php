<?php
use Illuminate\Support\Str;
?>
<style>
    body {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .id-card {
        width: 6.2cm;
        height: 9.4cm;
        padding: 0 0 0 15px;
        text-align: center;
        position: relative;
        font-size: 9px;
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
    }

    .id-card>.profile {
        width: 2cm;
        height: 2.4cm;
        border-radius: 0px;
        margin-top: 10px;
        margin-bottom: 5px;
        position: relative;
        text-align: center;
        margin-left: -15px;
    }

    .id-card-left {
        text-align: left;
        font-weight: bold;
        color: rgb(78, 27, 145);
        font-size: 10px;
    }

    .id-card-date-khmer {
        text-align: left;
        margin-top: 10.5px;
        font-size: 9px
    }

    .id-card-date-khmer-pp {
        font-size: 9px
    }

    .id-card-center {
        text-align: center;
        font-weight: bold;
        margin-left: -15px;
        font-size: 10px;
    }

    .id-signature>.stamp {
        height: 70px;
        width: 70px;
        margin-right: -60px;
    }

    .id-signature>.id-qr-code {
        height: 70px;
        width: 70px;
    }

    .student-card-view>.card-body .id,
    .card-body .phone,
    .card-body .info {
        font-size: 14px;
        margin-bottom: 0px;
    }

    .ps-1 {
        padding-left: 0.28rem !important;
    }

    .ps-3 {
        padding-left: 0.80rem !important;
    }

    .ps-4 {
        padding-left: 1.49rem !important;
    }

    .ps-5 {
        padding-left: 2.50rem !important;
    }

    .id-card-left>.pull-right {
        float: right;
        padding-right: 1.90rem !important;
        font-weight: bold !important;
    }

    .id-signature>.pull-left {
        float: left;
    }

    .id-signature>.signature_leader {
        float: right !important;
        font-family: 'Khmer OS Muol Light', sans-serif;
        padding-right: 2.90rem !important;
    }


    .card-students {
        height: 9.1cm;
        border-radius: 15px;
        text-align: center;
        padding: 10px 20px 0px;
        position: relative;
    }

    .stu-card-header {
        font-size: 10px;
        font-family: 'Khmer OS Muol Light', sans-serif;
        text-align: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }

    .stu-card-header span {
        display: block;
    }

    .stu-card-header-sub {
        font-size: 8px;
        font-family: 'Khmer OS Muol Light', sans-serif;
        text-align: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }

    .stu-card-header-sub span {
        display: block;
    }

    .card-students .logo {
        position: absolute;
        top: 0px;
        right: 10px;
    }

    .card-students .footer {
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        background: #ffdd00;
        font-size: 8px;
        color: #000;
        padding-top: 10px;
        padding-bottom: 10px;
        height: 40px;
        text-align: left;
        display: block;
        padding-left: 20px;
        border-top: 2px solid #f61616;
    }

    .card-students .footer a {
        color: #0a0a0a;
        text-decoration: none;
        display: block;
    }

    .card-students .footer a:hover {
        text-decoration: underline;
    }

    .card-body {
        text-align: center;
        /*margin-bottom: 20px;*/
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 150px;
    }

    .card-body span {
        font-size: 11px;
        color: #d9534f;
        margin: 0;
    }

    .card-body .card-personal {
        font-family: 'Khmer OS Muol Light', sans-serif;
        padding-bottom: 10px;
    }

    @media print {
        @page {
            /* size: 5.5cm 8.6cm; */
            size: 5.5cm 8.6cm;
            margin: 0;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }
    }
</style>
<div class="id-card card_background">
    <img alt="Portrait of a person in an orange robe" class="profile" height="120"
        src="https://via.placeholder.com/150x150" width="120">
    <div class="details" style="margin-left: 10px;margin-top: -10px;">
        <div class="id-card-center">
            អត្តលេខ {{ $records->code }}
        </div>
        <div class="id-card-left">
            គោត្តនាម-នាម <span class="ps-1">{{ $records->name_2 }}</span> <span class="pull-right">ភេទ
                {{ $records->gender }}</span>
        </div>
        <div class="id-card-left">
            អក្សរឡាតាំង <span class="ps-3">{{ $records->name }}</span>
        </div>
        <div class="id-card-left">
            ថ្ងៃខែឆ្នាំកំណើត <span class="ps-1">{{ $records->date_of_birth }}</span>
        </div>
        <div class="id-card-left">
            ជំនាញ<span class="ps-3"></span> <span class="ps-4">{{ $records->skill }}</span>
        </div>
        <div class="id-card-left">
            កម្រិត <span class="ps-5">{{ $records->level }}</span>
        </div>
        <div class="id-card-date-khmer">
            {{ App\Service\service::updateDateTimeCardStudent() ?? '' }}
        </div>
        <div class="id-card-date-khmer-pp">
            រាជធានីភ្នំពេញុ, {{ formatDateToKhmer(now(), 'kh') }}
        </div>
    </div>
    <div class="id-signature">
        <img class="id-qr-code pull-left" alt="QR code"
            src="{{ asset('asset/NTTI/images/modules/qrcode_web.ntti.thesis.edu.kh.png') }}">
        <span class="signature_leader">នាយកវិទ្យាស្ថាន</span>
    </div>
</div>
<div class="page-break"></div>
<div class="card-students">
    <div class="logo">
        <img src="/asset/NTTI/images/modules/ntti_flage_05.png" height="80" width="100" alt="Logo">
    </div>
    <div class="stu-card-header">
        <span>ព្រះរាជាណាចក្រកម្ពុជា</span>
        <span>ជាតិ សាសនា ព្រះមហាក្សត្រ</span>
    </div>
    <div class="khmer-text">
        <img src="{{ asset('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view" width="50"
            title="Style Khmer">
    </div>
    <div class="stu-card-header-sub">
        <span>ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</span>
        <span>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</span>
    </div>

    <div class="card-body">
        <span class="card-personal">បណ្ណសម្គាល់ខ្លូននិស្សិត</span>
        <span>STUDENT IDENTIFICATION CARD</span>
    </div>
    <div class="footer">
        <span>មហាវិថីសហព័ន្ធរុស្សី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ</span>
        <a href="mailto:info@ntti.edu.kh">info@ntti.edu.kh</a>
        <a href="https://www.ntti.edu.kh" target="_blank">www.ntti.edu.kh</a>
    </div>
</div>
