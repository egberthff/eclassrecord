<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Assignment;
use App\Faculty;
use Auth;
use App\CurriculumSubject;
use App\Schoolyear;
use App\Student;
use App\AssignmentScore;

class AssignmentController extends Controller
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
        $faculty = Faculty::where('id_no', $user->email)->first();

        if($faculty->curriculum_subject_id){
            $model = Assignment::where('user_id', $user->id)->where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $faculty->section)->where('status', 1)->get();
            $inactive = Assignment::where('user_id', $user->id)->where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $faculty->section)->where('status', 0)->get();
            $subj_activ = $faculty->curriculum_subject_id;

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
            $model = [];
            $subj_activ = '';
            $section_activ = '';
            $sections = [];
            $inactive = [];
        }

        return view('admin.assignments.index', compact('model', 'inactive', 'faculty', 'subj_activ', 'section_activ', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        $faculty = Faculty::where('id_no', $user->email)->first();

        $model = new Assignment;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->date = $request->date;
        $model->description = $request->description;
        $model->items_total = $request->items_total;
        $model->curriculum_subject_id = $request->curriculum_subject_id;
        $model->course_term = $faculty->course_term;
        $model->section = $faculty->section;
        $model->save();

        
        $faculty->curriculum_subject_id = $request->curriculum_subject_id;
        $faculty->save();

        Session::flash('Inserted');
        
        return redirect('assignment-add_score/'.$model->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Assignment::find($id);
        if($course->status == 1){
            $course->status = 0;

            Session::flash('Archived');
        }else{
            $course->status = 1;

            Session::flash('Activated');
        }
        $course->save();
        return redirect('assignment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Assignment::findorFail($id);
        return view('admin.assignments.edit', compact('model'));
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
        $model = Assignment::findorFail($id);
        $score = AssignmentScore::where('assignment_id', $id)->where('score', '>', $request->items_total)->count();
        if($request->items_total != $model->items_total){
            if($score > 0){
                Session::flash('Error');
                return redirect()->back();
            }else{
                $model->name = $request->name;
                $model->date = $request->date;
                $model->description = $request->description;
                $model->items_total = $request->items_total;
            }
        }else{
            $model->name = $request->name;
            $model->date = $request->date;
            $model->description = $request->description;
        }
        $model->save();

        Session::flash('Updated');
        return redirect('assignment');
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

    public function handleChange(Request $request)
    {
        // Retrieve the selected value from the request
        $value = $request->input('value');

        $user = Auth::user();
        $faculty = Faculty::where('id_no', $user->email)->first();
        $faculty->curriculum_subject_id = $value;
        $faculty->save();

        if($faculty->curriculum_subject_id == $value){
            return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        }

        // Perform some action with the value, e.g., save to the database
        // Example: $result = Model::create(['value' => $value]);

        // Return a response
        
    }


    public function add_score($id){

        $sy = Schoolyear::where('status', 1)->first();


        $collection = Assignment::findOrFail($id);
        $students = Student::where('schoolyear_id', $sy->id)->where('course_id', $collection->curriculum_subject->course_id)->where('yearlevel', $collection->curriculum_subject->year)->where('section', $collection->section)
        ->orderBy('lastname')
        ->orderBy('firstname')
        ->orderBy('middlename')
        ->get();
        return view('admin.assignments.scores', compact('collection', 'students'));
    }


    public function upload_score(Request $request)
    {
        // Retrieve the selected value from the request
        $quiz_id = $request->input('quiz_id');
        $id_no = $request->input('id_no');
        $score = $request->input('score');


        $model = AssignmentScore::where('assignment_id', $quiz_id)->where('id_no', $id_no)->first();

        if($model){
            $model->score = $score;
            $model->save();
        }else{
            $model = new AssignmentScore;
            $model->assignment_id = $quiz_id;
            $model->id_no = $id_no;
            $model->score = $score;
            $model->save();
        }
        

        return response()->json(['success' => true, 'message' => 'Value processed successfully']);
        
    }
}
