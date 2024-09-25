<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('teachers') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
            @if($type == 'cr')
              បន្ថែមថ្មី
            @else
              កែប្រែ |
            @endif
           {{ $records->name_2 ?? '' }} &nbsp;&nbsp; 
           <button type="button" id="BtnSave" class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-content-save"></i> save</button>
           <button type="button" id="BtnCreateUser" data-code="{{$records->code ?? ''}}" class="btn btn-dark btn-icon-text btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-account"></i> create user</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="{{ url('/teachers') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="col-lg-12 mx-auto">
      <!-- Accordion -->
      <div id="accordion_formData" class="accordion shadow">
        <div id="headingOne" class="card-header bg-white shadow-sm border-0">
          <h2 class="mb-0">
            <button type="button" data-toggle="collapse" data-target="#General" aria-expanded="true"
              aria-controls="General" class="btn text-dark font-weight-bold collapsible-link general-accordion">សិស្សទូទៅ</button>
          </h2>
        </div>
        <div id="General" aria-labelledby="headingOne" data-parent="#accordion_formData" class="collapse show">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" name="type" id="type" value="{{ $records->code ?? '' }}">
                  <span class="labels col-sm-3 col-form-label text-end">លេខកូដ<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="code" name="code" 
                        value="{{ $records->code ?? '' }}" placeholder="លេខកូដ" 
                        aria-label="លេខកូដ" {{ isset($records->code) ? 'readonly' : '' }}>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">គោត្តនាម និងនាម<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value="{{ $records->name_2 ?? '' }}"
                      placeholder="គោត្តនាម និងនាម" aria-label="គោត្តនាម និងនាម">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះជាឡាតាំង<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $records->name ?? '' }}"
                      placeholder="ឈ្មោះជាឡាតាំង" aria-label="ឈ្មោះជាឡាតាំង">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end"><br>ថ្ងៃខែឆ្នាំកំណើត<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <span class="date-note">ថ្ងៃ-ខៃ-ឆ្នាំ</span>
                    <input type="date" class="form-control form-control-sm" id="date_of_birth" name="date_of_birth" value="{{ $records->date_of_birth ?? '' }}"
                      placeholder="ថ្ងៃខែឆ្នាំកំណើត" aria-label="ថ្ងៃខែឆ្នាំកំណើត">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ភេទ</span>
                  <div class="col-sm-9">
                    <select class="js-example-basic-single" id="gender" name="gender" style="width: 100%;">
                        <option value="">&nbsp;</option>
                        <?php  $genders = ['ប្រុស' => 'Male - ប្រុស', 'ស្រី' => 'Female - ស្រី']; ?>
                        @foreach($genders as $key => $label)
                          <option value="{{ $key }}" {{ isset($records->gender) && $records->gender == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន</span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="address" name="address" value="{{ $records->address ?? '' }}"
                      placeholder="អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន" aria-label="អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">អ៊ីមែល</span>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $records->email ?? '' }}"
                        placeholder="អ៊ីមែល" aria-label="អ៊ីមែល">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">លេខទូរស័ព្ទ</span>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="phone_no" name="phone_no" value="{{ $records->phone_no ?? '' }}"
                        placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">អត្តសញ្ញាប័ណ</span>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="id_card" name="id_card" value="{{ $records->id_card ?? '' }}"
                        placeholder="អត្តសញ្ញាប័ណ" aria-label="អត្តសញ្ញាប័ណ">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាតដេម៉ង់</span>
                    <div class="col-sm-9">
                      <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;">
                        <option value="">&nbsp;</option>
                          @foreach ($department as $record) 
                              <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                              {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                              </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            
          </div>
        </div>
      </div>
      <!-- Accordion item 2 -->
      <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
        <h2 class="mb-0">
          <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo"
            class="btn  collapsed text-dark font-weight-bold text-uppercase general-accordion">ពត៏មានអាណាព្យាបាល</button>
        </h2>
      </div>
      <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion_formData" class="collapse show">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ឪពុក<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="father_name" name="father_name" value="{{ $records->father_name ?? '' }}"
                    placeholder="ឈ្មោះ ឪពុក" aria-label="ឈ្មោះ ឪពុក">
                </div>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ទូរស័ព្ទ ឪពុក</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="father_phone" name="father_phone" value="{{ $records->father_phone ?? '' }}"
                    placeholder="ទូរស័ព្ទ ឪពុក" aria-label="ទូរស័ព្ទ ឪពុក">
                </div>
              </div>
            </div> --}}
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ម្ដាយ<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name" value="{{ $records->mother_name ?? '' }}"
                    placeholder="ឈ្មោះ ម្ដាយ" aria-label="ឈ្មោះ ម្ដាយ">
                </div>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ទូរស័ព្ទ ម្ដាយ</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="mother_phone" name="mother_phone" value="{{ $records->mother_phone ?? '' }}"
                    placeholder="ទូរស័ព្ទ ម្ដាយ" aria-label="ទូរស័ព្ទ ម្ដាយ">
                </div>
              </div>
            </div> --}}
          </div>

        </div>
      </div>
      <!-- End -->
      <!-- Accordion item 3 -->
      <div id="headingThree" class="card-header bg-white shadow-sm border-0">
        <h2 class="mb-0">
          <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
            aria-controls="collapseThree"
            class="btn collapsed text-dark font-weight-bold text-uppercase collapsible-link general-accordion">ពត៏មាន ផ្សេងៗ</button>
        </h2>
      </div>
      <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion_formData" class="collapse show">
        <div class="card-body p-3">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំចូលធ្វើការ</span>
                <div class="col-sm-9">
                  <input type="date" class="form-control form-control-sm" id="date_of_joining" name="date_of_joining" value="{{ $records->date_of_joining ?? '' }}"
                  placeholder="ឆ្នាំចូលធ្វើការ" aria-label="ឆ្នាំចូលធ្វើការ">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ស្ថានភាពអាពាហ៍ពិពាហ៍</span>
                <div class="col-sm-9">
                  <select class="js-example-basic-single" id="marital_status" name="marital_status" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    <option value="មានគ្រួសារ" {{ isset($records->marital_status) && $records->marital_status == 'មានគ្រួសារ' ? 'selected' : '' }}>មានគ្រួសារ</option>
                    <option value="នៅលីវ" {{ isset($records->marital_status) && $records->marital_status == 'នៅលីវ' ? 'selected' : '' }}>នៅលីវ</option>
                </select>
              </div>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">កម្រិតបរិញ្ញាបត្រ</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="qualification" name="qualification" value="{{ $records->qualification ?? '' }}"
                  placeholder="កម្រិតបរិញ្ញាបត្រ" aria-label="កម្រិតបរិញ្ញាបត្រ">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព</span>
                <div class="col-sm-9">
                  <select class="js-example-basic-single" id="status" name="status" style="width: 100%;">
                    <option value="yes" {{ isset($records->status) && $records->status == 'yes' ? 'selected' : '' }}>yes</option>
                    <option value="no" {{ isset($records->status) && $records->status == 'no' ? 'selected' : '' }}>no</option>
                  </select>
              </div>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">បទពិសោធន៍​ការងារ	</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="work_exp" name="work_exp" value="{{ $records->work_exp ?? '' }}"
                  placeholder="បទពិសោធន៍​ការងារ	" aria-label="បទពិសោធន៍​ការងារ	">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              {{-- <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព</span>
                <div class="col-sm-9">
                  <select class="js-example-basic-single" id="status" name="status" style="width: 100%;">
                    <option value="yes" {{ isset($records->status) && $records->status == 'yes' ? 'selected' : '' }}>yes</option>
                    <option value="no" {{ isset($records->status) && $records->status == 'no' ? 'selected' : '' }}>no</option>
                  </select>
              </div>
            </div> --}}
            </div>
          </div>
          

        </div>
      </div>
      <!-- End -->
    </div>
  </form>
  <!--Model--->
  @include('system.modal_create_user_student')
  <!--End Model-->
</div><br><br>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#BtnSave').on('click', function() {
        var formData = $('#frmDataCard').serialize();
        var type = $('#type').val();
        var checkbox = $('#status');
        var status = checkbox.prop('checked') ? 'yes' : 'no';
        var url;
        if (!type) {
            if(FieldRequired()) return;
            url = '/teachers/store?status=' + status;
        } else {
            url = '/teachers/update?status=' + status;
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
                  $('#frmDataCard')[0].reset();
                  notyf.success(response.msg);
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
      var email = $("#email").val();
      $.ajax({
        type: "get",
        url: `/teachers/create-user-account`,
        data: {
          code: code, password:password , email: email
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
  });
  function DownlaodExcel() {
    var url = '/student/downlaodexcel/';
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
    });
    if(inValid){
        notyf.error('field is required');
    } 
    return inValid;
}
</script>
