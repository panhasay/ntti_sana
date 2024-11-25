@extends('app_layout.app_layout')
@section('content')
<style>

</style>
<div class="page-head page-head-custom">
    <div class="row">
        <div class="container">
            <h1 class="page-title">My Profile</h1>

            <div class="action-buttons">
                <button class="btn">
                    <i class="fas fa-cog"></i> System Setting
                </button>
                <button class="btn">
                    <i class="fas fa-info-circle"></i> Company Information
                </button>
                <button class="btn">
                    <i class="fas fa-lock"></i> Two Factor Auth <i class="fas fa-chevron-down ms-1"></i>
                </button>
                <button class="btn btn-update">Update</button>
            </div>

            <div class="row">
                <!-- Left Profile Section -->
                <div class="col-md-3">
                    <div class="profile-card">
                        <div class="profile-section">
                            <img src="{{ asset('assets/heang.jpg') }}" class="profile-image" alt="Profile">
                            <h4 class="profile-name">SengHeang</h4>
                            <p class="profile-title">President Small/Medium</p>
                            <p class="account-no">Account No : 9</p>
                            <button class="upload-btn">
                                <i class="fas fa-upload text-primary"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Right Form Section -->
                <div class="col-md-9">
                    <!-- General Section -->
                    <div class="card-form mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>General</h5>
                            <i class="fas fa-chevron-up"></i>
                        </div>
                        <div>
                            <form action="">
                                <div class="row mt-3">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <input type="hidden" id="type" name="type" value="">
                                            <span class="labels col-sm-3 col-form-label text-right">Email</span>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm " id="Email" name="Email" value="{{ $records->email ?? '' }}" placeholder="Email" aria-label="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <span class="labels col-sm-3 col-form-label text-right">Name</span>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm " id="name" name="name" value="{{ $records->name ?? '' }}" placeholder="" aria-label="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <input type="hidden" id="type" name="type" value="">
                                            <span class="labels col-sm-3 col-form-label text-right">Gender</span>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm " id="Email" name="Email" value="{{ $records_by_user->gender ?? '' }}" placeholder="Email" aria-label="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <span class="labels col-sm-3 col-form-label text-right">Phone Number</span>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm " id="name" name="name" value="{{ $records_by_user->phone_no ?? $records_by_user->phone_student }}" placeholder="" aria-label="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Communication Section -->

                </div>
            </div>
        </div>
    </div>
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
                type: "POST"
                , url: `/classes-delete`
                , data: {
                    code: code
                }
                , success: function(response) {
                    if (response.status == 'success') {
                        $("#divConfirmation").modal('hide');
                        $("#row" + code).remove();
                        notyf.success(response.msg);
                    } else if (response.status == 'error') {
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
            type: 'get'
            , url: url
            , data: data
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , beforeSend: function() {
                $('.loader').show();
            }
            , success: function(response) {
                $('.loader').hide();
                $('.print-content').html(response);
                $('.print-content').printThis({});
            }
            , error: function(xhr, ajaxOptions, thrownError) {}
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
            type: "post"
            , url: url
            , data: data
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , beforeSend: function() {}
            , success: function(response) {
                notyf.error(response.msg);
            }
            , error: function(xhr, ajaxOptions, thrownError) {}
        });
    }

</script>
@endsection
