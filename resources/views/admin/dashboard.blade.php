<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
    }

    /* customize css modal */
    .modal-content {
        border: 0px solid #e4e9f0 !important;
    }

    /* customize css modal */

    .dashboard-card {
        border-radius: 12px;
        transition: transform 0.2s ease-in-out;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    }

    .icon-img {
        width: 64px;
        height: 64px;
    }

    .khmer-text {
        font-family: 'Khmer OS', 'Noto Sans Khmer', sans-serif;
        font-size: 14px;
        color: #444;
        line-height: 1.4;
    }

    .student-card-view {
        max-width: 600px;
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;

        transition: transform 0.2s ease-in-out;
    }

    .student-card-view:hover {
        transform: translateY(-4px);
    }

    .student-card-view img {
        object-fit: cover;
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .student-card-view>.student-information {
        padding-top: 0px !important;
    }

    .student-card-view>.card-body {
        padding: 0px !important;
        padding-left: 15px !important;
        padding-top: 4px !important;
        padding-bottom: 5px !important;
    }

    .student-card-view>.card-body .name {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
    }

    .student-card-view>.card-body>.name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        width: 99%;
    }

    .student-card-view>.card-body .id,
    .card-body .phone,
    .card-body .info {
        font-size: 14px;
        margin-bottom: 0px;
    }
</style>

@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => 'Administration'],
        ['route' => request()->path(), 'title' => ''],
    ]" />

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 g-2 mt-2">
                <a href="{{ route('admin.user.index') }}" class="text-decoration-none text-dark">
                    <div class="student-card-view" style="border: 2px solid rgb(221, 221, 221);">
                        <img src="{{ asset('asset/admin/user-profile_17365503.png') }}" alt="Profile Picture" width="140"
                            height="140">
                        <div class="card-body student-information">
                            <h5 class="card-title fw-bold mb-1 mt-3">User List</h5>
                            <h5 class="card-text khmer-text mt-2">កំណត់ត្រារបស់អ្នកប្រើប្រាស់</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 g-2 mt-2">
                <a href="{{ url('/admin/roles') }}" class="text-decoration-none text-dark">
                    <div class="student-card-view" style="border: 2px solid rgb(221, 221, 221);">
                        <img src="{{ asset('asset/admin/team-work_18287373.png') }}" alt="Profile Picture" width="140"
                            height="140">
                        <div class="card-body student-information">
                            <h5 class="card-title fw-bold mb-1 mt-3">Role & Permissions</h5>
                            <h5 class="card-text khmer-text mt-2">បញ្ជីឈ្មោះសិទ្ធ និងការអនុញ្ញាត</h5>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
