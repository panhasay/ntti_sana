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
        // Handle select all checkbox
        $('#select_all').on('change', function() {
            // Get the state of the select all checkbox
            const isChecked = $(this).prop('checked');

            // Find all checkboxes in the table body and set their state
            $('tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        // Handle individual checkbox changes
        $('tbody input[type="checkbox"]').on('change', function() {
            // Check if all checkboxes are checked
            const allChecked = $('tbody input[type="checkbox"]').length ===
                $('tbody input[type="checkbox"]:checked').length;

            // Update the select all checkbox state
            $('#select_all').prop('checked', allChecked);
        });
    });
</script>
@endsection