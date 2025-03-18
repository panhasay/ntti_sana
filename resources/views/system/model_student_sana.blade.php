
<!-- Modal -->
<div class="modal fade" id="ModalStudentSana" tabindex="-1" aria-labelledby="ModalStudentSana" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 743px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalStudentSana">បន្ថែមនិស្សឹត</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-2">    
            <form id="frmDataSublistStudentSana" role="form" class="form-sample" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="hidden" id="data_student">
                    <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះនិស្សិត</span>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single FieldRequired formSublist student_code" id="student_code" name="student_code" style="width: 100% !important;">
                            <option value="">&nbsp;</option>
                            @foreach ($students as $record) 
                                <option value="{{ $record->code ?? '' }}">
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">ប្រធានបទសាណា</span>
                    <div class="col-sm-9">
                        <input class="formSublist form-control form-control-sm" type="text" date-name="topic" id="topic" name="topic" placeholder="ប្រធានបទសាណា" value="" style="width: 100%;">
                    </div>
                </div>   --}}
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
          <button type="button" data-id="" class="btn btn-primary BtnsaveStudentSana" id="BtnsaveStudentSana">រក្សាទុក</button>
        </div>
      </div>
    </div>
  </div>
