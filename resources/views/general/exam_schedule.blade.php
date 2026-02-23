@extends('app_layout.app_layout')
@section('content')
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
@include('system.modal_comfrim_delet')
@include('general.exam_schedule_lists')

<script>
    $(document).ready(function() {
        $('#select_all').on('change', function() {
            const isChecked = $(this).prop('checked');
            $('tbody input[type="checkbox"]').prop('checked', isChecked);
        });
        $('tbody input[type="checkbox"]').on('change', function() {
            const allChecked = $('tbody input[type="checkbox"]').length ===
                $('tbody input[type="checkbox"]:checked').length;

            // Update the select all checkbox state
            $('#select_all').prop('checked', allChecked);
        });
    });
</script>
@endsection