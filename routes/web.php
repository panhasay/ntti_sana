<?php
    use App\Http\Controllers\Admin\adminController;
    use App\Http\Controllers\General\ClassesController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\AuthController;
    use App\Http\Controllers\General\AssingClassesController;
    use App\Http\Controllers\General\AttendanceController;
    use App\Http\Controllers\General\ClassScheduleController;
    use App\Http\Controllers\General\DividedNewClassesController;
    use App\Http\Controllers\General\ExamScheduleController;
    use App\Http\Controllers\General\SkillsController;
    use App\Http\Controllers\Report\ListOfStudentController;
    use App\Http\Controllers\General\StudnetController;
    use App\Http\Controllers\General\SubjectsController;
    use App\Http\Controllers\General\TeacherController;
    use App\Http\Controllers\Report\ReportFirstYearStudentRegistrationController;
    use App\Http\Controllers\SystemSetup\DashboardController;
    use App\Http\Controllers\SystemSetup\DepartmentController;
    use App\Http\Controllers\SystemSetup\SystemSettingController;
    use App\Http\Controllers\SystemSetup\TableController;
    use App\Http\Controllers\SystemSetup\UsersController;
    use App\Models\General\DividedNewClasses;
    use GuzzleHttp\Middleware;
    use Illuminate\support\Facades\App;
    use App\Http\Controllers\Report\ReportListTableStudentOfYearController;
    use App\Http\Controllers\General\ScoreController;
    use App\Models\General\ExamSchedule;
    use App\Http\Controllers\Certificates\CertificateController;
    use App\Http\Controllers\General\SectionsController;
    use App\Http\Controllers\General\StudentSanaController;
    use App\Http\Controllers\General\TransferController;
    use App\Http\Controllers\Report\ReportAttendanceController;
    use App\Http\Controllers\Report\ReportListOfStudentClassAndSectionController;
    use App\Http\Controllers\Report\ReportTotalScoreExamController;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Artisan;
    use App\Http\Controllers\General\ExamCreditController;
    use App\Http\Controllers\General\RetakeExamController;
Route::get('/clear-all', function() {
    Artisan::call('cache:clear');    
    Artisan::call('config:clear');   
    Artisan::call('route:clear');    
    Artisan::call('view:clear');     
    return 'All specific caches cleared!';
});

Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'kh'])) {
        abort(400);
    }
    App::setLocale($locale);
});
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/', [AuthController::class, 'HomeLogin'])->name('HomeLogin');
    Route::get('/thank-you-for-submit', function () {
        return view('/system.thank_you_for_submit');
    });
    Route::get('/menu-reports', function () {
        return view('general.main_menu_report');
    });
    Route::get('user-dont-have-permission', function () {
        return view('errors.permission_acces');
    });

    Route::get('/login-blocked', function () {
        return view('errors.login_block'); 
    })->name('login.blocked');

    Route::get('/return-login', [AuthController::class, 'returnlogin'])->name('returnlogin');

    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->middleware('limit.logins')->name('login.post');
    Route::get('registration_hole', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
   
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['perfix' => 'department', 'middleware' => 'user_permission'], function (){
    // Route::get('/department-menu', [AuthController::class, 'departmentMenu']);
    Route::get('/department-menu', [AuthController::class, 'departmentMenu'])->middleware('user_permission');
   
});
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot.password');
Route::group(['perfix' => 'student'], function (){
    Route::get('/student', [StudnetController::class, 'index'])->name('student');
    Route::get('/settings-customize-field', [StudnetController::class, 'SettingsCustomizeField'])->name('SettingsCustomizeField');
    Route::get('/student/print', [StudnetController::class, 'Print'])->name('Print');
    Route::post('/student/downlaodexcel', [StudnetController::class, 'downlaodexcel'])->name('downlaodexcel');
    Route::get('/student/transaction', [StudnetController::class, 'transaction'])->name('transaction');
    Route::get('/system/avanceSearch/student/ajaxpagination', [StudnetController::class, 'Ajaxpaginat'])->name('Ajaxpaginat');
    Route::get('/pusher/send-message', [StudnetController::class, 'sendmessage'])->name('sendmessage');
    Route::get('/system/avanceSearch/student/ajaxpagination', [StudnetController::class, 'Ajaxpaginat'])->name('Ajaxpaginat');
    Route::POST('/student/store',[StudnetController::class, 'store']);
    Route::POST('/student/delete',[StudnetController::class,'delete']);
    Route::POST('/student/update',[StudnetController::class,'update']);
    Route::get('/student/create-user-account',[StudnetController::class,'CreateUser']);
    Route::POST('/studnet/import-excel',[StudnetController::class,'ImportExcel']);
    Route::get('/manage-academic-work',[StudnetController::class,'ManageStudnetWork']);
    Route::get('/assign-classes',[StudnetController::class,'ManageAssignClasses']);
    Route::get('/student/getImage',[StudnetController::class,'GetImage']);
    Route::Post('/student/uploadimage',[StudnetController::class,'UploadImage']);
    Route::Post('/student/delete-image',[StudnetController::class,'DeleteImage']);
    Route::get('/students/list', [StudnetController::class, 'getStudents'])->name('students.list');
})->middleware('auth');

