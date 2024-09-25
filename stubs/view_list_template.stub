@extends('admin.layouts.app')
@section('title')
    systemPageTitle
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-8">
                                        <button class="btn btn-primary ladda-button i-add" id="create-data"
                                            data-style="expand-right" data-url = '' data-prefix = '{{ $prefix }}'
                                            data-type = "create"><span class="ladda-label">Add
                                                {{ createHeaderTitle($prefix) }}</span></button>
                                        <div class="dropdown dropdown-topbar pt-3 mt-1 d-inline-block">
                                            <a class="btn  btn-info dropdown-toggle" href="#" role="button"
                                                id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action <i class="mdi mdi-chevron-down"></i>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item" href="#" data-prefix = "{{$prefix}}" onclick="exportExcell(this,event)">DownLoad Excel</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" data-prefix = "{{$prefix}}" onclick="prepareUpload(this,event)">Upload Excel</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" data-prefix = "{{$prefix}}" onclick="printData(this,event)">Print as PDF</a>
                                                <div class="dropdown-divider a-primary"></div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <form class="app-search">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Search...">
                                                <span class="fa fa-search"></span>
                                                <i class="fa fa-filter" data-bs-toggle="collapse" href="#collapseExample"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="collapseExample"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @include('admin.component.advanceSearch')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $page }}</h4>
                                <div class="table-responsive" id="dataTableRecord">
                                    @include('admin.component.table_list')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>


        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Pok Puthea</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('script')
    <script>
        const prefix = "{{ $prefix }}";
        $(document).ready(function() {
            $(".table").tableFixer({"head" : false, "left" : 1}); 
            initializingTL.TLSelect2('inactived');
            $(document).on('click', '.m-confirm-submit', function(e) {
                let code = $(this).data('code');
            })
        });
    </script>
@endsection