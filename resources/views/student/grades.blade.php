@extends('layouts.admin')
@section('student_grades')
active
@endsection
@section('head')
<style>
.margin-0rem {
    margin-bottom: 0rem !important;
}

.fsize_15 {
    font-size: 15px !important;
}

.fsize_12 {
    font-size: 12px !important;
}

table thead tr th {
    font-weight: normal;
}
</style>
@endsection
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="container-fluid row pull-center" style="text-align: right;padding-top: 10px;padding-bottom: 10px;">
            <div class="col-md-3" style="text-align: right;">
                <img src="{{URL::to('logo.png')}}" style="width: 100px;height:100px;" alt="">
            </div>
            <div class="col-md-6" style="text-align: center;">
                <p class="cambria margin-0rem fsize_15">Republic of the Philippines</p>
                <p class="cambria margin-0rem fsize_15" style="font-weight: bold;">BOHOL ISLAND STATE
                    UNIVERSITY-BALILIHAN CAMPUS</p>
                <p class="cambria margin-0rem fsize_15">Magsija, Balilihan, Bohol</p>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="container-fluid">
            <p class="fsize_12" style="margin-bottom: 0em;text-align:center;">Vision: A premier S & T university for the
                formation of a world class and virtue-laden human resource for sustainable development of Bohol and the
                country</p>
            <p class="fsize_12" style="border-bottom: solid 1px;text-align:center;">Mission: BISU is committed to
                provide quality higher education in the arts and sciences, as well as in the professional and
                technological fields, undertake research and development and extension services for the sustainable
                development of Bohol and the country.</p>
            <?php 
                $student = App\Student::where('schoolyear_id', $sy->id)->where('id_no', Auth::user()->email)->first();
                $course = App\Course::findOrFail($student->course_id);
            ?>

            <p class="cambria margin-0rem" style="text-align: left;">
                Student Name: <b>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}}</b> <br> Course: <b>@isset($course){{$course->course}} @endisset</b> <br> Year Level: <b>@isset($student){{$student->yearlevel}} @endisset</b> <br> Section: <b>@isset($student){{$student->section}} @endisset</b> <br> School Year: <b>@isset($sy){{$sy->name}} @endisset</b>
            </p>
            <br>
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;font-size: 15px;">
                1ST SEMESTER GRADES
            </p>
            <div class="table-responsive m-b-40" style="overflow-x: auto;">
                <table id="table4" class="table table-bordered" style="width: 100%;">
                    <thead style="background-color: white;">
                        <tr>
                            <th width="10" style="text-align: center;"><b>SUBJECT</b></th>
                            <th width="30" style="text-align: center;"><b>Description</b></th>
                            <th width="10" style="text-align: center;"><b>PRELIM</b></th>
                            <th width="10" style="text-align: center;"><b>MIDTERM</b></th>
                            <th width="10" style="text-align: center;"><b>PRE-FINALS</b></th>
                            <th width="10" style="text-align: center;"><b>FINALS</b></th>
                            <th width="10" style="text-align: center;"><b>FINAL GRADE</b></th>
                            <th width="10" style="text-align: center;"><b>REMARKS</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subjects_first_sem = App\CurriculumSubject::
                            where('schoolyear_id', $sy->id)
                            ->where('course_id', $student->course_id)
                            ->where('year', $student->yearlevel)
                            ->where('semester', 1)
                            ->where('status', 1)
                            ->get();

                            $percentage  = App\Setting::where('id', '<>', 0)->first();

                            function getGradewithBoard($score) {
                                if ($score >= 100) return 1.0;
                                elseif ($score >= 98) return 1.1;
                                elseif ($score >= 96) return 1.2;
                                elseif ($score >= 94) return 1.3;
                                elseif ($score >= 92) return 1.4;
                                elseif ($score >= 90) return 1.5;
                                elseif ($score >= 88) return 1.6;
                                elseif ($score >= 86) return 1.7;
                                elseif ($score >= 84) return 1.8;
                                elseif ($score >= 82) return 1.9;
                                elseif ($score >= 80) return 2.0;
                                elseif ($score >= 78) return 2.1;
                                elseif ($score >= 76) return 2.2;
                                elseif ($score >= 74) return 2.3;
                                elseif ($score >= 72) return 2.4;
                                elseif ($score >= 70) return 2.5;
                                elseif ($score >= 68) return 2.6;
                                elseif ($score >= 66) return 2.7;
                                elseif ($score >= 64) return 2.8;
                                elseif ($score >= 62) return 2.9;
                                elseif ($score >= 60) return 3.0;
                                elseif ($score >= 58) return 3.1;
                                elseif ($score >= 56) return 3.2;
                                elseif ($score >= 54) return 3.3;
                                elseif ($score >= 52) return 3.4;
                                elseif ($score >= 50) return 3.5;
                                elseif ($score >= 48) return 3.6;
                                elseif ($score >= 46) return 3.7;
                                elseif ($score >= 44) return 3.8;
                                elseif ($score >= 42) return 3.9;
                                elseif ($score >= 40) return 4.0;
                                elseif ($score >= 38) return 4.1;
                                elseif ($score >= 36) return 4.2;
                                elseif ($score >= 34) return 4.3;
                                elseif ($score >= 32) return 4.4;
                                elseif ($score >= 30) return 4.5;
                                elseif ($score >= 28) return 4.6;
                                elseif ($score >= 26) return 4.7;
                                elseif ($score >= 24) return 4.8;
                                elseif ($score >= 20) return 4.9;
                                else return 5.0; // For scores below 20
                            }

                            function getGradewithoutBoard($score) {
                                if ($score >= 99) return 1.0;
                                elseif ($score >= 97) return 1.1;
                                elseif ($score >= 94) return 1.2;
                                elseif ($score >= 92) return 1.3;
                                elseif ($score >= 89) return 1.4;
                                elseif ($score >= 87) return 1.5;
                                elseif ($score >= 84) return 1.6;
                                elseif ($score >= 82) return 1.7;
                                elseif ($score >= 79) return 1.8;
                                elseif ($score >= 77) return 1.9;
                                elseif ($score >= 74) return 2.0;
                                elseif ($score >= 72) return 2.1;
                                elseif ($score >= 69) return 2.2;
                                elseif ($score >= 66) return 2.3;
                                elseif ($score >= 64) return 2.4;
                                elseif ($score >= 61) return 2.5;
                                elseif ($score >= 59) return 2.6;
                                elseif ($score >= 56) return 2.7;
                                elseif ($score >= 54) return 2.8;
                                elseif ($score >= 52) return 2.9;
                                elseif ($score >= 50) return 3.0;
                                elseif ($score >= 47) return 3.1;
                                elseif ($score >= 44) return 3.2;
                                elseif ($score >= 42) return 3.3;
                                elseif ($score >= 39) return 3.4;
                                elseif ($score >= 37) return 3.5;
                                elseif ($score >= 34) return 3.6;
                                elseif ($score >= 32) return 3.7;
                                elseif ($score >= 29) return 3.8;
                                elseif ($score >= 27) return 3.9;
                                elseif ($score >= 24) return 4.0;
                                elseif ($score >= 22) return 4.1;
                                elseif ($score >= 19) return 4.2;
                                elseif ($score >= 17) return 4.3;
                                elseif ($score >= 14) return 4.4;
                                elseif ($score >= 12) return 4.5;
                                elseif ($score >= 9) return 4.6;
                                elseif ($score >= 7) return 4.7;
                                elseif ($score >= 4) return 4.8;
                                elseif ($score >= 2) return 4.9;
                                else return 5.0; // For scores 0-1
                            }

                            function calculateFinalGrade($quizScore, $projectScore, $examScore, $classwork_percent, $project_percent, $exam_percent) {
                                // Define the weights
                                $quizWeight = $classwork_percent / 100; //weight for Quiz
                                $projectWeight = $project_percent / 100; // weight for Projects
                                $examWeight = $exam_percent / 100;    // weight for Exam
                            
                                // Compute the weighted average
                                $finalGrade = ($quizScore * $quizWeight) +
                                              ($projectScore * $projectWeight) +
                                              ($examScore * $examWeight);
                            
                                return $finalGrade;
                            }

                            $tot_gwa_first_sem = 0;
                            $tot_gwa_second_sem = 0;
                        ?>
                        @isset($subjects_first_sem)
                        @foreach($subjects_first_sem as $subj_)
                        <?php 
                            $quizes = App\Quiz::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities = App\Activity::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances = App\Attendance::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments = App\Assignment::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount = $quizes->count() + $activities->count() + $attendances->count() + $assignments->count();
                            $projects = App\Project::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams = App\MajorExam::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');

                            $quizes_mid = App\Quiz::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_mid = App\Activity::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_mid = App\Attendance::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_mid = App\Assignment::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_mid = $quizes_mid->count() + $activities_mid->count() + $attendances_mid->count() + $assignments_mid->count();
                            $projects_mid = App\Project::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_mid = App\MajorExam::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            
                            $quizes_prefi = App\Quiz::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_prefi = App\Activity::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_prefi = App\Attendance::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_prefi = App\Assignment::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_prefi = $quizes_prefi->count() + $activities_prefi->count() + $attendances_prefi->count() + $assignments_prefi->count();
                            $projects_prefi = App\Project::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_prefi = App\MajorExam::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            
                            $quizes_finals = App\Quiz::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_finals = App\Activity::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_finals = App\Attendance::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_finals = App\Assignment::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_finals = $quizes_finals->count() + $activities_finals->count() + $attendances_finals->count() + $assignments_finals->count();
                            $projects_finals = App\Project::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_finals = App\MajorExam::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');


                            $quiz_act_att_ass_total = 0;
                            $quiz_act_att_ass_total_mid = 0;
                            $quiz_act_att_ass_total_prefi = 0;
                            $quiz_act_att_ass_total_finals = 0;

                            $quiz_act_att_ass_total += App\Quiz::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Activity::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Attendance::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Assignment::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total = App\Project::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total = App\MajorExam::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');

                            $quiz_act_att_ass_total_mid += App\Quiz::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Activity::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Attendance::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Assignment::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_mid = App\Project::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_mid = App\MajorExam::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            
                            $quiz_act_att_ass_total_prefi += App\Quiz::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Activity::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Attendance::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Assignment::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_prefi = App\Project::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_prefi = App\MajorExam::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            
                            $quiz_act_att_ass_total_finals += App\Quiz::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Activity::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Attendance::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Assignment::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_finals = App\Project::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_finals = App\MajorExam::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');


                            $quiz_act_att_ass_studtotal = 0;
                            $proj_studtotal = 0;
                            $exam_studtotal = 0;

                            $quiz_act_att_ass_studtotal_mid = 0;
                            $proj_studtotal_mid = 0;
                            $exam_studtotal_mid = 0;

                            $quiz_act_att_ass_studtotal_prefi = 0;
                            $proj_studtotal_prefi = 0;
                            $exam_studtotal_prefi = 0;

                            $quiz_act_att_ass_studtotal_finals = 0;
                            $proj_studtotal_finals = 0;
                            $exam_studtotal_finals = 0;

                            if($quizes){
                                $quiz_act_att_ass_studtotal = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes)->sum('score');
                            }
                            if($quizes_mid){
                                $quiz_act_att_ass_studtotal_mid = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_mid)->sum('score');
                            }
                            if($quizes_prefi){
                                $quiz_act_att_ass_studtotal_prefi = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_prefi)->sum('score');
                            }
                            if($quizes_finals){
                                $quiz_act_att_ass_studtotal_finals = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_finals)->sum('score');
                            }

                            if($activities){
                                $quiz_act_att_ass_studtotal += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities)->sum('score');
                            }
                            if($activities_mid){
                                $quiz_act_att_ass_studtotal_mid += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_mid)->sum('score');
                            }
                            if($activities_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_prefi)->sum('score');
                            }
                            if($activities_finals){
                                $quiz_act_att_ass_studtotal_finals += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_finals)->sum('score');
                            }


                            if($attendances){
                                $quiz_act_att_ass_studtotal += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances)->sum('score');
                            }
                            if($attendances_mid){
                                $quiz_act_att_ass_studtotal_mid += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_mid)->sum('score');
                            }
                            if($attendances_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_prefi)->sum('score');
                            }
                            if($attendances_finals){
                                $quiz_act_att_ass_studtotal_finals += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_finals)->sum('score');
                            }

                            if($assignments){
                                $quiz_act_att_ass_studtotal += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments)->sum('score');
                            }
                            if($assignments_mid){
                                $quiz_act_att_ass_studtotal_mid += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_mid)->sum('score');
                            }
                            if($assignments_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_prefi)->sum('score');
                            }
                            if($assignments_finals){
                                $quiz_act_att_ass_studtotal_finals += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_finals)->sum('score');
                            }


                            if($quiz_act_att_ass_studtotal > 0){
                                $quiz_act_att_ass_percent = round((round($quiz_act_att_ass_studtotal) / $quiz_act_att_ass_total) * 100);
                            }else{
                                $quiz_act_att_ass_percent = 0;
                            }
                            if($quiz_act_att_ass_studtotal_mid > 0){
                                $quiz_act_att_ass_percent_mid = round((round($quiz_act_att_ass_studtotal_mid) / $quiz_act_att_ass_total_mid) * 100);
                            }else{
                                $quiz_act_att_ass_percent_mid = 0;
                            }
                            if($quiz_act_att_ass_studtotal_prefi > 0){
                                $quiz_act_att_ass_percent_prefi = round((round($quiz_act_att_ass_studtotal_prefi) / $quiz_act_att_ass_total_prefi) * 100);
                            }else{
                                $quiz_act_att_ass_percent_prefi = 0;
                            }
                            if($quiz_act_att_ass_studtotal_finals > 0){
                                $quiz_act_att_ass_percent_finals = round((round($quiz_act_att_ass_studtotal_finals) / $quiz_act_att_ass_total_finals) * 100);
                            }else{
                                $quiz_act_att_ass_percent_finals = 0;
                            }

                            if($course){
                                if($course->board_exam == 1){
                                    $quiz_act_att_ass_grade = getGradewithBoard($quiz_act_att_ass_percent);
                                    $quiz_act_att_ass_grade_mid = getGradewithBoard($quiz_act_att_ass_percent_mid);
                                    $quiz_act_att_ass_grade_prefi = getGradewithBoard($quiz_act_att_ass_percent_prefi);
                                    $quiz_act_att_ass_grade_finals = getGradewithBoard($quiz_act_att_ass_percent_finals);
                                }else{
                                    $quiz_act_att_ass_grade = getGradewithoutBoard($quiz_act_att_ass_percent);
                                    $quiz_act_att_ass_grade_mid = getGradewithoutBoard($quiz_act_att_ass_percent_mid);
                                    $quiz_act_att_ass_grade_prefi = getGradewithoutBoard($quiz_act_att_ass_percent_prefi);
                                    $quiz_act_att_ass_grade_finals = getGradewithoutBoard($quiz_act_att_ass_percent_finals);
                                }
                            }else{
                                $quiz_act_att_ass_grade = 5.0;
                                $quiz_act_att_ass_grade_mid = 5.0;
                                $quiz_act_att_ass_grade_prefi = 5.0;
                                $quiz_act_att_ass_grade_finals = 5.0;
                            }




                            if($projects){
                                $proj_studtotal = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects)->sum('score');
                            }
                            if($projects_mid){
                                $proj_studtotal_mid = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_mid)->sum('score');
                            }
                            if($projects_prefi){
                                $proj_studtotal_prefi = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_prefi)->sum('score');
                            }
                            if($projects_finals){
                                $proj_studtotal_finals = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_finals)->sum('score');
                            }


                            if($proj_studtotal > 0){
                                $proj_percent = round((round($proj_studtotal) / $proj_total) * 100);
                            }else{
                                $proj_percent = 0;
                            }
                            if($proj_studtotal_mid > 0){
                                $proj_percent_mid = round((round($proj_studtotal_mid) / $proj_total_mid) * 100);
                            }else{
                                $proj_percent_mid = 0;
                            }
                            if($proj_studtotal_prefi > 0){
                                $proj_percent_prefi = round((round($proj_studtotal_prefi) / $proj_total_prefi) * 100);
                            }else{
                                $proj_percent_prefi = 0;
                            }
                            if($proj_studtotal_finals > 0){
                                $proj_percent_finals = round((round($proj_studtotal_finals) / $proj_total_finals) * 100);
                            }else{
                                $proj_percent_finals = 0;
                            }
                            
                            
                            
                            if($course){
                                if($course->board_exam == 1){
                                    $proj_grade = getGradewithBoard($proj_percent);
                                    $proj_grade_mid = getGradewithBoard($proj_percent_mid);
                                    $proj_grade_prefi = getGradewithBoard($proj_percent_prefi);
                                    $proj_grade_finals = getGradewithBoard($proj_percent_finals);
                                }else{
                                    $proj_grade = getGradewithoutBoard($proj_percent);
                                    $proj_grade_mid = getGradewithoutBoard($proj_percent_mid);
                                    $proj_grade_prefi = getGradewithoutBoard($proj_percent_prefi);
                                    $proj_grade_finals = getGradewithoutBoard($proj_percent_finals);
                                }
                            }else{
                                $proj_grade = 5.0;
                                $proj_grade_mid = 5.0;
                                $proj_grade_prefi = 5.0;
                                $proj_grade_finals = 5.0;
                            }


                            if($major_exams){
                                $exam_studtotal = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams)->sum('score');
                            }
                            if($major_exams_mid){
                                $exam_studtotal_mid = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_mid)->sum('score');
                            }
                            if($major_exams_prefi){
                                $exam_studtotal_prefi = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_prefi)->sum('score');
                            }
                            if($major_exams_finals){
                                $exam_studtotal_finals = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_finals)->sum('score');
                            }


                            if($exam_studtotal > 0){
                                $exam_percent = round((round($exam_studtotal) / $exam_total) * 100);
                            }else{
                                $exam_percent = 0;
                            }
                            if($exam_studtotal_mid > 0){
                                $exam_percent_mid = round((round($exam_studtotal_mid) / $exam_total_mid) * 100);
                            }else{
                                $exam_percent_mid = 0;
                            }
                            if($exam_studtotal_prefi > 0){
                                $exam_percent_prefi = round((round($exam_studtotal_prefi) / $exam_total_prefi) * 100);
                            }else{
                                $exam_percent_prefi = 0;
                            }
                            if($exam_studtotal_finals > 0){
                                $exam_percent_finals = round((round($exam_studtotal_finals) / $exam_total_finals) * 100);
                            }else{
                                $exam_percent_finals = 0;
                            }

                            if($course){
                                if($course->board_exam == 1){
                                    $exam_grade = getGradewithBoard($exam_percent);
                                    $exam_grade_mid = getGradewithBoard($exam_percent_mid);
                                    $exam_grade_prefi = getGradewithBoard($exam_percent_prefi);
                                    $exam_grade_finals = getGradewithBoard($exam_percent_finals);
                                }else{
                                    $exam_grade = getGradewithoutBoard($exam_percent);
                                    $exam_grade_mid = getGradewithoutBoard($exam_percent_mid);
                                    $exam_grade_prefi = getGradewithoutBoard($exam_percent_prefi);
                                    $exam_grade_finals = getGradewithoutBoard($exam_percent_finals);
                                }
                            }else{
                                $exam_grade = 5.0;
                                $exam_grade_mid = 5.0;
                                $exam_grade_prefi = 5.0;
                                $exam_grade_finals = 5.0;
                            }


                            $grade = calculateFinalGrade($quiz_act_att_ass_grade, $proj_grade, $exam_grade, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_mid = calculateFinalGrade($quiz_act_att_ass_grade_mid, $proj_grade_mid, $exam_grade_mid, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_prefi = calculateFinalGrade($quiz_act_att_ass_grade_prefi, $proj_grade_prefi, $exam_grade_prefi, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_finals = calculateFinalGrade($quiz_act_att_ass_grade_finals, $proj_grade_finals, $exam_grade_finals, $percentage->classwork, $percentage->projects, $percentage->exams);

                            $gwa = ($grade + $grade_mid + $grade_prefi + $grade_finals) / 4;
                            

                            $tot_gwa_first_sem += $gwa;
                            
                        ?>
                        <tr>
                            <td><b>{{$subj_->subject_code}}</b></td>
                            <td>{{$subj_->subject_desc}}</td>
                            @if($grade > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_mid > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_mid ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_mid ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_prefi > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_prefi ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_prefi ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_finals > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_finals ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_finals ?? 0, 1)}}</td>  
                            @endif
                            @if($gwa > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($gwa ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($gwa ?? 0, 1)}}</td>  
                            @endif
                            @if($gwa > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: black;">Passed</td>  
                            @endif
                        </tr>
                        @endforeach
                        @endisset
                        <tr>
                            <td colspan="6" style="text-align: right;font-weight: bold;">GWA</td>
                            @isset($subjects_first_sem)
                                <?php 
                                    $final_gwa = $tot_gwa_first_sem / $subjects_first_sem->count();
                                ?>
                                @if($final_gwa > 3)
                                    <td style="text-align: center;font-weight: bold;color: red;">{{number_format($final_gwa ?? 0, 1)}}</td>
                                    <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                                @else
                                    <td style="text-align: center;font-weight: bold;color: green;">{{number_format($final_gwa ?? 0, 1)}}</td>  
                                    <td style="text-align: center;font-weight: bold;color: black;">Passed</td>  
                                @endif
                            @else
                                <td style="text-align: center;font-weight: bold;color: red;">5.0</td>
                                <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                            @endisset
                        </tr>
                    </tbody>
                </table>
            </div>


            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;font-size: 15px;">
                2ND SEMESTER GRADES
            </p>
            <div class="table-responsive m-b-40" style="overflow-x: auto;">
                <table id="table4" class="table table-bordered" style="width: 100%;">
                    <thead style="background-color: white;">
                        <tr>
                            <th width="10" style="text-align: center;"><b>SUBJECT</b></th>
                            <th width="30" style="text-align: center;"><b>Description</b></th>
                            <th width="10" style="text-align: center;"><b>PRELIM</b></th>
                            <th width="10" style="text-align: center;"><b>MIDTERM</b></th>
                            <th width="10" style="text-align: center;"><b>PRE-FINALS</b></th>
                            <th width="10" style="text-align: center;"><b>FINALS</b></th>
                            <th width="10" style="text-align: center;"><b>FINAL GRADE</b></th>
                            <th width="10" style="text-align: center;"><b>REMARKS</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subjects_second_sem = App\CurriculumSubject::
                            where('schoolyear_id', $sy->id)
                            ->where('course_id', $student->course_id)
                            ->where('year', $student->yearlevel)
                            ->where('semester', 2)
                            ->where('status', 1)
                            ->get();
                        ?>
                        @isset($subjects_second_sem)
                        @foreach($subjects_second_sem as $subj_)
                        <?php 
                            $quizes = App\Quiz::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities = App\Activity::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances = App\Attendance::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments = App\Assignment::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount = $quizes->count() + $activities->count() + $attendances->count() + $assignments->count();
                            $projects = App\Project::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams = App\MajorExam::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');

                            $quizes_mid = App\Quiz::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_mid = App\Activity::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_mid = App\Attendance::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_mid = App\Assignment::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_mid = $quizes_mid->count() + $activities_mid->count() + $attendances_mid->count() + $assignments_mid->count();
                            $projects_mid = App\Project::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_mid = App\MajorExam::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            
                            $quizes_prefi = App\Quiz::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_prefi = App\Activity::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_prefi = App\Attendance::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_prefi = App\Assignment::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_prefi = $quizes_prefi->count() + $activities_prefi->count() + $attendances_prefi->count() + $assignments_prefi->count();
                            $projects_prefi = App\Project::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_prefi = App\MajorExam::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            
                            $quizes_finals = App\Quiz::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $activities_finals = App\Activity::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $attendances_finals = App\Attendance::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $assignments_finals = App\Assignment::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $classworkcount_finals = $quizes_finals->count() + $activities_finals->count() + $attendances_finals->count() + $assignments_finals->count();
                            $projects_finals = App\Project::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');
                            $major_exams_finals = App\MajorExam::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->get('id');


                            $quiz_act_att_ass_total = 0;
                            $quiz_act_att_ass_total_mid = 0;
                            $quiz_act_att_ass_total_prefi = 0;
                            $quiz_act_att_ass_total_finals = 0;

                            $quiz_act_att_ass_total += App\Quiz::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Activity::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Attendance::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total += App\Assignment::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total = App\Project::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total = App\MajorExam::where('course_term', 1)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');

                            $quiz_act_att_ass_total_mid += App\Quiz::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Activity::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Attendance::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_mid += App\Assignment::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_mid = App\Project::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_mid = App\MajorExam::where('course_term', 2)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            
                            $quiz_act_att_ass_total_prefi += App\Quiz::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Activity::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Attendance::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_prefi += App\Assignment::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_prefi = App\Project::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_prefi = App\MajorExam::where('course_term', 3)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            
                            $quiz_act_att_ass_total_finals += App\Quiz::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Activity::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Attendance::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $quiz_act_att_ass_total_finals += App\Assignment::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $proj_total_finals = App\Project::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');
                            $exam_total_finals = App\MajorExam::where('course_term', 4)->where('curriculum_subject_id', $subj_->id)->where('status', 1)->sum('items_total');


                            $quiz_act_att_ass_studtotal = 0;
                            $proj_studtotal = 0;
                            $exam_studtotal = 0;

                            $quiz_act_att_ass_studtotal_mid = 0;
                            $proj_studtotal_mid = 0;
                            $exam_studtotal_mid = 0;

                            $quiz_act_att_ass_studtotal_prefi = 0;
                            $proj_studtotal_prefi = 0;
                            $exam_studtotal_prefi = 0;

                            $quiz_act_att_ass_studtotal_finals = 0;
                            $proj_studtotal_finals = 0;
                            $exam_studtotal_finals = 0;

                            if($quizes){
                                $quiz_act_att_ass_studtotal = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes)->sum('score');
                            }
                            if($quizes_mid){
                                $quiz_act_att_ass_studtotal_mid = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_mid)->sum('score');
                            }
                            if($quizes_prefi){
                                $quiz_act_att_ass_studtotal_prefi = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_prefi)->sum('score');
                            }
                            if($quizes_finals){
                                $quiz_act_att_ass_studtotal_finals = App\QuizScore::where('id_no', $student->id_no)->whereIn('quiz_id', $quizes_finals)->sum('score');
                            }

                            if($activities){
                                $quiz_act_att_ass_studtotal += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities)->sum('score');
                            }
                            if($activities_mid){
                                $quiz_act_att_ass_studtotal_mid += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_mid)->sum('score');
                            }
                            if($activities_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_prefi)->sum('score');
                            }
                            if($activities_finals){
                                $quiz_act_att_ass_studtotal_finals += App\ActivityScore::where('id_no', $student->id_no)->whereIn('activity_id', $activities_finals)->sum('score');
                            }


                            if($attendances){
                                $quiz_act_att_ass_studtotal += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances)->sum('score');
                            }
                            if($attendances_mid){
                                $quiz_act_att_ass_studtotal_mid += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_mid)->sum('score');
                            }
                            if($attendances_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_prefi)->sum('score');
                            }
                            if($attendances_finals){
                                $quiz_act_att_ass_studtotal_finals += App\AttendanceScore::where('id_no', $student->id_no)->whereIn('attendance_id', $attendances_finals)->sum('score');
                            }

                            if($assignments){
                                $quiz_act_att_ass_studtotal += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments)->sum('score');
                            }
                            if($assignments_mid){
                                $quiz_act_att_ass_studtotal_mid += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_mid)->sum('score');
                            }
                            if($assignments_prefi){
                                $quiz_act_att_ass_studtotal_prefi += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_prefi)->sum('score');
                            }
                            if($assignments_finals){
                                $quiz_act_att_ass_studtotal_finals += App\AssignmentScore::where('id_no', $student->id_no)->whereIn('assignment_id', $assignments_finals)->sum('score');
                            }


                            if($quiz_act_att_ass_studtotal > 0){
                                $quiz_act_att_ass_percent = round((round($quiz_act_att_ass_studtotal) / $quiz_act_att_ass_total) * 100);
                            }else{
                                $quiz_act_att_ass_percent = 0;
                            }
                            if($quiz_act_att_ass_studtotal_mid > 0){
                                $quiz_act_att_ass_percent_mid = round((round($quiz_act_att_ass_studtotal_mid) / $quiz_act_att_ass_total_mid) * 100);
                            }else{
                                $quiz_act_att_ass_percent_mid = 0;
                            }
                            if($quiz_act_att_ass_studtotal_prefi > 0){
                                $quiz_act_att_ass_percent_prefi = round((round($quiz_act_att_ass_studtotal_prefi) / $quiz_act_att_ass_total_prefi) * 100);
                            }else{
                                $quiz_act_att_ass_percent_prefi = 0;
                            }
                            if($quiz_act_att_ass_studtotal_finals > 0){
                                $quiz_act_att_ass_percent_finals = round((round($quiz_act_att_ass_studtotal_finals) / $quiz_act_att_ass_total_finals) * 100);
                            }else{
                                $quiz_act_att_ass_percent_finals = 0;
                            }

                            if($course){
                                if($course->board_exam == 1){
                                    $quiz_act_att_ass_grade = getGradewithBoard($quiz_act_att_ass_percent);
                                    $quiz_act_att_ass_grade_mid = getGradewithBoard($quiz_act_att_ass_percent_mid);
                                    $quiz_act_att_ass_grade_prefi = getGradewithBoard($quiz_act_att_ass_percent_prefi);
                                    $quiz_act_att_ass_grade_finals = getGradewithBoard($quiz_act_att_ass_percent_finals);
                                }else{
                                    $quiz_act_att_ass_grade = getGradewithoutBoard($quiz_act_att_ass_percent);
                                    $quiz_act_att_ass_grade_mid = getGradewithoutBoard($quiz_act_att_ass_percent_mid);
                                    $quiz_act_att_ass_grade_prefi = getGradewithoutBoard($quiz_act_att_ass_percent_prefi);
                                    $quiz_act_att_ass_grade_finals = getGradewithoutBoard($quiz_act_att_ass_percent_finals);
                                }
                            }else{
                                $quiz_act_att_ass_grade = 5.0;
                                $quiz_act_att_ass_grade_mid = 5.0;
                                $quiz_act_att_ass_grade_prefi = 5.0;
                                $quiz_act_att_ass_grade_finals = 5.0;
                            }




                            if($projects){
                                $proj_studtotal = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects)->sum('score');
                            }
                            if($projects_mid){
                                $proj_studtotal_mid = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_mid)->sum('score');
                            }
                            if($projects_prefi){
                                $proj_studtotal_prefi = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_prefi)->sum('score');
                            }
                            if($projects_finals){
                                $proj_studtotal_finals = App\ProjectScore::where('id_no', $student->id_no)->whereIn('project_id', $projects_finals)->sum('score');
                            }


                            if($proj_studtotal > 0){
                                $proj_percent = round((round($proj_studtotal) / $proj_total) * 100);
                            }else{
                                $proj_percent = 0;
                            }
                            if($proj_studtotal_mid > 0){
                                $proj_percent_mid = round((round($proj_studtotal_mid) / $proj_total_mid) * 100);
                            }else{
                                $proj_percent_mid = 0;
                            }
                            if($proj_studtotal_prefi > 0){
                                $proj_percent_prefi = round((round($proj_studtotal_prefi) / $proj_total_prefi) * 100);
                            }else{
                                $proj_percent_prefi = 0;
                            }
                            if($proj_studtotal_finals > 0){
                                $proj_percent_finals = round((round($proj_studtotal_finals) / $proj_total_finals) * 100);
                            }else{
                                $proj_percent_finals = 0;
                            }
                            
                            
                            
                            if($course){
                                if($course->board_exam == 1){
                                    $proj_grade = getGradewithBoard($proj_percent);
                                    $proj_grade_mid = getGradewithBoard($proj_percent_mid);
                                    $proj_grade_prefi = getGradewithBoard($proj_percent_prefi);
                                    $proj_grade_finals = getGradewithBoard($proj_percent_finals);
                                }else{
                                    $proj_grade = getGradewithoutBoard($proj_percent);
                                    $proj_grade_mid = getGradewithoutBoard($proj_percent_mid);
                                    $proj_grade_prefi = getGradewithoutBoard($proj_percent_prefi);
                                    $proj_grade_finals = getGradewithoutBoard($proj_percent_finals);
                                }
                            }else{
                                $proj_grade = 5.0;
                                $proj_grade_mid = 5.0;
                                $proj_grade_prefi = 5.0;
                                $proj_grade_finals = 5.0;
                            }


                            if($major_exams){
                                $exam_studtotal = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams)->sum('score');
                            }
                            if($major_exams_mid){
                                $exam_studtotal_mid = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_mid)->sum('score');
                            }
                            if($major_exams_prefi){
                                $exam_studtotal_prefi = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_prefi)->sum('score');
                            }
                            if($major_exams_finals){
                                $exam_studtotal_finals = App\MajorExamScore::where('id_no', $student->id_no)->whereIn('major_exam_id', $major_exams_finals)->sum('score');
                            }


                            if($exam_studtotal > 0){
                                $exam_percent = round((round($exam_studtotal) / $exam_total) * 100);
                            }else{
                                $exam_percent = 0;
                            }
                            if($exam_studtotal_mid > 0){
                                $exam_percent_mid = round((round($exam_studtotal_mid) / $exam_total_mid) * 100);
                            }else{
                                $exam_percent_mid = 0;
                            }
                            if($exam_studtotal_prefi > 0){
                                $exam_percent_prefi = round((round($exam_studtotal_prefi) / $exam_total_prefi) * 100);
                            }else{
                                $exam_percent_prefi = 0;
                            }
                            if($exam_studtotal_finals > 0){
                                $exam_percent_finals = round((round($exam_studtotal_finals) / $exam_total_finals) * 100);
                            }else{
                                $exam_percent_finals = 0;
                            }

                            if($course){
                                if($course->board_exam == 1){
                                    $exam_grade = getGradewithBoard($exam_percent);
                                    $exam_grade_mid = getGradewithBoard($exam_percent_mid);
                                    $exam_grade_prefi = getGradewithBoard($exam_percent_prefi);
                                    $exam_grade_finals = getGradewithBoard($exam_percent_finals);
                                }else{
                                    $exam_grade = getGradewithoutBoard($exam_percent);
                                    $exam_grade_mid = getGradewithoutBoard($exam_percent_mid);
                                    $exam_grade_prefi = getGradewithoutBoard($exam_percent_prefi);
                                    $exam_grade_finals = getGradewithoutBoard($exam_percent_finals);
                                }
                            }else{
                                $exam_grade = 5.0;
                                $exam_grade_mid = 5.0;
                                $exam_grade_prefi = 5.0;
                                $exam_grade_finals = 5.0;
                            }


                            $grade = calculateFinalGrade($quiz_act_att_ass_grade, $proj_grade, $exam_grade, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_mid = calculateFinalGrade($quiz_act_att_ass_grade_mid, $proj_grade_mid, $exam_grade_mid, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_prefi = calculateFinalGrade($quiz_act_att_ass_grade_prefi, $proj_grade_prefi, $exam_grade_prefi, $percentage->classwork, $percentage->projects, $percentage->exams);
                            $grade_finals = calculateFinalGrade($quiz_act_att_ass_grade_finals, $proj_grade_finals, $exam_grade_finals, $percentage->classwork, $percentage->projects, $percentage->exams);

                            $gwa = ($grade + $grade_mid + $grade_prefi + $grade_finals) / 4;

                            $tot_gwa_second_sem += $gwa;
                        ?>
                        <tr>
                            <td><b>{{$subj_->subject_code}}</b></td>
                            <td>{{$subj_->subject_desc}}</td>
                            @if($grade > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_mid > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_mid ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_mid ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_prefi > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_prefi ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_prefi ?? 0, 1)}}</td>  
                            @endif
                            @if($grade_finals > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($grade_finals ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($grade_finals ?? 0, 1)}}</td>  
                            @endif
                            @if($gwa > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">{{number_format($gwa ?? 0, 1)}}</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: green;">{{number_format($gwa ?? 0, 1)}}</td>  
                            @endif
                            @if($gwa > 3)
                                <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                            @else
                                <td style="text-align: center;font-weight: bold;color: black;">Passed</td>  
                            @endif
                        </tr>
                        @endforeach
                        @endisset
                        <tr>
                            <td colspan="6" style="text-align: right;font-weight: bold;">GWA</td>
                            @isset($subjects_second_sem)
                                <?php 
                                    $final_gwa = $tot_gwa_second_sem / $subjects_second_sem->count();
                                ?>
                                @if($final_gwa > 3)
                                    <td style="text-align: center;font-weight: bold;color: red;">{{number_format($final_gwa ?? 0, 1)}}</td>
                                    <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                                @else
                                    <td style="text-align: center;font-weight: bold;color: green;">{{number_format($final_gwa ?? 0, 1)}}</td>  
                                    <td style="text-align: center;font-weight: bold;color: black;">Passed</td>  
                                @endif
                            @else
                                <td style="text-align: center;font-weight: bold;color: red;">5.0</td>
                                <td style="text-align: center;font-weight: bold;color: red;">Failed</td>
                            @endisset
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function handleChange(selectedValue) {
    // Check if a value is selected
    if (!selectedValue) return;

    // AJAX request
    $.ajax({
        url: '/handle-change', // URL of the route in Laravel
        type: 'POST',
        data: {
            value: selectedValue, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {
            // Refresh the page after the AJAX request is successful
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
}

function handleChangeSection(selectedValue) {
    // Check if a value is selected
    if (!selectedValue) return;

    // AJAX request
    $.ajax({
        url: '/handle-change-section', // URL of the route in Laravel
        type: 'POST',
        data: {
            value: selectedValue, // Data to send to the server
            _token: '{{ csrf_token() }}' // CSRF token for Laravel
        },
        success: function(response) {
            // Refresh the page after the AJAX request is successful
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
}


$(document).ready(function() {
    $('a.btnDel').click(function(event) {
        event.preventDefault();
        swal({
            title: 'CONFIRM ACTION!',
            text: 'Are you sure you want to delete this record?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'DELETE',
            reverseButtons: true,
            focusConfirm: false,
        }).then((result) => {
            if (result.value) {
                $(this).parent().find('.formDelete').submit();
            }
        });
    });
    @if(Session::has('Inserted'))
    swal(
        'Saved',
        'New Quiz added successfully.',
        'success'
    )
    @elseif(Session::has('CourseTerm_Updated'))
    swal(
        'Saved',
        'Course Term has been updated successfully.',
        'success'
    )
    @elseif(Session::has('Activated'))
    swal(
        'Activated',
        'Quiz has been removed from archive successfuly.',
        'success'
    )
    @elseif(Session::has('Archived'))
    swal(
        'Deleted',
        'Quiz has been added to archive.',
        'success'
    )
    @elseif(Session::has('Deleted'))
    swal(
        'Deleted',
        'Quiz deleted successfully.',
        'success'
    )
    @elseif(Session::has('Updated'))
    swal("SUCCESS!", "{!! session('Updated') !!}", "success");
    swal(
        'Updated',
        'Quiz updated successfully.',
        'success'
    )
    @elseif(Session::has('Error'))
    swal(
        'INFO',
        'Unable to delete, this record is used.',
        'info'
    )
    @elseif(Session::has('Duplicate'))
    swal('Duplicate Record.', 'This record already exist.', 'info');
    @endif
});
</script>
@endsection