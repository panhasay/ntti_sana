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

use App\Models\General\ExamSchedule;
use App\Http\Controllers\Certificates\CertificateController;
use App\Http\Controllers\General\StudentSanaController;
use App\Http\Controllers\General\TransferController;
use App\Http\Controllers\Report\ReportListOfStudentClassAndSectionController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'kh'])) {
        abort(400);
    }
    App::setLocale($locale);
    // ...
    // Route::get('department', [AuthController::class, 'department']);
});
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/thank-you-for-submit', function () {
        return view('/system.thank_you_for_submit');
    });
    Route::get('/menu-reports', function () {
        return view('general.main_menu_report');
    });
    Route::get('user-dont-have-permission', function () {
        return view('errors.permission_acces');
    });


        // Login Route
    // Route::post('login', [AuthController::class, 'login'])->middleware('limit.logins')->name('login.post');

    // Blocked Route
    Route::get('/login-blocked', function () {
        return view('errors.login_block'); // Create a view to show the blocked message
    })->name('login.blocked');

    Route::get('/return-login', [AuthController::class, 'returnlogin'])->name('returnlogin');


    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->middleware('limit.logins')->name('login.post');
    Route::get('registration_hole', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
   
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['perfix' => 'department', 'middleware' => 'user_permission'], function (){
    Route::get('/department-menu', [AuthController::class, 'departmentMenu']);
});
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
    Route::get('reports-list-of-student-priview', [ReportFirstYearStudentRegistrationController::class, 'Priview'])->name('Priview');
    Route::get('reports-list-of-student-print', [ReportFirstYearStudentRegistrationController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ReportFirstYearStudentRegistrationController::class, 'export']);
})->middleware('auth');

Route::group(['perfix' => 'dashboard'], function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
    // Route::get('reports-list-of-student-priview', [DashboardController::class, 'Priview'])->name('Priview');
    Route::get('dahhboard-student-print', [DashboardController::class, 'Print'])->name('Print');
    // Route::get('dashboard-student-account', [DashboardController::class, 'StudentUserAccount'])->name('StudentUserAccount');
    Route::get('teacher-dashboard', [DashboardController::class, 'TeacherDashboard'])->name('TeacherDashboard');
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
});
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
    // Route::get('departments/transaction', [UsersController::class, 'transaction'])->name('transaction');
    // Route::post('departments/update', [UsersController::class, 'update'])->name('update');
    // Route::post('departments/store', [UsersController::class, 'store'])->name('store');
})->middleware('auth');

Route::group(['perfix' => 'table'], function (){
    Route::get('/menu-search', [SystemSettingController::class, 'pageSearch']);
    Route::get('/settings-customize-fields', [SystemSettingController::class, 'SettingsCustomizeField']);
    Route::get('/system/avanceSearch/{page}',[SystemSettingController::class, 'AvanceSearch']);
    Route::get('/system/live-Search/{page}',[SystemSettingController::class, 'LiveSearch']);
})->middleware('auth');


Route::group(['perfix' => 'classes'], function (){
    Route::get('/classes', [ClassesController::class, 'index']);
    Route::get('/classes/transaction', [ClassesController::class, 'transaction']);
    Route::post('/classes/update', [ClassesController::class, 'update']);
    Route::post('/classes/store', [ClassesController::class, 'store']);
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
})->middleware('auth');
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/dashboards-attendance', [AttendanceController::class, 'index']);

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

Route::group(['perfix' => 'exam-schedule'], function (){
    Route::get('/exam-schedule',[ExamScheduleController::class,'index']);
    Route::get('/exam-schedule/transaction', [ExamScheduleController::class, 'transaction']);
    Route::post('/exam-schedule/update', [ExamScheduleController::class, 'update']);
    Route::post('/exam-schedule/store', [ExamScheduleController::class, 'store']);
    Route::get('/exam-schedule/create', [ExamScheduleController::class, 'GetDataForCreateExamSchedule'])->name('exam.schedule.create');
    Route::post('/exam-schedule/save', [ExamScheduleController::class, 'SaveExamSchedule'])->name('save.exam.schedule');
    Route::get('/get-exam-schedules', [ExamScheduleController::class, 'getSchedules'])->name('get.exam.schedules');
    Route::post('/exam-schedule/update/{id}', [ExamScheduleController::class, 'updateExamSchedule']);
    Route::post('/exam-schedule/upload-document', [ExamScheduleController::class, 'uploadDocument'])->name('exam-schedule.upload-document');
    Route::get('/exam-schedule/view-pdf/{filename}', [ExamScheduleController::class, 'viewPdf'])->name('viewPdf');
    Route::delete('/exam-schedule/delete/{id}', [ExamScheduleController::class, 'deleteExamSchedule']);
    Route::post ('/exam-schedule/save-schedule', [ExamScheduleController::class, 'SaveSchedule']);
    Route::get('/exam-schedule-print',[ExamScheduleController::class,'printLine']);
})->middleware('auth');

