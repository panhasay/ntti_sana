<div class="modal fade {{ $additionalClasses }}" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog
        {{ $size ? 'modal-' . $size : '' }}
        {{ $centered ? 'modal-dialog-centered' : '' }}
        {{ $scrollable ? 'modal-dialog-scrollable' : '' }}
        {{ $fullscreen ? 'modal-fullscreen' : '' }}"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                {{ $footer ?? '<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>' }}
            </div>
        </div>
    </div>
</div>
