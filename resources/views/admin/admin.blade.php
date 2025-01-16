<style>
    body {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => 'Admin Panel'],
        ['route' => request()->path(), 'title' => 'System Panel'],
    ]" />
    <div class="card">
        <div class="card-header">
            <h3>Terminal Commander</h3>
        </div>
        <div class="card-body">
            <div class="col-sm-3">
                <span class="form-label">Commander</span>
                <div class="input-group">
                    <select class="select2-search" id="cmd_migrate" name="cmd_migrate" style="width: 100%"
                        placeholder="សូមជ្រើសរើសក្រុម">
                        <option value="">Please Choose CMD</option>
                        @foreach ($record_cmd as $item)
                            <option value="{{ $item['command'] }}">{{ $item['description'] }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" id="command-input" class="form-control"
                    placeholder="Enter command (e.g., php artisan list)">
                <div class="input-group-append">
                    <button id="run-command-btn" class="btn btn-primary">
                        Run Command
                    </button>
                    <button id="run-npm-btn" class="btn btn-primary">
                        Run NPM
                    </button>
                </div>
            </div>

            <div id="command-output" class="mt-3 p-3 bg-dark text-light" style="max-height: 400px; overflow-y: auto;">
                <p class="text-muted">Command output will appear here...</p>
            </div>
        </div>
    </div>

    <script>
        document.title = "NTTI-Admin Panel";
    </script>
@endsection
