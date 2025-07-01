<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
        <thead>
            <tr class="general-data">
                <th>
                    {{-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> --}}
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">

                </th>
                <th>
                    <a type="button" class="btn btn-outline-info" id="certificateLink">
                        បោះពុម្ព
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </a>
                </th>
                <th width="10">អត្តលេខ</th>
                <th width="50">គោត្តនាម និងនាម</th>
                <th width="50">ឈ្មោះជាឡាតាំង</th>
                <th>ភេទ</th>
                <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                <th width="20">លេខទូរស័ព្ទ</th>
                <th>ក្រុម/ថា្នក់</th>
                <th>ជំនាញ</th>
                <th>កម្រិត</th>
                <th>វេនសិក្សា</th>
                <th>ដេប៉ាដេម៉ង់</th>
                <th>ឆ្នាំសិក្សា</th>
                <th width="200">ផ្សេងៗ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr id="row_line{{ $record->code }}">
                    <?php $picture = App\Models\General\Picture::where('code', $record->code)->value('picture_ori'); ?>
                    <td class="text-center">
                        <input class="form-check-input certificate-checkbox" type="checkbox" value="{{ $record->id }}"
                            id="id_check_box_certificate_{{ $record->id }}" data-id="{{ $record->id }}">
                    </td>

                    <td>
                        <button data-page="student" id="BtnPriview" data-code="{{ $record->code ?? '' }}"
                            data-name="{{ $record->name_2 ?? '' }}" type="button"
                            class="btn btn-outline-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-eye"></i> ក្រែសម្រួល
                        </button>
                    </td>
                    <td class="text-center"> {{ $record->code ?? '-' }}</td>
                    <td>{{ $record->name_2 ?? '' }}</td>
                    <td>{{ ucwords(strtolower($record->name ?? '-')) }}</td>
                    <td>{{ $record->gender ?? '-' }}</td>
                    <td>
                        {{-- {{ App\Service\service::DateYearKH($record->date_of_birth) ?? '-' }} --}}
                        {{ $record->date_year_kh ?? '-' }}
                    </td>
                    <td>{{ $record->phone_student ?? '-' }}</td>
                    <td>{{ $record->class_code ?? '-' }}</td>
                    <td>{{ DB::table('skills')->where('code', $record->skills_code)->value('name_2') ?? '' }}</td>
                    <td>{{ $record->qualification ?? '' }}</td>
                    <td>{{ DB::table('sections')->where('code', $record->sections_code)->value('name_2') ?? '' }}</td>
                    <td>{{ DB::table('department')->where('code', $record->department_code)->value('name_2') ?? '' }}
                    </td>
                    <td>{{ $record->session_year_code ? str_replace('_', '-', $record->session_year_code) : '' }}</td>
                    <td></td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $records->links('pagination::bootstrap-4') }}
</div><br><br>
