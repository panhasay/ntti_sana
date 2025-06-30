<div class="modal fade" id="divHangOfStudy" tabindex="-1" aria-labelledby="modalHangOfStudyLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title" id="modalHangOfStudyLabel">ស្នើរសុំ ព្យួរកាសិក្សា</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row container mt-2 mb-2" style="white-space: nowrap">
                    <div class="col-md-12 col-sm-6 text-center">
                        ឈ្មោះ <span id="student_code"></span><span id="name_2" class="name_2 bold"></span>
                        ថ្ងៃខែឆ្នាំកំណើត <span id="date_of_birth" class="date_of_birth"></span><br>
                        ជានិស្សឹតរៀនក្រុម <span id="class_code" class="class_code"></span>
                      
                        លេខទូរស័ព្ទ <span id="phone_student" class="phone_student"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 text-center mt-3" style="white-space: nowrap">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 text-center ">
                                <span class="bold">កម្មវិត្ថុ:</span>
                                សំណើរសុំ ព្យួរកាសិក្សារយៈ</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-md-6 col-sm-6 text-center ">
                                {{-- <input type="text" class="form-control form-control-sm " id="hang_of_study"
                                    name="hang_of_study" value="" placeholder="ព្យួរកាសិក្សារយៈ"
                                    aria-label="ព្យួរកាសិក្សារយៈ"> --}}
                                    <select class="js-example-basic-single" id="hang_of_study" name="hang_of_study" style="width: 100%;">
                                        <option value="">សូមជ្រើសរើស</option>
                                        <option value="1" >1 ខែ</option>
                                        <option value="3" >3 ខែ</option>
                                        <option value="6" >6 ខែ</option>
                                        <option value="12" >12 ខែ</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 text-center mt-3" style="white-space: nowrap">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 text-center ">
                                គិតចាប់ពីថ្ងៃ :</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-md-6 col-sm-6 text-center ">
                                <input type="text" class="form-control form-control-sm " id="from_date"
                                    min="1970-01-01" max="2050-12-31" name="from_date" value="" placeholder="ថ្ងៃ-ខែ-ឆ្នាំ"
                                    aria-label="ថ្ងៃ-ខែ-ឆ្នាំ">
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12 col-sm-6 text-center">
                       <div class="row">
                            <div class="col-md-3 col-sm-3">
                              <span class="bold">រូបភាព លិខិតស្នើរសុំ</span> 
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <input type="file" class="form-control form-control-sm " id="file_name">
                            </div>
                       </div>
                    </div>
                    <div class="col-md-12 col-sm-6 text-center">
                       <div class="row">
                           <img src="" alt="">
                       </div>
                    </div>
                </div>
            </div><br>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnYesSave" data-code="" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>