@extends('app_layout.app_layout')
<style>
  .col-md-6 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: 50%;
    margin-bottom: -10px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-top: -7px;
    margin-left: -15px;
  }

  .labels {
    text-align: right !important;
    font-family: 'Khmer OS Battambang';
    padding: 9px 8px 6px 16px !important;
  }
</style>
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-12 col-6">
      <div class="page-title page-title-custom text-left bold">
        {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
          href="{{url('/student/registration/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i>
          បន្ថែមថ្មី</i></a> --}}
        <button type="button" id="BtnSave" class="btn btn-success btn-icon-text btn-sm text-center">
          <i class="mdi mdi-content-save"></i> រក្សាទុក
        </button>
        {{-- @if(isset($records->code) && $records->code)
        <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">បោះពុម្ភ
          <i class="mdi mdi-printer btn-icon-append"></i>
        </button>
        @endif --}}
        ឈ្មោះ៖ {{ $records->name_2 ?? '' }} ក្រុម៖​ {{ $records->class_code ?? '' }}
      </div>
    </div>
    <div class="col-md-6 col-sm-12 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a href="javascript:void(0);" onclick="history.back()">
            <i class="mdi mdi-keyboard-return"></i>
        </a>
        </h4>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="card-body p-3">
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <input type="hidden" id="type" name="type" value="{{ $records->code ?? '' }}">
            <input type="hidden" id="type" name="skills_code" value="{{ $records->skills_code ?? '' }}">
            <input type="hidden" id="type" name="qualification" value="{{ $records->qualification ?? '' }}">
            <input type="hidden" id="type" name="sections_code" value="{{ $records->sections_code ?? '' }}">
            <span class="labels col-sm-3 col-form-label">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name_2" name="name_2"
                value="{{ $records->name_2 ?? ''}}" placeholder="ឈ្មោះ ជាភាសាខ្មែរ" aria-label="ឈ្មោះ ជាភាសាខ្មែរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អក្សរឡាតាំង<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name" name="name"
                value="{{ $records->name ?? ''}}" placeholder="ឈ្មោះ ជាអក្សរឡាតាំង" aria-label="ឈ្មោះ ជាអក្សរឡាតាំង">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label dateInput">ថ្ងៃ ខែ ឆ្នាំកំណើត<strong
                style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"
                id="date_of_birth" name="date_of_birth"
                value="{{ isset($records->date_of_birth) ? \Carbon\Carbon::parse($records->date_of_birth)->format('d-m-Y') : '' }}"
                min="1970-01-01" max="2010-12-31"
                placeholder="ថ្ងៃ-ខែ-ឆ្នាំកំណើត" aria-label="ថ្ងៃ-ខែ-ឆ្នាំកំណើត">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-6 col-form-label">សញ្ជាតិ<strong style="color:red; font-size:15px;">
                    *</strong></span>
                <div class="col-sm-6">
                  <input type="text" class="form-control form-control-sm " id="" name="" value="ខ្មែរ"
                    placeholder="សញ្ជាតិ" aria-label="សញ្ជាតិ">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label">ភេទ</span>
                <div class="col-sm-9">
                  <select class="js-example-basic-single" id="gender" name="gender" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    <option value="ប្រុស" {{ isset($records->gender) && $records->gender == 'ប្រុស' ? 'selected' : ''
                      }}>ប្រុស</option>
                    <option value="ស្រី" {{ isset($records->gender) && $records->gender == 'ស្រី' ? 'selected' : ''
                      }}>ស្រី</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ទីកន្លែងកំណើត<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="student_address" name="student_address"
                value="{{ $records->student_address ?? ''}}" placeholder="ទីកន្លែងកំណើត" aria-label="ទីកន្លែងកំណើត">
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អាសយដ្ឋានបច្ចុប្បន្ន<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="current_address" name="current_address"
                value="{{ $records->current_address ?? ''}}" placeholder="អាសយដ្ឋានបច្ចុប្បន្ន"
                aria-label="អាសយដ្ឋានបច្ចុប្បន្ន">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="occupation" name="occupation"
                value="{{ $records->occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">លេខទូរស័ព្ទ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="number" class="form-control form-control-sm " id="phone_student" name="phone_student"
                value="{{ $records->phone_student ?? ''}}" placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អាណាព្យាបាល</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="guardian_name" name="guardian_name"
                value="{{ $records->guardian_name ?? ''}}" placeholder="អាណាព្យាបាល" aria-label="អាណាព្យាបាល">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">លេខទូរស័ព្ទ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="number" class="form-control form-control-sm " id="guardian_phone" name="guardian_phone"
                value="{{ $records->guardian_phone ?? ''}}" placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
            </div>
          </div>
        </div>


        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឈ្មោះឪពុក<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="father_name" name="father_name"
                value="{{ $records->father_name ?? ''}}" placeholder="ឈ្មោះឪពុក" aria-label="ឈ្មោះឪពុក">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="father_occupation" name="father_occupation"
                value="{{ $records->father_occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឈ្មោះម្ដាយ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="mother_name" name="mother_name"
                value="{{ $records->mother_name ?? ''}}" placeholder="ឈ្មោះម្ដាយ" aria-label="ឈ្មោះម្ដាយ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="mother_occupation" name="mother_occupation"
                value="{{ $records->father_occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ជំនាញ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code"
                style="width: 100%;" disabled>
                <option value="">&nbsp;</option>
                @foreach ($skills as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">វេន<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code"
                style="width: 100%;" disabled >
                <option value="">&nbsp;</option>
                @foreach ($sections as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) && $records->sections_code
                  == $record->code ? 'selected' : '' }}>
                  វេន-{{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ក្រុម/ថា្នក់<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                style="width: 100%;" disabled>
                <option value="">&nbsp;</option>
                @foreach ($classes as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">សុំចូលរៀនឆ្នាំទី<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="apply_year" name="apply_year"
                style="width: 100%;" >
                <option value="">&nbsp;</option>
                @foreach ($study_years as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->apply_year) && $records->apply_year ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label ">កម្រិត<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single" id="qualification" name="qualification" style="width: 100%;">
                @foreach ($qualification as $value => $record)
                  <option value="{{ $record->code }}" {{ isset($records->qualification) && $records->qualification ==
                    $record->code ?
                    'selected' : '' }}>
                    {{ $record->code }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឆ្នាំសិក្សា<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="session_year_code" name="session_year_code"
                style="width: 100%;" readonly >
                <option value="">&nbsp;</option>
                @foreach ($school_years as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->session_year_code) &&
                  $records->session_year_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->name) ? $record->name : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឆមាស<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="semester" name="semester" style="width: 100%;" readonly >
                <option value="1" {{ (isset($records->semester) && $records->semester == '1') ? '' : 'selected'
                  }}>ឆមាសទី ១</option>
                <option value="2" {{ (isset($records->semester) && $records->semester == '2') ? 'selected' : ''
                  }}>ឆមាសទី ២</option>
              </select>
            </div>
          </div>
        </div>

        <div id="headingThree" class="card-header bg-white shadow-sm border-0">
          <h2 class="mb-0">
            <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
              aria-controls="collapseThree"
              class="btn collapsed text-dark font-weight-bold text-uppercase collapsible-link general-accordion">ពត៏មាន
              ផ្សេងៗ</button>
          </h2>
        </div>

        <div class="col-md-6 col-sm-12 mt-2">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-6 col-form-label">ថា្នក់សិក្សា<strong style="color:red; font-size:15px;">
                    *</strong></span>
                <div class="col-sm-6">
                  <select class="js-example-basic-single" id="bakdop_type" name="bakdop_type" style="width: 100%;"
                    placeholder="វិទ្យាសាស្រ្ដពិត">
                    <?php 
                  $options = [
                      'វិទ្យាសាស្រ្តពិត' => 'វិទ្យាសាស្រ្តពិត',
                      'វិទ្យាសាស្រ្តសង្គម' => 'វិទ្យាសាស្រ្តសង្គម',
                      'ផ្សេងៗ' => 'ផ្សេងៗ',
                  ];
                  ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->bakdop_type) && $records->bakdop_type == $value ?
                      'selected' : '' }}>
                      {{ $label }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-5 col-form-label">លទ្ធិផលបាក់ឌុប</span>
                <div class="col-sm-7">
                  <select class="js-example-basic-single" id="bakdop_results" name="bakdop_results"
                    style="width: 100%;">
                    <?php 
                    $options = [
                            'ជាប់' => 'ជាប់',
                            'ធ្លាក់' => 'ធ្លាក់',
                            'C3' => 'C3',
                            'ផ្សេងៗ' => 'ផ្សេងៗ',
                        ];
                    ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->bakdop_results) && $records->bakdop_results ==
                      $value ?
                      'selected' : '' }}>
                      {{ $label }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-6 col-sm-12 mt-2">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-6 col-form-label">និទ្ទេស</span>
                <div class="col-sm-6">
                  <select class="js-example-basic-single" id="bakdop_index" name="bakdop_index" style="width: 100%;">
                    <?php 
                      $options = [
                              'A' => 'A',
                              'B' => 'B',
                              'C' => 'C',
                              'D' => 'D',
                              'E' => 'E',
                              'F' => 'F',
                              'Auto' => 'Auto',
                              'ផ្សេងៗ' => 'ផ្សេងៗ',
                          ];
                      ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->bakdop_index) && $records->bakdop_index == $value ?
                      'selected' : '' }}>
                      {{ $label }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-5 col-form-label">ឆ្នាំបញ្ចាប់ទុតិយភូម</span>
                <div class="col-sm-7">
                  <select class="js-example-basic-single" id="year_final" name="year_final" style="width: 100%;">
                    <?php 
                    $options = [
                            '2024' => '2024',
                            '2023' => '2023',
                            '2022' => '2022',
                            '2021' => '2021',
                            '2020' => '2020',
                            '2019' => '2019',
                            '2018' => '2018',
                        ];
                    ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->year_final) && $records->year_final == $value ?
                      'selected' : '' }}>
                      {{ $label }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-sm-12 mt-2">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-6 col-form-label">បេក្ខជន មកពីខេត្ត<strong
                    style="color:red; font-size:15px;">
                    *</strong></span>
                <div class="col-sm-6">
                  <select class="js-example-basic-single" id="bakdop_province" name="bakdop_province"
                    style="width: 100%;">
                    <?php 
                    $options = [
                        'ភ្នំពេញ' => 'ភ្នំពេញ',
                        'កណ្ដាល' => 'កណ្ដាល',
                        'កែប' => 'កែប',
                        'កោះកុង' => 'កោះកុង',
                        'កំពង់ចាម' => 'កំពង់ចាម',
                        'កំពង់ឆ្នាំង' => 'កំពង់ឆ្នាំង',
                        'កំពង់ធំ' => 'កំពង់ធំ',
                        'កំពង់ស្ពឺ' => 'កំពង់ស្ពឺ',
                        'កំពត' => 'កំពត',
                        'ក្រចេះ' => 'ក្រចេះ',
                        'តាកែវ' => 'តាកែវ',
                        'ត្បូងឃ្មុំ' => 'ត្បូងឃ្មុំ',
                        'បន្ទាយមានជ័យ' => 'បន្ទាយមានជ័យ',
                        'បាត់ដំបង' => 'បាត់ដំបង',
                        'ប៉ៃលិន' => 'ប៉ៃលិន',
                        'ពោធិ៍សាត់' => 'ពោធិ៍សាត់',
                        'ព្រៃវែង' => 'ព្រៃវែង',
                        'ព្រះវិហារ' => 'ព្រះវិហារ',
                        'ព្រះសីហនុ' => 'ព្រះសីហនុ',
                        'មណ្ឌលគិរី' => 'មណ្ឌលគិរី',
                        'រតនគិរី' => 'រតនគិរី',
                        'សៀមរាប' => 'សៀមរាប',
                        'ស្ទឹងត្រែង' => 'ស្ទឹងត្រែង',
                        'ស្វាយរៀង' => 'ស្វាយរៀង',
                        'ឧត្ដរមានជ័យ' => 'ឧត្ដរមានជ័យ',
                    ];
                    ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->bakdop_province) && $records->bakdop_province ==
                      $value ?
                      'selected' : '' }}>
                      {{ $label }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <span class="labels col-sm-5 col-form-label">អាហារូបករណ៍</span>
                <div class="col-sm-7">
                  <select class="js-example-basic-single" id="scholarship" name="scholarship" style="width: 100%;"
                    placeholder="វិទ្យាសាស្រ្ដពិត">
                    <?php 
                    $options = [
                        '100' => '100',
                        '95' => '95',
                        '90' => '90',
                        '85' => '85',
                        '80' => '80',
                        '75' => '75',
                        '70' => '70',
                        '65' => '65',
                        '60' => '60',
                        '55' => '55',
                        '50' => '50',
                        '45' => '45',
                        '40' => '40',
                        '35' => '35',
                        '30' => '30',
                        '25' => '25',
                        '20' => '20',
                        '15' => '15',
                        '10' => '10',
                        '5' => '5',
                    ];
                    ?>
                    <option value="">&nbsp;</option>
                    @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ isset($records->scholarship) && $records->scholarship == $value ?
                      'selected' : '' }}>
                      {{ $label }} %
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6" style="margin-top: -20px;">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label ">ប្រភព អាហារូបករណ៍</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="scholarship_type" name="scholarship_type"
              value="{{ $records->scholarship_type ?? ''}}" placeholder="ប្រភព អាហារូបករណ៍" aria-label="ប្រភព អាហារូបករណ៍">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-6" >
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label ">ស្គាល់សាលា តាមរយះ</span>
              <div class="col-sm-9">
                {{-- <input type="text" class="form-control form-control-sm " id="submit_your_application" name="submit_your_application"
                value="{{ $records->submit_your_application ?? ''}}" placeholder="ដាក់ពាក្សសិក្សា តាមរយះ" aria-label="ដាក់ពាក្សសិក្សា តាមរយះ"> --}}

                <select class="js-example-basic-single" id="submit_your_application" name="submit_your_application" style="width: 100%;">
                  <?php 
                    $options = [
                            'មិត្តភ័ក្តិ ឬ​​ គ្រួសារ' => 'មិត្តភ័ក្តិ ឬ​​ គ្រួសារ',
                            'លោកគ្រូ​ អ្នកគ្រូ' => 'លោកគ្រូ អ្នកគ្រូ',
                            'ទស្សនកិច្ចនៅវវិទ្យាស្ថាន' => 'ទស្សនកិច្ចនៅវវិទ្យាស្ថាន',
                            'តម្រង់ទិសតាមវិទ្យាល័យ' => 'តម្រង់ទិសតាមវិទ្យាល័យ',
                            'កម្មវិធីទស្សនកិច្ចសិក្សា' => 'កម្មវិធីទស្សនកិច្ចសិក្សា',
                            'បណ្តាញសង្គម(Facebook,Youtube,.Tiktok....)' => 'បណ្តាញសង្គម(Facebook,Youtube,.Tiktok....)',
                            'ប្រព័ន្ធផ្សព្វផ្សាយរបស់​ កម្មវិធីបណ្តុះបណ្តាលជំនាញ TVET' => 'ប្រព័ន្ធផ្សព្វផ្សាយរបស់​ កម្មវិធីបណ្តុះបណ្តាលជំនាញ TVET',
                            'កម្មវិធីតាំងពិពណ៌' => 'កម្មវិធីតាំងពិពណ៌',
                            'ផ្សេងៗ' => 'ផ្សេងៗ',
                        ];
                  ?>
                  <option value="">&nbsp;</option>
                  @foreach ($options as $value => $label)
                  <option value="{{ $value }}" {{ isset($records->submit_your_application) && $records->submit_your_application == $value ?
                    'selected' : '' }}>
                    {{ $label }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label ">មកពី វិទ្យាល័យ</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="educational_institutions" name="educational_institutions"
              value="{{ $records->educational_institutions ?? ''}}" placeholder="គ្រឹះស្ថាន សិក្សា ឫ វិទ្យាល័យសិក្សា" aria-label="គ្រឹះស្ថាន សិក្សា ឫ វិទ្យាល័យសិក្សា">
            </div>
          </div>
        </div>
      </div>


      
      
    </div>
    <div class="row border-bottom">
      <div class="col-md-12 col-sm-12 col-12">
        <div class="page-title page-title-custom">
          <div class="title-page text-center">
          </div>
        </div>
      </div>
      <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    </div>
  </form>
</div>

@include('system.modal_create_user_student')
<!---PRINT--->
<div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="YesPrints" data-code="{{ $records->code ?? '' }}" data-id=""
          class="btn btn-primary">បោះពុម្ភ</button>
      </div>
    </div>
  </div>
</div>
<!---PRINT CONNECT--->
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
<br><br>
<script>
  $(document).ready(function() {
    $('#date_of_birth').on('input', function () {
      // Allow only numeric characters and specific symbols (-, ., /)
      let rawValue = $(this).val().replace(/[^0-9\-\.\/]/g, ''); 

      // Update the input value with the cleaned value
      $(this).val(rawValue);

      // Check if rawValue contains invalid characters
      if (/[^0-9\-\.\/]/.test($(this).val())) {
          notyf.error("សូមវាយលេខ (0-9) និងសញ្ញា (-, ., /)!");
          return;
      }

      // Process input only if the raw numeric length is exactly 8 (ddmmyyyy)
      const numericValue = rawValue.replace(/[^0-9]/g, ''); // Remove symbols to check numeric length
      if (numericValue.length === 8) {
          const day = numericValue.substring(0, 2);
          const month = numericValue.substring(2, 4);
          const year = numericValue.substring(4, 8);

          // Validate date components
          const isValidDate = validateDate(day, month, year);

          if (isValidDate) {
              const formattedDate = `${day}-${month}-${year}`;
              $(this).val(formattedDate); // Update input with formatted date
              $('#error_message').text(''); // Clear error message
          } else {
              notyf.error("សូម ពិនិត្យមើល ថ្ងៃខែឆ្នាំម្ដងទៀត​!");
          }
      }
  });


      // Date validation function
      function validateDate(day, month, year) {
          const date = new Date(`${year}-${month}-${day}`);
          return (
              date &&
              date.getFullYear() == year &&
              date.getMonth() + 1 == month &&
              date.getDate() == day
          );
      }


    $('#BtnSave').on('click', function() {
        var formData = $('#frmDataCard').serialize();
        var type = $('#type').val();
        var checkbox = $('#status');
        var status = checkbox.prop('checked') ? 'yes' : 'no';
        var url;
        if (!type) {
            url = '/student/registration/store?status=' + status;
        } else {
            url = '/class-new/student/registration/update?status=' + status;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == 'success') {
                  notyf.success(response.msg);
                }else if(response.store == 'yes'){
                    window.location.href = '/student/registration/transaction?type=ed&code=' + response.code_transetion;
                }else {
                    notyf.error(response.msg);
                }
            }
        });
    });

    $(document).on('click', '#BtnCreateUser', function() {
      $("#btnYes").attr('data-code', $(this).attr('data-code'));
      $("#divCreateUser").modal('show');
    });

    $(document).on('click', '#btnYes', function() {
      var code = $(this).attr('data-code');
      var password = $("#password").val();
      var username = $("#username").val();
      $.ajax({
        type: "get",
        url: `/student/registration/create-user-account`,
        data: {
          code: code, password:password , username: username
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmation").modal('hide');
            notyf.success(response.msg);
          }else{
            notyf.error(response.msg);
          }
        }
      });
    });

    $(document).on('click', '#btnClose', function() {
      $("#divCreateUser").modal('hide');
    });

    $('#name').on('input', function(){
        let inputValue = $(this).val();
        let uppercasedValue = inputValue.toUpperCase();
        $(this).val(uppercasedValue);
    });

    $('#name_2').on('input', function() {
        // Regular expression for Khmer Unicode range
        let khmerPattern = /^[\u1780-\u17FF\s]*$/;
        // Get current input value
        let inputValue = $(this).val();
        // Test if input matches Khmer characters and spaces
        if (!khmerPattern.test(inputValue)) {
            // Remove last character if it doesn't match Khmer characters
            $(this).val(inputValue.replace(/[^ឨ-៹\s]+$/, ''));
            // Show error message with Notyf
            notyf.error("សូមបំពេញឈ្មោះជាអក្សខ្មែរ");
        }
    });

    $('#name').on('input', function() {
        // Regular expression for English letters and spaces
        let englishPattern = /^[A-Za-z\s]*$/;
        
        // Get current input value
        let inputValue = $(this).val();
        
        // Test if input matches only English characters and spaces
        if (!englishPattern.test(inputValue)) {
            // Remove last character if it doesn't match English characters
            $(this).val(inputValue.replace(/[^A-Za-z\s]+$/, ''));
            
            // Show error message with Notyf
            notyf.error("សូម បំពេញជា ភាសាអង់គ្លេស");
        }
    });

    $('.dateInput').on('input', function() {
        const minDate = new Date("1970-01-01");
        const maxDate = new Date("2010-12-31");
        const selectedDate = new Date($(this).val());

        if (selectedDate < minDate) {
            $(this).val("1970-01-01");
        } else if (selectedDate > maxDate) {
            $(this).val("2010-12-31");
        }
    });
    
    $('#bakdop_results').on('change', function(event) {
        var selectedValue = $(this).val();
        
        if (selectedValue == "ធ្លាក់") {
            if ($('#bakdop_index option[value="F"]').length == 0) {
                $('#bakdop_index').append('<option value="F">Option F</option>');
            }
        }
    });

    $(document).on('click', '#prints', function() {
      let name = @json($records->name_2 ?? '');
      $(".modal-confirmation-text").html(`បោះពុម្ផពាក្យសុំចូលរៀន ឈ្មោះ ${name}`);
      $("#YesPrints").attr('data-code', $(this).attr('data-type'));
      $("#ModelPrints").modal('show');
    });

    $(document).on('click', '#YesPrints', function() {
      var code = $(this).attr('data-code');
      var url = '/student/registration/prints?code=' + code + '&type=is_print';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          if (response.status != 'success') {
            $('.loader').hide();
            $('.print-content').printThis({});
            $('.print-content').html(response);
            $('#ModelPrints').modal('hide');
            
          } else {
            $('.loader').hide();
            notyf.error("Error: " + response.msg);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    });

  });

  function DownlaodExcel() {
    var url = '/student/registration/downlaodexcel/';
    if ($('#search_data').val() == '') {
      data = $("#advance_search").serialize();
    } else {
      data = 'value=' + $('#search_data').val();
    }
    data = $("#advance_search").serialize();
    $.ajax({
      type: "post",
      url: url,
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function() {
        // $.LoadingOverlay("show", {
        //   custom: loadingOverlayCustomElement
        // });
        // loadingOverlayCustomElement.text('Request Processing...');
      },
      success: function(response) {
        $.LoadingOverlay("hide", true);
        if (response.status == 'success') {
          $('#divPassword').modal('hide');
          location.href = response.path;
          // myfn.showNotify(response['status'], 'lime', 'top', 'right', response['message']);
        } else {
          $('.secure_msg').html(response.message);
          $('.secure_msg').show();
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {}
    });
  }
  function FieldRequired() {
    var inValid = false ;
    $('#frmDataCard').each(function (event) {
      var code = $('#code').val();
      if(!code){
          $('#code').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#code').removeClass('FieldRequired');
          inValid = false; 
      }
      var name = $('#name').val();
      if(!name){
          $('#name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#name').removeClass('FieldRequired');
          inValid = false; 
      }
      var name_2 = $('#name_2').val();
      if(!name_2){
          $('#name_2').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#name_2').removeClass('FieldRequired');
          inValid = false; 
      }
      var date_of_birth = $('#date_of_birth').val();
      if(!date_of_birth){
          $('#date_of_birth').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#date_of_birth').removeClass('FieldRequired');
          inValid = false; 
      }
      var phone_student = $('#phone_student').val();
      if(!phone_student){
          $('#phone_student').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#phone_student').removeClass('FieldRequired');
          inValid = false; 
      }
      var father_name = $('#father_name').val();
      if(!father_name){
          $('#father_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#father_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var mother_name = $('#mother_name').val();
      if(!mother_name){
          $('#mother_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#mother_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var father_occupation = $('#father_occupation').val();
      if(!father_occupation){
          $('#father_occupation').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#father_occupation').removeClass('FieldRequired');
          inValid = false; 
      }
      var mother_occupation = $('#mother_occupation').val();
      if(!mother_occupation){
          $('#mother_occupation').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#mother_occupation').removeClass('FieldRequired');
          inValid = false; 
      }
      var guardian_name = $('#guardian_name').val();
      if(!guardian_name){
          $('#guardian_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#guardian_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var guardian_address = $('#guardian_address').val();
      if(!guardian_address){
          $('#guardian_address').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#guardian_address').removeClass('FieldRequired');
          inValid = false; 
      }

    });
    if(inValid){
        notyf.error('field is required');
    } 
    return inValid;

    
  }
</script>
@endsection