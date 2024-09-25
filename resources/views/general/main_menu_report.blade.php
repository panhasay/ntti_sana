
  @extends('app_layout.app_layout')
  @section('content')
  {{-- @include('system.setting_customize_field') --}}
  <div class="page-head page-head-custom">
    <div class="row">
      <div class="col-md-6 col-sm-6  col-6">
        <div class="page-title page-title-custom">
          <div class="title-page">
            <i class="mdi mdi-format-list-bulleted"></i>
                រាយការណ៍
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <ul>
        <li><a href="{{ url('/reports-list-of-student') }}">តារាងក្រុមបញ្ចីនិស្សិត​ ឆ្នាំសិក្សា2023-2024</a></li>
      </ul>
  </div>
  @endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
