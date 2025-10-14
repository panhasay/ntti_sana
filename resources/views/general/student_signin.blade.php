<style>
  .labels-customize {
    padding-top: 0px !important;

  }

  .form-group-custome {
    margin-bottom: 0px !important;
    padding: 1px !important;
  }

  .labels {
    padding: 0px 10px 10px 1px !important;
  }

  @media screen and (min-width: 992px) {
    #frmDataCard {
      align-content: center;
      width: 50%;
      margin: auto;
    }
  }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-12 col-sm-12  col-12">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
          ពាក្យសុំចុះឈ្មោះចូលរៀន
        </div>
      </div>
    </div>
  </div>
</div>
<div class="">

  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="col-md-12 col-sm-12 col-12">

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                placeholder="ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ" aria-label="ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">អក្សរឡាតាំង</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="អក្សរឡាតាំង" aria-label="អក្សរឡាតាំង">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ថ្ងៃខែ ឆ្នាំកំ ឆ្នាំ ណើត</div>
        <div class="col-sm-12">
          <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
            placeholder="ថ្ងៃខែ ឆ្នាំកំ ឆ្នាំ ណើត" aria-label="ថ្ងៃខែ ឆ្នាំកំ ឆ្នាំ ណើត">
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">សញ្ជាតិ</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="សញ្ជាតិ" aria-label="សញ្ជាតិ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ភេទ</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="សញ្ជាតិ" aria-label="សញ្ជាតិ">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ទីកន្លែងកំណើត</div>
        <div class="col-sm-12">
          <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
            placeholder="ទីកន្លែងកំណើត" aria-label="ទីកន្លែងកំណើត">
        </div>
      </div>

      <div class="form-group-custome">
        <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ទីលំនៅបច្ចុប្បន្ន</div>
        <div class="col-sm-12">
          <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
            placeholder="ទីលំនៅបច្ចុប្បន្ន" aria-label="ទីលំនៅបច្ចុប្បន្ន">
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">មុខរបរ</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">លេខទូរស័ព្ទ</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="លេខទូរស័ព្ទ " aria-label="លេខទូរស័ព្ទ ">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">អាណាព្យាបាល</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="អាណាព្យាបាល" aria-label="អាណាព្យាបាល">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">លេខទូរស័ព្ទ</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="លេខទូរស័ព្ទ " aria-label="លេខទូរស័ព្ទ ">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ឈ្មោះឪពុក </div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="ឈ្មោះឪពុក " aria-label="ឈ្មោះឪពុក ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">លេខទូរស័ព្ទ</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="លេខទូរស័ព្ទ " aria-label="លេខទូរស័ព្ទ ">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ឈ្មោះម្ដាយ </div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="ឈ្មោះម្ដាយ " aria-label="ឈ្មោះម្ដាយ ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">លេខទូរស័ព្ទ</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="លេខទូរស័ព្ទ " aria-label="លេខទូរស័ព្ទ ">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ជំនាញ </div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="ជំនាញ  " aria-label="ជំនាញ  ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">វេន</div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="វេន " aria-label="វេន ">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">សុំចូលរៀនឆ្នាំទី</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="សុំចូលរៀនឆ្នាំទី" aria-label="សុំចូលរៀនឆ្នាំទី">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">កម្រិត </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                  placeholder="កម្រិត" aria-label="កម្រិត">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ឆ្នាំសិក្សា </div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="សុំចូលរៀនឆ្នាំទី" aria-label="សុំចូលរៀនឆ្នាំទី">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">ឆមាស </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                  placeholder="ឆមាស" aria-label="ឆមាស">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="headingThree" class="card-header bg-white shadow-sm border-0 mt-3">
        <h2 class="mb-0">
          <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
            aria-controls="collapseThree"
            class="btn collapsed text-dark font-weight-bold text-uppercase collapsible-link general-accordion">ពត៏មាន
            ផ្សេងៗ</button>
        </h2>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ថា្នក់សិក្សា</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="ថា្នក់សិក្សា" aria-label="ថា្នក់សិក្សា">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">លទ្ធិផលបាក់ឌុប </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                  placeholder="លទ្ធិផលបាក់ឌុប" aria-label="លទ្ធិផលបាក់ឌុប">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">និទ្ទេស</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="និទ្ទេស" aria-label="និទ្ទេស">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">ឆ្នាំបញ្ចាប់ទុតិយភូម </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                  placeholder="ឆ្នាំបញ្ចាប់ទុតិយភូម" aria-label="ឆ្នាំបញ្ចាប់ទុតិយភូម">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">បេក្ខជន មកពីខេត្ត </div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="បេក្ខជន មកពីខេត្ត " aria-label="បេក្ខជន មកពីខេត្ត ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">អាហារូបករណ៍ </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                  placeholder="អាហារូបករណ៍" aria-label="អាហារូបករណ៍">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">ប្រភព អាហារូបករណ៍</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="ប្រភព អាហារូបករណ៍" aria-label="ប្រភព អាហារូបករណ៍">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize">ស្គាល់សាលា តាមរយះ </div>
              <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="index_class" name="index_class" value=""
                  placeholder="ស្គាល់សាលា តាមរយះ" aria-label="ស្គាល់សាលា តាមរយះ">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-custome">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">មកពី វិទ្យាល័យ</div>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
                placeholder="មកពី វិទ្យាល័យ" aria-label="មកពី វិទ្យាល័យ">
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <div class="form-group-custome">
              <div class="labels col-sm-12 col-form-label text-start mt-3 labels-customize"></div>
              <div class="col-sm-12">
                
              </div>
              
            </div>
          </div>
          <br>
        </div>
      </div>
      <br>
      <div class="row col-md-12 col-sm-12 col-12 mt-3 text-center" style="margin-left: 2px;">
          <button type="button" id="BtnSave" class="btn btn-success btn-icon-text btn-sm text-center">
                <i class="mdi mdi-content-save"></i> ស្នើរសុំ
          </button>
      </div>
      {{-- <div class="form-group-custome">
        <div class="labels ol-sm-12 col-form-label text-start mt-3 labels-customize">សញ្ជាតិ</div>
        <div class="col-sm-9">
          <input type="text" class="form-control form-control-sm " id="index_class" name="index_class" value=""
            placeholder="សញ្ជាតិ" aria-label="សញ្ជាតិ">
        </div>
      </div> --}}
    </div>
  </form>

  <br><br><br><br><br><br><br>
</div>

<script>
  $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $(document).on('click', '#btnDelete', function() {
        $(".modal-confirmation-text").html('Do you want to delete?');
        $("#btnYes").attr('data-code', $(this).attr('data-code'));
        $("#divConfirmation").modal('show');
      });
      $(document).on('click', '#btnYes', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "POST",
          url: `/classes-delete`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              $("#row" + code).remove();
              notyf.success(response.msg);
            }else if (response.status == 'error') {
              notyf.error(response.msg);
            }
          }
        });
      });
      $('#BtnSave').on('click', function() {
        var formData = $('#frmDataCard').serialize();
        var type = $('#type').val();
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "success",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success"
            });
          }
        });

        return console.log(formData);

        var url;
        if (!type) {
            url = `/skills/store`;
        } else {
            url = `/skills/update`;
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


    });
  
    function prints(ctrl) {
      var url = 'departments/print';
      var data = '';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          $('.loader').hide();
          $('.print-content').html(response);
          $('.print-content').printThis({});
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
  
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
        beforeSend: function() {},
        success: function(response) {
          notyf.error(response.msg);
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
</script>
@endsection