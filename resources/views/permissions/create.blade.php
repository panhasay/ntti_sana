<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
    }

    /* customize css modal */
    .modal-content {
        border: 0px solid #e4e9f0 !important;
    }
</style>

@extends('app_layout.app_layout')

@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->fullUrl(), 'title' => request()->get('module') . ':បង្កើតលេខកូដ'],
        ['route' => 'certificate/dept-menu/' . request()->get('dept_code'), 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'certificate/dept-menu', 'title' => request()->get('dept_n')],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" />

    <h4>Create Permission</h4>
    <div id="success-message" class="alert alert-success d-none"></div>
    <form id="create-permission-form">
        @csrf
        <div class="mb-3">
            <label for="permission-name" class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control" id="permission-name">
            <div class="invalid-feedback" id="error-name"></div>
        </div>

        <div class="mb-3">
            <label for="roles" class="form-label">Assign to Roles</label>
            <select name="roles[]" id="roles" class="form-select" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="error-roles"></div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#create-permission-form').on('submit', function(e) {
                e.preventDefault();

                $('.invalid-feedback').text('');
                $('input, select').removeClass('is-invalid');
                $('#success-message').addClass('d-none');

                $.ajax({
                    url: "{{ route('permissions.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#success-message').text(response.success).removeClass('d-none');
                        $('#create-permission-form')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#permission-name').addClass('is-invalid');
                                $('#error-name').text(errors.name[0]);
                            }
                            if (errors.roles) {
                                $('#roles').addClass('is-invalid');
                                $('#error-roles').text(errors.roles[0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
