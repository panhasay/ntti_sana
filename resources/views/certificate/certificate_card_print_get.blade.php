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
        height: 9.8cm;
        background-color: white;
        /* border-radius: 10px; */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 0;
        /* padding-left: 15px; */
        text-align: center;
        position: relative;
        font-size: 9px;
        background-image: url('/asset/NTTI/images/modules/background-card.png');
        background-size: cover;
        background-position: center;
    }

    .id-card .flag {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .id-card>.profile {
        width: 100px;
        height: 110px;
        border-radius: 5px;
        margin-top: 18px;
        margin-bottom: 10px;
        position: relative;
    }

    .id-card-left {
        text-align: left;
    }

    .id-card-date-khmer {
        text-align: left;
        margin-top: 10px;
    }

    .id-card-center {
        text-align: center;
        font-weight: bold;
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
    }

    .id-signature>.pull-left {
        float: left;
    }

    @media print {
        @page {
            size: 5.5cm 8.5cm;
            margin: 0;
        }
    }
</style>
<div class="id-card">
    <img alt="Portrait of a person in an orange robe" class="profile" height="120"
        src="https://via.placeholder.com/150x150" width="120">
    <div class="details" style="margin-left: 10px;">
        <div class="id-card-center">
            អត្តលេខ 800002
        </div>
        <div class="id-card-left">
            គោត្តនាម-នាម <span class="ps-1">សុខរិន</span> <span class="pull-right">ភេទ
                ប្រុស</span>
        </div>
        <div class="id-card-left">
            អក្សរឡាតាំង <span class="ps-3">KHIEV SOKRIN</span>
        </div>
        <div class="id-card-left">
            ថ្ងៃខែឆ្នាំកំណើត <span class="ps-1">០៦ មេសា ២០០៥</span>
        </div>
        <div class="id-card-left">
            ជំនាញ<span class="ps-3"></span> <span class="ps-4">ព័ត័មានវិទ្យា</span>
        </div>
        <div class="id-card-left">
            កម្រិត <span class="ps-5">បរិញ្ញាបត្រ</span>
        </div>
        <div class="id-card-date-khmer">
            ថ្ងៃសុក្រ ៥ កើត ខែបុស្ស ឆ្នាំរោង ឆស័ក ពុទ្ធសករាជ ២៥៦៨
        </div>
        <div class="info">
            រាជធានីភ្នំពេញុ, {{ formatDateToKhmer(now()) }}
        </div>
    </div>
    <div class="id-signature">
        <img class="id-qr-code pull-left" alt="QR code"
            src="{{ asset('asset/NTTI/images/modules/qrcode_web.ntti.thesis.edu.kh.png') }}">
        <img class="stamp" alt="QR code"
            src="{{ asset('asset/NTTI/images/modules/qrcode_web.ntti.thesis.edu.kh.png') }}">
    </div>
</div>
