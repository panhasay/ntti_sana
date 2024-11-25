
<style>
    @page {
        size: A4;
    }
    @media print {
        body {
            font-family: 'Khmer OS Battambang' !important;
            line-height: 19px !important;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            page-break-after: always !important;
            page-break-after: auto !important;
            overflow: hidden !important; /* Hide scrollbars */
        }
        .form-container {
            width: auto !important;
            margin: 15px auto;
            page-break-inside:avoid !important; 
            page-break-after:auto !important;
        }
        .form-2{
            width: auto !important;
            margin: 10px auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }
        .header-left .logo {
            width: 100px;
        }
        .header-middle {
            text-align: center;
            border: 1px solid #333;
            padding: 12px !important;
            border-radius: 15px !important;
        }

        .header-middle div {
            font-size: 14px;
            margin: 0;
            font-family: 'Khmer OS Muol Light' !important;
        }

        .header-middle h2 {
            font-size: 14px;
            margin: 5px 0;
        }

        .header-middle h3 {
            font-size: 16px;
            color: #555;
        }

        .header-right .photo-box {
            width: 100px;
            height: 120px;
            border: 1px dashed #000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
        }

        form {
            font-size: 14px;
            font-family: 'Khmer OS Battambang' !important;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-family: 'Khmer OS Battambang' !important;
           
        }

        .form-row label {
            flex: 1;
            margin-right: 10px;
            font-family: 'Khmer OS Battambang' !important;
        }

        .form-row input {
            flex: 2;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Khmer OS Battambang' !important;
        }


        .form-row-2 {
            display: flex;
            align-items: center;
            font-family: 'Khmer OS Battambang' !important;
           
        }

        .form-row-2 label {
            flex: 1;
            margin-right: 7px;
            font-family: 'Khmer OS Battambang' !important;
        }

        .form-row-2 input {
            flex: 2;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Khmer OS Battambang' !important;
        }
        .signature {
            margin-top: 20px;
        }

        .signature label {
            margin-right: 10px;
        }

        .signature input {
            width: 200px;
            font-family: 'Khmer OS Battambang' !important;
        }
        .title{
            font-size: 12px;
            font-family: 'Khmer OS Muol Light' !important;
        }
        .title-eng{
            font-size: 12px !important;
        }
        .sub-title{
            font-family: 'Khmer OS Muol Light' !important;
            font-size: 11px !important;
        }
        .text-center{
            text-align: center !important;
        }
        .general-data > td{
            border: 1px solid #333 !important;
            font-size: 10px !important;
            text-align: center!important;
            
        }
        thead{
            border: 1px solid #333 !important;
        }
        table{
            width: 96% !important;
            margin: auto !important;
        }
        .footer_print{
            font-size: 10px !important;
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for Admission</title>
</head>
<body>
    <div class="form-container">
        <header>
            <div class="header-left" style="margin-top: -50px;">
                <img src="{{ asset('asset/NTTI/images/ntti_logo.jpg') }}" alt="Institute Logo" class="logo">
            </div>
            <div class="header-middle" style="margin-top: -50px;">
                <div>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                <h2>National Technical Training Institute</h2>
            </div>
            <div class="header-right">
                <div class="photo-box">4x6</div>
            </div>
        </header>
        <div class="text-center" style="margin-top: -30px;">
            <div class="title text-center">ពាក្យសុំចូលរៀន</div>
            <div class="title-eng bold text-center">APPLICATION FOR ADMISSION</div>
            <div class="sub-title text-center">សូមគោរពជូន ឯកឧត្តមនាយក វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
        </div>
        <br>
        <form>
            <div class="form-row">
                <label for="name-kh">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<br>Name</label>
                <input type="text" id="name-kh" value="{{ $records->name_2 ?? '' }}">
                <label for="name-latin">&nbsp;&nbsp;អក្សរឡាតាំង<br>&nbsp;&nbsp;In Latin</label>
                <input type="text" id="name-latin" value="{{ $records->name ?? '' }}">
                
            </div>
            <div class="form-row">
                <label for="dob" style="white-space: nowrap;">ថ្ងៃ ខែ ឆ្នាំកំណើត<br>Date of Birth:</label>
                <input type="text" id="dob" style="width: 100px;" value="{{ $DateFormartKhmer ?? '' }}">
                <label for="nationality">&nbsp;&nbsp;សញ្ជាតិ<br>&nbsp;&nbsp;Nationality</label>
                <input type="text" id="nationality" style="width: 10px;" value="ខ្មែរ">
                <label for="sex">&nbsp;&nbsp;ភេទ<br>&nbsp;&nbsp;Sex</label>
                <input type="text" id="sex" style="width: 10px;" value="{{ $records->gender ?? '' }}">
            </div>
            <div class="form-row">
                <label for="place-of-birth">ទីកន្លែងកំណើត / Place of Birth:</label>
                <input type="text" id="place-of-birth" value="{{ $records->student_address ?? '' }}">
            </div>
            <div class="form-row">
                <label for="current-residence">ទីលំនៅបច្ចុប្បន្ន / Current Residence:</label>
                <input type="text" id="current-residence"  value="{{ $records->current_address ?? '' }}">
            </div>
            <div class="form-row">
                <label for="occupation">មុខរបរ <br> Occupation</label>
                <input type="text" id="occupation" value="{{ $records->occupation ?? '' }}">
                <label for="occupation">&nbsp;&nbsp;លេខទូរស័ព្ទ<br>&nbsp;&nbsp; Phone Number</label>
                <input type="text" id="occupation" value="{{ $records->phone_student ?? '' }}">
            </div>
            <div class="form-row">
                <label for="occupation">អាណាព្យាបាល<br>Guardian's Name</label>
                <input type="text" id="occupation" value="{{ $records->guardian_name ?? '' }}">
                <label for="occupation">&nbsp;&nbsp;លេខទូរស័ព្ទ<br>&nbsp;&nbsp; Phone Number</label>
                <input type="text" id="occupation" value="{{ $records->guardian_phone ?? '' }}">
            </div>
            <div class="form-row">
                <label for="fathers-name">ឈ្មោះឪពុក<br>Father's Name</label>
                <input type="text" id="fathers-name" value="{{ $records->father_name ?? '' }}">
                <label for="fathers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                <input type="text" id="fathers-occupation" value="{{ $records->father_occupation ?? '' }}">
            </div>
            <div class="form-row">
                <label for="mothers-name">ឈ្មោះម្ដាយ<br>Mother's Name</label>
                <input type="text" id="mothers-name" value="{{ $records->mother_name ?? '' }}">
                <label for="mothers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                <input type="text" id="mothers-occupation" value="{{ $records->mother_occupation ?? '' }}">
            </div>
            <div class="form-row">
                <label for="highest-qualification">កម្រិតវប្បធម៌/HighestQualification:</label>
                <input type="text" id="highest-qualification" value="គ្រឹះស្ថានសិក្សា{{ $records->educational_institutions ?? ''}} ទីកន្លែងសិក្សា{{ $records->bakdop_province ?? '' }} ឆ្នាំបញ្ជាប់{{ $records->year_final ?? '' }} បាក់ឌុប{{ $records->bakdop_results ?? '' }}">
            </div>
            <div class="form-row">
                <label for="year-applied" style="white-space: nowrap;">សុំចូលរៀនឆ្នាំទី<br>Year applied for</label>
                <input type="text" id="year-applied" style="width: 10px !important;" value="{{ $records->apply_year ?? '' }}">
                <label for="major">&nbsp;&nbsp;ឆមាស<br>&nbsp;&nbsp;Semester</label>
                <input type="text" id="major" style="width: 10px !important;" value="{{ $records->semester ?? '' }}">
                <label for="major">&nbsp;&nbsp;ឆ្នាំសិក្សា<br>&nbsp;&nbsp;Academic Year</label>
                <input type="text" id="major" style="width: 10px !important;" value="{{ isset($records->session_year_code) ? str_replace('_', ' - ', $records->session_year_code) : '' }}"> 
                <label for="major">&nbsp;&nbsp;ជំនាញ<br>&nbsp;&nbsp;Major</label>
                <input type="text" id="major" style="width: 10px !important;" value="{{ $skills->name_2 ?? '' }}">
            </div>
            <div class="row">
                <div class="col-sm">
                    កម្រិត​ : អនុបណ្ឌិត<input type="checkbox" value="" {{ $records->qualification == "អនុបណ្ឌិត" ? 'checked' : '' }}>

                </div>
                <div class="col-sm">
                    បរិញ្ញាបត្រ<input type="checkbox" {{ $records->qualification == "បរិញ្ញាបត្រ" ? 'checked' : '' }}>
                </div>
                <div class="col-sm">
                    បរិញ្ញាបត្ររង <input type="checkbox" value="បរិញ្ញាបត្ររង" {{ $records->qualification == "បរិញ្ញាបត្ររង" ? 'checked' : '' }}>
                </div>
                <div class="col-sm">
                    បរិញ្ញាបត្រ C1,C2,C3<input type="checkbox" value="បរិញ្ញាបត្ររង" {{ $records->qualification == "C1" ? 'checked' : '' }}>
                </div>
              </div>
          
            <div class="row">
                <div class="col-sm">
                    ម៉ោងសិក្សា:Morningព្រឹក <input type="checkbox" {{ $records->sections_code == "M" ? 'checked' : '' }}>
                </div>
                <div class="col-sm">
                    Afternoon រសៀល <input type="checkbox" {{ $records->sections_code == "A" ? 'checked' : '' }}>
                </div>
                <div class="col-sm">
                    Evening  <input type="checkbox" {{ $records->sections_code == "N" ? 'checked' : '' }}>
                </div>
                <div class="col-sm">
                    Online Learning <input type="checkbox" value="បរិញ្ញាបត្ររង">
                </div>
              </div>
              <p>
                ខ្ញុំបាទ/នាងខ្ញុំ សូមសន្យាថា គោរពតាមបទបញ្ជាផ្ទៃក្នុង និងកម្មវិធីរបស់វិទ្យាស្ថានឪ្យបាន ត្រឹមត្រូវ ។ បើមានការប្រព្រឹត្តខុសដោយប្រការណា មួយ ខ្ញុំ/នាខ្ញុំ សូមទទួលខុសត្រូវចំពោះមុខប្រឹក្សាវិន័យរបស់វិទ្យាស្ថាន។<br>
                I assure that I shall adhere to the rules and regulations set by the Institute, and I understand that any mischievous performance and moral misconduct shall be subject to the rules of the Institute.
            </p>

            <div class="row">
                <div class="col-sm-8">
                    <p class="bold">សូមភ្ជាប់មកនូវជាមួយ</p>
                    &nbsp;&nbsp;&nbsp;&nbsp;- សញ្ញាបត្រ (ច្បាប់ចម្លងផ្លូវការ) ១សន្លឹក<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;- រូមថតថ្មី ថតចំពីមុខ ៤x៦ ៣សន្លឹក<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;- រូមថតថ្មី ថតចំពីមុខ ៣x៤ ២សន្លឹក<br>
                </div>
                <div class="col-sm-4">
                   <p class="text-center">{{ $formattedDate ?? '' }}</p> <br>
                  <p class="bold text-center"> ហត្ថលេខាសាមីខ្លួន</p>
                </div>
               
                <div style="margin-top: 45px;">
                    <table>
                        <thead>
                            <tr class="general-data">
                                <td rowspan="2">ISO  9001 : 2015 / Cert NO : 720466</td>
                                <td>លេខៈ NTTI/DIT/PR-004/FR-007</td>
                                <td colspan="2">ចេញផ្សាយៈលើកទី 05</td>
                            </tr>
                            <tr class="general-data">
                                <td>ថ្ងៃពិនិត្យឡើងវិញៈ August 29, 2014</td>
                                <td>ថ្ងៃមានប្រសិទ្ធភាពៈ August 24, 2017</td>
                                <td>ទំព័រទីៈ 1 of 1</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>
        <div class="text-center mt-1">វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ តាមបណ្ដោយផ្លូវសហព័ន្ធរុស្សុី</div>
        <div class="text-center">Tel: 855-23-883 039, Fax : 855-23-883-039 Email: info@ntti.edu.kh , website : www.info@ntti.edu.kh.com</div>
        <div class="shit-1">
            <div class="form-2">
                <header>
                    <div class="header-left">
                        <img src="{{ asset('asset/NTTI/images/ntti_logo.jpg') }}" alt="Institute Logo" class="logo">
                    </div>
                    <div class="header-middle">
                        <div>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                        <h2>National Technical Training Institute</h2>
                    </div>
                    <div class="header-right" style="margin-top: 45px;">
                        <div class="photo-box">4x6</div>
                    </div>
                </header>
                <div class="text-center" style="margin-top: -30px;">
                    <div class="title text-center">សាលបត្រ័ទទួលពាក្យ</div>
                    <div class="title-eng bold text-center">ADMISSION FOR</div>
                </div>
            </div>
            <form>
                <div class="form-row-2">
                    <label for="name-kh">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<br>Name</label>
                    <input type="text" id="name-kh" value="{{ $records->name_2 ?? '' }}">
                    <label for="name-latin">&nbsp;&nbsp;អក្សរឡាតាំង<br>&nbsp;&nbsp;In Latin</label>
                    <input type="text" id="name-latin" value="{{ $records->name ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="dob" style="white-space: nowrap;">ថ្ងៃ ខែ ឆ្នាំកំណើត<br>Date of Birth:</label>
                    <input type="text" id="dob" style="width: 100px;" value="{{ $DateFormartKhmer ?? '' }}">
                    <label for="nationality">&nbsp;&nbsp;សញ្ជាតិ<br>&nbsp;&nbsp;Nationality</label>
                    <input type="text" id="nationality" style="width: 10px;" value="ខ្មែរ">
                    <label for="sex">&nbsp;&nbsp;ភេទ<br>&nbsp;&nbsp;Sex</label>
                    <input type="text" id="sex" style="width: 10px;" value="{{ $records->gender ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="current-residence">ទីលំនៅបច្ចុប្បន្ន / Current Residence:</label>
                    <input type="text" id="current-residence"  value="{{ $records->current_address ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="occupation">មុខរបរ <br> Occupation</label>
                    <input type="text" id="occupation" value="{{ $records->occupation ?? '' }}">
                    <label for="occupation">&nbsp;&nbsp;លេខទូរស័ព្ទ<br>&nbsp;&nbsp; Phone Number</label>
                    <input type="text" id="occupation" value="{{ $records->phone_student ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="fathers-name">ឈ្មោះឪពុក<br>Father's Name</label>
                    <input type="text" id="fathers-name" value="{{ $records->father_name ?? '' }}">
                    <label for="fathers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                    <input type="text" id="fathers-occupation" value="{{ $records->father_occupation ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="mothers-name">ឈ្មោះម្ដាយ<br>Mother's Name</label>
                    <input type="text" id="mothers-name" value="{{ $records->mother_name ?? '' }}">
                    <label for="mothers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                    <input type="text" id="mothers-occupation" value="{{ $records->mother_occupation ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="year-applied" style="white-space: nowrap;">សុំចូលរៀនឆ្នាំទី<br>Year applied for</label>
                    <input type="text" id="year-applied" style="width: 10px !important;" value="{{ $records->apply_year ?? '' }}">
                    <label for="major">&nbsp;&nbsp;ឆមាស<br>&nbsp;&nbsp;Semester</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ $records->semester ?? '' }}">
                    <label for="major">&nbsp;&nbsp;ឆ្នាំសិក្សា<br>&nbsp;&nbsp;Academic Year</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ isset($records->session_year_code) ? str_replace('_', ' - ', $records->session_year_code) : '' }}"> 
                    <label for="major">&nbsp;&nbsp;ជំនាញ<br>&nbsp;&nbsp;Major</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ $skills->name_2 ?? '' }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        ថ្ងៃទីខែឆ្នាំទទួលពាក្យ<br>Date of Receipt:______________
                    </div>
                    <div class="col-4">
                        ឈ្មោះបុគ្គលិកទទូលពាក្យ<br>Name of Officer:______________
                    </div>
                    <div class="col-4">
                        ហត្ថលេខា<br>Signature:______________
                    </div>
                </div><br>
                {{-- <div class="row">
                    <div>
                        <table>
                            <thead>
                                <tr class="general-data">
                                    <td rowspan="2">ISO  9001 : 2015 / Cert NO : 720466</td>
                                    <td>លេខៈ NTTI/DIT/PR-004/FR-007</td>
                                    <td colspan="2">ចេញផ្សាយៈលើកទី 05</td>
                                </tr>
                                <tr class="general-data">
                                    <td>ថ្ងៃពិនិត្យឡើងវិញៈ August 29, 2014</td>
                                    <td>ថ្ងៃមានប្រសិទ្ធភាពៈ August 24, 2017</td>
                                    <td>ទំព័រទីៈ 1 of 1</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> --}}
            </form>
        </div>
        <div class="mt-3">
            ...................................................................................................................................................................................................................................................................................................................................................................
        </div>
        <div class="shit-1" style="margin-top: -10px;">
            <div class="form-2">
                <header>
                    <div class="header-left">
                        <img src="{{ asset('asset/NTTI/images/ntti_logo.jpg') }}" alt="Institute Logo" class="logo">
                    </div>
                    <div class="header-middle">
                        <div>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                        <h2>National Technical Training Institute</h2>
                    </div>
                    <div class="header-right" style="margin-top: 45px;">
                        <div class="photo-box">4x6</div>
                    </div>
                </header>
                <div class="text-center" style="margin-top: -30px;">
                    <div class="title text-center">សាលបត្រ័ទទួលពាក្យ</div>
                    <div class="title-eng bold text-center">ADMISSION FOR</div>
                </div>
            </div>
            <form>
                <div class="form-row-2">
                    <label for="name-kh">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<br>Name</label>
                    <input type="text" id="name-kh" value="{{ $records->name_2 ?? '' }}">
                    <label for="name-latin">&nbsp;&nbsp;អក្សរឡាតាំង<br>&nbsp;&nbsp;In Latin</label>
                    <input type="text" id="name-latin" value="{{ $records->name ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="dob" style="white-space: nowrap;">ថ្ងៃ ខែ ឆ្នាំកំណើត<br>Date of Birth:</label>
                    <input type="text" id="dob" style="width: 100px;" value="{{ $DateFormartKhmer ?? '' }}">
                    <label for="nationality">&nbsp;&nbsp;សញ្ជាតិ<br>&nbsp;&nbsp;Nationality</label>
                    <input type="text" id="nationality" style="width: 10px;" value="ខ្មែរ">
                    <label for="sex">&nbsp;&nbsp;ភេទ<br>&nbsp;&nbsp;Sex</label>
                    <input type="text" id="sex" style="width: 10px;" value="{{ $records->gender ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="current-residence">ទីលំនៅបច្ចុប្បន្ន / Current Residence:</label>
                    <input type="text" id="current-residence"  value="{{ $records->current_address ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="occupation">មុខរបរ <br> Occupation</label>
                    <input type="text" id="occupation" value="{{ $records->occupation ?? '' }}">
                    <label for="occupation">&nbsp;&nbsp;លេខទូរស័ព្ទ<br>&nbsp;&nbsp; Phone Number</label>
                    <input type="text" id="occupation" value="{{ $records->phone_student ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="fathers-name">ឈ្មោះឪពុក<br>Father's Name</label>
                    <input type="text" id="fathers-name" value="{{ $records->father_name ?? '' }}">
                    <label for="fathers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                    <input type="text" id="fathers-occupation" value="{{ $records->father_occupation ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="mothers-name">ឈ្មោះម្ដាយ<br>Mother's Name</label>
                    <input type="text" id="mothers-name" value="{{ $records->mother_name ?? '' }}">
                    <label for="mothers-occupation">&nbsp;&nbsp;មុខរបរ<br>&nbsp;&nbsp;Occupation</label>
                    <input type="text" id="mothers-occupation" value="{{ $records->mother_occupation ?? '' }}">
                </div>
                <div class="form-row-2">
                    <label for="year-applied" style="white-space: nowrap;">សុំចូលរៀនឆ្នាំទី<br>Year applied for</label>
                    <input type="text" id="year-applied" style="width: 10px !important;" value="{{ $records->apply_year ?? '' }}">
                    <label for="major">&nbsp;&nbsp;ឆមាស<br>&nbsp;&nbsp;Semester</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ $records->semester ?? '' }}">
                    <label for="major">&nbsp;&nbsp;ឆ្នាំសិក្សា<br>&nbsp;&nbsp;Academic Year</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ isset($records->session_year_code) ? str_replace('_', ' - ', $records->session_year_code) : '' }}"> 
                    <label for="major">&nbsp;&nbsp;ជំនាញ<br>&nbsp;&nbsp;Major</label>
                    <input type="text" id="major" style="width: 10px !important;" value="{{ $skills->name_2 ?? '' }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        ថ្ងៃទីខែឆ្នាំទទួលពាក្យ<br>Date of Receipt:______________
                    </div>
                    <div class="col-4">
                        ឈ្មោះបុគ្គលិកទទូលពាក្យ<br>Name of Officer:______________
                    </div>
                    <div class="col-4">
                        ហត្ថលេខា<br>Signature:______________
                    </div>
                </div><br>
                {{-- <div class="row">
                    <div>
                        <table>
                            <thead>
                                <tr class="general-data">
                                    <td rowspan="2">ISO  9001 : 2015 / Cert NO : 720466</td>
                                    <td>លេខៈ NTTI/DIT/PR-004/FR-007</td>
                                    <td colspan="2">ចេញផ្សាយៈលើកទី 05</td>
                                </tr>
                                <tr class="general-data">
                                    <td>ថ្ងៃពិនិត្យឡើងវិញៈ August 29, 2014</td>
                                    <td>ថ្ងៃមានប្រសិទ្ធភាពៈ August 24, 2017</td>
                                    <td>ទំព័រទីៈ 1 of 1</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> --}}
            </form>
        </div>
    </div>
</body>
</html>