Route::group(['perfix' => 'table'], function (){
    Route::get('/table', [TableController::class, 'index']);
    Route::get('/table_field', [TableController::class, 'table_field']);
    Route::post('/build', [TableController::class, 'build']);
})->middleware('auth');

Route::group(['prefix' => 'table'], function () {
    Route::get('/table', [TableController::class, 'index']);
    Route::post('/add_table', [TableController::class, 'create']);
    Route::get('/table_field', [TableController::class, 'table_filed']);
    Route::post('/build', [TableController::class, 'build']);
    Route::get('/ajaxpagination', [TableController::class, 'Ajaxpaginat']);
})->middleware('auth');
// report
Route::group(['perfix' => 'reports-list-of-student'], function (){
    Route::get('reports-list-of-student', [ListOfStudentController::class, 'index'])->name('index');
    Route::get('reports-list-of-student-priview', [ListOfStudentController::class, 'Priview'])->name('Priview');
    Route::get('reports-list-of-student-print', [ListOfStudentController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ListOfStudentController::class, 'export']);
})->middleware('auth');

Route::group(['perfix' => 'report-first-year-student-registration'], function (){
    Route::get('report-first-year-student-registration', [ReportFirstYearStudentRegistrationController::class, 'index'])->name('index');
    Route::get('report-first-year-student-registration-priview', [ReportFirstYearStudentRegistrationController::class, 'Priview'])->name('Priview');
    Route::get('reports-list-of-student-print', [ReportFirstYearStudentRegistrationController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ReportFirstYearStudentRegistrationController::class, 'export']);
})->middleware('auth');

Route::group(['prefix' => 'dashboard','middleware' => 'user_permission'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('student-print', [DashboardController::class, 'Print'])->name('dashboard.print');
    // Route::get('teacher-dashboard', [DashboardController::class, 'TeacherDashboard'])->name('dashboard.teacherDashboard');
    // Route::get('teacher-management-class', [DashboardController::class, 'TeacherMmanagementClass'])->name('dashboard.teacherManagementClass');
   
});

     Route::get('dahhboard-student-account', [DashboardController::class, 'StudentUserAccount'])->name('dashboard.studentAccount');
 Route::get('teacher-dashboard', [DashboardController::class, 'TeacherDashboard'])->name('dashboard.teacherDashboard');
    Route::get('teacher-management-class', [DashboardController::class, 'TeacherMmanagementClass'])->name('dashboard.TeacherMmanagementClass');

