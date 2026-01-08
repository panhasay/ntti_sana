@extends('app_layout.app_layout')
<style>
    table,
    tr,
    th,
    td {
        padding: 12px !important;
        font-size: 15px !important;
    }

    th {
        font-weight: 600 !important;
    }

    .empty-session {
        font-size: 18px;
        margin-top: 150px;
    }
</style>
@section('content')
    <div class="page-title py-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    តារាងបែងចែកម៉ោងបង្រៀន
                </div>
                <div class="header-left">
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
                        href="{{ route('class.schedule.add') }}"><i class="mdi mdi-account-plus"></i>
                        បន្ថែមថ្មី</i></a>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ម៉ោងបង្រៀន</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if ($class_schedule->isEmpty())
        <div class="empty-session text-center">
            គ្មានទិន្នន័យក្នុងឆ្នាំសិក្សានេះទេ!
        </div>
    @else
        <table class="table table-striped table-hover text-center" id="table1">
            <thead>
                <tr class="bg-light">
                    <th></th>
                    <th>ល.រ</th>
                    <th>ថ្នាក់/ក្រុម</th>
                    <th>វេនសិក្សា</th>
                    <th>ជំនាញ</th>
                    <th>កម្រិត</th>
                    <th>ដេប៉ាតឺម៉ង់</th>
                    <th>ចាប់ផ្ដើមអនុវត្ត</th>
                    <th>ឆ្នាំសិក្សា</th>
                    <th>ឆមាស</th>
                    <th>បរិញ្ញាប័ត្រ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($class_schedule as $record)
                    @php
                        $skill = App\Models\General\Skills::where('code', $record->skills_code)->first();
                        $department = App\Models\SystemSetup\Department::where(
                            'code',
                            $record->department_code,
                        )->first();
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('class.schedule.list', ['id' => $record->id]) }}"
                                class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                                <i class="mdi mdi-border-color"></i> បញ្ចូលកាលវិគាគ
                            </a>
                            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2 delete-btn"
                                data-id="{{ $record->id }}"><i class="mdi mdi-delete-forever text-white"></i>លុប</button>
                        </td>
                        <td>{{ $index++ }}</td>
                        <td>{{ $record->class_code }}</td>
                        <td>{{ $record->section->name_2 }}</td>
                        <td>{{ $skill->name_2 ?? '' }}</td>
                        <td>{{ $record->qualification }}</td>
                        <td>{{ $department->name_2 ?? '' }}</td>
                        <td>{{ \App\Service\service::convertToKhmerDate($record->start_date) }}</td>
                        <td>{{ $record->session_year_code }}</td>
                        <td>ឆមាសទី {{ $record->semester }}</td>
                        <td>ឆ្នាំទី​ {{ $record->years }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                let id = $(this).data('id');
                let button = $(this);
                Swal.fire({
                    title: 'តើអ្នកប្រាកដថាចង់លុបទេ?',
                    text: "ទិន្នន័យនេះនឹងត្រូវបានលុបចោលដោយអចិន្ត្រៃយ៍!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'បាទ/ចាស, លុប!',
                    cancelButtonText: 'បោះបង់'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('class.schedule.delete', '') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ជោគជ័យ!',
                                        text: response.message,
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                    button.closest('tr').fadeOut(500,
                                        function() {
                                            $(this).remove();
                                        });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'មិនអនុញ្ញាត!',
                                        text: response.message
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'មានបញ្ហា!',
                                    text: 'មិនអាចលុបទិន្នន័យបានទេ'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
