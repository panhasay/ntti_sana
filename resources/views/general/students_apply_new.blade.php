@extends('app_layout.app_layout')
@section('content')
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
@include('system.modal_comfrim_delet')
@include('general.students_apply_new_list')
<script>
   $(document).on('click', '.detail-row-student', function () {
        if ($('.student-detail-row').length > 0) {
            $('.student-detail-row').remove();
            return;
        }
        let $row = $(this);
        $.ajax({
            url: "{{ route('class.students.detail') }}",
            type: "GET",
            data: {
                class_code: $row.data('class'),
                sections_code: $row.data('section'),
                session_year_code: $row.data('session')
            },
            beforeSend: function () {
                $('.loader').show();
            },
            success: function (res) {
                $('.loader').hide();
                $row.after(res);
            }
        });
    });
</script>
@endsection