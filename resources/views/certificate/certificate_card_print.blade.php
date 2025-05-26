<?php
use Illuminate\Support\Str;
?>
<style>
    body {
       
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .id-card {
        width: 6.2cm;
        height: 9.5cm;
        padding: 0 0 0 15px;
        text-align: center;
        position: relative;
        font-size: 9.1px;
        margin-left: 10px !important;
        font-family: "Battambang" !important;
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
        /* font-family: "Battambang" !important; */
    }
    .id-card>.profile {
        position: absolute;
        width: 2cm;
        height: 2.55cm;
        top: 10px !important;
        margin-top: 10px;
        margin-bottom: 5px;
        position: relative;
        text-align: center;
        margin-left: -15px;
        border-radius: 2px !important
        
    }

    .id-card-left {
        text-align: left;
        font-weight: bold;
        color: rgb(0, 18, 138);
        font-size: 11.05px !important;
        font-family: "Battambang" !important;
    }
    .id-card-left span .name_2{
        text-align: left;
        font-weight: 900;
          color: rgb(0, 18, 138);
        font-size: 11.05px !important;
        font-family: "Arial" !important;
    }
    .id-card-left label {
        text-align: left;
        font-weight: 900;
        color: rgb(0, 18, 138);
        font-size: 11.05px !important;
        font-family: "Battambang" !important;
    }

    .id-card-date-khmer {
          color: rgb(0, 18, 138);
        text-align: center;
        margin-left: -24px !important;
        margin-top: 10.5px;
        font-size: 9px !important;
        font-weight: 600 !important;
        font-family: "Battambang" !important;
    }

    .id-card-date-khmer-pp {
        float: right;
          color: rgb(0, 18, 138);
        font-size: 9px !important;
        padding-right: 32px !important;
        font-weight: 600 !important;    
        font-family: "Battambang" !important;
    }

    .id-card-center {
        text-align: center;
        margin-left: -15px;
        font-size: 11px !important;
        font-family: "Arial" !important;
        margin-bottom: 3px !important;
    }
    .id-card-center label{
        text-align: center;
        margin-left: -15px;
        font-size: 11px !important;
        font-weight: bold !important;
        font-family: "Battambang" !important;
    }

    .id-signature>.stamp {
        height: 75px;
        margin-right: 0px;
        font-family: "Battambang" !important;
    }

    .id-signature>.id-qr-code {
        /* height: 70px;
        width: 70px; */
        margin-top: 15px;
    }

    .student-card-view>.card-body .id,
    .card-body .phone,
    .card-body .info {
        font-size: 14px;
        margin-bottom: 0px;
        font-family: "Battambang" !important;
    }

    .ps-1 {
        padding-left: 0.28rem !important;
        font-family: "Battambang" !important;
    }

    .ps-3 {
        padding-left: 0.80rem !important;
        font-family: "Battambang" !important;
    }

    .ps-4 {
        padding-left: 1.49rem !important;
        font-family: "Battambang" !important;
    }

    .ps-5 {
        padding-left: 2.50rem !important;
        font-family: "Battambang" !important;
    }

    .id-card-left>.pull-right {
        float: right;
        padding-right: 1.2rem !important;
        font-weight: bold !important;
        font-family: "Battambang" !important;
    }

    .id-signature>.pull-left {
        float: left;
    }

    .id-signature>.signature_leader {
        float: right !important;
        padding-right: 2.90rem !important;
        font-family: "Battambang" !important;
    }


    .card-students {

        border-radius: 15px;
        text-align: center;
        padding: 25px 20px 0px;
        position: relative;
        font-family: "Battambang" !important;
    }

    .stu-card-header {
         color: rgb(0, 18, 138);
        font-size: 11px;
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
          color: rgb(0, 18, 138);
        font-size: 9px;
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
        bottom: -127px;
        left: 0;
        right: 0;
        background: #ffdd00;
        font-size: 8px;
        color: #000;
        text-align: left;
        display: block;
        padding-left: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-top: 2px solid #f61616;
        font-family: "Battambang" !important;
    }

    .card-students .footer a {
        color: #0a0a0a;
        text-decoration: none;
        display: block;
        font-family: "Battambang" !important;
    }

    .card-students .footer a:hover {
        text-decoration: underline;
        font-family: "Battambang" !important;
    }

    .card-body {
        text-align: center;
        /*margin-bottom: 20px;*/
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 113px;
        line-height: 30px;
        font-family: "Battambang" !important;
    }

    .card-body span {
        font-size: 12px;
        color: #d9534f;
        margin: 0;
        font-family: "Battambang" !important;
    }

    .card-body .card-personal {
        font-family: 'Khmer OS Muol Light', sans-serif;
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
        .khmer-text img {
            position: absolute !important;
            top: 65px;
            left: 40%;
        }
    }
</style>
<div class="id-card card_background">
    <img alt="Portrait of a person in an orange robe" class="profile" 
        src="{{ $records->photo_status == true ? '/uploads/student/' . $records->stu_photo : '/asset/NTTI/images/faces/default_User.jpg' }}"
        width="120">
    <div class="details">
        <div class="id-card-center">
            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;អត្តលេខ</label>
            <span style=" font-weight: 900; font-family: 'Arial' !important; font-size: 12px !important;">
                <b>{{ $records->code }}</b>
            </span>
        </div>
        {{-- <span style="margin-top: 5px !important;">&nbsp;</span> --}}
        <div class="id-card-left">
            គោត្តនាម-នាម <label class="ps-1 name_1">{{ $records->name_2 }}</label> <span class="pull-right">ភេទ
                {{ $records->gender }}</span>
        </div>
        <div class="id-card-left">
            អក្សរឡាតាំង <span class="ps-3 name_2">{{ $records->name }}</span>
        </div>
        <div class="id-card-left">
            ថ្ងៃខែឆ្នាំកំណើត<span
                class="ps-1">{{ App\Service\service::DateYearKH($records->date_of_birth) ?? '' }}</span>
        </div>
        <div class="id-card-left">
            ជំនាញ<span class="ps-3"></span><span class="ps-4">&nbsp; {{ $records->skill }}</span>
        </div>
        <div class="id-card-left">
            <?php 
                $description =  App\Models\General\Qualifications::where('code',$records->level)->first();
            ?>
            កម្រិត<span class="ps-5">&nbsp;&nbsp;{{ $description->name_3 ?? '' }}</span>
        </div>
        <div class="id-card-date-khmer">
            {{ $records->print_khmer_lunar ?? $record_date_khmer }}
        </div>
        <div class="id-card-date-khmer-pp">
            {{ $records->print_date_due ?? 'រាជធានីភ្នំពេញ, ' . formatDateToKhmer(now(), 'kh') }}
        </div>
    </div>
    <div class="id-signature">
        <div class="id-qr-code pull-left">
            {{ App\Http\Controllers\QrCodeController::generateCardStudent($records->code) }}
        </div>
        <img class="stamp" alt="QR code"
            src="{{ asset('asset/NTTI/images/modules/Simple Email Signature with Picture.svg') }}">
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
    <br>
    <div class="khmer-text" style="background-image: none;">
        <img src="{{ asset('asset/NTTI/images/modules/tactieng_khmer.png') }}" alt="A scenic view" width="50"
            title="Style Khmer">
    </div>
    <div class="stu-card-header-sub">
        <span>ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</span>
        <span>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</span>
    </div>
    <div class="card-body">
        <span class="card-personal">បណ្ណសម្គាល់ខ្លួននិស្សិត</span>
        <span style="font-weight: bold !important;padding-top:10px !important">STUDENT IDENTIFICATION CARD</span>
    </div>
    <div class="footer">
        <span>មហាវិថីសហព័ន្ធរុស្សី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ</span>
        <a href="mailto:info@ntti.edu.kh">info@ntti.edu.kh</a>
        <a href="https://www.ntti.edu.kh" target="_blank">www.ntti.edu.kh</a>
    </div>
</div>
