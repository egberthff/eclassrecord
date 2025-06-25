@extends('layouts.admin')
@section('insights')
active
@endsection
@section('head')
    <style>
        .margin-0rem{
            margin-bottom: 0rem !important;
        }
        .fsize_15{
            font-size: 15px !important;
        }
        .fsize_12{
            font-size: 12px !important;
        }
        table thead tr th{
            font-weight: normal;
        }
    </style>
@endsection
@section('content')
<section class="welcome p-t-30 p-b-10" >
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-3">Grades
            </h1>
        </div>
    </div>
</div>
</section>

<div class="row">
    <div class="col-md-4" style="padding-top: 10px;padding-left: 25px;">
        <div class="form-group" style="margin-top: -10px;">
            <?php 
            $subjs = App\CurriculumSubject::where('faculty_id', Auth::user()->email)->get();
            ?>
            <label class=" form-control-label">Current Subject </label>
            <select class="form-control select2" name="curriculum_subject_id" id="company" aria-required="true" aria-invalid="false" data-validation="required" style="font-weight: bold;" onchange="handleChange(this.value)">
            @isset($subjs)
                @foreach($subjs as $subj)
                <option value="{{$subj->id}}" @if($subj_activ != '' && $subj->id == $subj_activ) selected @endif>{{$subj->course->code}} [Year : {{$subj->year}} Sem : {{$subj->semester}}] {{$subj->subject_code}}</option>
                @endforeach
            @endisset
            </select>
        </div>
    </div>

    <!-- <a href="mailto:someone@example.com?subject=Hello&body=This%20is%20a%20test%20email">Send Email</a> -->
    <div class="col-md-2">
        <div class="form-group">
            <label class=" form-control-label">Section</label>
            <select class="form-control select2" name="section" id="company" aria-required="true" aria-invalid="false" data-validation="required" style="font-weight: bold;" onchange="handleChangeSection(this.value)">
            <option value="">Select Section</option>
            @isset($sections)
                @foreach($sections as $section)
                <option value="{{$section->section}}" @if($section_activ != '' && $section->section == $section_activ) selected @endif>{{$section->section}}</option>
                @endforeach
            @endisset
            </select>
        </div>
    </div>
    
    <br><br><br>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="container-fluid row pull-center" style="text-align: right;padding-top: 10px;padding-bottom: 10px;">
            <div class="col-md-3" style="text-align: right;">
                <img src="{{URL::to('logo.png')}}" style="width: 100px;height:100px;" alt="">
            </div>
            <div class="col-md-6" style="text-align: center;">
                <p class="cambria margin-0rem fsize_15">Republic of the Philippines</p>
                <p class="cambria margin-0rem fsize_15" style="font-weight: bold;">BOHOL ISLAND STATE UNIVERSITY-BALILIHAN CAMPUS</p>
                <p class="cambria margin-0rem fsize_15">Magsija, Balilihan, Bohol</p>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="container-fluid">
            <p class="fsize_12" style="margin-bottom: 0em;text-align:center;">Vision: A premier S & T university for the formation of a world class and virtue-laden human resource for sustainable development of Bohol and the country</p>
            <p class="fsize_12" style="border-bottom: solid 1px;text-align:center;">Mission: BISU is committed to provide quality higher education in the arts and sciences, as well as in the professional and technological fields, undertake research and development and extension services for the sustainable development of Bohol and the country.</p>
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;padding-top: 10px;">@isset($collection->course){{$collection->course->course}} @endisset</p>
            <p class="cambria margin-0rem" style="text-align: center;">@isset($collection->course){{$collection->subject_code}} @endisset</p>
            <p class="cambria margin-0rem" style="text-align: center;">
                @isset($collection) @if($collection->semester == 1) 1st Semester @else 2nd Semester @endif @endisset  {{$sy->name}}
            </p>

            <div class="table-responsive m-b-40" style="overflow-x: auto;">
                <table id="table4" class="table table-bordered" style="width: 100%;">
                  <thead style="background-color: white;">
                        <?php
                            $quizes = App\Quiz::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $activities = App\Activity::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $attendances = App\Attendance::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $assignments = App\Assignment::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $classworkcount = $quizes->count() + $activities->count() + $attendances->count() + $assignments->count();
                            $projects = App\Project::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $major_exams = App\MajorExam::where('course_term', 1)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();

                            $quizes_mid = App\Quiz::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $activities_mid = App\Activity::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $attendances_mid = App\Attendance::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $assignments_mid = App\Assignment::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $classworkcount_mid = $quizes_mid->count() + $activities_mid->count() + $attendances_mid->count() + $assignments_mid->count();
                            $projects_mid = App\Project::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $major_exams_mid = App\MajorExam::where('course_term', 2)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            
                            $quizes_prefi = App\Quiz::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $activities_prefi = App\Activity::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $attendances_prefi = App\Attendance::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $assignments_prefi = App\Assignment::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $classworkcount_prefi = $quizes_prefi->count() + $activities_prefi->count() + $attendances_prefi->count() + $assignments_prefi->count();
                            $projects_prefi = App\Project::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $major_exams_prefi = App\MajorExam::where('course_term', 3)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            
                            $quizes_finals = App\Quiz::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $activities_finals = App\Activity::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $attendances_finals = App\Attendance::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $assignments_finals = App\Assignment::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $classworkcount_finals = $quizes_finals->count() + $activities_finals->count() + $attendances_finals->count() + $assignments_finals->count();
                            $projects_finals = App\Project::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $major_exams_finals = App\MajorExam::where('course_term', 4)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            
                            $percentage  = App\Setting::where('id', '<>', 0)->first();
                        ?>
                      <tr>
                          <th width="10%">NO.</th>
                          <th width="30%">NAME OF STUDENTS</th>
                          <th width="60%" style="text-align: center;">PERFORMANCE</th>
                      </tr>
                        <?php 
                            $quiz_act_att_ass_total = 0;
                            $proj_total = 0;
                            $exam_total = 0;

                            $quiz_act_att_ass_total_mid = 0;
                            $proj_total_mid = 0;
                            $exam_total_mid = 0;

                            $quiz_act_att_ass_total_prefi = 0;
                            $proj_total_prefi = 0;
                            $exam_total_prefi = 0;

                            $quiz_act_att_ass_total_finals = 0;
                            $proj_total_finals = 0;
                            $exam_total_finals = 0;
                         ?> 

                         
                         @isset($quizes)
                            @foreach($quizes as $element)
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($quizes_mid)
                            @foreach($quizes_mid as $element)
                                <?php 
                                    $quiz_act_att_ass_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($quizes_prefi)
                            @foreach($quizes_prefi as $element)
                                <?php 
                                    $quiz_act_att_ass_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($quizes_finals)
                            @foreach($quizes_finals as $element)
                                <?php 
                                    $quiz_act_att_ass_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                          
                          @isset($activities)
                            @foreach($activities as $element)
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($activities_mid)
                            @foreach($activities_mid as $element)
                                <?php 
                                    $quiz_act_att_ass_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($activities_prefi)
                            @foreach($activities_prefi as $element)
                                <?php 
                                    $quiz_act_att_ass_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($activities_finals)
                            @foreach($activities_finals as $element)
                                <?php 
                                    $quiz_act_att_ass_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset




                          @isset($attendances)
                            @foreach($attendances as $element)
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($attendances_mid)
                            @foreach($attendances_mid as $element)
                                <?php 
                                    $quiz_act_att_ass_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($attendances_prefi)
                            @foreach($attendances_prefi as $element)
                                <?php 
                                    $quiz_act_att_ass_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($attendances_finals)
                            @foreach($attendances_finals as $element)
                                <?php 
                                    $quiz_act_att_ass_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset



                          @isset($assignments)
                            @foreach($assignments as $element)
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($assignments_mid)
                            @foreach($assignments_mid as $element)
                                <?php 
                                    $quiz_act_att_ass_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($assignments_prefi)
                            @foreach($assignments_prefi as $element)
                                <?php 
                                    $quiz_act_att_ass_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($assignments_finals)
                            @foreach($assignments_finals as $element)
                                <?php 
                                    $quiz_act_att_ass_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset



                          @isset($projects)
                            @foreach($projects as $element)
                                <?php 
                                    $proj_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($projects_mid)
                            @foreach($projects_mid as $element)
                                <?php 
                                    $proj_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($projects_prefi)
                            @foreach($projects_prefi as $element)
                                <?php 
                                    $proj_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($projects_finals)
                            @foreach($projects_finals as $element)
                                <?php 
                                    $proj_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset




                          @isset($major_exams)
                            @foreach($major_exams as $element)
                                <?php 
                                    $exam_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($major_exams_mid)
                            @foreach($major_exams_mid as $element)
                                <?php 
                                    $exam_total_mid += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($major_exams_prefi)
                            @foreach($major_exams_prefi as $element)
                                <?php 
                                    $exam_total_prefi += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                          @isset($major_exams_finals)
                            @foreach($major_exams_finals as $element)
                                <?php 
                                    $exam_total_finals += $element->items_total;
                                ?>
                            @endforeach
                          @endisset
                  </thead>
                  <tbody>
                    @isset($students)
                        <?php 
                            $x = 0; 
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
                        ?>
                        @foreach($students as $stud)
                            <?php 
                                $x++; 
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
                            ?>
                            <tr>
                                @isset($quizes)
                                    @foreach($quizes as $element)
                                        <?php 
                                            $quiz = App\QuizScore::where('id_no', $stud->id_no)->where('quiz_id', $element->id)->first();

                                            if($quiz){
                                                $qscore = $quiz->score;
                                                $quiz_act_att_ass_studtotal += $qscore;
                                            }else{
                                                $qscore = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($quizes_mid)
                                    @foreach($quizes_mid as $element)
                                        <?php 
                                            $quiz = App\QuizScore::where('id_no', $stud->id_no)->where('quiz_id', $element->id)->first();

                                            if($quiz){
                                                $qscore_mid = $quiz->score;
                                                $quiz_act_att_ass_studtotal_mid += $qscore_mid;
                                            }else{
                                                $qscore_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($quizes_prefi)
                                    @foreach($quizes_prefi as $element)
                                        <?php 
                                            $quiz = App\QuizScore::where('id_no', $stud->id_no)->where('quiz_id', $element->id)->first();

                                            if($quiz){
                                                $qscore_prefi = $quiz->score;
                                                $quiz_act_att_ass_studtotal_prefi += $qscore_prefi;
                                            }else{
                                                $qscore_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($quizes_finals)
                                    @foreach($quizes_finals as $element)
                                        <?php 
                                            $quiz = App\QuizScore::where('id_no', $stud->id_no)->where('quiz_id', $element->id)->first();

                                            if($quiz){
                                                $qscore_finals = $quiz->score;
                                                $quiz_act_att_ass_studtotal_finals += $qscore_finals;
                                            }else{
                                                $qscore_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                
                                @isset($activities)
                                    @foreach($activities as $element)
                                        <?php 
                                            $act = App\ActivityScore::where('id_no', $stud->id_no)->where('activity_id', $element->id)->first();

                                            if($act){
                                                $actscore = $act->score;
                                                $quiz_act_att_ass_studtotal += $actscore;
                                            }else{
                                                $actscore = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($activities_mid)
                                    @foreach($activities_mid as $element)
                                        <?php 
                                            $act = App\ActivityScore::where('id_no', $stud->id_no)->where('activity_id', $element->id)->first();

                                            if($act){
                                                $actscore_mid = $act->score;
                                                $quiz_act_att_ass_studtotal_mid += $actscore_mid;
                                            }else{
                                                $actscore_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($activities_prefi)
                                    @foreach($activities_prefi as $element)
                                        <?php 
                                            $act = App\ActivityScore::where('id_no', $stud->id_no)->where('activity_id', $element->id)->first();

                                            if($act){
                                                $actscore_prefi = $act->score;
                                                $quiz_act_att_ass_studtotal_prefi += $actscore_prefi;
                                            }else{
                                                $actscore_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($activities_finals)
                                    @foreach($activities_finals as $element)
                                        <?php 
                                            $act = App\ActivityScore::where('id_no', $stud->id_no)->where('activity_id', $element->id)->first();

                                            if($act){
                                                $actscore_finals = $act->score;
                                                $quiz_act_att_ass_studtotal_finals += $actscore_finals;
                                            }else{
                                                $actscore_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset

                                @isset($attendances)
                                    @foreach($attendances as $element)
                                        <?php 
                                            $att = App\AttendanceScore::where('id_no', $stud->id_no)->where('attendance_id', $element->id)->first();

                                            if($att){
                                                $attscore = $att->score;
                                                $quiz_act_att_ass_studtotal += $attscore;
                                            }else{
                                                $attscore = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($attendances_mid)
                                    @foreach($attendances_mid as $element)
                                        <?php 
                                            $att = App\AttendanceScore::where('id_no', $stud->id_no)->where('attendance_id', $element->id)->first();

                                            if($att){
                                                $attscore_mid = $att->score;
                                                $quiz_act_att_ass_studtotal_mid += $attscore_mid;
                                            }else{
                                                $attscore_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($attendances_prefi)
                                    @foreach($attendances_prefi as $element)
                                        <?php 
                                            $att = App\AttendanceScore::where('id_no', $stud->id_no)->where('attendance_id', $element->id)->first();

                                            if($att){
                                                $attscore_prefi = $att->score;
                                                $quiz_act_att_ass_studtotal_prefi += $attscore_prefi;
                                            }else{
                                                $attscore_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($attendances_finals)
                                    @foreach($attendances_finals as $element)
                                        <?php 
                                            $att = App\AttendanceScore::where('id_no', $stud->id_no)->where('attendance_id', $element->id)->first();

                                            if($att){
                                                $attscore_finals = $att->score;
                                                $quiz_act_att_ass_studtotal_finals += $attscore_finals;
                                            }else{
                                                $attscore_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset

                                @isset($assignments)
                                    @foreach($assignments as $element)
                                        <?php 
                                            $ass = App\AssignmentScore::where('id_no', $stud->id_no)->where('assignment_id', $element->id)->first();

                                            if($ass){
                                                $ass_score = $ass->score;
                                                $quiz_act_att_ass_studtotal += $ass_score;
                                            }else{
                                                $ass_score = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($assignments_mid)
                                    @foreach($assignments_mid as $element)
                                        <?php 
                                            $ass = App\AssignmentScore::where('id_no', $stud->id_no)->where('assignment_id', $element->id)->first();

                                            if($ass){
                                                $ass_score_mid = $ass->score;
                                                $quiz_act_att_ass_studtotal_mid += $ass_score_mid;
                                            }else{
                                                $ass_score_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($assignments_prefi)
                                    @foreach($assignments_prefi as $element)
                                        <?php 
                                            $ass = App\AssignmentScore::where('id_no', $stud->id_no)->where('assignment_id', $element->id)->first();

                                            if($ass){
                                                $ass_score_prefi = $ass->score;
                                                $quiz_act_att_ass_studtotal_prefi += $ass_score_prefi;
                                            }else{
                                                $ass_score_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($assignments_finals)
                                    @foreach($assignments_finals as $element)
                                        <?php 
                                            $ass = App\AssignmentScore::where('id_no', $stud->id_no)->where('assignment_id', $element->id)->first();

                                            if($ass){
                                                $ass_score_finals = $ass->score;
                                                $quiz_act_att_ass_studtotal_finals += $ass_score_finals;
                                            }else{
                                                $ass_score_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset


                                
                                <?php 
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

                                    if($collection != ''){
                                        if($collection->course->board_exam == 1){
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
                                    


                                ?>

                                @isset($projects)
                                    @foreach($projects as $element)
                                        <?php 
                                            $proj = App\ProjectScore::where('id_no', $stud->id_no)->where('project_id', $element->id)->first();

                                            if($proj){
                                                $proj_score = $proj->score;
                                                $proj_studtotal += $proj_score;
                                            }else{
                                                $proj_score = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($projects_mid)
                                    @foreach($projects_mid as $element)
                                        <?php 
                                            $proj = App\ProjectScore::where('id_no', $stud->id_no)->where('project_id', $element->id)->first();

                                            if($proj){
                                                $proj_score_mid = $proj->score;
                                                $proj_studtotal_mid += $proj_score_mid;
                                            }else{
                                                $proj_score_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($projects_prefi)
                                    @foreach($projects_prefi as $element)
                                        <?php 
                                            $proj = App\ProjectScore::where('id_no', $stud->id_no)->where('project_id', $element->id)->first();

                                            if($proj){
                                                $proj_score_prefi = $proj->score;
                                                $proj_studtotal_prefi += $proj_score_prefi;
                                            }else{
                                                $proj_score_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($projects_finals)
                                    @foreach($projects_finals as $element)
                                        <?php 
                                            $proj = App\ProjectScore::where('id_no', $stud->id_no)->where('project_id', $element->id)->first();

                                            if($proj){
                                                $proj_score_finals = $proj->score;
                                                $proj_studtotal_finals += $proj_score_finals;
                                            }else{
                                                $proj_score_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset

                                
                                <?php 
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
                                    
                                    
                                    
                                    if($collection != ''){
                                        if($collection->course->board_exam == 1){
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

                                    
                                    
                                ?>
                                

                                @isset($major_exams)
                                    @foreach($major_exams as $element)
                                        <?php 
                                            $exam = App\MajorExamScore::where('id_no', $stud->id_no)->where('major_exam_id', $element->id)->first();

                                            if($exam){
                                                $exam_score = $exam->score;
                                                $exam_studtotal += $exam_score;
                                            }else{
                                                $exam_score = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($major_exams_mid)
                                    @foreach($major_exams_mid as $element)
                                        <?php 
                                            $exam = App\MajorExamScore::where('id_no', $stud->id_no)->where('major_exam_id', $element->id)->first();

                                            if($exam){
                                                $exam_score_mid = $exam->score;
                                                $exam_studtotal_mid += $exam_score_mid;
                                            }else{
                                                $exam_score_mid = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($major_exams_prefi)
                                    @foreach($major_exams_prefi as $element)
                                        <?php 
                                            $exam = App\MajorExamScore::where('id_no', $stud->id_no)->where('major_exam_id', $element->id)->first();

                                            if($exam){
                                                $exam_score_prefi = $exam->score;
                                                $exam_studtotal_prefi += $exam_score_prefi;
                                            }else{
                                                $exam_score_prefi = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset
                                @isset($major_exams_finals)
                                    @foreach($major_exams_finals as $element)
                                        <?php 
                                            $exam = App\MajorExamScore::where('id_no', $stud->id_no)->where('major_exam_id', $element->id)->first();

                                            if($exam){
                                                $exam_score_finals = $exam->score;
                                                $exam_studtotal_finals += $exam_score_finals;
                                            }else{
                                                $exam_score_finals = '';
                                            }
                                        ?>
                                    @endforeach
                                @endisset

                                
                                <?php 
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

                                    if($collection != ''){
                                        if($collection->course->board_exam == 1){
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
                                ?>
                                <?php 
                                    $grade = calculateFinalGrade($quiz_act_att_ass_grade, $proj_grade, $exam_grade, $percentage->classwork, $percentage->projects, $percentage->exams);
                                    $grade_mid = calculateFinalGrade($quiz_act_att_ass_grade_mid, $proj_grade_mid, $exam_grade_mid, $percentage->classwork, $percentage->projects, $percentage->exams);
                                    $grade_prefi = calculateFinalGrade($quiz_act_att_ass_grade_prefi, $proj_grade_prefi, $exam_grade_prefi, $percentage->classwork, $percentage->projects, $percentage->exams);
                                    $grade_finals = calculateFinalGrade($quiz_act_att_ass_grade_finals, $proj_grade_finals, $exam_grade_finals, $percentage->classwork, $percentage->projects, $percentage->exams);

                                    $gwa = ($exam_percent + $exam_percent_mid + $exam_percent_prefi + $exam_percent_finals) / 4;
                                ?>
                                <td>{{$x}}</td>
                                <td>{{$stud->lastname}}, {{$stud->firstname}} {{$stud->middlename}}</td>
                                <td style="text-align: center;font-weight: bold;color: black;">
                                    @if($gwa > 75)
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$gwa}}%" aria-valuenow="{{$gwa}}" aria-valuemin="0" aria-valuemax="100">{{$gwa}}%</div>
                                    </div>
                                    @else
                                    <div class="progress mb-2">
											<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$gwa}}%" aria-valuenow="{{$gwa}}" aria-valuemin="0" aria-valuemax="100">{{$gwa}}%</div>
									</div>
                                    @endif
                                </td>  
                            </tr>
                        @endforeach
                    @endisset
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


      $(document).ready(function(){
          $('a.btnDel').click(function (event) {
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
                  if(result.value){
                  $(this).parent().find('.formDelete').submit();
              }
          });
          });
          @if(  Session::has('Inserted') )
            swal(
              'Saved',
              'New Quiz added successfully.',
              'success'
            )
         @elseif(  Session::has('CourseTerm_Updated') )
            swal(
              'Saved',
              'Course Term has been updated successfully.',
              'success'
            )
          @elseif( Session::has('Activated') )
            swal(
              'Activated',
              'Quiz has been removed from archive successfuly.',
              'success'
            )
          @elseif( Session::has('Archived') )
            swal(
              'Deleted',
              'Quiz has been added to archive.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'Quiz deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Quiz updated successfully.',
              'success'
            )
          @elseif( Session::has('Error') )
            swal(
              'INFO',
              'Unable to delete, this record is used.',
              'info'
            )
          @elseif( Session::has('Duplicate') )
            swal('Duplicate Record.', 'This record already exist.', 'info');
          @endif
      });
  </script>
@endsection