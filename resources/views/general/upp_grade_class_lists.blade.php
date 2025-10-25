<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          ឡើងថ្នាក់/ក្រុម
        </div>
        {{-- <div class="header-left">
          <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
            href="{{url('/student/registration/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i>
            បន្ថែមថ្មី</i>
          </a>
          <button type="button" id="BtnDownlaodExcel"
            class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
              class="mdi mdi-printer btn-icon-append"></i>
          </button>
        </div> --}}
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">ឡើងថ្នាក់</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <table class="table table-striped" id="table1">
    <thead>
      <tr class="thead">
        <th width="50"></th>
        <th width="10">លេខក្រុម</th>
        <th>វេនសិក្សា</th>
         <th>ឆមាស</th>
        <th>ឆ្នាំ</th>
        <th>ជំនាញ</th>
        <th>កម្រិត</th>
        <th>ឆ្នាំសិក្សា</th>
      </tr>
    </thead>
    <tbody>
        @if(count($records) > 0)
          @foreach ($records as $record)
            <tr id="row{{$record->class_code}}">
              <td>
                  <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                    href="{{ '/up-grade-class/transaction?type=ed&semester=' . ($record->semester ?? '') . '&years=' . ($record->years ?? '') . '&code=' . \App\Service\service::Encr_string($record->class_code ?? '') }}">
                    <i class="mdi mdi-border-color"></i> ចំនួននិស្សិត
                  </a>
              </td>
              <td>{{ preg_replace('/[^a-zA-Z0-9]/', '', $record->class_code ?? '') }}</td>
              <td>{{ $record->section->name_2 ?? '' }}</td>
              <td>ឆមាសទី {{ $record->semester ?? '' }}</td>
              <td>ឆ្នាំ {{ $record->years ?? '' }}</td>
              <td>{{ $record->skill->name_2 ?? '' }}</td>
              <td>{{ $record->qualification ?? '' }}</td>
              <td>{{ str_replace('_', ' - ', $record->session_year_code ?? '') }}</td>
            </tr>
          @endforeach
        @endif
    </tbody>
  </table>
</div><br>