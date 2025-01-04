@extends('layout')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg p-4">
        {{-- <div class="text-center">
            <img src="{{ asset('images/blocked.png') }}" alt="Blocked Icon" class="img-fluid mb-3" style="max-width: 150px;">
        </div> --}}
        <h3 class="text-danger text-center mb-3 khmer-mef2" style="font-family: 'Bayon', sans-serif;">ការប៉ុនប៉ងចូលច្រើនពេក</h3>
        <p class="text-muted text-center">
            You have exceeded the maximum number of login attempts. Please try again after <strong>5 minutes</strong>.
        </p>
        <div class="text-center mt-4">
            <a href="{{ route('returnlogin') }}" class="btn btn-primary btn-block">Return to Login</a>
        </div>
    </div>
</section>
@endsection
