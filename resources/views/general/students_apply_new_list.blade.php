<div class="control-table table-responsive custom-data-table-wrapper2">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    សិស្សបានដាក់បានដាក់ពាក្យ
                </div>
                <div class="header-left">
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="#"><i class="mdi mdi-account-plus"></i>
                        បន្ថែមថ្មី
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/student/index-student') }}">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">សិស្សបានដាក់បានដាក់ពាក្យ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <table class="table table-striped" id="table1">
        <thead>
            <tr>
                <th class="text-center">ថា្នក់/ក្រុម</th>
                <th class="text-center">វេនសិក្សា</th>
                <th class="text-center">ជំនាញ</th>
                <th class="text-center">កម្រិត</th>
                <th class="text-center">ឆមាស</th>
                <th class="text-center">ដេប៉ាតឺម៉ង់</th>
                <th class="text-center">ចាប់ផ្តើមអនុវត្ត</th>
                <th class="text-center">ឆ្នាំសិក្សា</th>
                <th class="text-center">បរិញាប័ត្រ ឆ្នាំ</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
           @foreach ($records as $record)
                @php
                    Carbon\Carbon::setLocale('km');
                    $department = $departments[$record->department_code] ?? '';
                    $section    = $sections[$record->sections_code] ?? '';
                    $skill      = $skills[$record->skills_code] ?? '';
                    $date = Carbon\Carbon::parse($record->start_date);
                    $formattedDate = 'ថ្ងៃទី ' . $date->day . ' ខែ ' . $date->translatedFormat('F') . ' ឆ្នាំ ' . $date->year;
                @endphp
                <tr class="detail-row-student" style=" cursor: pointer;"
                        data-class="{{ $record->class_code }}"
                        data-section="{{ $record->sections_code }}"
                        data-session="{{ $record->session_year_code }}"
                    >
                    <td class="text-center">{{ $record->class_code }}</td>
                    <td class="text-center">{{ $section }}</td>
                    <td class="text-center">{{ $skill }}</td>
                    <td class="text-center">{{ $record->qualification }}</td>
                    <td class="text-center">ឆមាសទី {{ $record->semester }}</td>
                    <td class="text-center">{{ $department }}</td>
                    <td class="text-center">{{ $formattedDate }}</td>
                    <td class="text-center">{{ $record->session_year_code }}</td>
                    <td class="text-center">ឆ្នាំទី {{ $record->years }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><br><br>