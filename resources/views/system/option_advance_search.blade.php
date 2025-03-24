<form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-sm-3">
                    <span class="labels">ថា្នក់/ក្រុម</span>
                    <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($classs as $record)
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code
                                == $record->code ? 'selected' : '' }}>
                                {{ isset($record->code) ? $record->code : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
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

                <div class="col-sm-3">
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
                <div class="col-sm-3">
                    <span class="labels">វេន</span>
                    <div class="col-sm-9">
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
                </div>

                {{-- <div class="col-sm-3">
                    <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong
                            style="color:red; font-size:15px;"> *</strong></span>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single" id="qualification" name="qualification" style="width: 100%;">
                            <option value="">&nbsp;</option>
                            @foreach ($qualifications as $value => $label)
                            <option value="{{ $label->code }}" {{ isset($records->level) && $records->level ==
                                $label->code ? 'selected' : '' }}>
                                {{ $label->code ?? ''}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
            </div>
            <button type="button" class="btn btn-primary text-white" data-page="{{ $page_name ?? '' }}"
                id="btn-adSearch">Search</button>
        </div>
    </div>
</form>