Route::get('dsa', [DashboardController::class, 'StudentUserAccount'])->name('StudentUserAccount');
Route::group(['perfix' => 'department' ,  'middleware' => 'permission'], function (){
    Route::get('department-setup', [DepartmentController::class, 'index'])->name('index');
    Route::post('department-delete', [DepartmentController::class, 'delete'])->name('delete');
    Route::get('departments/transaction', [DepartmentController::class, 'transaction'])->name('transaction');
    Route::post('departments/update', [DepartmentController::class, 'update'])->name('update');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('store');
    Route::get('departments/print', [DepartmentController::class, 'Print'])->name('Print');

})->middleware('auth');
Route::group(['perfix' => 'Users'], function (){
    Route::get('users', [UsersController::class, 'index'])->name('index');
    Route::get('profile', [UsersController::class, 'Profile'])->name('Profile');
    Route::get('profile/reset-password', [UsersController::class, 'ResetPassword'])->name('ResetPassword');
    Route::GET('profile/update-information', [UsersController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::POST('profile/upload-img', [UsersController::class, 'UploadImages'])->name('UploadImages');
    Route::GET('users/transaction', [UsersController::class, 'transaction'])->name('transaction');
    Route::post('users/update', [UsersController::class, 'update'])->name('update');
    Route::post('users/store', [UsersController::class, 'store'])->name('store');
})->middleware('auth');

Route::group(['perfix' => 'table'], function (){
    Route::get('/menu-search', [SystemSettingController::class, 'pageSearch']);
    Route::get('/settings-customize-fields', [SystemSettingController::class, 'SettingsCustomizeField']);
    Route::get('/system/avanceSearch/{page}',[SystemSettingController::class, 'AvanceSearch']);
    Route::get('/system/avanceSearch-clear-data/{page}',[SystemSettingController::class, 'avanceSearchClearData']);
    Route::get('/system/live-Search/{page}',[SystemSettingController::class, 'LiveSearch']);
    Route::get('/system/class-get-data-group',[SystemSettingController::class, 'ClassGetData']);
    // Route::get('/', [SystemSettingController::class, 'index'])->name('locations.index');
    // Route::get('/districts', [SystemSettingController::class, 'districts'])->name('locations.districts');
    // Route::get('/communes', [SystemSettingController::class, 'communes'])->name('locations.communes');
    // Route::get('/villages', [SystemSettingController::class, 'villages'])->name('locations.villages');
})->middleware('auth');


Route::group(['perfix' => 'classes'], function (){
    Route::get('/classes', [ClassesController::class, 'index']);
    Route::get('/classes/transaction', [ClassesController::class, 'transaction']);
    Route::post('/classes/update', [ClassesController::class, 'update']);
    Route::post('/classes/store', [ClassesController::class, 'store']);
    Route::post('/classes-delete', [ClassesController::class, 'deleteCLASS']);
    Route::POST ('/class-schedule', [ClassesController::class, 'delete']);
})->middleware('auth');

Route::group(['perfix' => 'skills'], function (){
    Route::get('/skills', [SkillsController::class, 'index']);
    Route::get('/skills/transaction', [SkillsController::class, 'transaction']);
    Route::post('/skills/update', [SkillsController::class, 'update']);
    Route::post('/skills/store', [SkillsController::class, 'store']);
    Route::POST ('/skills-delete', [SkillsController::class, 'delete']);
})->middleware('auth');

Route::group(['perfix' => 'subject' ], function (){
    Route::get('/subject', [SubjectsController::class, 'index']);
    Route::get('/subjects/transaction', [SubjectsController::class, 'transaction']);
    Route::post('/subjects/update', [SubjectsController::class, 'update']);
    Route::post('/subjects/store', [SubjectsController::class, 'store']);
    Route::POST ('/subjects-delete', [SubjectsController::class, 'delete']);
})->middleware('auth');

Route::group(['perfix' => 'teachers' ], function (){
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/transaction', [TeacherController::class, 'transaction']);
    Route::post('/teachers/update', [TeacherController::class, 'update']);
    Route::post('/teachers/store', [TeacherController::class, 'store']);
    Route::POST ('/teachers-delete', [TeacherController::class, 'delete']);
    Route::get('/teachers/create-user-account',[TeacherController::class,'CreateUser']);
})->middleware('auth');

Route::group(['perfix' => 'teachers' ], function (){
    Route::get('/assign-classes', [AssingClassesController::class, 'index']);
    Route::get('/assign-classes/transaction', [AssingClassesController::class, 'transaction']);
    Route::post('/assign-classes/update', [AssingClassesController::class, 'update']);
    Route::get('/assing-studnet-to-class', [AssingClassesController::class, 'AssingStudentToClass']);
    Route::POST('/assign-student-line/update',[AssingClassesController::class,'UpdateStudentLine']);
    Route::get ('/assign-classes-delete-studnet-line', [AssingClassesController::class, 'DeleteStudentLine']);
    Route::get('/assign-student-line-by-code',[AssingClassesController::class,'AssingStudent']);
    Route::get('/assign-student-print-print',[AssingClassesController::class,'printLine']);
    Route::get('/create-assing-classeds-new',[AssingClassesController::class,'CreateNewAssingClasses']);
    Route::get('/get-attendant-student',[AssingClassesController::class,'GetAttendantStudent']);
    Route::get('/update-attendant-date-student',[AssingClassesController::class,'UpdateAttendantDateStudent']);
    Route::get('/supdate-attendant-score-student',[AssingClassesController::class,'UpdateAttendanScoretDateStudent']);
    Route::get('/assign-classes-update-examtype',[AssingClassesController::class,'UpdateExamType']);
    Route::get('/exam-results',[AssingClassesController::class,'ExamResults']);
    Route::get('/get-exam-results',[AssingClassesController::class,'GetExamResults']);
    Route::get('/get-exam-results-print-exam',[AssingClassesController::class,'PrintExamResults']);
    Route::get('/get-exam-results-excel-exam',[AssingClassesController::class,'ExcelExamResults']);
    Route::get('/assign-classes/downlaodexcel-line',[AssingClassesController::class,'DownlaodexcelLine']);
    Route::post('/update-score-student', [AssingClassesController::class, 'UpdateScoreStudent']);
})->middleware('auth');
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/dashboards-attendance', [AttendanceController::class, 'index']);
    Route::post('/submit-by-date', [AttendanceController::class, 'SumbitDocumentByDate']);
})->middleware('auth');
Route::group(['perfix' => '/class-schedule'], function (){
    Route::get('/class-schedule', [ClassScheduleController::class, 'index']);
    Route::get('/class-schedule/transaction', [ClassScheduleController::class, 'transaction']);
    Route::post('/class-schedule/update', [ClassScheduleController::class, 'update']);
    Route::post('/class-schedule/store', [ClassScheduleController::class, 'store']);
    Route::POST ('/class-schedule-delete', [ClassScheduleController::class, 'delete']);
    Route::POST ('/class-schedule/save-schedule', [ClassScheduleController::class, 'SaveSchedule']);
    Route::POST ('/class-schedule-delete-line', [ClassScheduleController::class, 'DeleteLine']);
    Route::get('/class-schedule-print',[ClassScheduleController::class,'printLine']);
    Route::get('/update/class-schedule/transaction',[ClassScheduleController::class,'EditTeacherSchedule']);
})->middleware('auth');

