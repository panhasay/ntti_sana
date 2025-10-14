@extends('app_layout.card_student_layout')
@section('content')
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
    </style>
    <div class="container mt-lg-5 mt-0">
        <div class="row p-3 mt-lg-5 mt-0">
            <div class="col-12 col-lg-4 p-1 border-primary border-3 border rounded-2">
                <div class="text-center">
                    <img src="{{ asset('asset/NTTI/NTTI.png') }}" alt="" class="card-student">
                    <h3 class="stu-name py-1">{{ $student->name_2 }}</h3>
                </div>
                <div class="border-top border-primary border-3 p-2">
                    <div class="d-flex justify-content-between info-stu mt-1 text-start">
                        <p class="fw-bold">អត្តលេខៈ</p>
                        <p>{{ $student->code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">ក្រុមៈ</p>
                        <p>{{ $student->class_code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">ជំនាញៈ</p>
                        <p class="text-break text-end">{{ $student->skill_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">កម្រិតៈ</p>
                        <p>{{ $student->qualification }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu">
                        <p class="fw-bold">វេនសិក្សាៈ</p>
                        <p>{{ $student->section_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 mt-3 mt-lg-0 border-primary border-3 border rounded-2">
                <div class="btn btn-detail-light fw-bold active-btn" id="btn-personal">
                    ព័ត៌មានផ្ទាល់ខ្លួន
                </div>
                <div class="btn btn-detail-light fw-bold" id="btn-guardian">
                    ព័ត៌មានអាណាព្យាបាល
                </div>

                <div id="personal-info" class="content-section">
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">គោត្តនាម និងនាមៈ</p>
                        <p>{{ $student->name_2 }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះឡាតាំងៈ</p>
                        <p>{{ $student->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ថ្ងៃខែឆ្នាំកំណើតៈ</p>
                        <p>{{ $student->date_of_birth }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ថ្នាក់ / ក្រុមៈ</p>
                        <p>{{ $student->class_code }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p>{{ $student->phone_student }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ជំនាញៈ</p>
                        <p>{{ $student->skill_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">អ៊ីមែលៈ</p>
                        <p>N/A</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">ភេទៈ</p>
                        <p>{{ $student->gender }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">អាស័យ​ដ្ឋាន​បច្ចុប្បន្នៈ</p>
                        <p class="text-break">{{ $student->student_address }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">ដេប៉ាតឺម៉ង់ៈ</p>
                        <p class="text-break">{{ $student->department_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-end">
                        <p class="fw-bold text-nowrap me-2">កាលបរិច្ចេទសុពលភាពៈ</p>
                        <p>{{ $student->expire_date }}</p>
                    </div>
                </div>

                <div id="guardian-info" class="content-section d-none">
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះឪពុកៈ</p>
                        <p>{{ $student->father_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p>{{ $student->father_phone == '' ? ($student->mother_phone == '' ? 'N/A' : $student->mother_phone) : $student->father_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p>{{ $student->father_occupation }}</p>
                    </div>
                    <div class="border-top border-primary border-3"></div>
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">ឈ្មោះម្ដាយៈ</p>
                        <p>{{ $student->mother_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p>{{ $student->mother_phone == '' ? ($student->father_phone == '' ? 'N/A' : $student->father_phone) : $student->mother_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p>{{ $student->mother_occupation }}</p>
                    </div>
                    <div class="border-top border-primary border-3"></div>
                    <div class="d-flex justify-content-between info-stu mt-3 text-start">
                        <p class="fw-bold text-nowrap">អាណាព្យាបាលៈ</p>
                        <p>{{ $student->guardian_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">លេខទូរស័ព្ទៈ</p>
                        <p>{{ $student->guardian_phone == '' ? 'N/A' : $student->guardian_phone }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">មុខរបរៈ</p>
                        <p>{{ $student->guardian_occupation == '' ? 'N/A' : $student->guardian_occupation }}</p>
                    </div>
                    <div class="d-flex justify-content-between info-stu text-start">
                        <p class="fw-bold text-nowrap">អាសយដ្ឋានៈ</p>
                        <p>{{ $student->guardian_address == '' ? 'N/A' : $student->guardian_address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center py-2">
            <button type="button" class="btn btn-primary me-3 font-in-modal" data-bs-toggle="modal"
                data-bs-target="#editStudentModal">
                កែប្រែ
            </button>
            <a href="/register-card-student" class="btn btn-primary font-in-modal">ត្រឡប់</a>
        </div>
    </div>
    <script>
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
    </script>
@endsection
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
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
                            <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}"
                                class="form-control" autocomplete="off">
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
                            <label class="fw-bold">ឈ្មោះឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_name" class="form-control"
                                value="{{ $student->father_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">លេខទូរស័ព្ទឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_phone" class="form-control"
                                value="{{ $student->father_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">មុខរបរ​ឪពុក:</label>
                            <input type="text" autocomplete="off" name="father_occupation" class="form-control"
                                value="{{ $student->father_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">ឈ្មោះម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_name" class="form-control"
                                value="{{ $student->mother_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">លេខទូរស័ព្ទម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_phone" class="form-control"
                                value="{{ $student->mother_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">មុខរបរ​ម្ដាយ:</label>
                            <input type="text" autocomplete="off" name="mother_occupation" class="form-control"
                                value="{{ $student->mother_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">ឈ្មោះអាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_name" class="form-control"
                                value="{{ $student->guardian_name }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">លេខទូរស័ព្ទអាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_phone" class="form-control"
                                value="{{ $student->guardian_phone }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">មុខរបរ​អាណាព្យាបាល:</label>
                            <input type="text" autocomplete="off" name="guardian_occupation" class="form-control"
                                value="{{ $student->guardian_occupation }}">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="fw-bold">អាស័យដ្ឋាន​អាណាព្យាបាល:</label>
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
                $('#gender_' + response.student.code).text(response.student.gender);
                $('#successMessage')
                    .text('ទិន្នន័យត្រូវបាន​ updated!')
                    .fadeIn();
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr) {
                alert('Error updating student');
            }
        });
    });
</script>