Route::group(['prefix' => 'certificate', 'middleware' => 'auth'], static function () {
    Route::controller(CertificateController::class)->group(function () {
        Route::post('/level_shift_skill', 'showLevelShiftSkill');
    });
});

Route::group(['prefix' => 'certificate', 'middleware' => 'auth'], static function () {
    Route::controller(CertificateController::class)->group(function () {
        Route::get('/dept-menu', 'index')->name('cert.dept_menu');
        Route::get('/dept-menu/{dept_code}', 'showMenuModule')->where('dept_code', '[A-Z_]+')->name('cert.dept.list');

        $subModules = DB::table('cert_sub_module')->where('active', 1)->whereNotNull('route')->get();
        foreach ($subModules as $item) {
            Route::get('/{dept_code}' . '/' . $item->route . '/{module_code}', $item->controller)->name('certificate.' . $item->route);
        }

        Route::prefix('student')->group(function () {
            Route::post('/bar', 'getStudentPieBarChartData');
        });

        Route::post('/level_shift_skill', 'showLevelShiftSkill');
        Route::post('/card_view', 'showCardView');
        Route::post('/card_view_list', 'showCardView');
        Route::post('/print_card', 'printCardStudent');
        Route::post('/card_view_info', 'showViewCardInformation');
        Route::post('/upload_student_info', 'updateCardInformation');
        Route::post('/disable_student_info', 'disableCardInformation');
        Route::post('/show_change_date_print_card', 'showChangeDatePrintCard');
        Route::post('/upload_zip_photo', 'uploadZip');
        Route::post('/upload_multiple_photo', 'uploadMultiplePhoto');
        Route::get('/print_card', static function () {
            return view('certificate/certificate_card_print_get');
        });
        Route::get('/print_card_pdf', 'printCardStudentPdf');
        Route::get('/D_IT/student_card/certificate/card-student-print', 'printListClassification');
        Route::get('/D_EL/student_card/certificate/card-student-print', 'printListClassification');
        Route::get('/D_CL/student_card/certificate/card-student-print', 'printListClassification');

        Route::get('/D_IT/student_card/certificate/card-student-excel', 'ExcelListClassification');
        Route::get('/D_EL/student_card/certificate/card-student-excel', 'ExcelListClassification');
        Route::get('/D_CL/student_card/certificate/card-student-excel', 'ExcelListClassification');
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
})->middleware('auth');

Route::group(['perfix' => 'report_list_of_student_class_and_section'], function (){
    Route::get('report_list_of_student_class_and_section', [ReportListOfStudentClassAndSectionController::class, 'index'])->name('index');
    Route::get('report_list_of_student_class_and_section-priview', [ReportListOfStudentClassAndSectionController::class, 'Priview'])->name('Priview');
    Route::get('report_list_of_student_class_and_section-print', [ReportListOfStudentClassAndSectionController::class, 'Print'])->name('Print');
    Route::get('reports-list-of-student-print/export/', [ReportListOfStudentClassAndSectionController::class, 'export']);
})->middleware('auth');

Route::group(['prefix' => 'student-sana'], function (){
    Route::get('/',[StudentSanaController::class,'index']);
    Route::get('/transaction', [StudentSanaController::class, 'transaction']);
    Route::post('/update', [StudentSanaController::class, 'update']);
    Route::post('/store', [StudentSanaController::class, 'store']);
    Route::POST ('/transfer-delete', [StudentSanaController::class, 'delete']);
})->middleware('auth');






