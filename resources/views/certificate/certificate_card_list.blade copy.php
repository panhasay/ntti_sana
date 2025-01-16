<style>
    * {
        font-family: "Khmer OS Battambang", serif !important;
    }

    .id-card {
        width: 300px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        padding-left: 5px;
        padding-right: 5px;
        text-align: center;
        position: relative;
        font-size: 12px;
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
        height: 120px;
        border-radius: 5px;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .id-card-left {
        text-align: left;
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

    @media print {
        @page {
            size: 10mm 50mm;
            margin: 0;
        }
    }
</style>

@extends('app_layout.app_layout')
@section('content')
<x-dashboard-page-header title="ផ្ទាំងគ្រប់គ្រងសិស្សផ្ទាល់ខ្លួន" dashboardUrl="{{ request()->path() }}" />
<button type="button" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2" name="btn_print" id="btn_print">
    Print
    <i class="mdi mdi-printer btn-icon-append"></i>
</button>
<div class="id-card">
    <img alt="Portrait of a person in an orange robe" class="profile" height="120"
        src="{{ asset('/upload/student/a68cfa995a1bb68dcd84e8b13e29ef2c56c7d363.png') }}" width="120">
    <div class="details" style="margin-left: 10px;">
        <div class="id-card-center">
            អត្តលេខ 500695
        </div>
        <div class="id-card-left">
            គោត្តនាម-នាម <span class="ps-1">សុខរិន</span> <span class="pull-right">ភេទ ប្រុស</span>
        </div>
        <div class="id-card-left">
            អក្សរឡាតាំង<span class="ps-3">KHIEV SOKRIN</span>
        </div>
        <div class="id-card-left">
            ថ្ងៃខែឆ្នាំកំណើត<span class="ps-1">០៦ មេសា ២០០៥</span>
        </div>
        <div class="id-card-left">
            ជំនាញ<span class="ps-3"></span> <span class="ps-4">ព័ត័មានវិទ្យា</span>
        </div>
        <div class="id-card-left">
            កម្រិត<span class="ps-5">បរិញ្ញាបត្រ</span>
        </div>
        <div class="id-card-left mt-2">
            ថ្ងៃអង្គារ ១១ កើត ខែបុស្ស ឆ្នាំថោះ បញ្ជស័ក ព.ស ២៦៦៧
        </div>
        <div class="info">
            រាជធានីភ្នំពេញុ, ថ្ថៃទី០២ ខែមករា ឆ្នាំ ២០២៤
        </div>
    </div>
    <div class="id-signature">
        <img class="id-qr-code pull-left" alt="QR code"
            src="{{ asset('asset/NTTI/images/modules/qrcode_web.ntti.thesis.edu.kh.png') }}">
        <span class="pull-right pe-5" style="font-family: 'Moul', serif !important;">នាយកវិទ្យាស្ថាន</span>
        <img alt="Official" class="stamp pull-right mt-3"
            src="{{ asset('/asset/NTTI/images/modules/ec-initial-signature-logo-vector-design_489997-2643.avif') }}">
    </div>
</div>
@endsection

<script type="module">
    function prints(ctrl) {
        var url = '/student/print';
        var data = '';
        data = $("#advance_search").serialize();
        $.ajax({
            type: 'get',
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                $('.print-content').html(response);
                $('.print-content').printThis({});
            },
            error: function(xhr, ajaxOptions, thrownError) {}
        });
    }

    $(function($) {
        $('#btn_print').click(function() {
            $(".id-card").printThis({
                importStyle: true,
                printContainer: true,
                importCSS: true,
            });
        });
        $('#btn_test_print').click(function() {
            // $("#printable").printThis({
            //     importStyle: true,
            //     printContainer: true,
            //     importCSS: true,
            //     style: `
            //         @page { size: 54mm 85.6mm; margin: 0; }
            //         body { margin: 0; }
            //     `,
            // });
            $('#printable').printThis({
                pageTitle: "My Printable Document",
                removeInline: true,
                printDelay: 333,
                header: "<h1>Header for Print</h1>",
                footer: "<h1>Footer for Print</h1>",
                base: false,
                formValues: true
            });
        });
    });

    function printCard() {

    }
</script>
