@extends('app_layout.app_layout')
@section('content')
    <h2 class="mb-4">Laravel DataTables with Bootstrap 5</h2>
    <table id="studentsTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Code</th>
                <th>Name</th>
                <th>Class</th>
                <th>Assigned Record</th>
                <th>Reference Code</th>
                <th>Print Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated by DataTables -->
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                ajax: {
                    url: "{{ route('users.get') }}", // Replace with your route
                    type: 'GET',
                    data: function(d) {
                        // Add any additional parameters here if needed
                        d.dept_code = $('#dept_code').val();
                        d.class_code = $('#class_code').val();
                        d.qualification = $('#qualification').val();
                        d.sections_code = $('#sections_code').val();
                        d.skills_code = $('#skills_code').val();
                        d.search = $('#search').val();
                    }
                },
                pageLength: 10, // Default number of records per page
                lengthMenu: [5, 10, 25, 50, 100], // Options for the number of records per page
                pagingType: 'full_numbers', // Customize pagination type (e.g., 'simple', 'simple_numbers', 'full', 'full_numbers')
                language: {
                    paginate: {
                        first: '<i class="bi bi-chevron-double-left"></i>', // Custom icon for "First"
                        last: '<i class="bi bi-chevron-double-right"></i>', // Custom icon for "Last"
                        next: '<i class="bi bi-chevron-right"></i>', // Custom icon for "Next"
                        previous: '<i class="bi bi-chevron-left"></i>' // Custom icon for "Previous"
                    },
                    lengthMenu: "Show _MENU_ entries per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    infoEmpty: "No entries available",
                    zeroRecords: "No matching records found"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'stu_photo',
                        name: 'stu_photo',
                        render: function(data, type, row) {
                            const photo = data ? `/uploads/student/${data}` :
                                '/asset/NTTI/images/faces/default_User.jpg';
                            return `<img src="${photo}" alt="Student Photo" class="img-thumbnail" style="width: 50px; height: 50px;">`;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name_2',
                        name: 'name_2'
                    },
                    {
                        data: 'class',
                        name: 'class'
                    },
                    {
                        data: 'record_assign_no',
                        name: 'record_assign_no',
                        render: function(data) {
                            return data ? `Year: ${data.years} | Semester: ${data.semester}` :
                                '---';
                        }
                    },
                    {
                        data: 'record_print.reference_code',
                        name: 'record_print.reference_code',
                        defaultContent: '---'
                    },
                    {
                        data: 'record_print.print_date',
                        name: 'record_print.print_date',
                        render: function(data) {
                            return data ? new Date(data).toISOString().split('T')[0] : '---';
                        }
                    },
                    {
                        data: 'record_print.status',
                        name: 'record_print.status',
                        render: function(data) {
                            return data == 1 ?
                                '<i class="mdi mdi-check-decagram mdi-24px text-success"></i> Delivered' :
                                '<i class="mdi mdi-close-octagon mdi-24px text-danger"></i> Not Delivered';
                        }
                    },
                    {
                        data: 'keyword',
                        name: 'keyword',
                        render: function(data, type, row) {
                            return `
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-rounded btn-icon" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="printCard('${row.code}')">
                                            <i class="mdi mdi-printer"></i> Print
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/certificate/transcript/show-info/${data}" target="_blank">
                                            <i class="mdi mdi-account-search"></i> View
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="addTranscript('${row.code}')">
                                            <i class="mdi mdi-plus"></i> Add
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        `;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        function printCard(code) {
            // Implement print card logic
            console.log('Print card for:', code);
        }

        function addTranscript(code) {
            // Implement add transcript logic
            console.log('Add transcript for:', code);
        }
    </script>
@endpush
