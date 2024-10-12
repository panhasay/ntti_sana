<div class="row append_file">
    <div class="col-3">
        <div class="drag-image">
            <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
            <h6>Add new Image</h6>
            <button class="btn-browse">Browse File</button>
            <form action="" id="formimg" enctype="multipart/form-data">
                <input type="file" hidden class="upload-item" name="file" id="file">
                <input type="text" hidden   name="code" id="code" value="{{$code ?? ''}}">
            </form>
          </div>
    </div>
    @foreach ($record as $item)
        <div class="col-3 row_{{$item->id}}">
            <div class="drag-image ">
            <img src="{{$item->picture_ori}}" alt=""> 
            <div class="btn delete_image" data-id ='{{$item->id}}'>Remove</div>
            </div>
        </div>
    @endforeach
</div>


