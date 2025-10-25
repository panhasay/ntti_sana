<div class="container">
    <div class="text-center bold">
        ក្រុម​ {{ $class_code ?? '' }} វេន {{ $sections_code->section->name_2 ??'' }} ឆមាស​ {{ $semester_old ?? '' }} ឆ្នាំទី {{ $years_old ?? '' }}
    </div>
    <div class="row text-center">
        ឡើងទៅក្រុម {{ $class_code ?? '' }}  
        <input type="hidden" value="{{ $class_code ?? '' }}" name="class_code">
        <div class="col-md-2">
            <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">វេន<strong
                        style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single" id="sections_code"
                        name="sections_code" style="width: 100%;" >
                        <option value="">&nbsp;</option>
                        @foreach ($sections as $record)
                        <option value="{{ $record->code ?? '' }}" {{ isset($sections_code->sections_code) &&
                            $sections_code->sections_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> 
        <div class="col-md-2">
             <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឆមាស</span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single" id="semester" name="semester" style="width: 100%;" >
                        <option value="1" {{ $semester == 1 ? 'selected' : '' }}>ឆមាសទី១</option>
                        <option value="2" {{ $semester == 2 ? 'selected' : '' }}>ឆមាសទី២</option>
                    </select>
                </div>
            </div>
        </div>
         <div class="col-md-2">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំ<strong style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single " id="years" name="years" style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($study_years as $record)
                            <option value="{{ $record->code ?? '' }}" {{ isset($years) && $years == $record->code ? 'selected' : '' }}>
                                {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំសិក្សា</span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single"  id="session_y_code" name="session_y_code" style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($school_years as $record)
                            <option value="{{ $record->code ??"" }}" {{ isset($nextSession) && $nextSession == $record->code ? 'selected' : '' }}>
                                {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
    </div>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr class="general-data">
                <th width="10">អត្តលេខ</th>
                <th width="150">គោត្តនាម និងនាម</th>
                <th width="150">ឈ្មោះជាឡាតាំង</th>
                <th width="100">ភេទ</th>
            </tr>
        </thead>
        <tbody class="data-list-studnet">
            @foreach ($records as $record)
            <tr>
                <td class="text-left"> {{ $record->student_code ?? '' }}</td>
                <td class="text-left"> {{ $record->student->name_2 ?? '' }}</td>
                <td class="text-left"> {{ $record->student->name ?? '' }}</td>
                <td class="text-left"> {{ $record->student->gender ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>