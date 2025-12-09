@extends('app_layout.card_student_layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card-student {
            width: 200px;
            height: 200px;
            object-fit: contain;
        }
        .stu-name {
            font-family: "Battambang", system-ui;
            font-weight: 900;
            font-style: normal;
        }

        .info-stu {
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        p {
            font-size: 20px
        }

        .btn-detail-light {
            transition: all 0.3s ease;
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .font-in-modal {
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .btn-detail-light:hover,
        .active-btn {
            border-left: solid 2px rgb(13, 110, 253) !important;
            border-right: solid 2px rgb(13, 110, 253) !important;
            border-bottom: solid 2px rgb(13, 110, 253) !important;
            color: rgb(0, 0, 0) !important;
            border-radius: 2px;
        }

        .content-section {
            background-color: transparent;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        p {
            margin-bottom: 8px;
        }

        #successMessage {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: auto;
            min-width: 250px;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            display: none;
        }

        .upload-area {
            width: 180px;
            height: 180px;
            border: 2px dashed #ccc;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #777;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
            transition: border-color 0.3s, background-color 0.3s;
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .upload-area.dragover {
            border-color: #198754;
            background-color: #e6f4ea;
        }

        .upload-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .remove-icon {
            position: absolute;
            top: 28px;
            right: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
            z-index: 10;
        }

        .upload-area.has-image .remove-icon {
            visibility: visible;
        }

        input[type="file"] {
            display: none;
        }

        .image-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translate(-50%, -10px);
            /* Center horizontally and start slightly above */
            min-width: 300px;
            max-width: 80%;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            text-align: center;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        /* When showing message */
        .image-message.show {
            opacity: 1;
            transform: translate(-50%, 0);
            /* Slide down smoothly */
        }

        /* Optional for better color contrast */
        .alert-success {
            background-color: #28a745 !important;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545 !important;
            color: #fff;
        }
        .border-primary{
            border: 2px solid #333 !important;
            border-radius: 20px !important;
        }
        .btn-detail-light:hover, .active-btn {
            border-left: solid 2px rgba(254, 254, 254, 0.025) !important; 
            border-right: solid 2px rgba(250, 250, 250, 0.064) !important;
            border-bottom: solid 2px rgba(217, 218, 220, 0.066) !important; 
            color: rgb(0, 0, 0) !important;
            border-radius: 2px; 
        }
        @media (max-width: 768px) {
            .btn-detail-light {
                white-space: nowrap !important;
            }
        }
    </style>
    <div class="container mt-lg-5 mt-0">
        <br>
         <h5 class="text-center stu-name">
            និស្សិត upload រូបថត 4x6 ផ្ទៃពណ៌ខៀវ ដើម្បីធ្វើកាត សម្រាប់សិក្សាឆ្នាំ ២០២៥-២០២៦។
        </ហ>
        <div class="row p-3 mt-lg-5 mt-0">
            <div class="col-12 col-lg-4 p-1 border-primary border-3 border rounded-2">
                <div class="d-flex justify-content-center align-items-center ">
                    <div>
                        <div class="upload-area" id="uploadArea" data-student-code="{{ $student->code }}">
                            <span id="uploadText"
                                style="{{ $student_pic ? 'display:none;' : 'display:block;' }}">
                                ចុចដើម្បីបញ្ចូលរូបភាព <i class="bi bi-cloud-upload fs-5"></i>
                            </span>
                            <img id="previewImage"
                                src="{{ $student_pic ? asset('uploads/student/' . $student_pic) : '' }}"
                                alt="" style="{{ $student_pic ? 'display:block;' : 'display:none;' }}">
                            {{-- <button type="button" class="remove-icon" id="removeImage"
                                style="{{ $student->student_profile ? 'display:block;z-index:9999' : 'display:none;' }}">&times;</button> --}}
                            <input type="file" name="student-profile" id="fileInput" accept="image/*">
                        </div>

                        <h3 id="name_{{ $student->code }}" class="stu-name mt-2 text-center">{{ $student->name_2 }}</h3>
                    </div>
                </div>
                <div class="border-top border-3">
                    <div class="d-flex justify-content-between info-stu mt-1 text-start">
                        <p class="fw-bold">អត្តលេខៈ</p>
                        <p id="code_{{ $student->code }}">{{ $student->code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">ក្រុមៈ</p>
                        <p id="class_{{ $student->code }}">{{ $student->class_code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">ជំនាញៈ</p>
                        <p id="skill_{{ $student->code }}" class="text-break text-end">{{ $student->skill->name_2 ?? '' }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">កម្រិតៈ</p>
                        <p id="qualification_{{ $student->code }}">{{ $student->qualification }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">វេនសិក្សាៈ</p>
                        <p id="section_name_{{ $student->code }}">{{ $student->section->name_2 ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 mt-3 mt-lg-0 border-primary border-3 border rounded-2">
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between gap-2">
                    <div class="btn btn-detail-light fw-bold active-btn" id="btn-personal">
                        ព័ត៌មានផ្ទាល់ខ្លួន
                    </div>
                    <div class="btn btn-detail-light fw-bold gap-2" id="btn-guardian">
                        ព័ត៌មានអាណាព្យាបាល
                    </div>
                    @if(isset($_GET['admin-card']) && $_GET['admin-card'] == 'admin')
                        <div class="btn btn-detail-light fw-bold gap-2" id="btn">
                            <button type="button" class="btn btn-primary me-3 font-in-modal" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                កែប្រែ
                            </button>
                        </div>
                    @endif
                </div>

                <div id="personal-info" class="content-section">
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">គោត្តនាម និងនាមៈ</p>
                        <p id="name_{{ $student->code }}">{{ $student->name_2 }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះឡាតាំងៈ</p>
                        <p id="nameEn_{{ $student->code }}">{{ $student->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ថ្ងៃខែឆ្នាំកំណើតៈ</p>
                        <p id="dob_{{ $student->code }}">{{ $student->date_of_birth }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ថ្នាក់ / ក្រុមៈ</p>
                        <p id="class_{{ $student->code }}">{{ $student->class_code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p id="phone_{{ $student->code }}">{{ $student->phone_student }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ជំនាញៈ</p>
                        <p id="skill_{{ $student->code }}">{{ $student->skill->name_2 ?? '' }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">អ៊ីមែលៈ</p>
                        <p id="email_{{ $student->code }}">N/A</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ភេទៈ</p>
                        <p id="gender_{{ $student->code }}">{{ $student->gender }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">អាស័យ​ដ្ឋាន​បច្ចុប្បន្នៈ</p>
                        <p id="address_{{ $student->code }}" class="text-break">{{ $student->student_address }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">ដេប៉ាតឺម៉ង់ៈ</p>
                        <p id="department_{{ $student->code }}" class="text-break">{{ $student->department->name_2 ??""  }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">កាលបរិច្ចេទសុពលភាពៈ</p>
                        <p id="expire_{{ $student->code }}">{{ $student->expire_date }}</p>
                    </div>
                </div>

                <div id="guardian-info" class="content-section d-none">
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះឪពុកៈ</p>
                        <p id="father_{{ $student->code }}">{{ $student->father_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p id="father_phone_{{ $student->code }}">
                            {{ $student->father_phone == '' ? ($student->mother_phone == '' ? 'N/A' : $student->mother_phone) : $student->father_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p id="father_occupation_{{ $student->code }}">{{ $student->father_occupation }}</p>
                    </div>
                    <div class="border-top border-primary border-3"></div>
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះម្ដាយៈ</p>
                        <p id="mother_{{ $student->code }}">{{ $student->mother_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p id="mother_phone_{{ $student->code }}">
                            {{ $student->mother_phone == '' ? ($student->father_phone == '' ? 'N/A' : $student->father_phone) : $student->mother_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p id="mother_occupation_{{ $student->code }}">{{ $student->mother_occupation }}</p>
                    </div>
                    <div class="border-top border-primary border-3"></div>
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">អាណាព្យាបាលៈ</p>
                        <p id="guardian_{{ $student->code }}">{{ $student->guardian_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p id="guardian_phone_{{ $student->code }}">
                            {{ $student->guardian_phone == '' ? 'N/A' : $student->guardian_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p id="guardian_occupation_{{ $student->code }}">
                            {{ $student->guardian_occupation == '' ? 'N/A' : $student->guardian_occupation }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">អាសយដ្ឋានៈ</p>
                        <p id="guardian_address_{{ $student->code }}">
                            {{ $student->guardian_address == '' ? 'N/A' : $student->guardian_address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-4">
            {{-- <button type="button" class="btn btn-primary me-3 font-in-modal" data-bs-toggle="modal"
                data-bs-target="#editStudentModal">
                កែប្រែ
            </button> --}}
            {{-- <a href="/register-card-student" class="btn btn-primary font-in-modal">ត្រឡប់</a> --}}
        </div>
    </div>
    <!--doas message-->
    <div class="text-center">
        <div id="image-success" class="image-message alert alert-success text-center text-white" style="display: none;">
        </div>
        <div id="image-fail" class=" image-message alert alert-danger text-center text-white" style="display: none;">
        </div>
    </div>
    <!--end doas message-->
    <script>
        const studentData = @json($student);
        console.log('Student data:', studentData);

        const personalBtn = document.getElementById("btn-personal");
        const guardianBtn = document.getElementById("btn-guardian");
        const personalInfo = document.getElementById("personal-info");
        const guardianInfo = document.getElementById("guardian-info");

        personalBtn.addEventListener("click", () => {
            personalInfo.classList.remove("d-none");
            guardianInfo.classList.add("d-none");
            personalBtn.classList.add("active-btn");
            guardianBtn.classList.remove("active-btn");
        });
        guardianBtn.addEventListener("click", () => {
            guardianInfo.classList.remove("d-none");
            personalInfo.classList.add("d-none");
            guardianBtn.classList.add("active-btn");
            personalBtn.classList.remove("active-btn");
        });

        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const previewImage = document.getElementById('previewImage');
        const uploadText = document.getElementById('uploadText');
        const removeImage = document.getElementById('removeImage');
        const uploadStatus = document.getElementById('successMessage');

        const studentCode = uploadArea.dataset.studentCode;

        uploadArea.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', e => handleFiles(e.target.files));

        uploadArea.addEventListener('dragover', e => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));

        uploadArea.addEventListener('drop', e => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        removeImage.addEventListener('click', e => {
            e.stopPropagation();
            previewImage.src = '';
            previewImage.style.display = 'none';
            uploadText.style.display = 'block';
            removeImage.style.display = 'none';
            fileInput.value = '';
        });

        function handleFiles(files) {
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    uploadText.style.display = 'none';
                    removeImage.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);

                uploadImage(file);
            }
        }

        const imageMessageSuccess = document.getElementById('image-success');
        const imageMessageFail = document.getElementById('image-fail');

        function uploadImage(file) {
            const formData = new FormData();
            formData.append('image', file);

            if (uploadStatus) uploadStatus.textContent = 'កំពុងផ្ទុករូបភាព...';

            $.ajax({
                url: `/upload-profile/${studentCode}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        // ✅ Success alert
                        Swal.fire({
                            title: "Ntti Portal",
                            text: data.message,
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "យល់ព្រម"
                        });

                        // Update preview
                        previewImage.src = data.path + '?t=' + new Date().getTime();
                        previewImage.style.display = 'block';
                        uploadText.style.display = 'none';
                        removeImage.style.display = 'inline-block';

                    } else {
                        // ⚠️ Server responded but failed
                        Swal.fire({
                            title: "កំហុស!",
                            text: data.message || '❌ មានបញ្ហាក្នុងការផ្ទុករូបភាព។',
                            icon: "error",
                            confirmButtonColor: "#d33",
                            confirmButtonText: "យល់ព្រម"
                        });
                    }
                },
                error: function (xhr) {
                    // 🟥 Handle validation or system errors
                    let message = '❌ កំហុសក្នុងការផ្ទុក!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        title: "កំហុស!",
                        text: message,
                        icon: "error",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "យល់ព្រម"
                    });
                },
                complete: function () {
                    if (uploadStatus) uploadStatus.textContent = '';
                }
            });
        }


        function showImageMessage(type, message) {
            const successEl = imageMessageSuccess;
            const failEl = imageMessageFail;
            successEl.classList.remove('show');
            failEl.classList.remove('show');

            if (type === 'success') {
                successEl.textContent = message;
                successEl.style.display = 'block';
                setTimeout(() => successEl.classList.add('show'), 10);
            } else {
                failEl.textContent = message;
                failEl.style.display = 'block';
                setTimeout(() => failEl.classList.add('show'), 10);
            }

            setTimeout(() => {
                successEl.classList.remove('show');
                failEl.classList.remove('show');
            }, 3000);
        }

        function handleFiles(files) {
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                const file = files[0];
                if (file.size > 2 * 1024 * 1024) {
                    showImageMessage('fail', '⚠ រូបភាពធំពេក (ត្រូវតែតិចជាង 2MB)!');
                    return;
                }

                const reader = new FileReader();

                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    uploadText.style.display = 'none';
                    removeImage.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);

                uploadImage(file);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const hasImage = previewImage.src && !previewImage.src.endsWith('/');
            if (hasImage) {
                console.log('Existing image path:', previewImage.src);
            } else {
                console.log('No existing image for this student.');
            }
        });
    </script>
@endsection
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-in-modal" id="editStudentModalLabel">កែប្រែព័ត៌មានសិស្ស</h5>
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('students.update', $student->code) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body font-in-modal">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">គោត្តនាម និងនាមៈ</label>
                            <input type="text" name="name_2" value="{{ $student->name_2 }}"
                                class="form-control" autocomplete="off" required>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ឈ្មោះឡាតាំងៈ</label>
                            <input type="text" name="name" autocomplete="off" value="{{ $student->name }}"
                                class="form-control" required>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ភេទៈ</label>
                            <select name="gender" class="form-select" required>
                                <option value="">-- ជ្រើសរើសភេទ --</option>
                                <option value="ប្រុស" {{ $student->gender == 'ប្រុស' ? 'selected' : '' }}>ប្រុស
                                </option>
                                <option value="ស្រី" {{ $student->gender == 'ស្រី' ? 'selected' : '' }}>ស្រី
                                </option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ថ្ងៃខែឆ្នាំកំណើតៈ</label>
                           <input autocomplete="off" type="text" class="form-control form-control-sm" id="date_of_birth"
                            name="date_of_birth"
                            value="{{ isset($records->date_of_birth) ? \Carbon\Carbon::parse($records->date_of_birth)->format('d-m-Y') : '' }}"
                            min="1970-01-01" max="2010-12-31" placeholder="ថ្ងៃ-ខែ-ឆ្នាំកំណើត" aria-label="ថ្ងៃ-ខែ-ឆ្នាំកំណើត">
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">លេខទូរស័ព្ទៈ</label>
                            <input type="text" autocomplete="off" name="phone_student"
                                value="{{ $student->phone_student }}" class="form-control">
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">អាស័យដ្ឋានបច្ចុប្បន្នៈ</label>
                            <input type="text" autocomplete="off" name="student_address"
                                value="{{ $student->student_address }}" class="form-control">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ឈ្មោះឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_name" class="form-control"
                                value="{{ $student->father_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">លេខទូរស័ព្ទឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_phone" class="form-control"
                                value="{{ $student->father_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">មុខរបរ​ឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_occupation" class="form-control"
                                value="{{ $student->father_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ឈ្មោះម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_name" class="form-control"
                                value="{{ $student->mother_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">លេខទូរស័ព្ទម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_phone" class="form-control"
                                value="{{ $student->mother_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">មុខរបរ​ម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_occupation" class="form-control"
                                value="{{ $student->mother_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">ឈ្មោះអាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_name" class="form-control"
                                value="{{ $student->guardian_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">លេខទូរស័ព្ទអាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_phone" class="form-control"
                                value="{{ $student->guardian_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">មុខរបរ​អាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_occupation" class="form-control"
                                value="{{ $student->guardian_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label">អាស័យដ្ឋាន​អាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_address" class="form-control"
                                value="{{ $student->guardian_address }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary">រក្សាទុក</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="successMessage" class="alert alert-success text-center" style="display: none;">
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#date_of_birth').on('input', function () {
      // Allow only numeric characters and specific symbols (-, ., /)
      let rawValue = $(this).val().replace(/[^0-9\-\.\/]/g, ''); 

      // Update the input value with the cleaned value
      $(this).val(rawValue);

      // Check if rawValue contains invalid characters
      if (/[^0-9\-\.\/]/.test($(this).val())) {
          notyf.error("សូមវាយលេខ (0-9) និងសញ្ញា (-, ., /)!");
          return;
      }
      // Process input only if the raw numeric length is exactly 8 (ddmmyyyy)
      const numericValue = rawValue.replace(/[^0-9]/g, ''); // Remove symbols to check numeric length
      if (numericValue.length === 8) {
        const day = numericValue.substring(0, 2);
        const month = numericValue.substring(2, 4);
        const year = numericValue.substring(4, 8);

        // Validate date components
        const isValidDate = validateDate(day, month, year);

        if (isValidDate) {
            const formattedDate = `${day}-${month}-${year}`;
            $(this).val(formattedDate);
            $('#error_message').text(''); 
        } else {
            notyf.error("សូម ពិនិត្យមើល ថ្ងៃខែឆ្នាំម្ដងទៀត​!");
        }
      }
    });
    $('#editStudentModal form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#editStudentModal').modal('hide');

                let student = response.student;
                let code = student.code;

                // Update personal info
                $('#name_' + code).text(student.name_2);
                $('#nameEn_' + code).text(student.name);
                $('#dob_' + code).text(student.date_of_birth);
                $('#class_' + code).text(student.class_code);
                $('#phone_' + code).text(student.phone_student);
                $('#skill_' + code).text(student.skill_name);
                $('#gender_' + code).text(student.gender);
                $('#address_' + code).text(student.student_address);
                $('#department_' + code).text(student.department_name);
                $('#expire_' + code).text(student.expire_date);

                // Update guardian info
                $('#father_' + code).text(student.father_name);
                $('#father_phone_' + code).text(student.father_phone || 'N/A');
                $('#father_occupation_' + code).text(student.father_occupation || 'N/A');

                $('#mother_' + code).text(student.mother_name);
                $('#mother_phone_' + code).text(student.mother_phone || 'N/A');
                $('#mother_occupation_' + code).text(student.mother_occupation || 'N/A');

                $('#guardian_' + code).text(student.guardian_name);
                $('#guardian_phone_' + code).text(student.guardian_phone || 'N/A');
                $('#guardian_occupation_' + code).text(student.guardian_occupation || 'N/A');
                $('#guardian_address_' + code).text(student.guardian_address || 'N/A');

                // Show success message
                $('#successMessage')
                    .text('ទិន្នន័យត្រូវបាន​ updated!')
                    .fadeIn();

                setTimeout(function() {
                    $('#successMessage').fadeOut();
                }, 2000);
            },
            error: function(xhr) {
                alert('Error updating student');
            }
        });
    });
</script>
