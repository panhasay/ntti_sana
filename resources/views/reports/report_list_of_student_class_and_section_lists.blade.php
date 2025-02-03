<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
        <thead>
            <tr class="general-data">
                <th class="text-center" width="20">លរ</th>
                <th width="20">ថ្នាក់</th>
                <th width="20">វេន</th>
                <th width="10">ជំនាញ</th>
                <th width="20">ដេប៉ាតឺម៉ង់</th>
                <th width="50">កម្រិត</th>
                <th width="50">ឆ្នាំសិក្សា</th>
                <th width="10">និស្សិតសរុប</th>
                <th width="15">និស្សិតស្រី</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            @foreach ($records as $index => $record)
            <tr id="row{{ $index+1 }}">
                <td class="text-center" height="35">{{ $index+1 }}</td>
                <td>{{ $record->class_code }}</td>
                <td>{{ $record->section ?? '' }}</td>
                <td>{{ $record->skills ?? '' }}</td>
                <td>{{ $record->department ?? '' }}</td>
                <td>{{ $record->qualification ?? '' }}</td>
                <td>{{ $record->session_year_code ?? '' }}</td>
                <td>{{ $record->total_students ?? '' }}</td>
                <td>{{ $record->total_f ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>