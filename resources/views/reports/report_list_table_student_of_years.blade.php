<style>
.report-table {
    width: 100%;
    border-collapse: collapse;
    margin: 17px 0;
    font-size: 14px;
}

.report-table th,
.report-table td {
    border: 1px solid #ccc;
    /* text-align: center; */
}

.report-table th {
    background-color: #f2f2f2;
}

.report-table tfoot td {
    font-weight: bold;
    background-color: #e6ffe6;
}

.signature-section {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.signature-section div {
    text-align: left;
    width: 40%;
}

.group-by>td {
    /* text-align: left !important; */
    font-weight: bold;
    padding: 7px;
}

.general>td {
    /* text-align: left !important; */
}
</style>
@extends('app_layout.app_layout')
@section('content')
<section>
    <div class="content-wrapper pb-0">
        <div class="title-report mt-3"> តារាងបញ្ជីក្រុមនិស្សិតបច្ចេកទេស​ និង បច្ចេកវិទ្យាតាមឆ្នាំសិក្សា</div>
        <!--option--->
        <div class="page-header flex-wrap">
            <div class="header-left">
                <button data-page="student" id="btn-priview" type="button"
                    class="btn btn-outline-primary btn-icon-text btn-sm">
                    <i class="mdi mdi-eye"></i> Priview </button>
                <button type="button" onclick="prints()"
                    class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
                    <i class="mdi mdi-printer btn-icon-append"></i>
                </button><button type="button" id="BtnDownlaodExcel"
                    class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                        class="mdi mdi-printer btn-icon-append"></i> </button>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">
                <div>
                </div>
                <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
                    aria-expanded="true" aria-controls="collapseExample">
                    Fliter
                </a>
            </div>
        </div>
        <div class="collapse" id="Fliter">
            <div class="card card-body card-report">
                <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="option bold"> Option</div>
                                <div class="col-sm-3 p-3">
                                    <span class="labels">ដេប៉ាតឺម៉ង់</span>
                                    <select class="js-example-basic-single select2-hidden-accessible" id="department_id"
                                        name="department_id" style="width: 100%;" data-select2-id="department_id"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="2">&nbsp;</option>
                                        <option value="2"></option>
                                        <option value="3"></option>
                                        <option value="20"></option>
                                        <option value="24"></option>
                                        <option value="25"></option>
                                        <option value="26"></option>
                                        <option value="27"></option>
                                        <option value="28"></option>
                                        <option value="29"></option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>

                                <div class="col-sm-3 p-3">
                                    <span class="labels">ជំនាញ</span>
                                    <select class="js-example-basic-single select2-hidden-accessible" id="category_id"
                                        name="category_id" style="width: 100%;" data-select2-id="category_id"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="4">&nbsp;</option>

                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="3" style="width: 100%;"><span class="selection"><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="col-sm-3 p-3">
                                    <span class="labels">ថ្នាក់</span>
                                    <select class="js-example-basic-single select2-hidden-accessible" id="class_id"
                                        name="class_id" style="width: 100%;" data-select2-id="class_id" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="" data-select2-id="6">&nbsp;</option>

                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="option bold"> Option Group BY</div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="labels">Group By</span>
                                    <select class="js-example-basic-single select2-hidden-accessible"
                                        id="group_by_category" name="group_by_category" style="width: 100%;"
                                        data-select2-id="group_by_category" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="8">&nbsp;</option>
                                        <option value="category">ជំនាញ</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="7" style="width: 100%;"><span class="selection"><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                            <!-- <button type="button" class="btn btn-primary text-white" data-page="student" id="btn-adSearch">Search</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!---end option-->
        <div class="print" style="display: none">
            <div class="print-content">

            </div>
        </div>
        <div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="btnYes" data-code="" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="report-container">
            <table class="report-table">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="3">ល.រ</th>
                        <th class="text-center" rowspan="3">កម្រិត</th>
                        <th class="text-center" colspan="6">ចំនួននិស្សិត</th>
                        <th class="text-center" colspan="2" rowspan="2">សរុបតាមជំនាញ</th>
                        <th class="text-center" rowspan="3">ផ្សេងៗ</th>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="2">ព្រឺក</th>
                        <th class="text-center" colspan="2">រសៀល</th>
                        <th class="text-center" colspan="2">យប់</th>
                        
                    </tr>
                    <tr>
                        <th class="text-center">សរុប</th>
                        <th class="text-center">ស្រី</th>
                        <th class="text-center">សរុប</th>
                        <th class="text-center">ស្រី</th>
                        <th class="text-center">សរុប</th>
                        <th class="text-center">ស្រី</th>
                        <th class="text-center">សរុប</th>
                        <th class="text-center">ស្រី</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="group-by">
                        <td colspan="11" class="text-left"> I បរិញ្ញាបត្របច្ចេកវិទ្យា </td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី១</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី២</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី៣</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី៤</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី៥ (សារណា)</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">សរុប បរិញ្ញាបត្រ</td>
                        <td class="text-center"></td> <!-- Qualification total -->
                        <td class="text-center"></td> <!-- Qualification girls -->

                        <td class="text-center"></td> <!-- Qualification today -->
                        <td class="text-center"></td> <!-- Qualification girls today -->

                        <td class="text-center"></td> <!-- Qualification total -->
                        <td class="text-center"></td> <!-- Qualification girls -->

                        <td class="text-center">134</td> <!-- Total overall -->
                        <td class="text-center">49</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="group-by">
                        <td colspan="11" class="text-left"> II បរិញ្ញាបត្ររង </td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី១</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center"></td>
                        <td>ឆ្នាំទី២</td>
                        <td class="text-center"></td> <!-- Total before today -->
                        <td class="text-center"></td> <!-- Girls before today -->

                        <td class="text-center"></td> <!-- Total today -->
                        <td class="text-center"></td> <!-- Girls today -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->

                        <td class="text-center"></td> <!-- Total overall -->
                        <td class="text-center"></td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">1</td>
                        <td>IT07B</td>
                        <td class="text-center">9</td> <!-- Total before today -->
                        <td class="text-center">6</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">92</td> <!-- Total overall -->
                        <td class="text-center">6</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">2</td>
                        <td>IT08B</td>
                        <td class="text-center">6</td> <!-- Total before today -->
                        <td class="text-center">0</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">6</td> <!-- Total overall -->
                        <td class="text-center">0</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">3</td>
                        <td>IT09B</td>
                        <td class="text-center">331</td> <!-- Total before today -->
                        <td class="text-center">21</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">331</td> <!-- Total overall -->
                        <td class="text-center">21</td> <!-- Girls overall -->
                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr class="general">
                        <td class="text-center">4</td>
                        <td>IT010B</td>
                        <td class="text-center">85</td> <!-- Total before today -->
                        <td class="text-center">22</td> <!-- Girls before today -->

                        <td class="text-center">0</td> <!-- Total today -->
                        <td class="text-center">0</td> <!-- Girls today -->

                        <td class="text-center">85</td> <!-- Total overall -->
                        <td class="text-center">22</td> <!-- Girls overall -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">សរុប បរិញ្ញាបត្ររង</td>
                        <td class="text-center"></td> <!-- Qualification total -->
                        <td class="text-center"></td> <!-- Qualification girls -->
                        <td class="text-center"></td> <!-- Qualification today -->
                        <td class="text-center"></td> <!-- Qualification girls today -->

                        <td class="text-center"></td> <!-- Qualification total -->
                        <td class="text-center"></td> <!-- Qualification girls -->

                        <td class="text-center">134</td> <!-- Total overall -->
                        <td class="text-center">49</td> <!-- Girls overall -->
                        <td></td>
                    </tr>

                    <!-- Grand Totals -->
                    <tr class="grand-total">
                        <td colspan="2" class="text-right"><strong>សរុបរូម​</strong></td>
                        <td class="text-center"><strong>874</strong></td> <!-- Grand total -->
                        <td class="text-center"><strong>96</strong></td> <!-- Grand total girls -->

                        <td class="text-center"><strong>0</strong></td> <!-- Grand total today -->
                        <td class="text-center"><strong>0</strong></td> <!-- Grand total girls today -->

                        <td class="text-center"><strong>874</strong></td> <!-- Grand total -->
                        <td class="text-center"><strong>96</strong></td> <!-- Grand total girls -->

                        <td class="text-center">9</td> <!-- Total overall -->
                        <td class="text-center">4</td> <!-- Girls overall -->
                        <td></td>
                    </tr>
                    <!-- Add more rows as necessary -->
                </tbody>
            </table>


        </div>
        <br>
        <br>
        <br><br><br><br><br><br><br><br><br>
        <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $(document).on('click', '#btnDelete', function() {
                $(".modal-confirmation-text").html('Do you want to delete?');
                $("#btnYes").attr('data-code', $(this).attr('data-code'));
                $("#divConfirmation").modal('show');
            });
            $(document).on('click', '#btnYes', function() {
                var code = $(this).attr('data-code');
                $.ajax({
                    type: "POST",
                    url: `/student/delete`,
                    data: {
                        code: code
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $("#divConfirmation").modal('hide');
                            $("#row" + code).remove();
                            notyf.success(response.msg);
                        }
                    }
                });
            });
            $(document).on('click', '#btnClose', function(e) {
                $("#divConfirmation").modal('hide');
            });
            $(document).on('click', '#btn-priview', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'NTTI PORTAL',
                    text: 'ប្រព័ន្ធ កំពុងដំណើរការ......!',
                });
                return false;
                let page = $(this).attr('data-page');
                let data = $('#advance_search').serialize();
                $.ajax({
                    type: "GET",
                    url: '/reports-list-of-student-priview?type=priview',
                    data: data,
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('.loader').hide();
                            $('.control-table').html("");
                            $('.control-table').html(response.view);
                            $('.collapse').removeClass('show')
                        } else {
                            $('.loader').hide();
                            notyf.error("Error: " + response.msg);
                        }
                    },
                    error: function() { // Corrected error handling
                        notyf.success("An error occurred during the request.");
                        $('.loader').hide();
                    }
                });
            });
            $(document).on('click', '#BtnDownlaodExcel', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'NTTI PORTAL',
                    text: 'ប្រព័ន្ធ កំពុងដំណើរការ......!',
                });
                return false;
                $(".modal-confirmation-text").html('Do you want to Downlaod Excel ?');
                $("#btnYes").attr('data-code', $(this).attr('data-type'));
                $("#divConfirmation").modal('show');
            });
            $(document).on('click', '#btnYes', function() {
                DownlaodExcel();
            });
        });

        function prints(ctrl) {
            Swal.fire({
                icon: 'warning',
                title: 'NTTI PORTAL',
                text: 'ប្រព័ន្ធ កំពុងដំណើរការ......!',
            });
            return false;
            var url = '/reports-list-of-student-priview?type=print';
            var data = '';
            data = $("#advance_search").serialize();
            $.ajax({
                type: 'get',
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    if (response.status != 'success') {
                        $('.loader').hide();
                        $('.print-content').printThis({});
                        $('.print-content').html(response);
                    } else {
                        $('.loader').hide();
                        notyf.error("Error: " + response.msg);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        }

        function DownlaodExcel() {
            var url = '/reports-list-of-student-priview?type=downlaodexcel';
            if ($('#search_data').val() == '') {
                data = $("#advance_search").serialize();
            } else {
                data = 'value=' + $('#search_data').val();
            }
            data = $("#advance_search").serialize();
            $.ajax({
                type: "get",
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {},
                success: function(response) {
                    $("#divConfirmation").modal('hide');
                    notyf.success(response.msg);
                    location.href = response.path;
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        }
        </script>

    </div>
</section>
@endsection