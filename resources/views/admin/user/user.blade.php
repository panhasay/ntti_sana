<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
    }

    /* customize css modal */
    .modal-content {
        border: 0px solid #e4e9f0 !important;
    }

    /* customize css modal */
</style>

@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => 'User List'],
        ['route' => 'admin/dashboard', 'title' => 'Administration'],
    ]" />

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="col-md-3 pull-left">
                <input type="text" class="form-control mb-2 mb-md-0 me-2" name="sch_user" id="sch_user"
                    placeholder="ស្វែងរក">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="control-table table-responsive custom-data-table-wrapper2">
                    <div class="col-md-12 mt-0">
                        <table class="table table-striped" id="tbl_user">
                            <thead>
                                <tr class="general-data">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="pagination_list" class="mt-3 mb-5"></div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const notyf = new Notyf({
                duration: 2000,
                ripple: true,
                dismissible: true,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            const $loader = $(".loader");
            $loader.css({
                position: "fixed",
                top: "50%",
                left: "50%",
                transform: "translate(-50%, -50%)",
                "z-index": "1000",
            }).fadeIn();

            const $tbl = $("#tbl_user");
            const $tbody = $("#tbl_user tbody");
            const $pagination_list = $("#pagination_list");
            let currentPageList = 1;

            function show() {
                const requestData = {
                    search: $("#sch_user").val(),
                    page: currentPageList,
                    rows_per_page: parseInt($("#pagination_list .rows_per_page").val() ?? 20),
                };
                $.ajax({
                    url: "{{ route('admin.user.show') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        let html = ``;
                        const currentPage = response.current_page;
                        const rowsPerPage = response.page;
                        const json = response.data;

                        $.each(json, function(index, item) {
                            const photo = `/asset/NTTI/images/faces/default_User.jpg`;
                            html += `<tr>`;
                            html += `<td>${index + 1 + (currentPage - 1) * rowsPerPage}</td>`;
                            html +=
                                `<td><div class="hover-photo"><img src="${photo}" alt="Student Photo"> ${item.name}</div></td>`;
                            html += `<td>${item.email}</td>`;
                            html += `<td>`;
                            if (item.roleArray && item.roleArray.length > 0) {
                                $.each(item.roleArray, function(i, role) {
                                    html +=
                                        `<span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm border border-indigo-400">${role}</span>`;
                                });
                            } else {
                                html += `<p>-</p>`;
                            }
                            html += `</td>`;

                            html += `</tr>`;
                        });

                        $tbody.html(html);
                        $("#pagination_list").html(response.links);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            }



            show();
        });
    </script>
@endpush
