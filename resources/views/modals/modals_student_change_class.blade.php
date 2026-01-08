
    <div class="document-container text-center">
        <section class="form-content">
            
            <p class="personal-info">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<span class="fill-in"> <span class="bold">{{ $student->student->name_2 ?? ''  }}</span> </span>កើតថ្ងៃទី <span class="fill-in-tiny bold">{{ App\Service\service::DateYearKH($student->student->date_of_birth) ?? '' }} </span> ជានិស្សិតក្រុមៈ<span class="fill-in-medium bold">{{ $student->class_code ?? '' }} </span>ឆមាសទី<span class="fill-in-tiny bold"> {{ $student->semester ?? '' }}</span>ឆ្នាំទី<span class="fill-in-tiny"> {{ $student->years ?? '' }}</span>។  លេខទូរស័ព្ទផ្ទាល់ខ្លួនៈ<span class="fill-in-medium"> {{ $student->student->phone_no ?? '' }}</span></p>

            <p class="guardian-info">អាណាព្យាបាលឈ្មោះ<span class="fill-in bold">{{ $student->student->guardian_name ?? '' }}</span>លេខទូរស័ព្ទៈ<span class="fill-in-medium bold">{{ $student->student->guardian_phone ?? '' }}</span></p>

            {{-- <div class="recipient-block">
                <p>សូមគោរពចូលមក</p>
                <p class="recipient-name"><strong>ឯកឧត្តមនាយកវិទ្យាស្ថានជាតិបណ្ដុះបណ្ដាលបច្ចេកទេស</strong></p>
            </div> --}}

            <p class="subject indent">
                <strong>កម្មវត្ថុ៖</strong> សំណើរសុំផ្ទេរការសិក្សាពីក្រុមៈ<span class="fill-in-small">{{ preg_replace('/[^a-zA-Z0-9]/', '', $student->class_code ?? '') }} </span>
                <span class="checkbox-container">
                    វេនពេល {{ $student->section->name_2 ?? '' }}
                </span>
            </p>
            <input type="hidden" id="class_old" value="{{ $student->class_code ?? "" }}">

            <input type="hidden" id="years" value="{{ $student->years ?? "" }}">
            <input type="hidden" id="semester" value="{{ $student->semester ?? "" }}">
            <input type="hidden" id="assing_no" value="{{ $student->assing_no ?? "" }}">
            <input type="hidden" id="session_year_codes" value="{{ $student->session_year_code ?? "" }}">

            <p class="transfer-to indent">
                ទៅក្រុម 
                <span class="fill-in-small">
                    <select class="js-example-basic-single" id="class_code_new" name="class_code_new" style="width: 30%;">
                        <option value="">&nbsp;</option>
                        @foreach ($class as $record)
                            @if ($record->code != $student->class_code)
                                <option value="{{ $record->code ?? '' }}">
                                    {{ preg_replace('/[^a-zA-Z0-9]/', '', $record->code ?? '') }} -
                                    {{ $record->section->name_2 ?? '' }} -
                                    {{ $record->level ?? '' }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </span> 
                ឆ្នាំ
                <span class="fill-in-small">
                    <select class="js-example-basic-single" id="year_new" name="year_new" style="width: 10%;">
                        <option value="">&nbsp;</option>
                        <option value="1">ឆ្នាំទី១</option>
                        <option value="2">ឆ្នាំទី២</option>
                        <option value="3">ឆ្នាំទី៣</option>
                        <option value="4">ឆ្នាំទី៤</option>
                    </select>
                </span> 
                ឆមាស
                <span class="fill-in-small">
                    <select class="js-example-basic-single" id="semester_new" name="semester_new" style="width: 10%;">
                        <option value="">&nbsp;</option>
                        <option value="1">ឆមាសទី១</option>
                        <option value="2">ឆមាសទី២</option>
                    </select>
                </span> 
               ចាប់ពីថ្ងៃទី <input autocomplete="off" type="date" class="form-control form-control-sm" id="posting_date" name="posting_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  placeholder="ចាប់ពីថ្ងៃទី" aria-label="ចាប់ពីថ្ងៃទី" style="width: 150px; display: inline-block; margin: 0 5px;"> តទៅ។
            </p>
            <p style="text-indent: 2em; margin: 0;">
                <strong>មូលហេតុ៖</strong> ដោយខ្ញុំបាទ/នាងខ្ញុំ
                <textarea name="reason_detail" id="reason_detail" placeholder="សូមបញ្ចូលមូលហេតុ" style="width: 500px; height: 30px; display: inline-block; vertical-align: middle; margin-left: 5px; resize: none;"></textarea>
            </p>
            <div class="reason-block">
                <span class="reason-line"></span>
                <span class="reason-line"></span>
                <span class="reason-line"></span>
            </div>
        </section>
        <hr class="section-divider">
    </div>