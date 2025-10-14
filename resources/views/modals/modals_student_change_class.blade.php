{{-- <div class="col-md-12 col-sm-6 text-left">អត្តលេខ​ : {{ $student->code ?? '' }} ឈ្មោះ <span class="bold"> {{
        $student->name_2 ?? '' }}</span> ថ្ងៃខែឆ្នាំកំណើត <span class="bold"> {{
        App\Service\service::DateYearKH($student->date_of_birth) ?? '' }}</span> រៀន នៅក្រុម​​ <span class="bold">{{
        $student->class_code ?? '' }}</span>
</div> --}}

    <div class="document-container text-center">
        <section class="form-content">
            
            <p class="personal-info">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<span class="fill-in"> <span class="bold">{{ $student->student->name_2 ?? ''  }}</span> </span>កើតថ្ងៃទី <span class="fill-in-tiny bold">{{ App\Service\service::DateYearKH($student->student->date_of_birth) ?? '' }}   </p>
            <p class="student-info">ជានិស្សិតក្រុមៈ<span class="fill-in-medium bold">{{ $student->class_code ?? '' }} </span>ឆមាសទី<span class="fill-in-tiny bold"> {{ $student->semester ?? '' }}</span>ឆ្នាំទី<span class="fill-in-tiny"> {{ $student->years ?? '' }}</span>។  លេខទូរស័ព្ទផ្ទាល់ខ្លួនៈ<span class="fill-in-medium"> {{ $student->student->phone_no ?? '' }}</span></p>
            <p class="guardian-info">អាណាព្យាបាលឈ្មោះ<span class="fill-in bold">{{ $student->student->guardian_name ?? '' }}</span>លេខទូរស័ព្ទៈ<span class="fill-in-medium bold">{{ $student->student->guardian_phone ?? '' }}</span></p>

            <div class="recipient-block">
                <p>សូមគោរពចូលមក</p>
                <p class="recipient-name"><strong>ឯកឧត្តមនាយកវិទ្យាស្ថានជាតិបណ្ដុះបណ្ដាលបច្ចេកទេស</strong></p>
            </div>

            <p class="subject indent">
                <strong>កម្មវត្ថុ៖</strong> សំណើរសុំផ្ទេរការសិក្សាពីក្រុមៈ<span class="fill-in-small">................</span>
                <span class="checkbox-container">
                    វេនពេល (ព្រឹក <span class="checkbox"></span> / រសៀល <span class="checkbox"></span> / យប់ <span class="checkbox"></span>)
                </span>
            </p>
            <p class="transfer-to indent">
                ទៅក្រុម <span class="fill-in-small">................</span> 
                <span class="checkbox-container">
                    វេនពេល(ព្រឹក <span class="checkbox"></span> / រសៀល <span class="checkbox"></span> / យប់ <span class="checkbox"></span>)
                </span>
                ចាប់ពីថ្ងៃទី<span class="fill-in-tiny">......</span>ខែ <span class="fill-in-tiny">.......</span> ឆ្នាំ២០<span class="fill-in-tiny">........</span>តទៅ។
            </p>
            <p class="reason indent">
                <strong>មូលហេតុ៖</strong> ដោយខ្ញុំបាទ/នាងខ្ញុំ
            </p>
            <div class="reason-block">
                <span class="reason-line"></span>
                <span class="reason-line"></span>
                <span class="reason-line"></span>
            </div>
        </section>

        <hr class="section-divider">

        <section class="signature-approval">
            <div class="signature-applicant">
                <p class="date-phnompenh">រាជធានីភ្នំពេញ, ថ្ងៃទី<span class="fill-in-tiny">.......</span>ខែ<span class="fill-in-tiny">...............</span>ឆ្នាំ២០<span class="fill-in-tiny">.........</span></p>
                <p class="signature-label"><strong>ហត្ថលេខា និងឈ្មោះសាមីខ្លួន</strong></p>
                <div class="signature-space"></div>
            </div>

            <div class="approval-blocks">
                <div class="approval-col">
                    <p class="approval-title">បានឃើញ និងបញ្ជូនមក</p>
                    <p class="approval-role"><strong>នាយករងទទួលបន្ទុកសិក្សា</strong></p>
                    <div class="signature-space-small"></div>
                </div>
                <div class="approval-col">
                    <p class="approval-title">បានឃើញ និងបញ្ជូនមក</p>
                    <p class="approval-role"><strong>គ្រូកាន់ក្រុម</strong></p>
                    <div class="signature-space-small"></div>
                </div>
                <div class="approval-col">
                    <p class="approval-title">បានឃើញ និងពិនិត្យត្រឹមត្រូវ</p>
                    <p class="approval-role"><strong>ប្រធានដេប៉ាតឺម៉ង់</strong></p>
                    <div class="signature-space-small"></div>
                </div>
            </div>
        </section>
    </div>