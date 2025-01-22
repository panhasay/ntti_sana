<style>
  body {
    font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .id-card {
    width: 23.2cm;
    height: auto;
    padding: 0 0 0 15px;
    text-align: center;
    position: relative;
    border: 1px solid #333;
    border-radius: 10px;
    font-size: 9.1px;
  }
  .card_background {
    background: url("https://ntti.nttiportal.com/asset/NTTI/images/modules/ntti_background_03.png") no-repeat center center;
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
      width: 8cm;
      height: 9.99cm;
      border-radius: 0px;
      margin-top: 10px;
      margin-bottom: 19px;
      position: relative;
      text-align: center;
      margin-left: -15px;
  }
  .id-card-left {
    text-align: left;
    font-weight: bold;
    color: rgb(78, 27, 145);
    font-size: 40px;
  }
  .id-card-date-khmer {
    color: rgb(78, 27, 145);
    text-align: center;
    margin-left: -15px !important;
    margin-top: 10.5px;
    font-size: 9px
  }
  .id-card-date-khmer-pp {
    color: rgb(78, 27, 145);
    font-size: 9px
  }
  .id-card-center {
    text-align: center;
    font-weight: bold;
    margin-left: -15px;
    font-size: 40px;
  }
  .id-signature>.stamp {
    height: 75px;
    margin-right: -35px;
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
      padding-right: 8.9rem !important;
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
    border-radius: 12px;
    text-align: center;
    padding: 0px 20px 0px;
    position: relative;
    border: 1px solid #333;
    height: 355px;
  }
  .stu-card-header {
    color: rgb(78, 27, 145);
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
    color: rgb(78, 27, 145);
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
    bottom: 1px;
    left: 0;
    right: 0;
    background: #ffdd00;
    font-size: 8px;
    color: #000;
    text-align: left;
    display: block;
    padding-left: 20px;
    border-radius: 9px;
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
    /*margin-bottom: 20px;*/
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
  .flex-container {
    display: flex;
    margin-left: -24px;
  }

  .flex-container > div {
    padding: 20px;
    font-size: 30px;
    /* width: 50%; */
  }
  .flex-container > div.student-info{
    /* border-right: 2px solid #333; */
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
    .detail-info{
      display: flex;
    }
  }
</style>
<div class="id-card card_background">
  <img alt="Portrait of a person in an orange robe" class="profile"
    src="{{ asset($imgs->picture_ori == true ? '/uploads/student/' . $imgs->picture_ori : '/asset/NTTI/images/faces/default_User.jpg') }}"
    width="120">
  <div class="details" style="margin-top: -10px;">
    <div class="id-card-center">
      អត្តលេខ : {{ $records->code ?? '' }}
    </div>
    <div class="id-card-left">
      គោត្តនាម-នាម : <span class="ps-1">  {{ $records->name_2 ?? '' }} </span> <span class="pull-right">ភេទ {{ $records->gender ?? '' }} 

    </div>
    <div class="id-card-left">
      អក្សរឡាតាំង : <span class="ps-3"> {{ $records->name ?? '' }} </span>
    </div>
    <div class="id-card-left">
      ថ្ងៃខែឆ្នាំកំណើត : <span class="ps-1"> {{ App\Service\service::DateYearKH($records->date_of_birth) ?? '' }}  </span>
    </div>
    <div class="id-card-left">
      ជំនាញ : <span class="ps-3"></span> {{ $skills->name_2 ?? '' }} <span class="ps-4"> </span>
    </div>
    <div class="id-card-left">
      កម្រិត : <span class="ps-5"> {{ $qualification->code ?? '' }} </span>
    </div>
    <div class="id-card-date-khmer">

    </div>
  </div>
  <div class="id-signature">
    <div class="id-qr-code pull-left">
</div>
<div class="page-break">

</div>

<div class="flex-container">
  <div class="student-info">
    <div class="id-card-left">
      លេខទូរស័ព្ទ : <span class="ps-3"> {{ $records->phone_student ?? '' }}</span>
    </div>
    <div class="id-card-left">
      ទីកន្លែងកំណើត : <span class="ps-3"> {{ $records->student_address ?? '' }}</span>
    </div>
    <div class="id-card-left">
      ឈ្មោះឪពុក : <span class="ps-3"> {{ $records->father_name ?? '' }}</span>
    </div>
    <div class="id-card-left">
      ឈ្មោះម្ដាយ : <span class="ps-3"> {{ $records->mother_name ?? '' }}</span>
    </div>
    <div class="id-card-left">
      ឈ្មោះអាណាព្យាបាល : <span class="ps-3"> {{ $records->guardian_name ?? '' }}</span>
    </div>
    
  </div>
    
  {{-- <div>2</div>  --}}
</div>
