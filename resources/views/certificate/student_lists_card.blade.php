<style>
    @page {
      size: A4;
      margin: 9mm;
    }
     @media print {
      .general-print>th {
        border: 1px solid #333;
        font-family: 'Khmer OS Battambang';
        padding: 10px;
        white-space: nowrap !important
      }.general-print>td{
        padding: 3px;
        border: 1px solid #333;
        font-family: 'Khmer OS Battambang';
        white-space: nowrap !important
      }
      .title{
        margin-top: 30px ;
      }

    }
</style>
<div class="row align-items-start">
    <div class="col-5 text-center KhmerOSMuolLight"><br>
        វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
        ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា

    </div>
    <div class="col-2">
    </div>
    <div class="col-5 text-center KhmerOSMuolLight">
        ព្រះរាជាណាចក្រកម្ពុជា
        ជាតិ សាសនា ព្រះមហាក្សត្រ
    </div>


    <div class="col-12 text-center  title" style="font-family: 'Moul' !important;">
        គំរូ បញ្ចីឈ្មោះនិស្សឹតធ្វើកាត ក្រុម<span class="bold"> : {{ $header->code ?? ''  }} </span>វេន{{ $header->section->name_2 ?? '' }} ជំនាញ{{ $header->skill->name_2 ?? '' }} ឆ្នាំសិក្សា ២០២៤-២០២៥
    </div>
</div>
<br>
<table class="table-print">
    <thead>
      <tr class="general-print">
        <th class="text-center" width="5">ល.រ</th>
        <th class="text-center" width="">អត្តលេខ</th>
        <th class="text-center" width="">គោត្តនាម-នាម</th>
        <th class="text-center" width="">ឈ្មោះជាឡាតាំង</th>
        <th class="text-center" width="">ភេទ</th>
        <th class="text-center" width="">ថ្ងៃខែឆ្នាំកំណើត</th>
        <th class="text-center" width="100">ផ្សេងៗ</th>
        <th class="text-center" width="">រូបភាព</th>
      </tr>
    </thead>
    <tbody id="recordsLineTableBody">
        <?php $index = 1; ?>
        @foreach ($records as $line)
          <?php
            $pictues = App\Models\General\Picture::selectRaw("picture_ori, code")->where('code', $line->code)->first();
          ?>
          <tr class="general-print">
            <td class="text-center">{{ $index++ }}</td>
            <td class="text-center">{{ $line->code }}</td>
            <td class="">{{ $line->name_2 }}</td>
            <td class="">{{ $line->name }}</td>
            <td class="text-center">{{ $line->gender }}</td>
            <td class="text-center">{{ App\Service\service::DateYearKH($line->date_of_birth) ?? '' }}</td>
            <td class="text-center"></td>
            <td class="text-center">
              <img 
                src="{{ asset($pictues && $pictues->picture_ori ? '/uploads/student/' . $pictues->picture_ori : '/asset/NTTI/images/faces/default_User.jpg') }}" 
                alt="" width="58" height="60"
              >
            </td>
          </tr>
        @endforeach
      </tbody>
      
