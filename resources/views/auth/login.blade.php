@extends('layout')
  
@section('content')
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
    <style>
      .background-radial-gradient {
        background-color: hsl(218, 41%, 15%);
        background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
          radial-gradient(1250px circle at 100% 100%,
            hsl(218, 41%, 45%) 15%, 
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%);
            height: 900px !important ;
      }
      #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }
      #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }
  
      .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
      .footer {
        color: color(dark);
        padding: 14px 25px 12px 37px;
        /* transition: all 0.25s ease; */
        -moz-transition: all 0.25s ease;
        -webkit-transition: all 0.25s ease;
        -ms-transition: all 0.25s ease;
        font-size: calc(0.875rem - 0.05rem);
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        /* z-index: 100000; */
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: #000000;
        text-align: center;
        background: #ffffff;
    }
    </style>
  
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            The Report 
            <span style="color: hsl(218, 81%, 75%)">National Technical Training Institute</span>
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
                        <label for="floatingInput">Email address</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword"  name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        @if(session()->has('message'))
                        <span class="text-danger"> {{session()->get('message')}}</span>
                        @endif
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
          <span class="text-whirt text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="https://www.ntti.edu.kh/" target="_blank">National Technical Training Institute</a> <span>អាសយដ្ឋាន: មហាវិថី សហព័ន្ធរុស្ស៊ី សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ</span></span>
        </div>
      </div>
    </footer>
  </section>
@endsection
