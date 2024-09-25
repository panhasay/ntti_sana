<div class="modal fade" id="divCreateUser" tabindex="-1" role="dialog" aria-labelledby="divCreateUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-m-header">
          <h5 class="modal-title" id="divCreateUser">Create User Account Student !</h5>
        </div>
        <div class="modal-body mt-3">
            <div class="container">
                <div class="row">  
                    <div class="col-md-6">                    
                        <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">អ៊ីមែល</span>
                        <div class="col-sm-12">
                          <?php
                              $name = $records->name ?? '';
                              $name = strtolower($name) ??  '';
                              $name = str_replace([' ', 'es'], ['', 'er'], $name);
                              $email = $name."@gmail.com";
                            ?>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" value="{{ $email ?? '' }}"
                            placeholder="email" aria-label="email" disabled>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">                    
                        <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">លេកូដ</span>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" id="password" name="password" value="123456"
                            placeholder="លេកូដ" aria-label="លេកូដ" disabled>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnYes" data-code="" class="btn btn-primary">Create</button>
        </div>
      </div>
    </div>
  </div> 