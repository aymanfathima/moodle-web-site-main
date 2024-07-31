<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::post('/add_contact_us', [App\Http\Controllers\HomeController::class, 'add_contact_us'])->name('add_contact_us');

Route::post('/download', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');


Route::post('/get_all_users', [App\Http\Controllers\ApiController::class, 'get_all_users'])->name('get_all_users');
Route::post('/get_user_messages', [App\Http\Controllers\ApiController::class, 'get_user_messages'])->name('get_user_messages');
Route::post('/send_message', [App\Http\Controllers\ApiController::class, 'send_message'])->name('send_message');
Route::post('/send_msg_all_students', [App\Http\Controllers\ApiController::class, 'send_msg_all_students'])->name('send_msg_all_students');
Route::post('/send_msg_all_teachers', [App\Http\Controllers\ApiController::class, 'send_msg_all_teachers'])->name('send_msg_all_teachers');


Route::middleware(['guest'])->group(function () {
    Route::get('/student-login', [App\Http\Controllers\AuthController::class, 'student_login'])->name('student_login');
    Route::post('/student-login', [App\Http\Controllers\AuthController::class, 'student_login_post'])->name('student_login_post');

    Route::get('/teacher-login', [App\Http\Controllers\AuthController::class, 'teacher_login'])->name('teacher_login');
    Route::post('/teacher-login', [App\Http\Controllers\AuthController::class, 'teacher_login_post'])->name('teacher_login_post');

    Route::get('/admin-login', [App\Http\Controllers\AuthController::class, 'admin_login'])->name('admin_login');
    Route::post('/admin-login', [App\Http\Controllers\AuthController::class, 'admin_login_post'])->name('admin_login_post');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'admin_dashboard'])->name('admin_dashboard');

        // profile routes
        Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'admin_profile'])->name('admin_profile');
        Route::put('/profile-update', [App\Http\Controllers\Admin\AdminController::class, 'admin_profile_update'])->name('admin_profile_update');
        Route::put('/password-update', [App\Http\Controllers\Admin\AdminController::class, 'admin_password_update'])->name('admin_password_update');

        // student routes
        Route::get('/student', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_index'])->name('admin_student_index');
        Route::get('/student-add', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_add'])->name('admin_student_add');
        Route::post('/student', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_store'])->name('admin_student_store');
        Route::get('/student-edit/{id}', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_edit'])->name('admin_student_edit');
        Route::put('/student-update/{id}', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_update'])->name('admin_student_update');
        Route::delete('/student-delete/{id}', [App\Http\Controllers\Admin\AdminStudentController::class, 'admin_student_delete'])->name('admin_student_delete');

        // teacher routes
        Route::get('/teacher', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_index'])->name('admin_teacher_index');
        Route::get('/teacher-add', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_add'])->name('admin_teacher_add');
        Route::post('/teacher', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_store'])->name('admin_teacher_store');
        Route::get('/teacher-edit/{id}', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_edit'])->name('admin_teacher_edit');
        Route::put('/teacher-update/{id}', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_update'])->name('admin_teacher_update');
        Route::delete('/teacher-delete/{id}', [App\Http\Controllers\Admin\AdminTeacherController::class, 'admin_teacher_delete'])->name('admin_teacher_delete');

        // quiz routes
        Route::get('/quiz', [App\Http\Controllers\Admin\AdminController::class, 'admin_quiz_index'])->name('admin_quiz_index');
        Route::get('/quiz-result/{id}', [App\Http\Controllers\Admin\AdminController::class, 'admin_quiz_result'])->name('admin_quiz_result');
        Route::get('/quiz-question/{id}', [App\Http\Controllers\Admin\AdminController::class, 'admin_quiz_question'])->name('admin_quiz_question');

        // payment routes
        Route::get('/payment', [App\Http\Controllers\Admin\AdminController::class, 'admin_payment_index'])->name('admin_payment_index');

        //contact us routes
        Route::get('/contact-us', [App\Http\Controllers\Admin\AdminController::class, 'admin_contact_us_index'])->name('admin_contact_us_index');

        // notices routes
        Route::get('/notices', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_index'])->name('admin_notice_index');
        Route::get('/notices-add', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_add'])->name('admin_notice_add');
        Route::post('/notices', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_store'])->name('admin_notice_store');
        Route::get('/notices-edit/{id}', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_edit'])->name('admin_notice_edit');
        Route::put('/notices-update/{id}', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_update'])->name('admin_notice_update');
        Route::delete('/notices-delete/{id}', [App\Http\Controllers\Admin\AdminNoticeController::class, 'admin_notice_delete'])->name('admin_notice_delete');

        // messages routes
        Route::get('/messages', [App\Http\Controllers\Admin\AdminMessageController::class, 'admin_message_index'])->name('admin_message_index');
        Route::get('/messages-add', [App\Http\Controllers\Admin\AdminMessageController::class, 'admin_message_add'])->name('admin_message_add');
        Route::post('/messages', [App\Http\Controllers\Admin\AdminMessageController::class, 'admin_message_store'])->name('admin_message_store');
        Route::delete('/messages-delete/{id}', [App\Http\Controllers\Admin\AdminMessageController::class, 'admin_message_delete'])->name('admin_message_delete');
    });
});

Route::group(['prefix' => 'teacher', 'namespace' => 'Teacher'], function () {
    Route::group(['middleware' => 'teacherauth'], function () {
        Route::get('/', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_dashboard'])->name('teacher_dashboard');

        // profile routes
        Route::get('/profile', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_profile'])->name('teacher_profile');
        Route::put('/profile-update', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_profile_update'])->name('teacher_profile_update');
        Route::put('/password-update', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_password_update'])->name('teacher_password_update');

        // student routes
        Route::get('/student', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_index'])->name('teacher_student_index');
        Route::get('/student-add', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_add'])->name('teacher_student_add');
        Route::post('/student', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_store'])->name('teacher_student_store');
        Route::get('/student-edit/{id}', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_edit'])->name('teacher_student_edit');
        Route::put('/student-update/{id}', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_update'])->name('teacher_student_update');
        Route::delete('/student-delete/{id}', [App\Http\Controllers\Teacher\TeacherStudentController::class, 'teacher_student_delete'])->name('teacher_student_delete');

        // lesson routes
        Route::get('/lesson', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_index'])->name('teacher_lesson_index');
        Route::get('/lesson-add', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_add'])->name('teacher_lesson_add');
        Route::post('/lesson', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_store'])->name('teacher_lesson_store');
        Route::get('/lesson-edit/{id}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_edit'])->name('teacher_lesson_edit');
        Route::put('/lesson-update/{id}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_update'])->name('teacher_lesson_update');
        Route::delete('/lesson-delete/{id}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_delete'])->name('teacher_lesson_delete');
        Route::get('/lesson-activity', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_activity_index'])->name('teacher_lesson_activity_index');
        Route::delete('/lesson-activity-delete/{id}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'teacher_lesson_activity_delete'])->name('teacher_lesson_activity_delete');

        // asset routes
        Route::get('/asset', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_index'])->name('teacher_asset_index');
        Route::get('/asset-add', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_add'])->name('teacher_asset_add');
        Route::post('/asset', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_store'])->name('teacher_asset_store');
        Route::get('/asset-edit/{id}', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_edit'])->name('teacher_asset_edit');
        Route::put('/asset-update/{id}', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_update'])->name('teacher_asset_update');
        Route::delete('/asset-delete/{id}', [App\Http\Controllers\Teacher\TeacherAssetController::class, 'teacher_asset_delete'])->name('teacher_asset_delete');

        // payment routes
        Route::get('/payment', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_index'])->name('teacher_payment_index');
        Route::get('/payment-add/{id}', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_add'])->name('teacher_payment_add');
        Route::post('/payment', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_store'])->name('teacher_payment_store');
        // Route::get('/payment-edit/{id}', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_edit'])->name('teacher_payment_edit');
        // Route::put('/payment-update/{id}', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_update'])->name('teacher_payment_update');
        // Route::delete('/payment-delete/{id}', [App\Http\Controllers\Teacher\TeacherPaymentController::class, 'teacher_payment_delete'])->name('teacher_payment_delete');

        // quiz routes
        Route::get('/quiz', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_index'])->name('teacher_quiz_index');
        Route::get('/quiz-add', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_add'])->name('teacher_quiz_add');
        Route::post('/quiz', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_store'])->name('teacher_quiz_store');
        Route::get('/quiz-edit/{id}', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_edit'])->name('teacher_quiz_edit');
        Route::put('/quiz-update/{id}', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_update'])->name('teacher_quiz_update');
        Route::delete('/quiz-delete/{id}', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_delete'])->name('teacher_quiz_delete');
        Route::get('/quiz-result/{id}', [App\Http\Controllers\Teacher\TeacherQuizController::class, 'teacher_quiz_result'])->name('teacher_quiz_result');

        // question routes
        Route::get('/question/{id}', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_index'])->name('teacher_question_index');
        Route::get('/question-add/{id}', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_add'])->name('teacher_question_add');
        Route::post('/question', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_store'])->name('teacher_question_store');
        Route::get('/question-edit/{id}', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_edit'])->name('teacher_question_edit');
        Route::put('/question-update/{id}', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_update'])->name('teacher_question_update');
        Route::delete('/question-delete/{id}', [App\Http\Controllers\Teacher\TeacherQuestionController::class, 'teacher_question_delete'])->name('teacher_question_delete');

        // message routes
        Route::get('/messages', [App\Http\Controllers\Teacher\TeacherMessageController::class, 'teacher_message_index'])->name('teacher_message_index');
    });
});

Route::group(['prefix' => 'student', 'namespace' => 'Student'], function () {
    Route::group(['middleware' => 'studentauth'], function () {
        Route::get('/', [App\Http\Controllers\Student\StudentController::class, 'student_dashboard'])->name('student_dashboard');

        // profile routes
        Route::get('/profile', [App\Http\Controllers\Student\StudentController::class, 'student_profile'])->name('student_profile');
        Route::put('/profile-update', [App\Http\Controllers\Student\StudentController::class, 'student_profile_update'])->name('student_profile_update');
        Route::put('/password-update', [App\Http\Controllers\Student\StudentController::class, 'student_password_update'])->name('student_password_update');

        // learning routes
        Route::get('/learning', [App\Http\Controllers\Student\StudentController::class, 'student_learning_index'])->name('student_learning_index');

        // lesson routes
        Route::post('/lesson', [App\Http\Controllers\Student\StudentController::class, 'student_lesson_upload'])->name('student_lesson_upload');

        // calender routes
        Route::get('/calender', [App\Http\Controllers\Student\StudentController::class, 'student_calender_index'])->name('student_calender_index');

        //payment routes
        Route::get('/payment', [App\Http\Controllers\Student\StudentController::class, 'student_payment_index'])->name('student_payment_index');

        // quiz routes
        Route::get('/quiz', [App\Http\Controllers\Student\StudentController::class, 'student_quiz_index'])->name('student_quiz_index');
        Route::get('/quiz-start/{id}', [App\Http\Controllers\Student\StudentController::class, 'student_quiz_start'])->name('student_quiz_start');
        Route::post('/quiz', [App\Http\Controllers\Student\StudentController::class, 'student_quiz_submit'])->name('student_quiz_submit');
        Route::get('/quiz-answer', [App\Http\Controllers\Student\StudentController::class, 'student_quiz_result'])->name('student_quiz_result');

        // message routes
        Route::get('/messages', [App\Http\Controllers\Student\StudentMessageController::class, 'student_message_index'])->name('student_message_index');
    });
});
