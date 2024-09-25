<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
      <div class="col-md-6 col-sm-6  col-6">
        <div class="page-title page-title-custom">
          <h4>
            <i class="mdi mdi-format-list-bulleted"></i>
              Table Field
          </h4>
      </div>
      </div>
      <div class="col-md-6 col-sm-6 col-6">
        <div class="page-title page-title-custom text-right">
          <h4 class="text-right">
            <a id="btnShowMenuSetting" href="javascript:;"><i class="mdi mdi-settings"></i></a>
          </h4>
      </div>
    </div>
  </div>
  {{-- <div class="page-toolbar">
      <a href="javascript:;" id="btnShowMenuSetting" style="font-size: 23px;color: #b0adad;">
        <i class="mdi mdi-settings"></i> mdi mdi-settings
      </a>
  </div> --}}
</div>
<div class="page-header flex-wrap">
    <div class="header-left">
      {{-- <button class="btn btn-primary mb-2 mb-md-0 me-2" id="_btnAddNew"> New </button> --}}
      <button class="btn btn btn-outline-warning btn-fw mb-2 mb-md-0 m-confirm"> Buill Table </button>
    </div>
    <div class="header-right ">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button type="button" class="btn btn-inverse-primary"><i class="mdi mdi-magnify"></i></button>
        </div>
      </div>
    </div>
</div>
@include('system_setup.table_field_card')
@include('system_setup.table_field_lists')
@include('modals.modals_confirm')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  </script>
<script>
  $(document).ready(function () {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      $(document).on('click','#_btnAddNew',function(e){
      // alert('Please');
        // let series_code = $(this).attr('series');
        $('#divImport').modal('show');
    });
    $(document).on('click','#close',function(){
      $('#divImport').modal('hide');
    });
    $(document).on('click','.m-confirm',function(e){
        $('#m-confirm').modal('show');
    });
    $(document).on('click','.m-confirm-submit',function(e){e.preventDefault();
        let code = $(this).data('code');
        console.log(code);
        let data ={
            code:code,
        }
        $.ajax({
            url: "/build",
            type: "post",
            data:data,
            headers: {
              'X-CSRF-TOKEN': csrfToken
            },
            beforeSend: function() {
              $('.loader').show();
            },
            success: function (response) {
              if(response.status == 'success'){
                $('.loader').hide();
                $('#m-confirm').modal('hide');
                $('.container-scroller').html("");
                $('.container-scroller').html(response.view);
                notyf.error(response.msg);
              }else{
                notyf.error(response.msg);
              }
            }
        });
    });
  });
</script>
