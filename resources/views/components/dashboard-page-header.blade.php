<div class="page-head page-head-custom">
    <div class="row">
        <div class="col-md-10 col-sm-6 col-6">
            <div class="page-title page-title-custom">
                <div class="title-page header-right">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    <a href="{{ url($dashboardUrl) }}" style="color:black;text-decoration:none;">{{ $title }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6">
            <div class="page-title page-title-custom text-right">
                <h4 class="text-right">
                    <a href="{{ url($dashboardUrl) }}"
                        style="color:black;text-decoration:none;padding-right: 1rem !important;font-family: Moul, serif;">
                        @if ($studentId)
                            {{ $studentId }}
                        @endif
                    </a>
                    <i class="mdi mdi-keyboard-return mouse-pointer" aria-hidden="true" onclick="history.go(-1);"
                        title="Back" style="color: #0d6efd;"></i>
                </h4>
            </div>
        </div>
    </div>
</div>
