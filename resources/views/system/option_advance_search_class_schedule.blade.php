<form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-sm-2">
                    <span class="labels">ថា្នក់/ក្រុម</span>
                    <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($classs as $record)
                            <option value="{{ $record->code ?? '' }}">
                                {{ str_replace('.', '', $record->code ?? '') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <span class="labels">ដេប៉ាតឺម៉ង់</span>
                    <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($department as $record)
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) &&
                            $records->department_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <span class="labels">ជំនាញ</span>
                    <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($skills as $record)
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) &&
                            $records->skills_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                            $record->name_2 : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <span class="labels">វេន</span>
                    <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($sections as $record)
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) &&
                                $records->sections_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                                $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <span class="labels">កម្រិត</span>
                    <select class="js-example-basic-single FieldRequired" id="qualification" name="qualification"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($qualifications as $value => $label)
                            <option value="{{ $label->code }}" {{ isset($records->level) && $records->level ==
                                $label->code ? 'selected' : '' }}>
                                {{ $label->code ?? ''}}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-sm-2">
                    <span class="labels">គ្រូ</span>
                    <select class="js-example-basic-single FieldRequired" id="teachers_code" name="teachers_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($teachers as $record)
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) &&
                                $records->sections_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->name_2) ?
                                $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
            </div>
            <button type="button" class="btn btn-primary text-white float-left btn-sm mb-2 mb-md-0 me-2" data-page="{{ $page_name ?? '' }}" id="btn-adSearch"><i class="mdi mdi-account-search"></i> ស្វែងរក</button>
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-page="{{ $page_name ?? '' }}" id="btnCleardata"><i class="mdi mdi-cloud-off-outline"></i> ជម្រះទិន្នន័យ</button>
        </div>
    </div>
</form>