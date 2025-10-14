@extends('app_layout.card_student_layout')
@section('content')
    <style>
        .login-card {
            border: solid 1px white;
            border-radius: 12px;
            padding: 75px 25px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .login-card h4 {
            font-weight: bold;
            margin-bottom: 20px;
            font-family: "Battambang", system-ui;
            font-weight: 900;
            font-style: normal;
            color: rgb(0, 0, 0)
        }

        .error {
            font-family: "Battambang", system-ui;
            font-weight: 500;
            font-style: normal;
            font-size: 22px
        }
    </style>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-card text-center mx-lg-0 mx-md-0 mx-3">
            <img src="{{ asset('asset/NTTI/NTTI.png') }}" alt="" class="w-50 h-50">
            <h4 class="py-3 mb-0">ព័ត៌មានកាតផ្ទាល់ខ្លួនរបស់និស្សិត
            </h4>
            @if (session('error'))
                <div class="text-danger mt-1 mb-3 error" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('card.student.login.post') }}">
                @csrf
                <div class="mb-3 text-start modern-input">
                    <input type="text" class="form-control" autocomplete="off" id="code" name="code"
                        placeholder="Enter your code" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">ស្នើរសុំ</button>
            </form>
        </div>
    </div>
@endsection
