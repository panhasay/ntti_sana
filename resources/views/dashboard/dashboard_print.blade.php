
<style>
    .border{
        border: 1px solid #333 !important;  
    }
   .general-data-print th{
        font-family: 'Moul' !important;
        background: #dad8d8d2 !important;
        padding: 10px !important;
   }
   .header-page{
        font-family: 'Moul' !important;
   }
   .title-list{
        font-family: 'Khmer OS Battambang';
        font-size: 16px !important;
   }
   .conten-info{
        width: 100%;
        display: flex;
        float: left;
        justify-content: space-between;
   }
   .info-img{
        width: 50%
   }
   .info-king{
    width: 100%;
   }
   .signature{
    font-family: 'Khmer OS Battambang';
   }
</style>
<div class="conten-info">
    <div class="info-img">
        <img src="asset/NTTI/images/logo.png" alt="logo">
    </div>
    <div class="info-king">
      <div class="text-end header-page">ព្រះរាជាណាចក្រកម្ពុជា&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div class="text-end header-page">ជាតិ សាសនា&nbsp;&nbsp;&nbsp;&nbsp; ព្រះមហាក្សត</div>
    </div>
  </div>
<br><br><br><br><br>
@if($type == 'skill')
    <div class="text-center title-list bold">
    តារាបញ្ចីឈ្មោះនិស្សិតសរុបតាមជំនាញ
    </div>
    <div class="control-table mt-2">
    <table class="table">
        <thead>
            <tr>
                <td width='5px' class="text-center bold border">លរ</td>
                <td width='400px' class="bold border">ជំនាញ</td>
                <td class="bold text-right border">និស្សិតស្រី</td>
                <td class="bold text-right border">និស្សិតប្រុស</td>
                <td class="bold text-right border">និស្សិតសរុប</td>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            @foreach($records as $record)
                <tr>
                    <th class="text-center border">{{ $index++}}</th>
                    <td class="border">{{ $record->category}}</td>
                    <td class="text-right border">{{ $record->qty_studen_female}}</td>
                    <td class="text-right border">{{ $record->qty_studen_male}}</td>
                    <td class="text-right border">{{ $record->qty_studen}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-right mt-4 signature">
            រាជធានីភ្នំពេញថ្ងៃទី&nbsp;&nbsp;&nbsp;&nbsp;ខែ&nbsp;&nbsp;&nbsp;   ឆ្នាំ​ 2024
        </div>
    </div>
  </div>
@elseif($type == 'year')
    <div class="text-center title-list bold">
        តារាបញ្ចីឈ្មោះនិស្សិតសរុបតាមឆ្នាំសិក្សា
    </div>
    <div class="control-table mt-2">
        <table class="table">
            <thead>
                <tr>
                    <td width='5px' class="text-center bold border">លរ</td>
                    <td width='400px' class="bold border">ជំនាញ</td>
                    <td class="bold text-right border">និស្សិតស្រី</td>
                    <td class="bold text-right border">និស្សិតប្រុស</td>
                    <td class="bold text-right border">និស្សិតសរុប</td>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                @foreach($records as $record)
                    <tr>
                        <th class="text-center border">{{ $index++}}</th>
                        <td class="border">{{ $record->session}}</td>
                        <td class="text-right border">{{ $record->qty_studen_female}}</td>
                        <td class="text-right border">{{ $record->qty_studen_male}}</td>
                        <td class="text-right border">{{ $record->qty_studen}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div class="row">
        <div class="col-md-12 text-right mt-4 signature">
            រាជធានីភ្នំពេញថ្ងៃទី&nbsp;&nbsp;&nbsp;&nbsp;ខែ&nbsp;&nbsp;&nbsp;   ឆ្នាំ​ 2024
        </div>
    </div>
    </div>
@elseif($type == 'department')
<div class="text-center title-list bold">
    តារាបញ្ចីឈ្មោះនិស្សិតសរុបតាមឆ្នាំសិក្សា
</div>
<div class="control-table mt-2">
    <table class="table">
        <thead>
            <tr>
                <td width='5px' class="text-center bold border">លរ</td>
                <td width='400px' class="bold border">ជំនាញ</td>
                <td class="bold text-right border">និស្សិតស្រី</td>
                <td class="bold text-right border">និស្សិតប្រុស</td>
                <td class="bold text-right border">និស្សិតសរុប</td>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            @foreach($records as $record)
                <tr>
                    <th class="text-center border">{{ $index++}}</th>
                    <td class="border">{{ $record->department_name}}</td>
                    <td class="text-right border">{{ $record->qty_studen_female}}</td>
                    <td class="text-right border">{{ $record->qty_studen_male}}</td>
                    <td class="text-right border">{{ $record->qty_studen}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
<div class="row">
    <div class="col-md-12 text-right mt-4 signature">
        រាជធានីភ្នំពេញថ្ងៃទី&nbsp;&nbsp;&nbsp;&nbsp;ខែ&nbsp;&nbsp;&nbsp;   ឆ្នាំ​ 2024
    </div>
</div>
@endif
  