Route::group(['prefix' => '', 'middleware' => 'auth'], function () {
    Route::get('/student/registration', [StudnetController::class, 'StudentRegistration']);
    Route::get('/student/registration/transaction', [StudnetController::class, 'StudentRegistrationTransaction']);
    Route::post('/student/registration/store', [StudnetController::class, 'storeRegistration']);
    Route::post('/student/registration/update', [StudnetController::class, 'updateRegistration']);
    Route::get('/student/registration/prints', [StudnetController::class, 'PrintRegistration']);
    Route::post('/student/register/delete', [StudnetController::class, 'DeleteRegistration']);
    Route::get('/student/registration-downlaodexcel', [StudnetController::class, 'StudentDownlaodRegistrationDownlaodexcel']);
    Route::get('/student/scholarship', [StudnetController::class, 'IndexStudentScholarshipc']);
    Route::get('/student/registration-remaining', [StudnetController::class, 'StudentRemaining']);
    Route::get('/student/registration/loop-skill', [StudnetController::class, 'StudentLoopSkill']);
    Route::get('/student/registration/loop-class', [StudnetController::class, 'StudentLoopClass']);
});

Route::group(['perfix' => 'class-new'], function (){
    Route::get('/class-new',[DividedNewClassesController::class,'index']);
    Route::get('/class-new/transaction', [DividedNewClassesController::class, 'transaction']);
    Route::get('/class-new/get-student-register', [DividedNewClassesController::class, 'GEteStudentRegister']);
    Route::POST ('/class-new/add-student-register', [DividedNewClassesController::class, 'AddStudentRegister']);
    Route::POST('/class-new/add-student-register-deleteline',[DividedNewClassesController::class,'DeleteStudentRegisterDeleteline']);
    Route::get('/class-new-print', [DividedNewClassesController::class, 'ClassNewPrintLine']);
    Route::get('/class-new/transaction/download-excel', [DividedNewClassesController::class, 'ClassNewDownloadExcel']);
    Route::get('/class-new/transaction/update-student', [DividedNewClassesController::class, 'ClassNewUpdateStudent']);
    Route::POST('/class-new/student/registration/update', [DividedNewClassesController::class, 'ClassNewUpdateStudentTransaction']);
})->middleware('auth');

