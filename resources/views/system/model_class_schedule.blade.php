<!-- Modal -->
<div class="modal fade" id="ModalTeacherSchedule" tabindex="-1" aria-labelledby="ModalTeacherSchedule"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="ModalTeacherSchedule">កាលវិភាគបង្រៀន</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">សាស្រ្តាចារ្យ</span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired formSublist" id="teachers_code"
                                name="teachers_code" style="width: 100% !important;">
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
                        <span class="labels col-sm-3 col-form-label text-end">មុខវិជ្ជា</span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired formSublist subjects_code"
                                date-type="subjects_code" id="subjects_code" name="subjects_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($subjects as $record)
                                <option value="{{ $record->code ?? '' }}">
                                    {{ isset($record->name) ? $record->name : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ថ្ងៃបង្រៀន</span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired formSublist" date-type="date_name"
                                id="date_name" name="date_name" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($date_name as $record)
                                    <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years
                                        == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name_2) ? $record->name_2 : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ម៉ោង</span>
                        <div class="col-sm-3">
                            <input class="formSublist form-control form-control-sm" type="text" date-name="room"
                                id="start_time" name="start_time" placeholder="ម៉ោង" value="" style="width: 100%;">
                        </div>

                        <span class="labels col-sm-3 col-form-label text-end">ដល់</span>
                        <div class="col-sm-3">
                            <input class="formSublist form-control form-control-sm" type="text" date-name="room"
                                id="end_time" name="end_time" placeholder="ម៉ោង" value="" style="width: 100%;">
                        </div>
                    </div>


                    {{-- <div class="form-group row">
                        <span class="labels col-sm-2 col-form-label text-end">ម៉ោង</span>
                        <div class="col-sm-2">
                            <input class="formSublist" type="text" date-name="start_time" id="start_time"
                                name="start_time" value="">
                        </div>
                        <span class="labels col-sm-2 col-form-label text-end">ដល់</span>
                        <div class="col-sm-2">
                            <input class="formSublist" type="text" date-name="end_time" id="end_time" name="end_time"
                                value="">
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">បន្ទាប់លេខ</span>
                        <div class="col-sm-9">
                            <input class="formSublist form-control form-control-sm" type="text" date-name="room"
                                id="room" name="room" placeholder="ម៉ោង" value="" style="width: 100%;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ម៉ោង ទី១ឫ២ {{ $record->sessions_type ?? '' }}</span>
                        <div class="col-sm-9">
                           <select class="js-example-basic-single FieldRequired formSublist" date-type="sessions_type"
                                id="sessions_type" name="sessions_type" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                <option value="1" {{ ($record->sessions_type ?? '') == 1 ? 'selected' : '' }}>ម៉ោងទី១</option>
                                <option value="2" {{ ($record->sessions_type ?? '') == 2 ? 'selected' : '' }}>ម៉ោងទី២</option>
                                <option value="3" {{ ($record->sessions_type ?? '') == 3 ? 'selected' : '' }}>ម៉ោងទី៣</option>
                            </select>
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