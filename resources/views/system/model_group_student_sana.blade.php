
<!-- Modal -->
<div class="modal fade" id="ModalCreateStudentSana" tabindex="-1" aria-labelledby="ModalCreateStudentSana" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 743px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalCreateStudentSana">បន្ថែមក្រុម</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-2">    
            <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">

                <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">លេខកូដក្រុម</span>
                    <div class="col-sm-9">
                        <input class="formSublist form-control form-control-sm" type="text" date-name="sub_class_code" id="code" name="sub_class_code" placeholder="លេខកូដក្រុម" value="" style="width: 100%;">
                    </div>
                </div> 

                <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">សាស្រ្ដចារ្យដឹកនាំ ​</span>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single FieldRequired formSublist" id="teacher_leader_code" name="teacher_leader_code" style="width: 100% !important;">
                            <option value="">&nbsp;</option>
                            @foreach ($teachers as $record) 
                                <option value="{{ $record->code ?? '' }}">
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">សាស្រ្ដចារ្យពិគ្រោះ​</span>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single FieldRequired formSublist"  multiple="multiple" id="teacher_consult_code" name="teacher_consult_code" style="width: 100% !important;">
                            <option value="">&nbsp;</option>
                            @foreach ($teachers as $record) 
                                <option value="{{ $record->code ?? '' }}">
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <span class="labels col-sm-3 col-form-label text-end">ប្រធានបទសាណា</span>
                    <div class="col-sm-9">
                        <input class="formSublist form-control form-control-sm" type="text" date-name="topic" id="topic" name="topic" placeholder="ប្រធានបទសាណា" value="" style="width: 100%;">
                    </div>
                </div>  
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
          <button type="button" data-id="" class="btn btn-primary" id="SaveTeacherSchedule">រក្សាទុក</button>
        </div>
      </div>
    </div>
  </div>