Route::group(['prefix' => 'certificate', 'middleware' => 'auth'], static function () {
    Route::controller(CertificateController::class)->group(function () {
        Route::post('/level_shift_skill', 'showLevelShiftSkill');
        Route::get('/get-date-card-due-date', 'GetDate');
        Route::get('/get-date-card-due-date', 'GetDate');
        Route::get('/D_IT/degree/MD_DE', 'IndexPrintCertificates');
        Route::get('/degree-print', 'CertificatesDegrePrints');
        Route::get('/degree-priview', 'CertificatesDegrePriview');
    });
});

Route::group(['prefix' => 'certificate', 'middleware' => 'auth'], static function () {
    Route::controller(CertificateController::class)->group(function () {
        Route::get('/dept-menu', 'index')->name('cert.dept_menu');
        Route::get('/dept-menu/{dept_code}', 'showMenuModule')->where('dept_code', '[A-Z_]+')->name('cert.dept.list');

        $subModules = DB::table('cert_sub_module')->where('active', 1)->whereNotNull('route')->get();
        Route::prefix('{dept_code}')->group(function () use ($subModules) {
            foreach ($subModules as $item) {
                Route::get($item->route . '/{module_code}', $item->controller)
                    ->name('certificate.' . $item->route);
            }
        });

        Route::prefix('student')->group(function () {
            Route::post('/bar', 'getStudentPieBarChartData');
        });

        Route::post('/level_shift_skill', 'showLevelShiftSkill');
        Route::post('/card_view', 'showCardView');
        Route::post('/card_view_list', 'showCardView');
        Route::post('/print_card', 'printCardStudent');
        Route::post('/print_card_revision', 'storePrintCardRevision');
        Route::post('/card_view_info', 'showViewCardInformation');
        Route::post('/upload_student_info', 'updateCardInformation');
        Route::post('/disable_student_info', 'disableCardInformation');
        Route::post('/show_change_date_print_card', 'showChangeDatePrintCard');
        Route::post('/upload_zip_photo', 'uploadZip');
        Route::post('/upload_multiple_photo', 'uploadMultiplePhoto');
        Route::post('/card_due_date', 'StoreDueDateSession');
        Route::post('/card_due_date_update', 'UpdateDueDateSession');
        Route::post('/card_total_student', 'showCardTotalStudent');
        
        // Route::get('/print_card', static function () {
        //     return view('certificate/certificate_card_print_get');
        // });

        Route::get('/print_card_pdf', 'printCardStudentPdf');
        Route::post('/card_due_expire', 'StoreDueDateExpireSession');
        Route::put('/card_due_expire_update', 'updateDueDateExpireSession');
        Route::post('/card_expire_show_level', 'showCardExpireLevel');
        Route::get('/student_card/transaction', 'printCardStudentPdf');
        Route::get('/D_IT/student_card/certificate/card-student-print', 'printListClassification');
        Route::get('/D_EL/student_card/certificate/card-student-print', 'printListClassification');
        Route::get('/D_CL/student_card/certificate/card-student-print', 'printListClassification');
        Route::get('/D_IT/student_card/certificate/card-student-excel', 'ExcelListClassification');
        Route::get('/D_EL/student_card/certificate/card-student-excel', 'ExcelListClassification');
        Route::get('/D_CL/student_card/certificate/card-student-excel', 'ExcelListClassification');
        Route::post('/student_card/expire/show', 'showExpireClass');
    });
});



Route::group(['prefix' => 'admin-panel', 'middleware' => 'auth'], static function () {
    Route::controller(adminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.ap');
        Route::post('/excute', 'show')->name('admin.ap.excute');
        Route::post('/excute-npm', 'showNPM')->name('admin.ap.excute-npm');
    });
});

