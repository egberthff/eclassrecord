<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Schoolyear;
use App\EvaluationSetting;
class SchoolyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Schoolyear::all();
        return view('admin.schoolyear.index', compact('model'));
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

        $count = Schoolyear::all()->count();
        $exist = Schoolyear::where('start_year', $request->start_year)->first();

        if($count == 0){
            if ($exist == null) {
                $model = new Schoolyear;
                $model->name = 'A.Y. '. $request->start_year.' - '.$request->end_year;
                $model->start_year = $request->start_year;
                $model->end_year = $request->end_year;
                $model->status = 1;
                $model->save();

                $setting = new EvaluationSetting;
                $setting->schoolyear_id = $model->id;
                $setting->students_enabled = 1;
                $setting->dean_enabled = 1;
                $setting->students_percentage = 60;
                $setting->dean_percentage = 40;
                $setting->save();
    
                Session::flash('Inserted');
            }else{
                Session::flash('Duplicate');
            }
        }else{
            if ($exist == null) {

                $model = new Schoolyear;
                $model->name = 'A.Y. '. $request->start_year.' - '.$request->end_year;
                $model->start_year = $request->start_year;
                $model->end_year = $request->end_year;
                $model->save();

                $setting = new EvaluationSetting;
                $setting->schoolyear_id = $model->id;
                $setting->students_enabled = 1;
                $setting->dean_enabled = 1;
                $setting->students_percentage = 60;
                $setting->dean_percentage = 40;
                $setting->save();
    
                Session::flash('Inserted');
            }else{
                Session::flash('Duplicate');
            }
        }

        
        return redirect('schoolyear');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schoolyear_show($id)
    {
        Schoolyear::where('status', 1)->update(['status'=> 0]);

        $model = Schoolyear::findOrFail($id);
        $model->status = 1;
        $model->save();

        Session::flash('Activated');
            
        return redirect('schoolyear');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Schoolyear::find($id);
        $model = Schoolyear::all();
        return view('admin.schoolyear.edit', compact('model' , 'collection'));
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

        $model = Schoolyear::findOrFail($id);
        $model->name = $request->name;
        $model->save();

        Session::flash('Updated');
        
        return redirect('schoolyear');
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

    public function schoolyear_delete($id)
    {
        $model = Schoolyear::findOrFail($id);
        $model->delete();

        return redirect('schoolyear');
    }
}
