<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\College;
use App\Course;
use App\Curriculum;
use App\CurriculumSubject;
use App\Schoolyear;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curriculums = Curriculum::all();
        $options = College::where('status', 1)->get();
        $model = Course::where('status', 1)->get();
        $inactive = Course::where('status', 0)->get();

        return view('admin.course.index', compact('model', 'options', 'inactive', 'curriculums'));
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
        $validator = $request->validate([
            'college_id' => 'required', 'max:255',
            'course' => 'required', 'max:255',
            'code' => 'required', 'max:255'
        ]);

        $exist = Course::where('course', $request->course)->where('code', $request->code)->first();

        if ($exist == null) {

            $model = new Course;
            $model->college_id = $request->college_id;
            $model->course = $request->course;
            $model->code = $request->code;
            if($request->board_exam == 'on'){
                $model->board_exam = 1;
            }
            $model->save();

            Session::flash('Inserted');
        }else{
            Session::flash('Duplicate');
        }

        
        return redirect('course');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        if($course->status == 1){
            $course->status = 0;

            Session::flash('Archived');
        }else{
            $course->status = 1;

            Session::flash('Activated');
        }
        $course->save();
        return redirect('course');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curriculums = Curriculum::all();
        $model = Course::where('status', 1)->get();
        $options = College::where('status', 1)->get();
        $collection = Course::find($id);
        $inactive = Course::where('status', 0)->get();
        return view('admin.course.edit', compact('model' , 'collection', 'options', 'inactive', 'curriculums'));
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
            'college_id' => 'required', 'max:255',
            'course' => 'required', 'max:255',
            'code' => 'required', 'max:255'
        ]);

        $model = Course::findOrFail($id);
        $model->college_id = $request->college_id;
        $model->course = $request->course;
        $model->code = $request->code;
        if($request->board_exam == 'on'){
            $model->board_exam = 1;
        }else{
            $model->board_exam = 0;
        }
        $model->save();

        Session::flash('Updated');
        
        return redirect('course');
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

    public function addsubjs($id){
        $collection = Course::findOrFail($id);
        return view('admin.course.addsubj', compact('collection'));
    }

    public function addsubjstore(Request $request){
        $sy = Schoolyear::where('status', 1)->first();
        $course_id = $request->course_id;
        $subjs = json_decode($request->subjects);

        if(isset($subjs)){
            foreach ($subjs as $key => $subj) {
                $exist = CurriculumSubject::where('course_id', $course_id)
                ->where('schoolyear_id', $sy->id)
                ->where('year', $subj->year)
                ->where('semester', $subj->semester)
                ->where('subject_code', $subj->subj_code)
                ->first();

                if ($exist == null) {
                    $model = new CurriculumSubject;
                    $model->schoolyear_id = $sy->id;
                    $model->course_id = $course_id;
                    $model->year = $subj->year;
                    $model->semester = $subj->semester;
                    $model->subject_code = $subj->subj_code;
                    $model->subject_desc = $subj->subj_desc;
                    $model->lec_units = $subj->lec_units;
                    $model->lab_units = $subj->lab_units;
                    $model->total_units = $subj->total_units;
                    $model->pre_reqs = $subj->pre_req;
                    $model->co_reqs = $subj->co_req;
                    $model->mt = $subj->mt;
                    $model->ft = $subj->ft;
                    $model->fg = $subj->fg;
                    $model->re = $subj->re;
                    $model->status = 1;
                    $model->save();

                }else{
                    $exist->schoolyear_id = $sy->id;
                    $exist->subject_desc = $subj->subj_desc;
                    $exist->lec_units = $subj->lec_units;
                    $exist->lab_units = $subj->lab_units;
                    $exist->total_units = $subj->total_units;
                    $exist->pre_reqs = $subj->pre_req;
                    $exist->co_reqs = $subj->co_req;
                    $exist->mt = $subj->mt;
                    $exist->ft = $subj->ft;
                    $exist->fg = $subj->fg;
                    $exist->re = $subj->re;
                    $exist->status = 1;
                    $exist->save();
                }
            }
        }

        Session::flash('Uploaded');
        return redirect('course/showsubj/'.$course_id);

        
    }

    public function removesubj($id){
        $collection = CurriculumSubject::find($id);
        if($collection->status == 1){
            $collection->status = 0;

            Session::flash('Archived');
        }else{
            $collection->status = 1;

            Session::flash('Activated');
        }
        $collection->save();

        return redirect()->back();
    }

    public function showsubj($id){
        $collection = Course::findOrFail($id);
        $subjects      = CurriculumSubject::where('course_id', $collection->id)->where('status', 1)->get();
        return view('admin.course.subjs', compact('collection', 'subjects'));
    }

    public function coursedeleteallsubs($id){
        $course_id = $id;
        // $assign_faculties_subj = CurriculumSubject::where('course_id', $course_id)->where('faculty_id', '<>', '')->count();
        CurriculumSubject::where([['course_id', $course_id], ['faculty_id', null]])->update(['status'=> 0]);

        Session::flash('Archived');
        return redirect()->back();
    }
}