Route::group(['prefix' => 'transfer'], function (){
    Route::get('/',[TransferController::class,'index']);
    Route::get('/transaction', [TransferController::class, 'transaction']);
    Route::post('/update', [TransferController::class, 'update']);
    Route::post('/store', [TransferController::class, 'store']);
    Route::POST ('/transfer-delete', [TransferController::class, 'delete']);
    Route::get ('/get-student/-hang_of_study', [TransferController::class, 'GetStudentHangOfStudy']);
    Route::POST ('/submit-student-request-hang-of-study', [TransferController::class, 'SubmitStudentRequestHangOfStudy']);
})->middleware('auth');

Route::group(['perfix' => 'report_list_of_student_class_and_section'], function (){
    Route::get('report_list_of_student_class_and_section', [ReportListOfStudentClassAndSectionController::class, 'index'])->name('index');
    Route::get('report_list_of_student_class_and_section-priview', [ReportListOfStudentClassAndSectionController::class, 'Priview'])->name('Priview');
    Route::get('report_list_of_student_class_and_section-print', [ReportListOfStudentClassAndSectionController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ReportListOfStudentClassAndSectionController::class, 'export']);
    Route::get('report_attendance_student', [ReportAttendanceController::class, 'index']);
})->middleware('auth');

Route::group(['prefix' => 'student-sana'], function (){
    Route::get('/',[StudentSanaController::class,'index']);
    Route::get('/transaction', [StudentSanaController::class, 'transaction']);
    Route::post('/update', [StudentSanaController::class, 'update']);
    Route::post('/store', [StudentSanaController::class, 'store']);
    Route::POST ('/transfer-delete', [StudentSanaController::class, 'delete']);
    Route::get ('/update/student-sana/transaction', [StudentSanaController::class, 'EcitStudentTransactionSana']);
    Route::get ('/edit/student-sana/transaction', [StudentSanaController::class, 'EcitStudentSana']);
    Route::get ('/save/update-student-sana', [StudentSanaController::class, 'SaveStudentSana']);
})->middleware('auth');

Route::group(['prefix' => 'report-total-score'], function (){
    Route::get('/',[ReportTotalScoreExamController::class,'index']);
    Route::get('/report-total-score-priview',[ReportTotalScoreExamController::class,'Priview']);
})->middleware('auth');

Route::get('/score', [ScoreController::class, 'index']);


Route::group(['perfix' => 'report_list_table_student_of_years'], function (){
    Route::get('report_list_table_student_of_years', [ReportListTableStudentOfYearController::class, 'index'])->name('index');
    Route::get('reports-list-of-student-priview', [ReportListTableStudentOfYearController::class, 'Priview'])->name('Priview');
    Route::get('reports-list-of-student-print', [ReportListTableStudentOfYearController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ReportListTableStudentOfYearController::class, 'export']);
})->middleware('auth');

Route::group(['prefix' => 'sections'], function () {
    Route::get('/', [SectionsController::class, 'index']);
    Route::get('/transaction', [SectionsController::class, 'transaction']);
    Route::post('/update', [SectionsController::class, 'update']);
    Route::post('/store', [SectionsController::class, 'store']);
    Route::post('/delete', [SectionsController::class, 'delete']);
})->middleware('auth');

