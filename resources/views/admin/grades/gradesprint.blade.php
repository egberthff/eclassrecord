<!DOCTYPE html>
<html>

<head>
    <title>GRADING SHEET</title>
    <link rel="icon" type="text/css" href="{{URL::to('logo.png')}}">
</head>

<!-- Bootstrap CSS-->
<link href="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
<style>
.century_gothic {
    font-family: Arial, sans-serif;
}

.cambria {
    font-family: Arial, sans-serif;
}

.calibri {
    font-family: Arial, sans-serif;
}

p {
    font-family: Arial, sans-serif;
}

input {
    font-family: Arial, sans-serif;
}

.margin-0rem {
    margin-bottom: 0rem;
}

.fsize_15 {
    font-size: 15px;
}

.checkbox-wrapper-28 label {
    font-family: Arial, sans-serif;
}

.checkbox-wrapper-28 {
    --size: 25px;
    position: relative;
}

.checkbox-wrapper-28 *,
.checkbox-wrapper-28 *:before,
.checkbox-wrapper-28 *:after {
    box-sizing: border-box;
}

.checkbox-wrapper-28 .promoted-input-checkbox {
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

.checkbox-wrapper-28 input:checked~svg {
    height: calc(var(--size) * 0.6);
    -webkit-animation: draw-checkbox-28 ease-in-out 0.2s forwards;
    animation: draw-checkbox-28 ease-in-out 0.2s forwards;
}

.checkbox-wrapper-28 label:active::after {
    background-color: #e6e6e6;
}

.checkbox-wrapper-28 label {
    color: black;
    line-height: var(--size);
    cursor: pointer;
    position: relative;
}

.checkbox-wrapper-28 label:after {
    content: "";
    height: var(--size);
    width: var(--size);
    margin-right: 8px;
    float: left;
    border: 2px solid black;
    border-radius: 3px;
    transition: 0.15s all ease-out;
}

.checkbox-wrapper-28 svg {
    stroke: black;
    stroke-width: 3px;
    height: 0;
    width: calc(var(--size) * 0.6);
    position: absolute;
    left: calc(var(--size) * 0.21);
    top: calc(var(--size) * 0.2);
    stroke-dasharray: 33;
}

th,
tr,
td {
    border-color: black;
}

span.form-error {
    display: none;
}

.col-md-1 {
    width: 8.33% !important;
}

.col-md-2 {
    width: 16.66% !important;
}

.col-md-3 {
    width: 25% !important;
}

.col-md-4 {
    width: 33.33% !important;
}

.col-md-5 {
    width: 41.6% !important;
}

.col-md-6 {
    width: 50% !important;
}

.col-md-7 {
    width: 58.33% !important;
}

.col-md-8 {
    width: 66.66% !important;
}

.col-md-10 {
    width: 83.3% !important;
}

.col-md-12 {
    width: 100% !important;
}
</style>

<body>

    <div class="container-fluid" style="height: 1500px;">
        <div class="container-fluid row pull-center" style="text-align: right;padding-top: 10px;padding-bottom: 10px;">
            <div class="col-md-12" style="text-align: center;">
                <img src="{{URL::to('header.png')}}" style="width: 90%;height:180px;" alt="">
            </div>

        </div>
        <div class="container-fluid">
            <p class="cambria margin-0rem"
                style="text-align: center;font-weight: bold;font-size: 20px;padding-top: 10px;border-top: 3px solid;">
                GRADING SHEET</p>
            <p class="cambria margin-0rem" style="text-align: center;padding-bottom: 10px;border-bottom: 3px solid;">
                <b>{{$sy->name}}</b>,
                Term: <b>{{$collection->semester}}</b></p>

            <div class="row">
                <div class="col-md-3">Section: <b>@isset($collection->course){{$collection->course->code}} @endisset
                        @isset($collection->year) {{$collection->year}}@endisset
                        @isset($section_activ){{$section_activ}} @endisset</b></div>
                <div class="col-md-3">Instructor: <b>{{Auth::user()->name}}</b></div>
                <div class="col-md-3"></div>
                <div class="col-md-3">Control #: <b>0000{{$collection->id}}</b></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">Subject Code:
                    <b>@isset($collection->subject_code){{$collection->subject_code}} @endisset</b>
                </div>
                <div class="col-md-3">Subject Description:
                    <b>@isset($collection->subject_desc){{$collection->subject_desc}} @endisset</b>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">Units: <b>@isset($collection->total_units){{$collection->total_units}}
                        @endisset</b></div>
            </div>
            <br>
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
                            <th><b>#</b></th>
                            <th><b>ID NO.</b></th>
                            <th style="width: 300px;"><b>NAME OF STUDENTS</b></th>
                            @if(Auth::user()->prelim == 1)
                            <th style="text-align: center;"><b>PRELIM</b></th>
                            @endif
                            @if(Auth::user()->midterm == 1)
                            <th style="text-align: center;"><b>MIDTERM</b></th>
                            @endif
                            @if(Auth::user()->prefi == 1)
                            <th style="text-align: center;"><b>SEMIFINAL</b></th>
                            @endif
                            @if(Auth::user()->final == 1)
                            <th style="text-align: center;"><b>FINAL</b></th>
                            @endif
                            <th style="text-align: center;"><b>FINAL GRADE</b></th>
                            <th style="text-align: center;"><b>RE-EXAM</b></th>
                            <th style="text-align: center;"><b>REMARKS</b></th>
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

                            if($collection->year == 1){
                                function getGradewithBoard($score) {
                                    if ($score >= 95) return 1.0;
                                    elseif ($score >= 94) return 1.1;
                                    elseif ($score >= 93) return 1.2;
                                    elseif ($score >= 91) return 1.3;
                                    elseif ($score >= 90) return 1.4;
                                    elseif ($score >= 89) return 1.5;
                                    elseif ($score >= 87) return 1.6;
                                    elseif ($score >= 86) return 1.7;
                                    elseif ($score >= 85) return 1.8;
                                    elseif ($score >= 84) return 2.0;
                                    elseif ($score >= 83) return 2.1;
                                    elseif ($score >= 81) return 2.3;
                                    elseif ($score >= 80) return 2.5;
                                    elseif ($score >= 79) return 2.6;
                                    elseif ($score >= 78) return 2.7;
                                    elseif ($score >= 76) return 2.9;
                                    elseif ($score >= 75) return 3.0;
                                    elseif ($score >= 73) return 3.2;
                                    elseif ($score >= 72) return 3.3;
                                    elseif ($score >= 71) return 3.4;
                                    elseif ($score >= 70) return 3.5;
                                    elseif ($score >= 69) return 3.6;
                                    elseif ($score >= 68) return 3.7;
                                    elseif ($score >= 66) return 3.9;
                                    elseif ($score >= 64) return 4.1;
                                    elseif ($score >= 63) return 4.2;
                                    elseif ($score >= 62) return 4.3;
                                    elseif ($score >= 61) return 4.4;
                                    elseif ($score >= 60) return 4.5;
                                    elseif ($score >= 58) return 4.6;
                                    elseif ($score >= 56) return 4.7;
                                    elseif ($score >= 54) return 4.8;
                                    elseif ($score >= 50) return 4.9;
                                    elseif ($score >= 40) return 5.0; // Matches the range for scores 40-49
                                    else return 5.0; // For scores below 40
                                }                                
    
                                function getGradewithoutBoard($score) {
                                    if ($score >= 95) return 1.0;
                                    elseif ($score >= 94) return 1.1;
                                    elseif ($score >= 93) return 1.2;
                                    elseif ($score >= 91) return 1.3;
                                    elseif ($score >= 90) return 1.4;
                                    elseif ($score >= 89) return 1.5;
                                    elseif ($score >= 87) return 1.6;
                                    elseif ($score >= 86) return 1.7;
                                    elseif ($score >= 85) return 2.0;
                                    elseif ($score >= 83) return 2.2;
                                    elseif ($score >= 81) return 2.4;
                                    elseif ($score >= 79) return 2.6;
                                    elseif ($score >= 77) return 2.8;
                                    elseif ($score >= 75) return 3.0;
                                    elseif ($score >= 74) return 3.2;
                                    elseif ($score >= 72) return 3.4;
                                    elseif ($score >= 71) return 3.5;
                                    elseif ($score >= 70) return 3.6;
                                    elseif ($score >= 69) return 3.7;
                                    elseif ($score >= 67) return 3.9;
                                    elseif ($score >= 65) return 4.1;
                                    elseif ($score >= 64) return 4.2;
                                    elseif ($score >= 63) return 4.3;
                                    elseif ($score >= 62) return 4.4;
                                    elseif ($score >= 61) return 4.5;
                                    elseif ($score >= 60) return 4.6;
                                    elseif ($score >= 59) return 4.7;
                                    elseif ($score >= 58) return 4.8;
                                    elseif ($score >= 56) return 4.9;
                                    else return 5.0; // For scores below 56
                                }
                                
                            }else{
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
                                    $tot_terms = 0;

                                    if(Auth::user()->prelim == 1){
                                        $grade = calculateFinalGrade($quiz_act_att_ass_grade, $proj_grade, $exam_grade, $percentage->classwork, $percentage->projects, $percentage->exams);
                                        $tot_terms++;
                                    }else{
                                        $grade = 0;
                                    }

                                    if(Auth::user()->midterm == 1){
                                        $grade_mid = calculateFinalGrade($quiz_act_att_ass_grade_mid, $proj_grade_mid, $exam_grade_mid, $percentage->classwork, $percentage->projects, $percentage->exams);
                                        $tot_terms++;
                                    }else{
                                        $grade_mid = 0;
                                    }

                                    if(Auth::user()->prefi == 1){
                                        $grade_prefi = calculateFinalGrade($quiz_act_att_ass_grade_prefi, $proj_grade_prefi, $exam_grade_prefi, $percentage->classwork, $percentage->projects, $percentage->exams);
                                        $tot_terms++;
                                    }else{
                                        $grade_prefi = 0;
                                    }

                                    if(Auth::user()->final == 1){
                                        $grade_finals = calculateFinalGrade($quiz_act_att_ass_grade_finals, $proj_grade_finals, $exam_grade_finals, $percentage->classwork, $percentage->projects, $percentage->exams);
                                        $tot_terms++;
                                    }else{
                                        $grade_finals = 0;
                                    }

                                    if($tot_terms == 0){
                                        $tot_terms = 1;
                                    }

                                    $gwa = ($grade + $grade_mid + $grade_prefi + $grade_finals) / $tot_terms;
                                ?>
                            <td>{{$x}}</td>
                            <td>{{$stud->id_no}}</td>
                            <td>{{$stud->lastname}}, {{$stud->firstname}} {{$stud->middlename}}</td>
                            @if(Auth::user()->prelim == 1)
                            @if($grade > 3)
                            <td style="text-align: right;">{{number_format($grade ?? 0, 1)}}
                            </td>
                            @else
                            <td style="text-align: right;">
                                {{number_format($grade ?? 0, 1)}}</td>
                            @endif
                            @endif
                            @if(Auth::user()->midterm == 1)
                            @if($grade_mid > 3)
                            <td style="text-align: right;">
                                {{number_format($grade_mid ?? 0, 1)}}</td>
                            @else
                            <td style="text-align: right;">
                                {{number_format($grade_mid ?? 0, 1)}}</td>
                            @endif
                            @endif
                            @if(Auth::user()->prefi == 1)
                            @if($grade_prefi > 3)
                            <td style="text-align: right;">
                                {{number_format($grade_prefi ?? 0, 1)}}</td>
                            @else
                            <td style="text-align: right;">
                                {{number_format($grade_prefi ?? 0, 1)}}</td>
                            @endif
                            @endif
                            @if(Auth::user()->final == 1)
                            @if($grade_finals > 3)
                            <td style="text-align: right;">
                                {{number_format($grade_finals ?? 0, 1)}}</td>
                            @else
                            <td style="text-align: right;">
                                {{number_format($grade_finals ?? 0, 1)}}</td>
                            @endif
                            @endif
                            @if($gwa > 3)
                            <td style="text-align: right;">{{number_format($gwa ?? 0, 1)}}
                            </td>
                            @else
                            <td style="text-align: right;">{{number_format($gwa ?? 0, 1)}}
                            </td>
                            @endif
                            <?php 
                                $re_exam = App\ReExam::where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('id_no', $stud->id_no)->first();
                            ?>
                            @if($gwa > 3)
                                @isset($re_exam) 
                                    @if($re_exam->grade == '3.0')
                                    <td style="text-align: right;">3.0</td>
                                    <td style="text-align: left;"></td>
                                    @else
                                    <td style="text-align: right;">5.0</td>
                                    <td style="text-align: left;">Failed</td>
                                    @endif
                                @else
                                    <td style="text-align: right;">5.0</td>
                                    <td style="text-align: left;">Failed</td>
                                @endisset
                            @else
                            <td style="text-align: right;"></td>
                            <td style="text-align: left;"></td>
                            @endif
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

<script src="{{URL::to('admin/vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{URL::to('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{URL::to('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>


<script type="text/javascript">
// Create a new <style> element
const printStyle = document.createElement('style');
printStyle.innerHTML = `
        @media print {
            .century_gothic {
                font-family: Arial, sans-serif;
            }

            .cambria {
                font-family: Arial, sans-serif;
            }

            .calibri {
                font-family: Arial, sans-serif;
            }

            p {
                font-family: Arial, sans-serif;
            }

            input {
                font-family: Arial, sans-serif;
            }

            .margin-0rem {
                margin-bottom: 0rem;
            }

            .fsize_15 {
                font-size: 15px;
            }

            .checkbox-wrapper-28 label {
                font-family: Arial, sans-serif;
            }

            .checkbox-wrapper-28 {
                --size: 25px;
                position: relative;
            }

            .checkbox-wrapper-28 *,
            .checkbox-wrapper-28 *:before,
            .checkbox-wrapper-28 *:after {
                box-sizing: border-box;
            }

            .checkbox-wrapper-28 .promoted-input-checkbox {
                border: 0;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            .checkbox-wrapper-28 input:checked~svg {
                height: calc(var(--size) * 0.6);
                -webkit-animation: draw-checkbox-28 ease-in-out 0.2s forwards;
                animation: draw-checkbox-28 ease-in-out 0.2s forwards;
            }

            .checkbox-wrapper-28 label:active::after {
                background-color: #e6e6e6;
            }

            .checkbox-wrapper-28 label {
                color: black;
                line-height: var(--size);
                cursor: pointer;
                position: relative;
            }

            .checkbox-wrapper-28 label:after {
                content: "";
                height: var(--size);
                width: var(--size);
                margin-right: 8px;
                float: left;
                border: 2px solid black;
                border-radius: 3px;
                transition: 0.15s all ease-out;
            }

            .checkbox-wrapper-28 svg {
                stroke: black;
                stroke-width: 3px;
                height: 0;
                width: calc(var(--size) * 0.6);
                position: absolute;
                left: calc(var(--size) * 0.21);
                top: calc(var(--size) * 0.2);
                stroke-dasharray: 33;
            }

            th,
            tr,
            td {
                border-color: black;
            }

            span.form-error {
                display: none;
            }

            .col-md-1{
                width: 8.33% !important;
            }

            .col-md-2{
                width: 16.66% !important;
            }

            .col-md-3{
                width: 25% !important;
            }

            .col-md-4{
                width: 33.33% !important;
            }

            .col-md-5{
                width: 41.6% !important;
            }

            .col-md-6{
                width: 50% !important;
            }

            .col-md-7{
                width: 58.33% !important;
            }

            .col-md-8{
                width: 66.66% !important;
            }

            .col-md-10{
                width: 83.3% !important;
            }

            .col-md-12{
                width: 100% !important;
            }
        }
    `;

// Append the style to the head
document.head.appendChild(printStyle);

// Trigger the print dialog
window.print();

// Optional: Remove the style after printing
// document.head.removeChild(printStyle);
</script>

</html>