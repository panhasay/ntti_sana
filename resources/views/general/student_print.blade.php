
<style>
  .title-list{
       font-family: 'Khmer OS Battambang';
       font-size: 16px !important;
       padding: 10px !important;
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
  .table> :not(:last-child)> :last-child>*, .jsgrid .jsgrid-table> :not(:last-child)> :last-child>* {
      border-bottom-color: #e4e9f0;
      font-family: "Moul", serif;
  }
</style>
<div class="conten-info">
   <div class="info-img">
       <img src="asset/NTTI/images/logo.png" alt="logo">
   </div>
   <div class="info-king">
     <div class="text-end header-page bold" style="font-family: 'Moul' !important;">ព្រះរាជាណាចក្រកម្ពុជា</div>
     <div class="text-end header-page bold" style="font-family: 'Moul' !important;">ជាតិ សាសនា   &nbsp;&nbsp;&nbsp;&nbsp; ព្រះមហាក្សត</div>
   </div>
 </div>
<div class="text-center title-list bold">តារាបញ្ចីឈ្មោះសិស្ស</div>
<div class="control-table">
   <table class="table table-striped">
       <thead>
         <tr>
           <tr class="">
             <th width="10" class="bold">អត្តលេខ</th>
             <th class="bold">គោត្តនាម និងនាម</th>
             <th class="bold">ឈ្មោះជាឡាតាំង</th>
             <th class="bold">ភេទ</th>
             <th class="bold">ថ្ងៃខែឆ្នាំកំណើត</th>
             <th class="bold" width="20">លេខទូរស័ព្ទ</th>
             <th class="bold" width="20">ក្រុម ថា្នក់</th>
             <th class="bold" width="20">រេន</th>
             <th class="bold" width="20">ជំនាញ</th>
             <th class="bold" width="40">ដេប៉ាតឺម៉ង់</th>
           </tr>
         </tr>
       </thead>
       <tbody>
         @foreach ($records as $record)
         <?php 
             $skills = DB::table('skills')->where('code',$record->skills_code)->value('name_2');
             $classes = DB::table('classes')->where('id',$record->class_code)->value('class');
             $section =  DB::table('sections')->where('id',$record->sections_id)->value('section');
             $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
             $department = DB::table('department')->where('id',$record->department_code)->value('department_name');
             $date = $record->date_of_birth;
             $khmerDate = App\Service\service::convertToKhmerDate($date);
         ?>
         <tr id="row{{$record->code}}">
           <td class="text-center">{{ $record->code ?? ''}}</td>
           <td>{{ $record->name ?? ''}}</td>
           <td>{{ $record->name_2 ?? ''}}</td>
           <td>{{ $gender ?? ''}}</td>
           <td >{{ $khmerDate ?? ''}}</td>
           <td class="text-center">{{ $record->phone_student ?? ''}}</td>
           <td>{{ $classes ?? ''}}</td>
           <td>{{ $section ?? ''}}</td>
           <td>{{ $skills ?? ''}}</td>
           <td>{{ $department ?? ''}}</td>
         </tr>
         @endforeach
       </tbody>
   </table>
</div>
 
 