Route::group(['perfix' => 'exam-schedule'], function () {
    Route::get('/exam-schedule', [ExamScheduleController::class, 'index']);
    Route::get('/exam-schedule/transaction', [ExamScheduleController::class, 'transaction']);
    Route::post('/exam-schedule/update', [ExamScheduleController::class, 'update']);
    Route::post('/exam-schedule/store', [ExamScheduleController::class, 'store']);
    Route::post('/exam-schedule/save', [ExamScheduleController::class, 'saveExamSchedule'])->name('save.exam.schedule');
    Route::post('/exam-schedule/delete-both-sessions', [ExamScheduleController::class, 'deleteBothSessions'])->name('delete.both.sessions');
    // Route::post('/exam-schedule/update/{id}', [ExamScheduleController::class, 'updateExamSchedule']);
    // Route::delete('/exam-schedule/delete/{id}', [ExamScheduleController::class, 'deleteExamSchedule']);
    Route::post('/exam-schedule/upload-document', [ExamScheduleController::class, 'uploadDocument'])->name('exam-schedule.upload-document');
    // Route::get('/exam-schedule/view-pdf/{filename}', [ExamScheduleController::class, 'viewPdf'])->name('viewPdf');
    Route::get('/exam-schedule-print', [ExamScheduleController::class, 'printLine']);
    // Route::post('/exam-schedule/confirm-print', [ExamScheduleController::class, 'confirmPrint'])->name('exam-schedule.confirm-print');
    // In web.php (routes file)
    // Route::delete('/exam-schedule/delete-multiple', [ExamScheduleController::class, 'destroyMultiple'])->name('exam-schedule-multi-delete');
    Route::post('/exam-schedule-print-multiple', [ExamScheduleController::class, 'printMultiple']);
    Route::get('/exam-schedule/get-schedule/{id}', [ExamScheduleController::class, 'getSchedule']);
    Route::get('/exam-schedule/get-assigned-teachers-subjects/{classCode}/{year}/{sessionYear}/{sectionCode}/{semester}/{level}/{skills_code}/{department_code}', [ExamScheduleController::class, 'getAssignedTeachersAndSubjects']);
    Route::post('/save-exam-date-khmer', [ExamScheduleController::class, 'saveExamDateKhmer'])->name('save-exam-date-khmer');
    Route::post('/save-exam-date-khmer-multiple', [ExamScheduleController::class, 'saveExamDateKhmerMultiple'])->name('exam-schedule.save-date-khmer-multiple');
    Route::POST('/exam-schedule-delete', [ExamScheduleController::class, 'delete'])->name('exam-schedule-delete');
    Route::post('/exam-schedule/delete-session', [ExamScheduleController::class, 'deleteSession'])->name('exam.schedule.delete.session');
    Route::get('/exam-schedule/get-all-teachers', [ExamScheduleController::class, 'getAllTeachers']);
    Route::post('/exam-schedule/update-date', [ExamScheduleController::class, 'updateDate'])->name('exam.schedule.update.date');
})->middleware('auth');

Route::group(['prefix' => 'exam-credit',], function () {
    Route::get('/', [ExamCreditController::class, 'index']);
    Route::get('/results', [ExamCreditController::class, 'examCreditResult'])->name('exam-credit.results');
    Route::get('/get-student-detail', [ExamCreditController::class, 'GetStudentDetail'])->name('get-student-detail');
    Route::get('/print-attendance-list',[ExamCreditController::class,'printAttedanceList']);
    Route::get('/attendance-list',[ExamCreditController::class,'attendanceList']);
    Route::get('/attendance-list-monthly',[ExamCreditController::class,'attendenceListMonthly']);
    Route::get('/attendance-list/download-excel', [ExamCreditController::class, 'attendanceListExcel']);
    Route::get('/print-attendance-list-monthly',[ExamCreditController::class,'printAttedanceListMonthly']);
    Route::get('/attendance-monthly/download-excel', [ExamCreditController::class, 'downloadAttedanceListMonthly']);
    Route::get('/exam-student-list',[ExamCreditController::class,'examCreditStudentList']);
    Route::post('/print-exam-student-list',[ExamCreditController::class,'printExamCreditStudentList']);
    Route::post('/assign-score', [ExamCreditController::class, 'assignScore'])->name('exam-credit.assign-score');
    Route::get('/assign-score/preview', [ExamCreditController::class, 'assignScorePreview'])->name('exam-credit.assign-score.preview');
    Route::post('/print-assign-score', [ExamCreditController::class, 'printAssignScore'])->name('exam-credit.print-assign-score');
    Route::post('/assign-score/export-excel', [ExamCreditController::class, 'assignScoreExcel'])->name('assign-score.export.excel');
    Route::get('/search-attendance', [ExamCreditController::class, 'liveSearchAttendance'])->name('exam-credit.search');
})->middleware('auth');

Route::group(['prefix' => 'retake-exam'],function(){
    Route::get('/', [RetakeExamController::class, 'index'])->name('retake.exam');
    Route::get('/live-search', [RetakeExamController::class, 'liveSearch'])->name('retake.exam.live.search');
    Route::post('/print-print-list', [RetakeExamController::class, 'printList'])->name('retake.exam.print.ajax');
    Route::get('/export-excel', [RetakeExamController::class, 'exportExcel'])->name('retake.exam.export');
    Route::get('/score/input', [ScoreController::class, 'input'])->name('score.input');
})->middleware('auth');

