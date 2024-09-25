
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
          លទ្ធិផលប្រឡងឆមាសទី {{ $_GET['semester'] ?? '' }} ឆ្នាំទី {{ $_GET['years'] ?? '' }} / {{ $_GET['type'] ?? ""}}  
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="" href="{{ url('manage-academic-work') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
<div class="page-header flex-wrap">
  <div class="header-left">
    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreateAssign" href="#"></i> Print</i></a> 
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="{{ $page ?? '' }}" name="search_data"
      placeholder="Serch...." aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div>
    </div>
    <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
      aria-expanded="false" aria-controls="collapseExample">
      Fliter
    </a>
  </div>
</div>
<div class="collapse" id="Fliter">
  <div class="card card-body">
    <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <div class="col-sm-3">
              <span class="labels">លេខកូដ</span>
              <input type="text" class="form-control form-control-sm" id="code" name="code" value=""
                placeholder="លេខកូដ" aria-label="លេខកូដ">
            </div>
            <div class="col-sm-3">
              <span class="labels">ដេប៉ាតឺម៉ង់</span>
              <input type="text" class="form-control form-control-sm" id="name" name="name" value=""
                placeholder="ដេប៉ាតឺម៉ង់" aria-label="ដេប៉ាតឺម៉ង់">
            </div>
            <div class="col-sm-3">
              <span class="labels">Department</span>
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="Department" aria-label="Department">
            </div>
          </div>
          <button type="button" class="btn btn-primary text-white" data-page="department" id="btn-adSearch">Search</button>
        </div>
      </div>
    </form>
  </div>
</div>


<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
<div class="modal" id="ModalExamResults">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-dark modal-title-exam-results khmer_os_b"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="content-exam-results">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@include('general.exam_results_lists')
<script>
    $(document).ready(function() {
        $('.ExamResults').on('click', function() {
          let class_code = $(this).attr('data-class');
          var years = "{{ isset($_GET['years']) ? addslashes($_GET['years']) : '' }}";
          var type = "{{ isset($_GET['type']) ? addslashes($_GET['type']) : '' }}";
          var semester = "{{ isset($_GET['semester']) ? addslashes($_GET['semester']) : '' }}";

          var url = 'get-exam-results?class_code=' + class_code + '&years=' + years + '&type=' + type + '&semester=' + semester;
          $.ajax({
              type: "get",
              url: url,
              class_code: class_code,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                  if (response.status === 'success') {
                      $('#ModalExamResults').modal('show');
                      $('.content-exam-results').html(response.html);  
                      $('.modal-title-exam-results').text(
                          'តារាង សរុបពិន្ទុ ' + semester + ' ឆ្នាំទី ' + years + ' ' + type + ' ក្រុម ' + class_code
                      );
                  } 
              },
          });
      });
    });
</script>
@endsection
