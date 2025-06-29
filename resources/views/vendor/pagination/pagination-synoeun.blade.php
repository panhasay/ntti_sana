@if ($paginator->hasPages())
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        {{-- Summary --}}
        <div class="summary-text col-md-4">
            {{-- Rows per Page --}}
            <div class="form-group">
                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon btn_refresh"
                    style="width: 35px;height: 35px" title="Refresh">
                    <i class="mdi mdi-refresh"></i>
                </button>
                <select class="form-control d-inline-block w-auto rows_per_page">
                    @php
                        $number = $paginator->perPage() ?? 20;
                    @endphp
                    @for ($i = 1; $i <= 10; $i++)
                        @php $value = $i * $number; @endphp
                        <option value="{{ $value }}" data-per-page="{{ $number }}"
                            {{ $number == $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endfor
                </select>
                Showing {{ ($paginator->currentPage() - 1) * $number + 1 }}
                to {{ $number }}
                of {{ $paginator->total() }} Total
            </div>
        </div>

        {{-- Pagination --}}
        <ul class="pagination justify-content-end col-md-6" style="margin-top:-30px">
            {{-- Previous Page --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="javascript:void(0);" data-page="{{ $paginator->currentPage() - 1 }}"
                    aria-label="Previous" tabindex="-1">Previous</a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="javascript:void(0);"
                                data-page="{{ $page }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="javascript:void(0);" data-page="{{ $paginator->currentPage() + 1 }}"
                    aria-label="Next">Next</a>
            </li>
        </ul>
    </div>
@endif
