<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:site_name" content="Metronic by Keenthemes" />

  <title>NTTI</title>
  {{-- <link rel="preconnect" href="{{asset('https://fonts.googleapis.com')}}">
  <link rel="preconnect" href="{{asset('https://fonts.googleapis.comhttps://fonts.gstatic.com')}}" crossorigin>
  <link href="{{asset('https://fonts.googleapis.com/css2?family=Moul&display=swap')}}" rel="stylesheet">
  <link href="{{asset('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Moul&family=Odor+Mean+Chey&display=swap')}}"
 rel="stylesheet"> --}}
  <!---front ---> 
  <!-- plugins:css -->
  {{-- <link rel="stylesheet" href="{{ asset('asset/NTTI/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{asset('asset/NTTI/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('asset/NTTI/vendors/css/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{asset('asset/NTTI/vendors/select2/select2.min.css')}}" />
  <link rel="stylesheet" href="{{asset('asset/NTTI/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('asset/NTTI/vendors/jquery-bar-rating/css-stars.css') }}" />
  <link rel="stylesheet" href="{{ asset('asset/NTTI/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{asset('asset/NTTI/css/global/style.css')}}" />
  <!-- End layout styles -->
  {{-- <link rel="shortcut icon" href="asset/NTTI/images/favicon.png" /> --}}
  <link rel="shortcut icon" href="{{asset('https://nttiportal.com/./uploads/school_content/logo/front_fav_icon-619eeffe4674b6.56720560.png')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css')}}"> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!---google chart -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    window.authUserID = @json(auth()->check() ? auth()->id() : null);
    const checkAuthRoute = @json(Route::currentRouteName(), JSON_THROW_ON_ERROR);
</script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    .loader{
      position: absolute !important;
      z-index: 100000000000000000;
    }
  </style>
</head>
<body class="addClass">
  <div class="loader" id="loader-1"></div>
  <div class="container-scroller">
    {{-- <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with
                this template!</p>
              <a href="https://www.bootstrapdash.com/product/plus-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/plus-admin-template/"><i
                class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white me-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ url('/department-menu') }}">
               <img src="{{ asset('asset/NTTI/images/logo.png') }}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('asset/NTTI/images/logo-mini.png')}}"
                alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-2">
              <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                  {{-- <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                    <span class="input-group-text" id="search">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div> --}}
                  
                  {{-- <input id="search_menu_function" class="form-control btn-circle-right" type="text"
                    name="search_menu_function" placeholder="{{ trans('greetings.Search').'...' }}"> --}}
                  {{-- <input type="text" class="form-control" id="search_menu_function" name="search_menu_function"
                    placeholder="Search" aria-label="search" aria-describedby="search" /> --}}
                  {{-- @include('system.menu_search_list') --}}
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-img">
                    
                    <?php
                        $user = Auth::user();

                        
                        

                        $picture =  App\Models\General\Picture::where('code', $user->id ?? '')->where('type','profile')->value('picture_ori');
                    ?>

                    @if(isset($picture) && $picture != null)
                      <img class="btn-Image" id="btn-Image" data-code ='{{$records_by_user->code ?? ''}}' src="{{ $picture ?? '' }}" width="1000" height="1000">
                    @else
                      <img class="btn-Image" id="btn-Image" data-code ='{{$records_by_user->code ?? ''}}' src="asset/NTTI/images/faces/default_User.jpg" width="1000" height="1000">
                    @endif
                    {{-- <img src="{{asset('asset/NTTI/images/faces/default_User.jpg')}}" alt="image" /> --}}


                  </div>
                  <div class="nav-profile-text">
                    <p class="text-black font-weight-semibold m-0"> {{ Auth::user()->name ?? ''}} </p>
                    <span class="font-13 online-color">{{ Auth::user()->username ?? ''}} <i class="mdi mdi-chevron-down"></i></span>
                  </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="{{ url('profile') }}">
                    <i class="mdi mdi-account me-2 text-success"></i> Profile </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                    {{-- @if(Auth::user()->email  == "saypanha500@gmail.com")
                      <a class="dropdown-item" href="{{ url('admin-panel') }}">
                      <i class="mdi mdi-account-convert me-2 text-primary"></i> Admin Panel</a>
                    @endif --}}
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
              data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/department-menu') }}">
                <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                <span class="menu-title">Department</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdown</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                  </li>
                </ul>
              </div>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                {{-- <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Forms</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                {{-- <i class="mdi mdi-contacts menu-icon"></i>
                <span class="menu-title">Icons</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                {{-- <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Charts</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                {{-- <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Tables</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                {{-- <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Tables</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                {{-- <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Tables</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                {{-- <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Tables</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                {{-- <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Tables</span> --}}
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/menu-reports') }}" class="nav-link"
                target="_blank">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Report</span></a>
            </li>
            <li class="nav-item">
              <div class="nav-link d-flex">
                {{-- <button class="btn btn-sm bg-danger text-white"> Trailing </button> --}}

                {{-- page  for hold  --}}
                {{-- <div class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle text-white font-weight-semibold"
                    id="notificationDropdown" href="#" data-bs-toggle="dropdown"> English </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="flag-icon flag-icon-bl me-3"></i> French </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="flag-icon flag-icon-cn me-3"></i> Chinese </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="flag-icon flag-icon-de me-3"></i> German </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="flag-icon flag-icon-ru me-3"></i>Russian </a>
                  </div>
                </div> --}}
                <a id="systemSettings" class="text-white" href="#"><i class="mdi mdi-settings"></i></a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="content-wrapper pb-0">
        @yield('content')

        </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="col-md-12">
          <span class="text-whirt text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a
              href="https://www.ntti.edu.kh/" target="_blank">National Technical Training Institute</a> <span>អាសយដ្ឋាន: មហាវិថី សហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ</span> <a
              href="https://www.facebook.com/panha.say.73" target="_blank">Deverlop By</a> </span>
        </div>
      </div>
    </footer>
    @include('system.modal_system_setting')
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
 

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
  integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
  integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
</script>
<script src="{{ asset('/asset/NTTI/vendors/js/vendor.bundle.base.js') }}"></script>

  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('asset/NTTI/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/flot/jquery.flot.categories.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
  <script src="{{ asset('asset/NTTI/vendors/flot/jquery.flot.stack.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('asset/NTTI/vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/select2.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/printThis.js') }}"></script>
  

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('asset/NTTI/js/off-canvas.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/misc.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/settings.js') }}"></script>
  <script src="{{ asset('asset/NTTI/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ asset('asset/NTTI/js/dashboard.js') }}"></script>
  <!-- End custom js for this page -->
  <script src="{{ asset('asset/NTTI/css/ntti.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  {{-- Google Chart --}}

  <script>
  //  let logoutTimer;
  //   const logoutAfter = 2400 * 10000; 

  //   function resetTimer() {
  //     clearTimeout(logoutTimer); 
  //     logoutTimer = setTimeout(() => {

  //         const swalWithBootstrapButtons = Swal.mixin({
  //             customClass: {
  //                 confirmButton: "btn btn-success",
  //                 cancelButton: "btn btn-danger"
  //             },
  //             buttonsStyling: false
  //         });

  //         swalWithBootstrapButtons.fire({
  //             title: "សូម login System ម្ដងទៀត",
  //             text: "You won't be able to revert this!",
  //             icon: "warning",
  //             confirmButtonText: "OK!",
  //             // showCancelButton: true,
  //             reverseButtons: true
  //         }).then((result) => {
  //             if (result.isConfirmed) {
  //                 // Redirect to logout
  //                 window.location.href = '/logout';
  //             } else if (result.dismiss === Swal.DismissReason.cancel) {
  //                 swalWithBootstrapButtons.fire({
  //                     title: "Cancelled",
  //                     text: "Your imaginary file is safe :)",
  //                     icon: "error"
  //                 });
  //             }
  //         });
  //     }, logoutAfter);
  //   }
  //   // Reset the timer on user interaction
  //   window.onload = resetTimer;
  //   document.onmousemove = resetTimer;
  //   document.onkeypress = resetTimer;

    // success, info, warning, error, and none
    var cleaSearch = ('.container-scroller');
        var notyf = new Notyf({
          duration: 3000,
        });
        $(document).ready(function() {
          // $('.js-example-basic-single').select2({
          //     placeholder: "សូមជ្រើសរើស",
          //     allowClear: true             
          // });
          
          // $(".collapse").addClass('show');

          $('.loader').hide();
           $('#search_menu_function').on('input', function () {
              let searchValue = $(this).val().trim();

              // Only search if input length > 3
              if (searchValue.length > 3) {
                  $.ajax({
                      type: 'GET',
                      url: '/menu-search', // Change this URL if needed
                      data: {
                          string: searchValue
                      },
                      beforeSend: function () {
                          // Optional: Show loading indicator
                          // $('.contentMenu').LoadingOverlay("show");
                      },
                      success: function (response) {
                          // $('.contentMenu').LoadingOverlay("hide");
                          if (response !== 'none') {
                              $('.contentMenu').html(response);
                          } else {
                              $('.contentMenu').html('');
                          }
                      },
                      error: function () {
                          console.error("Error during AJAX request.");
                          $('.contentMenu').html('<p>Error loading data.</p>');
                      }
                  });
              } else {
                  $('.contentMenu > .trigger').popover('hide');
              }
          });

          // Ensure IME input (like Khmer) is finalized before triggering input
          $('#search_menu_function').on('compositionend', function () {
              $(this).trigger('input');
          });

          $('#btnShowMenuSetting').click(function(e){
            $("#system_overlay").removeClass("setting-overlay");
            $(".bgOverlay").addClass("bg-dark-overlay");
          });

          $('.container-fluids').click(function(e){
            $("#system_overlay").addClass("setting-overlay");
          });

          $('#bg_overlay').click(function(e){
            $(".bgOverlay").removeClass("bg-dark-overlay");
            $("#system_overlay").addClass("setting-overlay");
          });

          $('customerField').click(function(e){
            alert('Please enter');
          });

          $(cleaSearch).click(function() {
            $('.contentMenu').html('');
          });

          $(document).on('click', '#btn-adSearch', function() {
            let page = $(this).attr('data-page');
            let data = $('#advance_search').serialize();
            $.ajax({
                type: "GET",
                url: `/system/avanceSearch/${page}`,
                data: data,
                beforeSend: function() {
                  $('.loader').show();
                },
                success: function (response) {
                    if(response.status == 'success'){
                        // $(".collapse").removeClass('show');
                        $('.loader').hide();
                        $('.control-table').html("");
                        $('.control-table').html(response.view);
                    } 
                }
            });
          });

          $(document).on('click', '#customize_list', function(event) {
            let type = $(this).attr('data-type');
            let table_id = $(this).attr('data-code');
            let page = $(this).attr('data-page');
            let data = {
              type: type,
              table_id: table_id
            };
            $.ajax({
              type: 'POST',
              url: `system/customize_page/${page}`,
              data: data,
              success: function(response) {
                if(response.status == 'success'){
                  $('#CustomPageModal').modal('show');
                  $('.diveCustomPage').html("");
                  $('.diveCustomPage').html(response.view);
                }else{
                  notyf.error(response.msg); 
                }
              }
            });
          });

          $('#search_data').keyup(function(e) {
              switch (e.which) {
                  case 38:
                      return;
                      break;
                  case 40:
                      return;
                      break;
                  case 37:
                      return;
                      break;
                  case 39:
                      return;
                      break;
              }
              if ($('#search_data').val().trim()) {
                  let page = $(this).attr('data-page');
                  $.ajax({
                      type: 'GET',
                      url: `/system/live-Search/${page}`,
                      data: {
                          string: $('#search_data').val()
                      },
                      beforeSend: function() {
                          // $('.contentMenu').LoadingOverlay("show");
                      },
                      success: function(response) {
                          // $('.contentMenu').LoadingOverlay("hide");
                          if (response !== 'none') {
                              $('.control-table').html(response.view);
                          } else {
                              $('.control-table').html("");
                          }
                      }
                  });
              } else {
                  $('.contentMenu > .trigger').popover('hide');
              }
          });

          $(document).on('click', '#btnClose', function(e) {
            $("#divConfirmation").modal('hide');
          });

          $(document).on('click', '#systemSettings', function(e) {
            $("#divsystemSettings").modal('show');
          });

          // uppercased code to text Big
          $('#code').on('input', function(){
              let inputValue = $(this).val();
              let uppercasedValue = inputValue.toUpperCase();
              $(this).val(uppercasedValue);
          });

          $(document).on('click', '#btnCleardata', function(e) {
            e.preventDefault(); 
            $("#advance_search")[0].reset(); 
            $("#advance_search").find("select").val(null).trigger("change");
            $("#advance_search").find("input[type='file']").val('');

            let page = $(this).attr('data-page');
            $.ajax({
                type: "GET",
                url: `/system/avanceSearch-clear-data/${page}`,
                beforeSend: function() {
                  $('.loader').show();
                },
                success: function (response) {
                    if(response.status == 'success'){
                        // $(".collapse").removeClass('show');
                        $('.loader').hide();
                        $('.control-table').html("");
                        $('.control-table').html(response.view);
                    } 
                }
            });
          });

          // $(document).on('change', '#class_code', function(e) {
          //   let class_code = $('#class_code').val();
          //   $.ajax({
          //       type: "GET",
          //       url: `/system/class-get-data-group?class_code=${class_code}`,
          //       beforeSend: function() {
          //         $('.loader').show();
          //       },
          //       success: function (response) {
          //         $('.loader').hide();
          //         if (response.status === 'success') {
          //             let $skillsSelect = $('#skills_code');
          //             $skillsSelect.empty();
          //             $skillsSelect.append(`<option value="${response.records.skills_code}">${response.records.skills_code} - ${response.skills}</option>`);

          //             let $selectionSelect = $('#sections_code');
          //             $selectionSelect.empty();
          //             $selectionSelect.append(`<option value="${response.records.sections_code}">${response.sections}</option>`);

          //             let $departmentSelect = $('#department_code');
          //             $departmentSelect.empty();
          //             $departmentSelect.append(`<option value="${response.records.department_code}">${response.department}</option>`);
                      
          //             let $levelSelect = $('#level');
          //             $levelSelect.empty();
          //             $levelSelect.append(`<option value="${response.records.level}">${response.records.level}</option>`);

          //             let $schoolyearcodeSelect = $('#school_year_code');
          //             $schoolyearcodeSelect.empty();
          //             $schoolyearcodeSelect.append(`<option value="${response.records.school_year_code}">${response.session_year}</option>`);
          //         }
          //       }
          //   });
          // });

          $(document).on('change', '#class_code', function () {
              let class_code = $(this).val();
                  $.ajax({
                      type: "GET",
                      url: `/system/class-get-data-group?class_code=${class_code}`,
                      beforeSend: function () {
                          $('.loader').show();
                      },
                      success: function (response) {
                          $('.loader').hide();

                          if (response.status === 'success') {
                              let selectData = {
                                  '#skills_code': [response.records.skills_code, response.skills],
                                  '#sections_code': [response.records.sections_code, response.sections],
                                  '#department_code': [response.records.department_code, response.department],
                                  '#level': [response.records.level, response.records.level],
                                  '#school_year_code': [response.records.school_year_code, response.session_year]
                              };

                              $.each(selectData, function (selector, values) {
                                  $(selector).empty().append(`<option value="${values[0]}">${values[1]}</option>`);
                              });
                          }
                      }
                  });
              });
          });



    //     document.addEventListener('DOMContentLoaded', function () {
    //     // Trigger an AJAX call when clicking the link
    //     const link = document.querySelector('a[href="/blue/test-middleware"]');
    //     link.addEventListener('click', function (e) {
    //         e.preventDefault(); // Prevent default link behavior
    //         // Perform AJAX request
    //         fetch('/blue/test-middleware')
    //             .then(response => {
    //                 if (!response.ok) {
    //                     return response.json().then(error => {
    //                         throw error;
    //                     });
    //                 }
    //                 return response.json();
    //             })
    //             .catch(error => {
    //                 if (error.message) {
    //                     Swal.fire({
    //                         icon: 'warning',
    //                         title: 'NTTI PORTAL',
    //                         text: error.message,
    //                     });
    //                 }
    //             });
    //     });
    // });

    @if(session('error'))
        Swal.fire({
            icon: 'warning',
            title: 'NTTI PORTAL',
            text: '{{ session('error') }}',
        });
    @endif
    
  </script>
</body>
</html>