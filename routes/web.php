<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CourseCoordinatorController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MajorExamController;
use App\Http\Controllers\EvaluationController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/myaccount', [HomeController::class,'myaccount'])->name('myaccount');

//modules
Route::resource('schoolyear', SchoolyearController::class);
Route::resource('college', CollegeController::class);
Route::resource('course',  CourseController::class);
Route::resource('students', StudentController::class);
Route::resource('faculty', FacultyController::class);
Route::resource('coursecoor', CourseCoordinatorController::class);
Route::resource('subject', SubjectController::class);
Route::resource('quizzes', QuizController::class);
Route::resource('curriculum', CurriculumController::class);
Route::resource('settings', SettingController::class);
Route::resource('activity', ActivityController::class);
Route::resource('attendance', AttendanceController::class);
Route::resource('assignment', AssignmentController::class);
Route::resource('project', ProjectController::class);
Route::resource('major_exam', MajorExamController::class);

//Faculty
Route::get('faculty_uploadcsv', [FacultyController::class, 'faculty_uploadcsv'])->name('faculty_uploadcsv');


//College
Route::get('college_view', [CollegeController::class, 'view_list'])->name('view_list');

//Course
Route::get('course/showsubj/{id}', [CourseController::class, 'showsubj'])->name('courseshowsubj');
Route::get('course/addsubjs/{id}', [CourseController::class, 'addsubjs'])->name('courseaddsubjs');
Route::post('course/addsubjstore', [CourseController::class, 'addsubjstore'])->name('courseaddsubjstore');
Route::get('coursedeleteallsubs/{id}', [CourseController::class, 'coursedeleteallsubs'])->name('coursedeleteallsubs');

//Curriculum
Route::get('curriculum/addsubjs/{id}', [CurriculumController::class, 'addsubjs'])->name('addsubjs');
Route::post('curriculum/addsubjstore', [CurriculumController::class, 'addsubjstore'])->name('addsubjstore');
Route::get('curriculum/removesubj/{id}', [CurriculumController::class, 'removesubj'])->name('removesubj');

Route::get('course_terms', [FacultyController::class, 'course_terms'])->name('course_terms');
Route::get('course_setterm/{id}', [FacultyController::class, 'course_setterm'])->name('course_setterm');
Route::post('faculty_upload', [FacultyController::class, 'store_upload'])->name('faculty_upload');
Route::get('grades', [FacultyController::class, 'grades'])->name('grades');
Route::get('create_email', [FacultyController::class, 'create_email'])->name('create_email');
Route::get('student_grades', [StudentController::class, 'student_grades'])->name('student_grades');
Route::get('insights', [FacultyController::class, 'insights'])->name('insights');


//Evaluations
Route::get('faculty_evaluate', [FacultyController::class, 'evaluate'])->name('faculty_evaluate');
Route::get('selectfaculty_evaluate', [FacultyController::class, 'selectfaculty_evaluate'])->name('selectfaculty_evaluate');
Route::get('selectreportsemester', [EvaluationController::class, 'selectreportsemester'])->name('selectreportsemester');
Route::post('selectedfacultytoevaluate', [FacultyController::class, 'selectedfacultytoevaluate'])->name('selectedfacultytoevaluate');
Route::get('evaluationsettings', [EvaluationController::class, 'evaluationsettings'])->name('evaluationsettings');
Route::patch('evaluationsettings_update/{id}', [EvaluationController::class, 'evaluationsettings_update'])->name('evaluationsettings_update');
Route::get('evaluationform/{id}', [EvaluationController::class, 'evaluationform'])->name('evaluationform');
Route::patch('evaluation_store/{id}', [EvaluationController::class, 'evaluation_store'])->name('evaluation_store');
Route::get('selectfaculty_generate/{id}', [EvaluationController::class, 'selectfaculty_generatereport'])->name('selectfaculty_generatereport');
Route::post('evaluation/report', [EvaluationController::class, 'evaluation_report'])->name('evaluation_report');

