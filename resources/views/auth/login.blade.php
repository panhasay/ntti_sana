<style>
  .footer {
      color: color(dark);
      padding: 14px 25px 12px 37px;
      transition: all .25sease;
      -moz-transition: all .25s ease;
      -webkit-transition: all .25sease;
      -ms-transition: all .25s ease;
      font-size: .825rem;
      font-family: Open Sans, sans-serif;
      font-weight: 400;
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      color: #fff;
      text-align: center;
      background: #fbfbfb !important;
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@extends('layout')
@section('content')

<!-- Section: Design Block -->
<!-- Modal or input area -->
<!-- Modal -->
<div class="modal fade" id="forGetform" tabindex="-1" role="dialog" aria-labelledby="forGetformLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forGetformLabel" style="font-family: Khmer OS Battambang !important;" >ភ្លេចលេខសម្ងាត់</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="email" id="email" class="form-control" placeholder="អ៊ីមែល" style="    font-family: Khmer OS Battambang !important;"><br>
        <input type="password" id="newpassword" class="form-control" placeholder="លេខសម្ងាត់" required  style="font-family: Khmer OS Battambang !important;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="    font-family: Khmer OS Battambang !important;">បិទ</button>
        <button type="button" class="btn btn-primary" id="submit-forgot" style="    font-family: Khmer OS Battambang !important;">ស្នើរ</button>
      </div>
    </div>
  </div>
</div>

<section class="background-radial-gradient overflow-hidden">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            The Ntti Portal
            {{-- <span style="color: hsl(218, 81%, 75%)">National Technical Training Institute</span> --}}
          </h1>
          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
            DIRECTOR OF NTTI ... Welcome to the National Technical Training Institute (NTTI) - one of the leading quality institutes of technical and vocational training and ...
          </p>
        </div>
        <div class="col-lg-5 mb-4 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
          <div class="card bg-glass">
            <div class="card-body px-4 py-4 px-md-4">
                <div class="col-12 khmer-mef2" style="font-family: 'Bayon', sans-serif;">ប្រព័ន្ធគ្រប់គ្រង</div>
                <form class="mt-3" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                        <label for="floatingInput" style="cursor: pointer;     font-family: Khmer OS Battambang !important;">អ៊ីមែល</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword"  name="password" placeholder="Password">
                        <label for="floatingPassword" style="cursor: pointer;     font-family: Khmer OS Battambang !important;">ពាក្យសម្ងាត់</label>
                        @if(session()->has('message'))
                        <span class="text-danger"> {{session()->get('message')}}</span>
                        @endif
                        <div class="text-right" id="forgot-link" style="cursor: pointer; font-family: 'Bayon'; color: #0f4e87;">ភ្លេចពាក្យសម្ងាត់ !</div>
                      </div><br>
                    <div class="offset-md-12">
                        <button type="submit" class="btn btn-primary col-md-12">
                            Login
                        </button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <footer class="footer">
      <div class="container">
        <div class="col-md-12">
          <span class="text-black text-center text-sm-left d-block d-sm-inline-block" style="color: #333; font-family: Khmer OS Battambang !important;">Copyright © 2024 <a href="https://www.ntti.edu.kh/" target="_blank">National Technical Training Institute</a> <span style="color: #333; font-family: Khmer OS Battambang !important;">អាសយដ្ឋាន: មហាវិថី សហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ</span> <a href="https://www.facebook.com/panha.say.73" target="_blank">Deverlop By</a> </span>
        </div>
      </div>
    </footer>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    $(document).ready(function() {
        // Open modal
        $('#forgot-link').on('click', function(e) {
            e.preventDefault();
            $('#forGetform').modal('show'); // Bootstrap modal show
        });

        // Submit form
        $('#submit-forgot').on('click', function() {
          const email = $('#email').val();
          const newpassword = $('#newpassword').val();

          if (!newpassword || !email) {
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "សូមបំពេញ!",
              });
              return;
          }

          $.ajax({
              url: '{{ route("forgot.password") }}',
              type: 'POST',
              data: {
                  email: email,
                  newpassword: newpassword,
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  $('#forGetform').modal('hide');
              },
              error: function(xhr) {
                  
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "អ៊ីមែលមិនត្រឹមត្រូវទេ!",
                });
              }
          });
        });
    });
  </script>
@endsection
