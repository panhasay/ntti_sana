<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped table-hover" style="margin-bottom: 4rem;">
        <thead>
            <tr>
                <th width="10" rowspan="2">ល.រ</th>
                <th rowspan="2">កាលបរិច្ឆេទ</th>
                <th colspan="2" class="text-center">{{ $records->class_code ?? '' }}</th>
                <th width="20" rowspan="2">ឯកសារ វិញ្ញាសា</th>
            </tr>
            <tr>
                <th>មុខវិជ្ជា</th>
                <th>សាស្ត្រាចារ្យ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($record_sub_lines as $record)
                <tr id="row{{ $record->id }}" class="table-row">
                    <td>
                        <a class="btn btn-primary btn-sm edit-btn"
                           data-id="{{ $record->id }}"
                           data-date="{{ $record->date }}"
                           data-subjects="{{ $record->subjects_code }}"
                           data-teacher="{{ $record->teacher_code }}"
                           data-bs-toggle="modal"
                           data-bs-target="#editModal">
                            <i class="mdi mdi-border-color"></i> Edit
                        </a>
                        {{-- <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $record->id }}">
                            <i class="mdi mdi-delete-forever"></i> Delete
                        </button> --}}
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $record->id }}">  <i class="mdi mdi-delete-forever"></i>Delete</button>

                    </td>
                    <td>{{ App\Service\service::convertToKhmerDate($record->date) ?? '' }}</td>
                    <td>{{ $record->subject->name ?? 'N/A' }}</td>
                    <td>{{ $record->teacher->name_2 ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-outline-danger btn-sm" data-code="{{ $record->id }}" id="UploadDocument">Upload File</button>
                        @if($record->document_exam)
                            <button onclick="viewFile('{{ asset('storage/' . $record->document_exam) }}')"  type="button"
                                    class="btn btn-outline-success btn-sm">
                                View File
                                <i class="mdi mdi-file-eye btn-icon-prepend"></i>
                            </button>
                         @else
                            <button 
                                type="button"
                                class="btn btn-outline-dark btn-sm">
                                &nbsp;&nbsp;&nbsp; No File &nbsp;&nbsp;&nbsp;
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="uploadFileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black" >Upload PDF File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="uploadFileForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="upload-record-id" name="code">
                    <input type="file" name="document_exam" accept=".pdf" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUploadPdf" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black">កែប្រែ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="col-md-12 mt-3">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">កាលបរិច្ឆេទ<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="edit-date" name="date" style="width: 349px;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">មុខវិជ្ជា<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" id="edit-subject" name="subjects_code" style="width: 349px;">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->code }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">សាស្ត្រាចារ្យ<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" id="edit-teacher" name="teacher_code" style="width: 349px;">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->code }}">{{ $teacher->name_2 ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                <button type="button" class="btn btn-primary save-changes">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>

<style>
    input, button, select, optgroup, textarea {
    padding-left: 12px; !important;
    font-size: 12px; !important;
    padding-top: 12px; !important;
   
}
</style>
    
    