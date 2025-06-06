<style>
    .page-head-custom>.row {
        margin-bottom: -30px;
    }

    .breadcrumb-font-khmer {
        font-family: Tahoma, "Khmer OS Battambang" !important;
    }

    @media (max-width: 767px) {
        .breadcrumb {
            display: none;
            text-align: right;
        }

        .dropdown {
            display: block;
        }

        .page-head-custom>.row {
            margin-bottom: 0px;
        }
    }
</style>
<div class="page-head page-head-custom">
    <div class="row">
        <div class="col-md-3 col-sm-5 col-8">
            <div class="page-title page-title-custom">
                <div class="title-page header-right">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    <a href="{{ url($firstItem['route']) }}"
                        style="color:black;text-decoration:none;font-family: Tahoma, 'Moul', sans-serif !important;">{{ $firstItem['title'] }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-4 justify-content-end">
            <nav aria-label="breadcrumb">
                <div class="page-title page-title-custom title-page">
                    <!-- Desktop Breadcrumbs -->
                    <ol class="breadcrumb justify-content-end"
                        style="border:none;margin-top: -10px;padding-right: 0px;">
                        @foreach ($array as $index => $item)
                            @if ($index > 0)
                                <li class="breadcrumb-item"><a href="{{ url($item['route']) }}"
                                        style="color:black;text-decoration:none;font-size: 11pt;"><span
                                            class="breadcrumb-font-khmer">{{ $item['title'] }}</span></a></li>
                            @endif
                        @endforeach
                    </ol>

                    <!-- Mobile Dropdown Icon -->
                    <div class="dropdown d-md-none pull-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="breadcrumbDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
                            @foreach ($array as $index => $item)
                                @if ($index > 0)
                                    <li><a class="dropdown-item" href="{{ url($item['route']) }}"
                                            style="font-family: 'Khmer OS Battambang'"><span
                                                class="breadcrumb-font-khmer">{{ $item['title'] }}</span></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </div>
</div>
