@extends('app_layout.app_layout')
@section('content')
<style>
    .content-wrapper {
        height: 180vh;
    }

    .custom-form-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 5px;
        box-shadow: 0 0px 5px rgba(0, 0, 0, 0.1) !important;
    }

    .custom-form-label {
        color: #333;
    }

    .btn-primary {
        background-color: #007bff;
        /* Primary button color */
        border: none;
        /* Remove border */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker on hover */
    }

    /* Adjusted margin for form rows */
    .row.mb-3 {
        margin-bottom: 0.5rem;
        /* Smaller margin for form rows */
    }

    /* Custom styles for card headers */
    .card-header {
        padding: 10px 15px;
        /* Adjusted padding for card headers */
    }

    /* Style for required asterisk */
    .required {
        color: red;
        /* Red color for required asterisk */
    }

    /* Custom styles for the profile card */
    .profile-card {
        background-color: #f8f9fa;
        /* Light gray background */
        border: 1px solid #ced4da;
        /* Border color */
        border-radius: 8px;
        /* Rounded corners */
        padding: 20px;
        /* Padding inside the card */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        text-align: center;
        /* Center text */
    }

    .profile-card img {
        width: 120px;
        /* Image width */
        height: 120px;
        /* Image height */
        object-fit: cover;
        /* Maintain aspect ratio */
        border-radius: 50%;
        /* Circular image */
    }

    .profile-card h4 {
        margin: 10px 0;
        /* Margin for title */
        font-weight: bold;
        /* Bold title */
    }

    .profile-card p {
        margin: 5px 0;
        /* Margin for paragraphs */
        color: #6c757d;
        /* Muted text color */
    }

    .upload-button {
        color: #007bff;
        /* Link color */
        text-decoration: none;
        /* Remove underline */
    }

    .upload-button:hover {
        text-decoration: underline;
        /* Underline on hover */
    }

    .card {
        border-left: 0.1px solid white;
         !important
    }

    .col-form-label {
        padding-top: 1px !important;
    }
    .form-group label{
        padding-top: 10px;
    }
    .form-group {
        margin-bottom: 2px !important;
    }
</style>

<div class="container p-3 bg-white rounded">
    <div class="d-flex justify-content-between mb-4">
        <div class="custom-action-buttons bold">
            <button id="ResetPassword" data-code="{{ $records->id ?? '' }}" class="btn btn-outline-info btn-sm">
                <i class="mdi mdi-reload btn-icon-prepend"></i> Reset Password
            </button>
            My Profile
        </div>
        <button class="btn btn-primary btn-sm">
            <i class="mdi mdi-upload btn-icon-prepend"></i> Update
        </button>
    </div>

    <div class="row">
        <!-- Left Profile Section -->
        <div class="col-md-3">
            <div class="card profile-card mb-4">
                <div class="card-body">
                    <?php $picture =  App\Models\General\Picture::where('code', $records_by_user->code ?? '' )->where('type','student')->value('picture_ori'); ?>
                    @if($picture != null)
                    <img class="btn-Image" id="btn-Image" data-code='{{$records_by_user->code ?? ''}}'
                        src="{{ $picture ?? '' }}" width="1000" height="1000">
                    @else
                    <img class="btn-Image" id="btn-Image" data-code='{{$records_by_user->code ?? ''}}'
                        src="asset/NTTI/images/faces/default_User.jpg" width="1000" height="1000">
                    @endif
                    <h4 class="card-title">{{ $records->name ?? '' }}</h4>
                    <p class="text-muted">Ntti Portal</p>
                    <button type="button" data-code="{{ $records_by_user->code ?? '' }}"
                        class="btn btn-outline-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2 btn-Image-user">Upload
                        Image
                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="col-md-9">
            <!-- General Section -->
            <div class="card mb-4 custom-form-container">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">General</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                អុីម៉ែល
                            </label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" value="{{ $records->email ?? '' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                គោត្តនាម នាម
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstName"
                                    value="{{ $records->name ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                ភេទ
                            </label>
                            <div class="col-sm-9">
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstName"
                                        value="{{ $records_by_user->gender ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                ថ្ងៃខែឆ្នាំកំ់ណើត
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dob"
                                    value="{{ $records_by_user->date_of_birth ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                លេខទូរស័ព្ទ
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" placeholder="Phone No."
                                    value="{{ $records->phone ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                ដេប៉ាតាម៉ង់
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="organization"
                                    value="{{ $records->department->name_2 ?? '' }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Communication Section -->
            <div class="card custom-form-container">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Communication</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                អាស័យដ្ឋាន
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address1" placeholder="Address"
                                    value="{{ $records_by_user->student_address ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                ប្រទេស
                            </label>
                            <div class="col-sm-9">
                                <select id="country" class="form-select">
                                    <option selected value="kh">Cambodia</option>
                                    <option value="us">USA</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label custom-form-label text-right">
                                ក្រុង
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="city" placeholder="City/Town"
                                    value="ភ្នំពេញ">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalResetPasswrod" tabindex="-1" aria-labelledby="ModalResetPasswrod" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalResetPasswrod">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
            <div class="form-group">
                <label for="exampleInputUsername1"> អុីម៉ែល</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ $records->email ?? '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1"> ពាក្យសម្ងាត់ចាស់ </label>
                <input type="text" class="form-control" id="password_old" name="password_old" placeholder="ពាក្យសម្ងាត់ចាស់">
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1"> ពាក្យសម្ងាត់ថ្មី​ </label>
                <input type="text" class="form-control" id="password_new" name="password_new" placeholder="ពាក្យសម្ងាត់ថ្មី​" >
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="BtnResetPassword" data-code="{{ $records->id ?? '' }}">Yes</button>
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
        $(document).on('click', '.btn-Image-user', function() {
            let code = $(this).attr('data-code');
            alert(code);
            $.ajax({
                type: "GET",
                url: `/student/getImages`,
                data: {
                code: code
                },
                beforeSend: function() {
                    $('.global_laoder').show();
                },
                success: function(response) {
                if (response.status == 'success') {
                    $('#imageModal').modal('show');
                    $('.PreImage').html();
                    $('.PreImage').html(response.view);
                }
                }
            });
        });
        $(document).on('click', '#ResetPassword', function() {
            let code = $(this).attr('data-code');
            $("#ModalResetPasswrod").modal('show');
        });
        $(document).on('click', '#BtnResetPassword', function() {
            let code = $(this).attr('data-code');
            let orl_value = $("#password_old").val(); 
            let new_value = $("#password_new").val(); 
            $.ajax({
                type: "GET",
                url: `/profile/reset-password?code=${code}&password=${orl_value}&new_value=${new_value}`,
                data: {
                code: code
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.loader').hide();
                if (response.status == 'success') {
                    $("#ModalResetPasswrod").modal('hide');
                    notyf.success(response.msg);
                }else {
                    notyf.error(response.msg);
                }
                }
            });
        });
    });

</script>
@endsection