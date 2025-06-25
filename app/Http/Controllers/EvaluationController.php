<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\EvaluationSetting;
use App\Schoolyear;
use App\Faculty;
use App\EvaluationValue;
use App\College;
use Auth;

class EvaluationController extends Controller
{
    public function evaluationsettings(){

        $schoolyear = Schoolyear::where('status', 1)->first();
        if($schoolyear){
            $element = EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
        }else{
            $element = '';
        }

        return view('admin.evaluate.settings', compact('element'));
    }

    public function evaluationsettings_update(Request $request, $id)
    {
        $percentage = $request->peer_percentage + $request->self_percentage + $request->student_percentage + $request->supervisor_percentage;
        if($percentage > 100){

            Session::flash('Greatertohundred');
            return redirect()->back();
        }

        if($percentage < 100){

            Session::flash('lesstohundred');
            return redirect()->back();
        }

        $setting = EvaluationSetting::findOrFail($id);
        $s1 = 0;$s2 = 0;$s3 = 0;$s4 = 0;$s5 = 0;$s6 = 0;

        if($request->s1){
            $s1 = 1;
        }else{$s1 = 0; }
        if($request->s2){
            $s2 = 1;
        }else{$s2 = 0; }
        if($request->s3){
            $s3 = 1;
        }else{$s3 = 0; }
        if($request->s4){
            $s4 = 1;
        }else{$s4 = 0; }
        if($request->s5){
            $s5 = 1;
        }else{
            if($setting->firstsem_enabled == 1){
                $s5 = 1;
            }else{
                $s5 = 0; 
            }
            
        }
        if($request->s6){
            $s6 = 1;
        }else{
            if($setting->secondsem_enabled == 1){
                $s6 = 1;
            }else{
                $s6 = 0; 
            }
        }

        
        
        $setting->peer_enabled = $s2;
        $setting->self_enabled = $s1;
        $setting->students_enabled = $s3;
        $setting->dean_enabled = $s4;
        $setting->peer_percentage = $request->peer_percentage;
        $setting->self_percentage = $request->self_percentage;
        $setting->students_percentage = $request->student_percentage;
        $setting->dean_percentage = $request->supervisor_percentage;
        $setting->firstsem_enabled = $s5;
        $setting->secondsem_enabled = $s6;
        $setting->department = $request->department;
        $setting->reviewer = $request->reviewer;
        $setting->reviewer_designation = $request->reviewer_designation;
        $setting->campus_director = $request->campus_director;
        $setting->save();

        Session::flash('Updated');
        
        return redirect('evaluationsettings');
    }

    public function evaluationform($id){
        $faculty = Faculty::findOrFail($id);
        $schoolyear = Schoolyear::where('status', 1)->first();

        if($schoolyear){
            $settings = EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
        }else{
            $settings = '';
        }

        return view('student.evaluation_form', compact('faculty', 'schoolyear', 'settings'));
    }

    public function evaluation_store(Request $request, $id){

        $user = Auth::user();
        $schoolyear = Schoolyear::where('status', 1)->first();

        $model = new EvaluationValue;
        $model->schoolyear_id = $schoolyear->id;
        $model->semester = $request->semester;
        $model->faculty_id = $id;
        $model->user_id = $user->id;
        $model->a1 = $request->a1;
        $model->a2 = $request->a2;
        $model->a3 = $request->a3;
        $model->a4 = $request->a4;
        $model->a5 = $request->a5;
        $model->b1 = $request->b1;
        $model->b2 = $request->b2;
        $model->b3 = $request->b3;
        $model->b4 = $request->b4;
        $model->b5 = $request->b5;
        $model->c1 = $request->c1;
        $model->c2 = $request->c2;
        $model->c3 = $request->c3;
        $model->c4 = $request->c4;
        $model->c5 = $request->c5;
        $model->d1 = $request->d1;
        $model->d2 = $request->d2;
        $model->d3 = $request->d3;
        $model->d4 = $request->d4;
        $model->d5 = $request->d5;
        $model->total_score = $request->a1 + $request->a2 + $request->a3 + $request->a4 + $request->a5 + $request->b1 + $request->b2 + $request->b3 + $request->b4 + $request->b5 + $request->c1 + $request->c2 + $request->c3 + $request->c4 + $request->c5 + $request->d1 + $request->d2 + $request->d3 + $request->d4 + $request->d5;
        $model->save();

        Session::flash('EvaluateFinish');

        if($user->role_id == 0){
            return redirect('selectfaculty_evaluate');
        }else{
            return redirect('faculty_evaluate');
        }

    }

    public function evaluation_report(Request $request){
        $schoolyear = Schoolyear::where('status', 1)->first();

        $faculty = Faculty::findOrFail($request->faculty_id);
        $college = College::findOrFail($request->college_id);

        if($request->semester == 1 || $request->semester == '1'){
            $semester = 'First Semester';
        }else{
            $semester = 'Second Semester';
        }

        $settings = EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
        

        $student_evaluations = EvaluationValue::where('schoolyear_id', $schoolyear->id)->where('faculty_id', $request->faculty_id)->where('semester', $request->semester)->where('user_id', '<>', 1)->get();
        $supervisor_evaluations_sum = EvaluationValue::where('schoolyear_id', $schoolyear->id)->where('faculty_id', $request->faculty_id)->where('semester', $request->semester)->where('user_id', 1)->sum('total_score');

        if($student_evaluations->count() > 0){
            $student_evaluations_count = $student_evaluations->count();
            $student_evaluations_sum = $student_evaluations->sum('total_score');

            $weightedScoreStudents = ($student_evaluations_sum / $student_evaluations_count) * 60;
            $weightedScoreSupervisor = ($supervisor_evaluations_sum / 1) * 40;

            $weightedRatingsStudents = ($weightedScoreStudents / 100);
            $weightedRatingsSupervisor = ($weightedScoreSupervisor / 100);
            $overallweightedRating = $weightedRatingsStudents + $weightedRatingsSupervisor;
        }else{
            $student_evaluations_count = 0;
            $student_evaluations_sum = 0;

            $weightedScoreStudents = 0;
            $weightedScoreSupervisor = ($supervisor_evaluations_sum / 1) * 40;

            $weightedRatingsStudents = 0;
            $weightedRatingsSupervisor = ($weightedScoreSupervisor / 100);
            $overallweightedRating = 0 + $weightedRatingsSupervisor;
        }

        

        if($overallweightedRating >= 93){
            $descriptive = 'Outstanding (O)';
        }elseif($overallweightedRating >= 75 && $overallweightedRating <= 92){
            $descriptive = 'Very Satisfactory (VS)';
        }elseif($overallweightedRating >= 50 && $overallweightedRating <= 74){
            $descriptive = 'Satisfactory (S)';
        }elseif($overallweightedRating >= 30 && $overallweightedRating <= 49){
            $descriptive = 'Fair (F)';
        }else{
            $descriptive = 'Unsatisfactory (U)';
        }

        return view('admin.report.report', compact('weightedRatingsStudents', 'weightedRatingsSupervisor', 'overallweightedRating', 'faculty', 'semester', 'descriptive', 'settings', 'student_evaluations_count', 'college'));
    }

    public function selectfaculty_generatereport($id){
        return view('admin.report.select_faculty', compact('id'));
    }

    public function selectreportsemester(){
        return view('admin.report.select_semester');
    }
}
