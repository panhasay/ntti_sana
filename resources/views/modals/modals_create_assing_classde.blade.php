
<div class="modal fade" id="ModalCreateAssign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalCreateAssign">Table </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="container">
                <h5 class="modal-confirmation-text text-center p-3"></h5>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btnCreateAssice" data-type="{{ $type }}" data-years="{{ $_GET['years'] ?? ''}}">create</button>
        </div>
      </div>
    </div>
</div>