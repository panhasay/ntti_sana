<style>
    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin: 17px 0;
        font-size: 14px;
    }

    .report-table th, .report-table td {
        border: 1px solid #ccc;
        /* text-align: center; */
    }

    .report-table th {
        background-color: #f2f2f2;
    }

    .report-table tfoot td {
        font-weight: bold;
        background-color: #e6ffe6;
    }

    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .signature-section div {
        text-align: left;
        width: 40%;
    }
    .group-by > td{
        /* text-align: left !important; */
        font-weight: bold;
        padding: 7px ;
    }
    .general > td {
        /* text-align: left !important; */
    }
</style>

<div class="control-table">
    <table class="report-table">
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">កម្រិតជំនាញបណ្ដុះបណ្ដាល</th>
                <th class="text-center" colspan="2">យោងពីថ្ងៃមុន</th>
                <th class="text-center" colspan="2">ដាក់ពាក្យថ្ងៃនេះ</th>
                <th class="text-center" colspan="2">ចំនួនសរុបដល់ថ្ងៃនេះ</th>
                <th class="text-center" rowspan="2">ផ្សេងៗ</th>
            </tr>
            <tr>
                <th class="text-center">សរុប</th>
                <th class="text-center">ស្រី</th>
                <th class="text-center">សរុប</th>
                <th class="text-center">ស្រី</th>
                <th class="text-center">សរុប</th>
                <th class="text-center">ស្រី</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $grand_total_count = 0; 
                $grand_total_girl = 0; 
                $grand_total_today = 0; 
                $grand_total_today_girl = 0; 
                $index_g = 1;
            ?>
            @foreach ($records as $qualification => $apply_years)
                @foreach ($apply_years as $apply_year => $students)
                    <tr class="group-by">
                        <td colspan="9" class="text-left"> {{ $index_g++ }} {{ $qualification }} </td>
                    </tr>
                    <?php $index = 1; ?>
                    @foreach ($students->groupBy('skills_code') as $skill_code => $students_group)
                        <?php 
                        $skills_name = App\Models\General\Skills::where('code', $skill_code)->value('name_2'); 
                     
                        $total_count = $students_group->sum('total_count');
                        $total_count_girl = $students_group->sum('total_count_girl');
                        $total_count_today = $students_group->sum('total_count_today');
                        $total_count_today_girl = $students_group->sum('total_count_today_girl');
                        
                        $grand_total_count += $total_count;
                        $grand_total_girl += $total_count_girl;
                        $grand_total_today += $total_count_today;
                        $grand_total_today_girl += $total_count_today_girl;
                        ?>
                        <tr class="general">
                            <td class="text-center">{{ $index++ }}</td>
                            <td>{{ $skills_name ?? '' }}</td>
                            <td class="text-center">{{ $total_count - $total_count_today }}</td> 
                            <td class="text-center">{{ $total_count_girl - $total_count_today_girl }}</td>
            
                            <td class="text-center">{{ $total_count_today }}</td>
                            <td class="text-center">{{ $total_count_today_girl }}</td> 
            
                            <td class="text-center">{{ $total_count }}</td> 
                            <td class="text-center">{{ $total_count_girl }}</td> 
                            <td></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="bold" colspan="2">សរុប {{ $qualification }}</td>
                        <td class="text-center">{{ $students->sum('total_count') - $students->sum('total_count_today') }}</td> 
                        <td class="text-center">{{ $students->sum('total_count_girl') - $students->sum('total_count_today_girl') }}</td> 
                        <td class="text-center">{{ $students->sum('total_count_today') }}</td> 
                        <td class="text-center">{{ $students->sum('total_count_today_girl') }}</td> 

                        <td class="text-center">{{ $students->sum('total_count') }}</td> 
                        <td class="text-center">{{ $students->sum('total_count_girl') }}</td> 
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
            
            <tr class="grand-total">
                <td colspan="2" class="text-right"><strong>សរុបរូម​</strong></td>
                <td class="text-center"><strong>{{ $grand_total_count - $grand_total_today }}</strong></td> 
                <td class="text-center"><strong>{{ $grand_total_girl - $grand_total_today_girl }}</strong></td> 
                <td class="text-center"><strong>{{ $grand_total_today }}</strong></td> 
                <td class="text-center"><strong>{{ $grand_total_today_girl }}</strong></td> 

                <td class="text-center"><strong>{{ $grand_total_count }}</strong></td>
                <td class="text-center"><strong>{{ $grand_total_girl }}</strong></td> 
                <td></td>
            </tr>
        </tbody>
    </table>

  
</div>
<br>
<br>
<br><br><br><br><br><br><br><br><br>