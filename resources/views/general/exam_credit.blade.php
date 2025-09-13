    @extends('app_layout.app_layout')
    @section('content')
        <div class="page-head page-head-custom">
            <div class="row">
                <div class="col-md-6 col-sm-6  col-6">
                    <div class="page-title page-title-custom">
                        <div class="title-page">
                            <i class="mdi mdi-format-list-bulleted"></i>
                            បញ្ជីរាយនាមវត្តមានប្រចាំខែ / ឆ្នាំ
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="page-title page-title-custom text-right">
                        <h4 class="text-right">
                            <a href="{{ url('department-menu') }}"><i class="mdi mdi-keyboard-return"></i></a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header flex-wrap">
            <div class="header-left">
                <a href="{{ url('exam-credit/exam-student-list') }}" class="btn btn-sm btn-success">
                    ប្រឡងក្រេឌីត
                </a>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">
                <input type="text" autocomplete="off" class="form-control" name="search_data_attendance"
                    id="search_data_attendance" placeholder="ស្វែងរក...">
            </div>
        </div>
        <div id="exam-credit-wrapper">
            @include('general.exam_credit_list')
        </div>
        <script>
            $(document).ready(function() {
                let debounceTimer;

                $('#search_data_attendance').on('keyup', function() {
                    clearTimeout(debounceTimer); // reset timer
                    let query = $(this).val();

                    debounceTimer = setTimeout(function() {
                        $.ajax({
                            url: '/exam-credit/search-attendance',
                            method: 'GET',
                            data: {
                                search_data_attendance: query
                            },
                            beforeSend: function() {
                                $('#exam-credit-wrapper').html(
                                    '<p class="text-center">⏳ កំពុងស្វែងរក...</p>');
                            },
                            success: function(data) {
                                $('#exam-credit-wrapper').html(data);
                            },
                            error: function(xhr) {
                                console.error('❌ Error:', xhr.responseText);
                                $('#exam-credit-wrapper').html(
                                    '<p class="text-danger text-center">មានបញ្ហាក្នុងការទាញទិន្នន័យ</p>'
                                );
                            }
                        });
                    }, 400); // ⏳ wait 400ms after user stops typing
                });
            });
            $(document).ready(function() {
                // Pagination click
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault(); // Prevent direct navigation
                    let page = $(this).attr('href').split('page=')[1];
                    let query = $('#search_data_attendance').val(); // Search term
                    fetch_data(page, query);
                });

                function fetch_data(page, query = '') {
                    $.ajax({
                        url: "/exam-credit/search-attendance?page=" + page,
                        method: "GET",
                        data: {
                            search_data_attendance: query
                        },
                        success: function(data) {
                            $('#exam-credit-wrapper').html(data); // Replace table
                        }
                    });
                }
            });
        </script>
    @endsection
