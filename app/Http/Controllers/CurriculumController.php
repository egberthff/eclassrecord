<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Curriculum;
use App\CurriculumSubject;
use App\Schoolyear;
class CurriculumController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Curriculum::all();
        return view('admin.curriculum.index', compact('model'));
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
        $exist = Curriculum::where('name', $request->name)->first();

        if ($exist == null) {

            $model = new Curriculum;
            $model->name = $request->name;
            $model->status = 1;
            $model->save();

            Session::flash('Inserted');
        }else{
            Session::flash('Duplicate');
        }

        
        return redirect('curriculum');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        /*$model = Schoolyear::findOrFail($id);
        $model->delete();

        return redirect('curriculum');*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Curriculum::find($id);
        $subjects      = CurriculumSubject::where('curriculum_id', $collection->id)->where('status', 1)->get();
        return view('admin.curriculum.edit', compact('collection', 'subjects'));
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
            'name' => 'required', 'max:255',
        ]);

        $model = Curriculum::findOrFail($id);
        $model->name = $request->name;
        $model->save();

        Session::flash('Updated');
        
        return redirect('curriculum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function addsubjs($id){
        $collection = Curriculum::findOrFail($id);
        return view('admin.curriculum.addcurr_subjects', compact('collection'));
    }

    public function addsubjstore(Request $request){

        $sy = Schoolyear::where('status', 1)->first();

        $curriculum_id = $request->curriculum_id;
        $subjs = json_decode($request->subjects);

        if(isset($subjs)){
            foreach ($subjs as $key => $subj) {
                $exist = CurriculumSubject::where('curriculum_id', $curriculum_id)
                ->where('schoolyear_id', $sy->id)
                ->where('year', $request->year)
                ->where('semester', $request->semester)
                ->where('subject_code', $subj->subj_code)
                ->first();

                if ($exist == null) {
                    $model = new CurriculumSubject;
                    $model->schoolyear_id = $sy->id;
                    $model->curriculum_id = $curriculum_id;
                    $model->year = $request->year;
                    $model->semester = $request->semester;
                    $model->subject_code = $subj->subj_code;
                    $model->subject_desc = $subj->subj_desc;
                    $model->lec_units = $subj->lec_units;
                    $model->lab_units = $subj->lab_units;
                    $model->total_units = $subj->total_units;
                    $model->pre_reqs = $subj->pre_req;
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
        return redirect('curriculum/'.$curriculum_id.'/edit');

        
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

}
