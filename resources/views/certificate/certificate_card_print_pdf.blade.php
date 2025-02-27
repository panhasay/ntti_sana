<?php
use Illuminate\Support\Str;
?>
<style>
    body {
        font-family: "Khmer OS Battambang" !important;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .id-card {
        width: 6.2cm;
        height: 9.4cm;
        padding-left: 18.5px;
        padding-right: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
        text-align: center;
        position: relative;
        font-size: 9.1px;
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
        position: absolute;
        width: 2cm;
        height: 2.55cm;
        border-radius: 0px;
        margin-top: 10px;
        position: relative;
        text-align: center;
        margin-left: -15px;
    }

    .id-card-left {
        text-align: left;
        font-weight: bold;
        color: rgb(0, 18, 128);
        font-size: 10.8px;
        font-family: "Khmer OS Battambang" !important;
    }

    .id-card-date-khmer {
        color: rgb(0, 18, 128);
        text-align: center;
        margin-left: -15px !important;
        margin-top: 10px;
        font-size: 9.2px;
        font-family: "Khmer OS Battambang" !important;
        font-weight: 900;
    }

    .id-card-date-khmer-pp {
        float: right;
        color: rgb(0, 18, 128);
        font-size: 9.2px;
        padding-right: 34px !important;
        font-family: "Khmer OS Battambang" !important;
        font-weight: 900;
    }

    .id-card-center {
        text-align: center;
        font-weight: bold;
        margin-left: -15px;
        font-size: 10.8px;
        margin-bottom: 5px;
    }

    .id-signature>.stamp {
        height: 70px;
        margin-right: 0px;
    }

    .id-signature>.id-qr-code {
        margin-top: 10px;
        float: left;
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

    .pull-right {
        float: right;
        padding-right: 1.2rem !important;
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
        border-radius: 15px;
        text-align: center;
        padding: 25px 20px 0px;
        position: relative;
    }

    .stu-card-header {
        color: rgb(0, 18, 128);
        font-size: 10.5px;
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
        color: rgb(0, 18, 128);
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
        bottom: -117px;
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
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 113px;
        line-height: 30px;
    }

    .card-body span {
        font-size: 12px;
        color: #d9534f;
        margin: 0;
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
    }
</style>
{{-- {{ $records->name_2 }} --}}
<div class="id-card card_background">
    <img alt="Portrait of a person in an orange robe" class="profile text-center"
        src="{{ $records->photo_status == true ? '/uploads/student/' . $records->stu_photo : '/asset/NTTI/images/faces/default_User.jpg' }}"
        height="100">
    <div class="details">
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
            ថ្ងៃខែឆ្នាំកំណើត<span class="ps-1"></span>
            {{ App\Service\service::DateYearKH($records->date_of_birth ?? '0000-00-00') }}
        </div>
        <div class="id-card-left">
            ជំនាញ<span class="ps-3"></span> <span class="ps-4">{{ $records->skill }}</span>
        </div>
        <div class="id-card-left">
            កម្រិត <span class="ps-5">{{ $records->level }}</span>
        </div>
        <div class="id-card-date-khmer">
            {{ $records->print_khmer_lunar ?? $record_date_khmer }}
        </div>
        <div class="id-card-date-khmer-pp">
            {{ $records->print_date_due ?? 'រាជធានីភ្នំពេញ, ' . formatDateToKhmer(now(), 'kh') }}
        </div>
    </div>
</div>
