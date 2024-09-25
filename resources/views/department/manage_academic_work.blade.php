<style>
    .menu-list ul li a{
     color: #2194ce;
    }
    .titl-main-name{
        font-size: 15px;
        font-family: 'Khmer M1';
    }
    .content-studnet {
        margin: auto !important;
        width: 804px;
    }
    .columns {
        flex: 0 0 33.333333%;
        max-width: 31.333333%;
    }
    .title-orerlay {
        width: 238px;
        height: 200px;
        background: #313131c4;
        position: relative;
        top: -290px;
        font-size: 35px;
        font-family: 'Khmer M1';
        color: #fff;
        padding: 26px 10px 10px 10px;
        cursor: pointer;
    }
    .row > * {
        -ms-flex-negative: 0;
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--bs-gutter-x)* .5);
        padding-left: calc(var(--bs-gutter-x)* .5);
        margin-top: var(--bs-gutter-y);
        height: 286px;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="row mt-4 content-studnet">
    <div class="columns">
            <div class="effect-9">
                <div class="effect-img">
                    <img src="https://img.freepik.com/free-vector/isometric-education-background_23-2148099751.jpg?semt=ais_user" alt="Team Image">
                </div>
                <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី (១) </div>
            </div>
            <a href="{{ url('/assign-classes?years=1&type=បរិញ្ញាប័ត្រ') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្រ <br>ឆ្នាំទី១
            </div>
        </a>
    </div>
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/flat-colorful-university-concept-background_23-2148195785.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី (២)</div>
        </div>
        <a href="{{ url('/assign-classes?years=2&type=បរិញ្ញាប័ត្រ') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្រ <br>ឆ្នាំទី២
            </div>
        </a>
    </div>
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-photo/flat-lay-international-worker-s-day-still-life_23-2150337560.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី (៣)</div>
        </div>
        <a href="{{ url('/assign-classes?years=3&type=បរិញ្ញាប័ត្រ') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្រ <br>ឆ្នាំទី៣
            </div>
        </a>
    </div>
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី (៤)</div>
        </div>
        <a href="{{ url('/assign-classes?years=4&type=បរិញ្ញាប័ត្រ') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្រ <br>ឆ្នាំទី៤
            </div>
        </a>
    </div>
    <!-- បរិញ្ញាប័ត្ររង -->
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី(៤)បរិញ្ញាប័ត្ររង</div>
        </div>
        <a href="{{ url('/assign-classes?years=1&type=បរិញ្ញាប័ត្ររង') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្ររង <br>ឆ្នាំទី១
            </div>
        </a>
    </div>
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី(២)​បរិញ្ញាប័ត្ររង</div>
        </div>
        <a href="{{ url('/assign-classes?years=2&type=បរិញ្ញាប័ត្ររង') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្ររង <br>ឆ្នាំទី២
            </div>
        </a>
    </div>
     <!-- បរិញ្ញាប័ត្ររង បន្ត-->
     <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី(៣)បរិញ្ញាប័ត្របន្ត</div>
        </div>
        <a href="{{ url('/assign-classes?years=3&type=បរិញ្ញាប័ត្របន្ត') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្របន្ត <br>ឆ្នាំទី៣
            </div>
        </a>
    </div>
    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង កាសិក្សាឆ្នាំទី(៤)​បរិញ្ញាប័ត្របន្ត</div>
        </div>
        <a href="{{ url('/assign-classes?years=4&type=បរិញ្ញាប័ត្របន្ត') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                បរិញ្ញាប័ត្របន្ត <br>ឆ្នាំទី៤
            </div>
        </a>
    </div>

    <div class="columns">
        <div class="effect-9">
            <div class="effect-img">
            <img src="https://img.freepik.com/free-vector/online-certification-illustration-style_23-2148570822.jpg?semt=ais_user" alt="Team Image">
            </div>
            <div class="title-department">គ្រប់គ្រង សាណា​​(៥)បញ្ចាប់​ឆ្នាំ</div>
        </div>
        <a href="{{ url('/assign-classes?years=5&type=បរិញ្ញាប័ត្រ') }}" style="text-decoration: none;">
            <div class="title-orerlay text-center">
                សាណា​​ <br> បញ្ចាប់​ឆ្នាំ
            </div>
        </a>
    </div>
</div>
<br><br>
@endsection
