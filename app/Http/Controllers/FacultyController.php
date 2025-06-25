<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Faculty;
use App\EvaluationSetting;
use App\Schoolyear;
use App\EvaluationValue;
use App\Student;
use App\CourseCoordinator;
use App\User;
use App\CurriculumSubject;
use App\ReExam;
use App\DynamicPercentage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Faculty::where('status', 1)->get();
        $archived = Faculty::where('status', 0)->get();
        return response()->view('admin.faculty.index', compact('model', 'archived'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.faculty.create');
    }

    public function faculty_uploadcsv()
    {
        return view('admin.faculty.uploadcsv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            'id_no' => 'required', 'max:255',
            'fname' => 'required', 'max:255',
            'lname' => 'required', 'max:255',
            'rank' => 'required', 'max:255'
        ]);

        $exist = Faculty::where('id_no', $request->id_no)->first();

        if ($exist == null) {

            $model = new Faculty;
            $model->id_no = $request->id_no;
            $model->fname = $request->fname;
            $model->mname = $request->mname;
            $model->lname = $request->lname;
            $model->rank = $request->rank;
            $model->email = $request->email;
            $model->status = 1;
            $model->save();

            $user = User::where('email', $request->id_no)->first();
            if(!$user){
                $user = new User;
                $user->name = $request->lname . ', ' . $request->fname . ' ' . $request->lname ;
                $user->email = $request->id_no;
                $user->password = Hash::make('password');
                $user->role_id = 2;
                $user->save();
            }else{
                $user->name = $request->lname . ', ' . $request->fname . ' ' . $request->lname ;
                $user->email = $request->id_no;
                $user->password = Hash::make('password');
                $user->role_id = 2;
                $user->save();
            }

            Session::flash('Inserted');
        }else{
            Session::flash('Duplicate');
        }

        
        return redirect('faculty');
    }

    public function store_upload(Request $request)
    {

        $faculties = json_decode($request->faculties);

        if(isset($faculties)){
            foreach ($faculties as $key => $faculty) {
                $exist = Faculty::where('id_no', $faculty->stud_id)->first();

                if ($exist == null) {

                    $model = new Faculty;
                    $model->id_no = $faculty->stud_id;
                    $model->fname = $faculty->first_name;
                    $model->mname = $faculty->middle_name;
                    $model->lname = $faculty->last_name;
                    $model->rank = $faculty->rank;
                    $model->email = $faculty->email;
                    $model->status = 1;
                    $model->save();

                    $user = User::where('email', $faculty->stud_id)->first();
                    if(!$user){
                        $user = new User;
                        $user->name = $faculty->last_name . ', ' . $faculty->first_name . ' ' . $faculty->last_name ;
                        $user->email = $faculty->stud_id;
                        $user->password = Hash::make('password');
                        $user->role_id = 2;
                        $user->save();
                    }else{
                        $user->name = $faculty->last_name . ', ' . $faculty->first_name . ' ' . $faculty->last_name ;
                        $user->email = $faculty->stud_id;
                        $user->password = Hash::make('password');
                        $user->role_id = 2;
                        $user->save();
                    }
                }else{
                    $exist->id_no = $faculty->stud_id;
                    $exist->fname = $faculty->first_name;
                    $exist->mname = $faculty->middle_name;
                    $exist->lname = $faculty->last_name;
                    $exist->rank = $faculty->rank;
                    $exist->email = $faculty->email;
                    $exist->status = 1;
                    $exist->save();

                    $user = User::where('email', $faculty->stud_id)->first();
                    if($user){
                        $user->name = $faculty->last_name . ', ' . $faculty->first_name . ' ' . $faculty->last_name;
                        $user->save();
                    }
                }
            }
        }

        Session::flash('Uploaded');
        return redirect('faculty');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = Faculty::find($id);
        if($faculty->status == 1){
            $faculty->status = 0;

            Session::flash('Archived');
        }else{
            $faculty->status = 1;
            Session::flash('Activated');
        }
        $faculty->save();
        return redirect('faculty');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Faculty::find($id);
        $model = Faculty::where('status', 1)->get();
        $archived = Faculty::where('status', 0)->get();
        return view('admin.faculty.edit', compact('collection', 'model', 'archived'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'id_no' => 'required', 'max:255',
            'fname' => 'required', 'max:255',
            'lname' => 'required', 'max:255',
            'rank' => 'required', 'max:255'
        ]);

        $model = Faculty::findOrFail($id);
        $model->id_no = $request->id_no;
        $model->fname = $request->fname;
        $model->mname = $request->mname;
        $model->lname = $request->lname;
        $model->rank = $request->rank;
        $model->email = $request->email;
        $model->save();

        $user = User::where('email', $model->id_no)->first();
        if($user){
            $user->name = $model->lname .', '.$model->fname.' '.$model->mname;
            $user->save();
        }

        Session::flash('Updated');
        
        return redirect('faculty');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function course_terms(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        return $faculty;
    }

    public function course_setterm($id)
    {
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();
        if($id <= 4 && $id != 0){
           $faculty->course_term = $id;
           $faculty->save();

           Session::flash('CourseTerm_Updated');
        }

        return redirect()->back();
    }





    public function evaluate(){
        $user = Auth::user();
        $schoolyear = Schoolyear::where('status', 1)->first();

        $semester = 0;
        
        if($schoolyear){
            $settings = EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
        }else{
            $settings = '';
        }

        if($settings->secondsem_enabled == 1) {
            $semester = 2;
        }else{
            $semester = 1;
        }

        if($user->role_id == 0){
            $model = Faculty::where('status', 1)->get(); 
        }else{
            $student = Student::where('id_no', $user->email)->first();
            $faculties = CourseCoordinator::where('status', 1)->where('schoolyear_id', $schoolyear->id)->where('course_id', $student->course_id)->where('yearlevel', $student->yearlevel)->where('semester',$semester)->get('faculty_id');
            $model = Faculty::whereIn('id', $faculties)->get(); 
        }
        

        $evaluated = EvaluationValue::where('user_id', Auth::user()->id)->where('schoolyear_id', $schoolyear->id)->where('semester', $semester)->get('faculty_id');

        return view('student.evaluate', compact('model', 'settings', 'schoolyear', 'evaluated'));
    }

    public function selectfaculty_evaluate(){

        $faculties = Faculty::where('status', '1')->get(); 
        return view('admin.evaluate.select_faculty', compact('faculties'));
    }

    public function selectedfacultytoevaluate(Request $request){

        return redirect('evaluationform/'.$request->faculty_id);
    }

    public function classrecord(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $subj_activ = $faculty->curriculum_subject_id;

            $sy = Schoolyear::where('status', 1)->first();

            $collection = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            
            $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->course_id)->where('yearlevel', $collection->year)->where('section', $faculty->section)
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middlename')
            ->get();
            
            $section_activ = $faculty->section;
            $curriculum = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $sections = DB::table('students')
                ->select('section')
                ->distinct()
                ->where('schoolyear_id', $sy->id)
                ->where('course_id', $curriculum->course_id)
                ->where('yearlevel', $curriculum->year)
                ->get();
        }else{
            $subj_activ = '';
            $students = [];
            $sy = Schoolyear::where('status', 1)->first();
            $collection = '';
            $section_activ = '';
            $sections = [];
        }
      return view('admin.class_record.index', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
        
       //  return view('admin.class_record.index_backup_copy', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
    }

    public function grades(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $subj_activ = $faculty->curriculum_subject_id;

            $sy = Schoolyear::where('status', 1)->first();

            $collection = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->course_id)->where('yearlevel', $collection->year)->where('section', $faculty->section)
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middlename')
            ->get();
            
            $section_activ = $faculty->section;
            $curriculum = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $sections = DB::table('students')
                ->select('section')
                ->distinct()
                ->where('schoolyear_id', $sy->id)
                ->where('course_id', $curriculum->course_id)
                ->where('yearlevel', $curriculum->year)
                ->get();
        }else{
            $subj_activ = '';
            $students = [];
            $sy = Schoolyear::where('status', 1)->first();
            $collection = '';
            $section_activ = '';
            $sections = [];
        }

        

        
        return view('admin.grades.grades', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
    }

    public function insights(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $subj_activ = $faculty->curriculum_subject_id;

            $sy = Schoolyear::where('status', 1)->first();

            $collection = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->course_id)->where('yearlevel', $collection->year)->where('section', $faculty->section)
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middlename')
            ->get();
            
            $section_activ = $faculty->section;
            $curriculum = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $sections = DB::table('students')
                ->select('section')
                ->distinct()
                ->where('schoolyear_id', $sy->id)
                ->where('course_id', $curriculum->course_id)
                ->where('yearlevel', $curriculum->year)
                ->get();
        }else{
            $subj_activ = '';
            $students = [];
            $sy = Schoolyear::where('status', 1)->first();
            $collection = '';
            $section_activ = '';
            $sections = [];
        }

        

        
        return view('admin.grades.insights', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
    }

    public function create_email(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $subj_activ = $faculty->curriculum_subject_id;

            $sy = Schoolyear::where('status', 1)->first();

            $collection = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->course_id)->where('yearlevel', $collection->year)->where('section', $faculty->section)
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middlename')
            ->get();
            
            $section_activ = $faculty->section;
            $curriculum = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $sections = DB::table('students')
                ->select('section')
                ->distinct()
                ->where('schoolyear_id', $sy->id)
                ->where('course_id', $curriculum->course_id)
                ->where('yearlevel', $curriculum->year)
                ->get();
        }else{
            $subj_activ = '';
            $students = [];
            $sy = '';
            $collection = '';
            $section_activ = '';
            $sections = [];
        }

        

        
        return view('admin.email.index', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
    }

    public function termsettings(){
        return view('admin.settings.termssettings');
    }

    public function termsettingsupdate(Request $request){
        $model = User::findOrFail(Auth::user()->id);
        if($request->prelim == 'on'){
            $model->prelim = 1;
        }else{
            $model->prelim = 0;
        }

        if($request->midterm == 'on'){
            $model->midterm = 1;
        }else{
            $model->midterm = 0;
        }

        if($request->prefi == 'on'){
            $model->prefi = 1;
        }else{
            $model->prefi = 0;
        }

        if($request->final == 'on'){
            $model->final = 1;
        }else{
            $model->final = 0;
        }

        $model->save();

        Session::flash('Updated');

        return redirect()->back();
        
    }

    public function gradesprint(){
        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $subj_activ = $faculty->curriculum_subject_id;

            $sy = Schoolyear::where('status', 1)->first();

            $collection = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->course_id)->where('yearlevel', $collection->year)->where('section', $faculty->section)
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middlename')
            ->get();
            
            $section_activ = $faculty->section;
            $curriculum = CurriculumSubject::findOrFail($faculty->curriculum_subject_id);
            $sections = DB::table('students')
                ->select('section')
                ->distinct()
                ->where('schoolyear_id', $sy->id)
                ->where('course_id', $curriculum->course_id)
                ->where('yearlevel', $curriculum->year)
                ->get();
        }else{
            $subj_activ = '';
            $students = [];
            $sy = Schoolyear::where('status', 1)->first();
            $collection = '';
            $section_activ = '';
            $sections = [];
        }

        

        
        return view('admin.grades.gradesprint', compact('faculty', 'subj_activ', 'students', 'collection', 'sy', 'sections', 'section_activ'));
    }

    public function handlechangerexam(Request $request)
    {
        // Retrieve the selected value from the request
        $value = $request->input('value');
        $id_no = $request->input('id_no');
        $curriculum_subject_id = $request->input('curriculum_subject_id');

        $model = ReExam::where('curriculum_subject_id', $curriculum_subject_id)->where('id_no', $id_no)->first();
        if(!$model){
            $model = new ReExam;
            $model->curriculum_subject_id = $curriculum_subject_id;
            $model->id_no = $id_no;
        }
        
        $model->grade = $value;
        $model->save();

        if($model->grade == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        // Perform some action with the value, e.g., save to the database
        // Example: $result = Model::create(['value' => $value]);

        // Return a response
        
    }

   function handleDynamicPercentage(Request $request)
{
    try{
        $id = $request->input('id');
        $curriculum_subject_id = $request->input('curriculum_subject_id');
        $quiz_percentage = $request->input('quiz_percentage');
        $attendance_percentage = $request->input('attendance_percentage');
        $schoolyear_id = $request->input('schoolyear_id');
        $school_id = $request->input('school_id');
        $course_term = $request->input('course_term');
        $semester_id = $request->input('semester_id');
        $class_id = $request->input('class_id');
        $section_id = $request->input('section_id');
        $teacher_id = Auth::user()->id;

        $dynamicPercentage = DynamicPercentage::updateOrCreate(
            [
                'id' => $id,
                'curriculum_subject_id' => $curriculum_subject_id,
                'schoolyear_id' => $schoolyear_id,
                'school_id' => $school_id,
                'course_id' => $class_id,
                'course_term' => $course_term,
                'semester' => $semester_id,
                'section_id' => $section_id,
                'teacher_id' => $teacher_id
            ],
            [
                'quiz_percentage' => $quiz_percentage,
                'attendance_percentage' => $attendance_percentage
            ]
        );

        if($dynamicPercentage->wasRecentlyCreated) {
            Session::flash('Inserted');
        } else {
            Session::flash('Updated');
        }

        if(!$dynamicPercentage){
            return response()->json(['success' => false, 'message' => 'Failed to save dynamic percentage']); 
        }

        return response()->json(['success' => true]);
    }catch(\Exception $e){
        // Log the error message for debugging
        Log::error('Error in handleDynamicPercentage: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
}