//Students
Route::get('student/login', function(){
    return view('auth.studentlogin');
})->name('student.login');
Route::get('myaccount', function(){
    return view('myaccount');
})->name('myaccount');
Route::post('office/update', [HomeController::class,'myaccountupdate'])->name('myaccountupdate');
Route::get('add_student', [StudentController::class, 'add_student'])->name('add_student');
Route::post('add_student_store', [StudentController::class, 'add_student_store'])->name('add_student_store');
Route::post('/checkidno', [StudentController::class, 'checkidno'])->name('checkidno');
Route::get('student_upd/{id}', [StudentController::class, 'student_upd'])->name('student_upd');
Route::get('student_destroy/{id}', [StudentController::class, 'student_destroy'])->name('student_destroy');
Route::get('schoolyear_delete/{id}', [SchoolyearController::class, 'schoolyear_delete'])->name('schoolyear_delete');
Route::post('schoolyear_show/{id}', [SchoolyearController::class, 'schoolyear_show'])->name('schoolyear_show');
Route::post('schoolyear_delete/{id}', [SchoolyearController::class, 'schoolyear_delete'])->name('schoolyear_delete');
Route::patch('student_upd_store/{id}', [StudentController::class, 'student_upd_store'])->name('student_upd_store');
Route::get('coordinatorship', [CourseCoordinatorController::class, 'uploadcsv'])->name('coor_uploadcsv');
Route::post('coordinatorship/store', [CourseCoordinatorController::class, 'uploadcsvsave'])->name('coor_uploadcsvsave');

Route::get('update_sections', [StudentController::class, 'update_sections'])->name('update_sections');
Route::get('getstudentsbycourseandyear/{course_id}/{yearlevel}',[StudentController::class, 'getstudentsbycourseandyear'])->name('getStudentsByCourseAndYear');
Route::post('update_sections_store', [StudentController::class, 'update_sections_store'])->name('update_sections_store');
Route::post('/handle-change-college', [StudentController::class, 'handleChangeCollege']);
Route::post('/handle-change-course', [StudentController::class, 'handleChangeCourse']);
Route::post('/handle-change-semester', [StudentController::class, 'handleChangeSemester']);
Route::post('/handle-change-yearlevel', [StudentController::class, 'handleChangeYearlevel']);
Route::post('/handle-change-sections', [StudentController::class, 'handleChangeSection']);


//QUIZ
Route::post('/handle-change', [QuizController::class, 'handleChange']);
Route::get('add_score/{id}', [QuizController::class, 'add_score'])->name('add_score');
Route::post('/upload_score', [QuizController::class, 'upload_score']);
Route::post('/handle-change-section', [QuizController::class, 'handleChangeSection']);
//ACTIVITY
Route::post('/activity-handle-change', [ActivityController::class, 'handleChange']);
Route::get('activity-add_score/{id}', [ActivityController::class, 'add_score'])->name('activity_add_score');
Route::post('/activity-upload_score', [ActivityController::class, 'upload_score']);
//ATTENDANCE
Route::post('/attendance-handle-change', [AttendanceController::class, 'handleChange']);
Route::get('attendance-add_score/{id}', [AttendanceController::class, 'add_score'])->name('attendance_add_score');
Route::post('/attendance-upload_score', [AttendanceController::class, 'upload_score']);
//ASSIGNMENTS
Route::post('/assignment-handle-change', [AssignmentController::class, 'handleChange']);
Route::get('assignment-add_score/{id}', [AssignmentController::class, 'add_score'])->name('assignment_add_score');
Route::post('/assignment-upload_score', [AssignmentController::class, 'upload_score']);
//PROJECTS
Route::post('/project-handle-change', [ProjectController::class, 'handleChange']);
Route::get('project-add_score/{id}', [ProjectController::class, 'add_score'])->name('project_add_score');
Route::post('/project-upload_score', [ProjectController::class, 'upload_score']);
//MAJOR-EXAM
Route::post('/major_exam-handle-change', [MajorExamController::class, 'handleChange']);
Route::get('major_exam-add_score/{id}', [MajorExamController::class, 'add_score'])->name('major_exam_add_score');
Route::post('/major_exam-upload_score', [MajorExamController::class, 'upload_score']);


//CLASS-RECORD
Route::get('/classrecord', [FacultyController::class, 'classrecord'])->name('classrecord');
Route::get('/termsettings', [FacultyController::class, 'termsettings'])->name('termsettings');
Route::post('/termsettingsupdate', [FacultyController::class, 'termsettingsupdate'])->name('termsettingsupdate');
Route::get('gradesprint', [FacultyController::class, 'gradesprint'])->name('gradesprint');
Route::post('/handlechangerexam', [FacultyController::class, 'handlechangerexam']);
Route::post('/save-dynamic-percentage', [FacultyController::class, 'handleDynamicPercentage'])->name('save_dynamic_percentage');