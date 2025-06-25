<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\CourseCoordinator;
use App\Course;
use App\Subject;
use App\Faculty;
use App\Schoolyear;
use App\EvaluationSetting;

class CourseCoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = CourseCoordinator::where('status', 1)->get();
        $inactive = CourseCoordinator::where('status', 0)->get();
        return view('admin.coursecoordinator.index', compact('model', 'inactive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $faculties = Faculty::all();
        return view('admin.coursecoordinator.create', compact('courses', 'subjects', 'faculties'));
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
        $settings = EvaluationSetting::where('schoolyear_id', $sy->id)->first();
        $semester = 1;

        if($settings->secondsem_enabled == '1'){
            $semester = 2;
        }else{
            $semester = 1;
        }

        if($request->subject){
            foreach($request->subject as $subj){
                
                $exist = CourseCoordinator::where('schoolyear_id', $sy->id)->where('course_id', $request->course_id)->where('subject', $subj)->where('faculty_id', $request->faculty_id)->where('semester', $semester)->where('yearlevel', $request->yearlevel)->first();

                if ($exist == null) {

                    $model = new CourseCoordinator;
                    $model->schoolyear_id = $sy->id;
                    $model->course_id = $request->course_id;
                    $model->subject = $subj;
                    $model->faculty_id = $request->faculty_id;
                    $model->semester = $semester;
                    $model->yearlevel = $request->yearlevel;
                    $model->status = 1;
                    $model->save();

                    Session::flash('Inserted');
                }else{
                    $exist->status = 1;
                    $exist->save();
                }

            }
        }
        
        return redirect('coursecoor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coursecoor = CourseCoordinator::find($id);
        if($coursecoor->status == 1){
            $coursecoor->status = 0;

            Session::flash('Archived');
        }else{
            $coursecoor->status = 1;

            Session::flash('Activated');
        }
        $coursecoor->save();
        return redirect('coursecoor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $faculties = Faculty::all();

        $collection = CourseCoordinator::findOrFail($id);

        return view('admin.coursecoordinator.edit', compact('courses', 'subjects', 'faculties', 'collection'));

        
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
        $sy = Schoolyear::where('status', 1)->first();
        $settings = EvaluationSetting::where('schoolyear_id', $sy->id)->first();
        $semester = 1;

        if($settings->secondsem_enabled == '1'){
            $semester = 2;
        }else{
            $semester = 1;
        }

        $exist = CourseCoordinator::where('schoolyear_id', $sy->id)->where('course_id', $request->course_id)->where('subject', $request->subject)->where('faculty_id', $request->faculty_id)->where('semester', $semester)->where('yearlevel', $request->yearlevel)->where('id', '<>', $id)->count();

        if ($exist < 1) {

            $model = CourseCoordinator::findOrFail($id);
            $model->schoolyear_id = $sy->id;
            $model->course_id = $request->course_id;
            $model->subject = $request->subject;
            $model->faculty_id = $request->faculty_id;
            $model->semester = $semester;
            $model->yearlevel = $request->yearlevel;
            $model->status = 1;
            $model->save();

            Session::flash('Inserted');
        }else{
            Session::flash('Exists');
        }
        
        return redirect('coursecoor');
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

    public function uploadcsv(){
        return view('admin.coursecoordinator.import_csv');
    }

    public function uploadcsvsave(Request $request){
        return $request->all();

        $coordinatorships = json_decode($request->coordinatorship);

        if(isset($coordinatorships)){
            foreach ($coordinatorships as $key => $stud) {
                $student = Student::where('id_no', $stud->stud_id)->where('schoolyear_id', $sy->id)->first();
                $coursection = Course::where('code', $stud->course)->first();

                if($student){
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
                    $student->access_key = 'facultyevaluation2023';

                    $student->save();

                    $user = User::where('email', $stud->stud_id)->first();
                    if(!$user){
                        $user = new User;
                        $user->name = $stud->last_name . ', ' . $stud->first_name . ' ' . $stud->middle_name ;
                        $user->email = $stud->stud_id;
                        $user->password = Hash::make('facultyevaluation2023');
                        $user->role_id = 1;
                        $user->save();
                    }else{
                        $user->name = $stud->last_name . ', ' . $stud->first_name . ' ' . $stud->middle_name ;
                        $user->email = $stud->stud_id;
                        $user->password = Hash::make('facultyevaluation2023');
                        $user->role_id = 1;
                        $user->save();
                    }
                    

                    
                }
            } 
        }

        Session::flash('Inserted');


    }

}
