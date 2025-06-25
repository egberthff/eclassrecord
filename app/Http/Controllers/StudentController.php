<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Student;
use App\Schoolyear;
use App\Course;
use App\User;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sy = Schoolyear::where('status', 1)->first();
        $user = Auth::user();
        if(!$sy){
            $model = [];
            $inactive = [];
            $sections = [];
        }else{
            $sections = [];
            if($user->course_active){
                if($user->yearlevel_active){
                    $sections = Student::where('schoolyear_id', $sy->id)
                    ->where('course_id', $user->course_active)
                    ->where('yearlevel', $user->yearlevel_active)
                    ->where('section', '<>', '')
                    ->distinct()
                    ->pluck('section');
                    if($user->section_active){
                        $model = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('yearlevel', $user->yearlevel_active)->where('section', $user->section_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('yearlevel', $user->yearlevel_active)->where('section', $user->section_active)->where('status', '0')->get();
                    }else{
                        $model = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('yearlevel', $user->yearlevel_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('yearlevel', $user->yearlevel_active)->where('status', '0')->get();
                    }
                }else{
                    if($user->section_active){
                        $model = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('section', $user->section_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('section', $user->section_active)->where('status', '0')->get();
                    }else{
                        $model = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('course_id', $user->course_active)->where('status', '0')->get();
                    }
                }
            }else{

                if($user->yearlevel_active){
                    if($user->section_active){
                        $model = Student::where('schoolyear_id', $sy->id)->where('yearlevel', $user->yearlevel_active)->where('section', $user->section_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('yearlevel', $user->yearlevel_active)->where('section', $user->section_active)->where('status', '0')->get();
                    }else{
                        $model = Student::where('schoolyear_id', $sy->id)->where('yearlevel', $user->yearlevel_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('yearlevel', $user->yearlevel_active)->where('status', '0')->get();
                    }
                }else{
                    if($user->section_active){
                        $model = Student::where('schoolyear_id', $sy->id)->where('section', $user->section_active)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('section', $user->section_active)->where('status', '0')->get();
                    }else{
                        $model = Student::where('schoolyear_id', $sy->id)->where('status', 'REGULAR')->orwhere('status', 'IRREGULAR')->get();
                        $inactive = Student::where('schoolyear_id', $sy->id)->where('status', '0')->get();
                    }
                }
            }

        }
        return view('admin.students.index', compact('model', 'inactive', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sy = Schoolyear::where('status', 1)->first();

        $students = json_decode($request->students);

        if(isset($students)){
            foreach ($students as $key => $stud) {
                $student = Student::where('id_no', $stud->stud_id)->where('schoolyear_id', $sy->id)->first();
                $coursection = Course::where('code', $stud->course)->first();

                if($student){
                    if(isset($stud->last_name)){
                        if($stud->last_name != ''){
                            $student->lastname = $stud->last_name;
                        }
                    }
                    if(isset($stud->first_name)){
                        if($stud->first_name != ''){
                            $student->firstname = $stud->first_name;
                        }
                    }
                    if(isset($stud->middle_name)){
                        if($stud->middle_name != ''){
                            $student->middlename = $stud->middle_name;
                        }
                    }
                    if(isset($stud->sex)){
                        $student->sex = $stud->sex;
                    }
                    if(isset($stud->address)){
                        $student->address = $stud->address;
                    }
                    if(isset($stud->birthdate)){
                        $student->dateofbirth = $stud->birthdate;
                    }
                    if(isset($stud->course)){
                        $student->course_id = $coursection->id;
                    }
                    if(isset($stud->year_level)){
                        $student->yearlevel = $stud->year_level;
                    }
                    if(isset($stud->units)){
                        $student->units = $stud->units;
                    }
                    if(isset($stud->section)){
                        $student->section = $stud->section;
                    }
                    if(isset($stud->email)){
                        $student->email = $stud->email;
                    }
                    $student->status = 'REGULAR';

                    $student->update();
                }else{
                    $student = new Student;
                    $student->schoolyear_id = $sy->id;
                    $student->id_no = $stud->stud_id;
                    $student->lastname = $stud->last_name;
                    $student->firstname = $stud->first_name;
                    $student->middlename = $stud->middle_name;
                    $student->sex = $stud->sex;
                    $student->address = $stud->address;
                    $student->dateofbirth = $stud->birthdate;
                    $student->course_id = $coursection->id;
                    $student->yearlevel = $stud->year_level;
                    $student->units = $stud->units;
                    $student->section = $stud->section;
                    $student->access_key = $stud->last_name;
                    $student->email = $stud->email;
                    
                    $student->save();

                    $user = User::where('email', $stud->stud_id)->first();
                    if(!$user){
                        $user = new User;
                        $user->name = $stud->last_name . ', ' . $stud->first_name . ' ' . $stud->middle_name ;
                        $user->email = $stud->stud_id;
                        $user->password = Hash::make($stud->last_name);
                        $user->role_id = 1;
                        $user->save();
                    }else{
                        $user->name = $stud->last_name . ', ' . $stud->first_name . ' ' . $stud->middle_name ;
                        $user->email = $stud->stud_id;
                        $user->password = Hash::make($stud->last_name);
                        $user->role_id = 1;
                        $user->save();
                    }
                    

                    
                }
            } 
        }

        Session::flash('Inserted');

        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if($student->status == 'REGULAR' || $student->status == 'IRREGULAR'){
            $student->status = '0';

            Session::flash('Archived');
        }else{
            $student->status = 'REGULAR';

            Session::flash('Activated');
        }
        $student->save();
        return redirect('students');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Student::findOrFail($id);
        return view('admin.students.student_edit', compact('model'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function student_destroy($id)
    {
        // $student = Student::findOrFail($id);
        // $student->delete();
        // Session::flash('Deleted');

        // return redirect('students');
    }

    public function add_student()
    {
        return view('admin.students.add_student');
    }

    public function add_student_store(Request $request)
    {
        $sy = Schoolyear::where('status', 1)->first();

        $student = new Student;
        $student->schoolyear_id = $sy->id;
        $student->id_no = $request->email;
        $student->lastname = $request->last_name;
        $student->firstname = $request->first_name;
        $student->middlename = $request->middle_name;
        $student->sex = $request->sex;
        $student->address = $request->address;
        $student->dateofbirth = $request->birthdate;
        $student->course_id = $request->course_id;
        $student->yearlevel = $request->year_level;
        $student->units = $request->units;
        $student->section = $request->section;
        $student->access_key = $request->password;
        $student->email = $request->email_address;
        

        $user = User::where('email', $request->email)->first();
        if(!$user){
            $student->save();

            $user = new User;
            $user->name = $request->last_name . ', ' . $request->first_name . ' ' . $request->middle_name ;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 1;
            $user->save();
        }else{
            $student->status = 'REGULAR';
            $student->save();
            
            $user->name = $request->last_name . ', ' . $request->first_name . ' ' . $request->middle_name ;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

        }

        

        Session::flash('Inserted');

        return redirect('students');
    }

    public function checkidno(Request $request){
        $user = User::where('email', $request->email)->count();
        return response()->json(['Success'=>true,'user'=>$user]);
    }

    public function student_upd($id){
        $model = Student::findOrFail($id);
        
        return view('admin.students.student_edit', compact('model'));
    }

    public function student_upd_store(Request $request, $id)
    {
        $sy = Schoolyear::where('status', 1)->first();

        $student = Student::findOrFail($id);
        $student->lastname = $request->last_name;
        $student->firstname = $request->first_name;
        $student->middlename = $request->middle_name;
        $student->sex = $request->sex;
        $student->address = $request->address;
        $student->dateofbirth = $request->birthdate;
        $student->course_id = $request->course_id;
        $student->yearlevel = $request->year_level;
        $student->units = $request->units;
        $student->section = $request->section;
        if($request->password){
            $student->access_key = $request->password;
        }
        $student->email = $request->email_address;
        $student->save();

        
        $user = User::where('email', $student->id_no)->first();
        if(!$user){
            $user = new User;
            $user->password = Hash::make($request->last_name);
        }
        $user->name = $request->last_name . ', ' . $request->first_name . ' ' . $request->middle_name ;
        $user->email = $student->id_no;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        Session::flash('Updated');

        return redirect('students');
    }

    public function update_sections(){
        return view('admin.students.update_sections');
    }

    public function getstudentsbycourseandyear($course_id, $yearlevel)
    {
        
        $students = Student::where('course_id', $course_id)
                            ->where('yearlevel', $yearlevel)
                            ->get(['id_no', 'lastname', 'middlename', 'firstname']);
        return response()->json($students);
    }

    public function update_sections_store(Request $request){
        $students = $request->students;
        if($students){
            if (in_array("all", $students)) {
                Student::where([['course_id', $request->course_id], ['yearlevel', $request->year_level]])->update(['section'=> $request->section]);
            } else {
                if($students->count() > 0){
                    foreach($students as $stud){
                       $model = Student::where('id_no', $stud)->first();
                       if($model){
                            $model->section = $request->section;
                            $model->save();
                       }
                    }
                }
            }
        }

        Session::flash('UpdatedSections');
        return redirect('students');
        
    }



    public function handleChangeCollege(Request $request)
    {
        $value = $request->input('value');

        $user = Auth::user();
        $user->college_active = $value;
        $user->course_active = '';
        $user->save();

        if($user->college_active == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        
    }

    public function handleChangeCourse(Request $request)
    {
        $value = $request->input('value');

        $user = Auth::user();
        $user->course_active = $value;
        $user->save();

        if($user->course_active == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        
    }

    public function handleChangeSemester(Request $request)
    {
        $value = $request->input('value');

        $user = Auth::user();
        $user->semester_active = $value;
        $user->save();

        if($user->semester_active == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        
    }

    public function handleChangeYearlevel(Request $request)
    {
        $value = $request->input('value');

        $user = Auth::user();
        $user->yearlevel_active = $value;
        $user->section_active = '';
        $user->save();

        if($user->yearlevel_active == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        
    }

    public function handleChangeSection(Request $request)
    {
        $value = $request->input('value');

        $user = Auth::user();
        $user->section_active = $value;
        $user->save();

        if($user->section_active == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        
    }

    public function student_grades(){
        $sy = Schoolyear::where('status', 1)->first();
        return view('student.grades', compact('sy'));
    }
}
