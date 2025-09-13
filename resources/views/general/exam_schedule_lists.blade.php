<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="50"></th>

                <th class="text-center" width="10"> <input type="checkbox" id="select_all"> <!-- Select all --></th>

                <th class="text-center">ថា្នក់/ក្រុម</th>
                <th class="text-center">វេនសិក្សា</th>
                <th class="text-center">ជំនាញ</th>
                <th class="text-center">កម្រិត</th>
                <th class="text-center">ឆមាស</th>
                <th class="text-center">ដេប៉ាតឺម៉ង់</th>
                <th class="text-center">ចាប់ផ្តើមអនុវត្ត</th>
                <th class="text-center">ឆ្នាំសិក្សា</th>
                <th class="text-center">បរិញាប័ត្រ ឆ្នាំ</th>
            </tr>
        </thead>
        <tbody>
            @include('general.exam_schedule_record')
        </tbody>
    </table>
    {{ $records->links('pagination::bootstrap-4') }}
</div><br><br>

<style>
    #select_all {
        transform: scale(1.2);
        cursor: pointer;
    }
</style>

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
