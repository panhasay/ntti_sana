<div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="examModal">កាប្រឡង</h5>
        </div>
        <div class="modal-body">
            <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
                <div class="col-md-11 mt-3">
                    <div class="form-group row">
                        <input type="hidden" id="type" name="type" value="{{ $records->id ?? '' }}">
                        <span class="labels col-sm-3 col-form-label text-end">កាលបរិច្ឆេទ<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm " id="date" name="date" value="{{ $records->date ?? ''}}" placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត" >
                        </div>
                    </div>
                </div>

                <div class="col-md-11">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">គ្រូសាស្រ្តចារ្យ<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="teacher_code" name="teacher_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($teachers as $record)
                                    <option value="{{ $record->code ?? '' }}" {{ isset($records->teacher_code) && $records->teacher_code == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name_2) ? $record->name_2 : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-11">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">មុខវិជ្ជា<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="subjects_code" name="subjects_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($subjects as $record)
                                    <option value="{{ $record->code ?? '' }}" {{ isset($records->subjects_code) && $records->subjects_code == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>