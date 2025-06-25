<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Subject;
use App\Curriculum;
use App\CurriculumSubject;
use App\Course;
use App\Faculty;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->college_active){
            $courses = Course::where('college_id', $user->college_active)->where('status', 1)->get();
            $course_id = Course::where('college_id', $user->college_active)->where('status', 1)->get('id');

            if($user->course_active){
                if($user->yearlevel_active){
                    if($user->semester_active){
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 0)->get();
                    }else{
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 0)->get();
                    }
                }else{
                    $model = CurriculumSubject::where('course_id', $user->course_active)->where('status', 1)->get();
                    $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('status', 0)->get();
                }

                
            }else{
                if($user->yearlevel_active){
                    if($user->semester_active){
                        $model = CurriculumSubject::whereIn('course_id', $course_id)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::whereIn('course_id', $course_id)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 0)->get();
                    }else{
                        $model = CurriculumSubject::whereIn('course_id', $course_id)->where('year', $user->yearlevel_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::whereIn('course_id', $course_id)->where('year', $user->yearlevel_active)->where('status', 0)->get();
                    }
                }else{
                    $model = CurriculumSubject::whereIn('course_id', $course_id)->where('status', 1)->get();
                    $inactive = CurriculumSubject::whereIn('course_id', $course_id)->where('status', 0)->get();
                }
            }
            
        }else{
            $courses = Course::where('status', 1)->get();
            if($user->course_active){
                if($user->yearlevel_active){
                    if($user->semester_active){
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 0)->get();
                    }else{
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 0)->get();
                    }
                }else{
                    $model = CurriculumSubject::where('course_id', $user->course_active)->where('status', 1)->get();
                    $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('status', 0)->get();
                }
            }else{
                if($user->yearlevel_active){
                    if($user->semester_active){
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 0)->get();
                    }else{
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('status', 0)->get();
                    }
                }else{
                    if($user->semester_active){
                        $model = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 1)->get();
                        $inactive = CurriculumSubject::where('course_id', $user->course_active)->where('year', $user->yearlevel_active)->where('semester', $user->semester_active)->where('status', 0)->get();
                    }else{
                        $model = CurriculumSubject::where('status', 1)->get();
                        $inactive = CurriculumSubject::where('status', 0)->get();
                    }
                }
            }
        }
        
        return view('admin.subject.index', compact('model', 'inactive', 'courses'));
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
            'name' => 'required', 'max:255',
            'course_subjcode' => 'required', 'max:255',
        ]);

        $exist = Subject::where('course_subjcode', $request->course_subjcode)->where('name', $request->name)->first();

        if ($exist == null) {

            $model = new Subject;
            $model->name = $request->name;
            $model->curriculum_id = $request->curriculum_id;
            $model->course_id = $request->course_id;
            $model->course_subjcode = $request->course_subjcode;
            $model->save();

            Session::flash('Inserted');
        }else{
            Session::flash('Duplicate');
        }

        
        return redirect('subject');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subj = Subject::find($id);
        if($subj->status == 1){
            $subj->status = 0;

            Session::flash('Archived');
        }else{
            $subj->status = 1;

            Session::flash('Activated');
        }
        $subj->save();
        return redirect('subject');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculties = Faculty::where('status', 1)->get();
        $collection = CurriculumSubject::find($id);
        return view('admin.subject.edit', compact('collection', 'faculties'));
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

        $model = CurriculumSubject::findOrFail($id);
        $model->subject_code = $request->subject_code;
        $model->subject_desc = $request->subject_desc;
        $model->lec_units = $request->lec_units;
        $model->lab_units = $request->lab_units;
        $model->total_units = $request->total_units;
        $model->faculty_id = $request->faculty_id;
        $model->save();

        $faculty = Faculty::where('id_no', $model->faculty_id)->first();
        if(!$faculty->curriculum_subject_id){
            $faculty->curriculum_subject_id = $id;
        }
        if(!$faculty->course_term){
            $faculty->course_term = 1;
        }
        $faculty->save();

        Session::flash('Updated');
        
        return redirect('subject');
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
}
