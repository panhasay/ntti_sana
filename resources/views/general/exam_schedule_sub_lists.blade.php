<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="10" rowspan="2">ល.រ</th>
                <th rowspan="2">កាលបរិច្ឆេទ</th>
                <th colspan="2" class="text-center">{{ $records->class_code ?? ''}}</th>
            </tr>
            <tr>
                <th>មុខវិជ្ជា</th>
                <th>សាស្ត្រាចារ្យ</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1;?>  
            @foreach ($record_sub_lines as $record)
                <tr>
                    <td height="38" class="text-center">{{ $index++ }}</td>
                    <td>{{ App\Service\service::convertToKhmerDate($record->date) ?? '' }}</td>
                    <td>{{ $record->subject->name ?? '' }}</td>
                    <td colspan="2">{{ $record->teacher->name_2 ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>