@extends('layouts.admin')
@section('class_record')
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

        input[type="number"] {
            width: 50px;
            padding: 0; /* Adjust padding to avoid extra width */
            box-sizing: border-box; /* Ensures padding and border are included in the width */
        }
    </style>
@endsection
@section('content')
<section class="welcome p-t-30 p-b-10" >
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-3">Class Record
            </h1>
        </div>
    </div>
</div>
</section>

<div class="row">
    <div class="col-md-4" style="padding-top: 10px;padding-left: 25px;">
    @isset($faculty)
        @if($faculty->course_term == 1)
            @if(Auth::user()->prelim == 1)
            <a href="{{route('course_setterm', 1)}}" class="btn btn-success btn-md">PRELIM</a>
            @endif
            @if(Auth::user()->midterm == 1)
            <a href="{{route('course_setterm', 2)}}" class="btn btn-success btn-md" style="background: gray;">MIDTERM</a>
            @endif
            @if(Auth::user()->prefi == 1)
            <a href="{{route('course_setterm', 3)}}" class="btn btn-success btn-md" style="background: gray;">PRE-FINALS</a>
            @endif
            @if(Auth::user()->final == 1)
            <a href="{{route('course_setterm', 4)}}" class="btn btn-success btn-md" style="background: gray;">FINALS</a>
            @endif
        @elseif($faculty->course_term == 2)
            @if(Auth::user()->prelim == 1)
            <a href="{{route('course_setterm', 1)}}" class="btn btn-success btn-md" style="background: gray;">PRELIM</a>
            @endif
            @if(Auth::user()->midterm == 1)
            <a href="{{route('course_setterm', 2)}}" class="btn btn-success btn-md">MIDTERM</a>
            @endif
            @if(Auth::user()->prefi == 1)
            <a href="{{route('course_setterm', 3)}}" class="btn btn-success btn-md" style="background: gray;">PRE-FINALS</a>
            @endif
            @if(Auth::user()->final == 1)
            <a href="{{route('course_setterm', 4)}}" class="btn btn-success btn-md" style="background: gray;">FINALS</a>
            @endif
        @elseif($faculty->course_term == 3)
            @if(Auth::user()->prelim == 1)
            <a href="{{route('course_setterm', 1)}}" class="btn btn-success btn-md" style="background: gray;">PRELIM</a>
            @endif
            @if(Auth::user()->midterm == 1)
            <a href="{{route('course_setterm', 2)}}" class="btn btn-success btn-md" style="background: gray;">MIDTERM</a>
            @endif
            @if(Auth::user()->prefi == 1)
            <a href="{{route('course_setterm', 3)}}" class="btn btn-success btn-md">PRE-FINALS</a>
            @endif
            @if(Auth::user()->final == 1)
            <a href="{{route('course_setterm', 4)}}" class="btn btn-success btn-md" style="background: gray;">FINALS</a>
            @endif
        @elseif($faculty->course_term == 4)
            @if(Auth::user()->prelim == 1)
            <a href="{{route('course_setterm', 1)}}" class="btn btn-success btn-md" style="background: gray;">PRELIM</a>
            @endif
            @if(Auth::user()->midterm == 1)
            <a href="{{route('course_setterm', 2)}}" class="btn btn-success btn-md" style="background: gray;">MIDTERM</a>
            @endif
            @if(Auth::user()->prefi == 1)
            <a href="{{route('course_setterm', 3)}}" class="btn btn-success btn-md" style="background: gray;">PRE-FINALS</a>
            @endif
            @if(Auth::user()->final == 1)
            <a href="{{route('course_setterm', 4)}}" class="btn btn-success btn-md">FINALS</a>
            @endif
        @else
            @if(Auth::user()->prelim == 1)
            <a href="{{route('course_setterm', 1)}}" class="btn btn-success btn-md" style="background: gray;">PRELIM</a>
            @endif
            @if(Auth::user()->midterm == 1)
            <a href="{{route('course_setterm', 2)}}" class="btn btn-success btn-md" style="background: gray;">MIDTERM</a>
            @endif
            @if(Auth::user()->prefi == 1)
            <a href="{{route('course_setterm', 3)}}" class="btn btn-success btn-md" style="background: gray;">PRE-FINALS</a>
            @endif
            @if(Auth::user()->final == 1)
            <a href="{{route('course_setterm', 4)}}" class="btn btn-success btn-md" style="background: gray;">FINALS</a>
            @endif
        @endif
        @endisset
    </div>
    <div class="col-md-4">
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

    <div class="col-md-2">
        <div class="form-group" style="margin-top: -10px;">
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

    <div class="col-md-2">
        <div class="form-group" style="margin-top: 10px;">
            <a href="#" onclick="window.location.reload();" class="btn btn-success"> <i class="fs-6 bi bi-arrow-repeat"></i> Grade</a>
        </div>
    </div>
    
    <br><br><br>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="container-fluid row pull-center" style="text-align: right;padding-top: 10px;">
            <div class="col-md-12" style="text-align: center;">
                <img src="{{URL::to('header.png')}}" style="width: 70%;height:170px;" alt="">
            </div>
        </div>
        <div class="container-fluid">
            <p class="cambria margin-0rem" style="text-align: center;font-weight: bold;padding-top: 10px;border-top: solid 1px;">@isset($collection->course){{$collection->course->course}}@endisset</p>
            <p class="cambria margin-0rem" style="text-align: center;">@isset($collection->course){{$collection->subject_code}}@endisset</p>
            <p class="cambria margin-0rem" style="text-align: center;">
                @isset($faculty->course_term)
                    @if($faculty->course_term == 1)
                        PRELIM GRADE
                    @elseif($faculty->course_term == 2)
                        MIDTERM GRADE
                    @elseif($faculty->course_term == 3)
                        PRE-FINALS GRADE
                    @else
                        FINALS GRADE
                    @endif 
                @endisset
            </p>
            <p class="cambria margin-0rem" style="text-align: center;">
                1st Semester {{$sy->name}}
            </p>

            <div class="table-responsive m-b-40" style="overflow-x: auto;">
                <table id="table4" class="table table-bordered" style="width: 150%;">
        <thead style="background-color: white;">
             <?php
                            $quizes = App\Quiz::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $activities = App\Activity::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $attendances = App\Attendance::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $assignments = App\Assignment::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $classworkcount = $quizes->count() + $activities->count() + $attendances->count() + $assignments->count();
                            $projects = App\Project::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $major_exams = App\MajorExam::where('course_term', $faculty->course_term)->where('curriculum_subject_id', $faculty->curriculum_subject_id)->where('section', $section_activ)->where('status', 1)->get();
                            $percentage  = App\Setting::where('id', '<>', 0)->first(); 
                            $dynamic_percentage = App\DynamicPercentage::where('semester', $faculty->course_term)
                                ->where('curriculum_subject_id', $faculty->curriculum_subject_id)
                                ->where('schoolyear_id', $sy->id)
                                ->where('course_term', $faculty->course_term)
                                ->where('section_id', $section_activ)
                                ->where('teacher_id', Auth::user()->id)
                                ->excludePercentageAndName()
                                ->first();  
                        ?>
        <tr>
            <th rowspan="3">NO.</th>
            <th rowspan="3" style="width: 300px;">NAME OF STUDENTS</th>
            <th colspan="{{(isset($attendances) ? count($attendances) : 0) + (isset($quizes) ? count($quizes) : 0) + 5}}" style="text-align: center;">CLASS WORKS (40%)</th>
            <th colspan="1">Transmu({{$percentage->classwork}}%)</th>
            <th rowspan="3"></th>
            <th colspan="{{(isset($activities) ? count($activities) : 0) + (isset($assignments) ? count($assignments) : 0) + (isset($projects) ? count($projects) : 0) + 2}}" style="text-align: center;">Project/Hands-on Outputs</th>
            <th colspan="1">Transmu({{$percentage->projects}}%)</th>
            <th rowspan="3"></th>
            <th colspan="{{$major_exams->count() + 2}}" style="text-align: center;">Major Examanation</th>
            <th colspan="1">Transmu({{$percentage->exams}}%)</th>
            <th rowspan="3"></th>
            <th rowspan="3">
                @isset($faculty->course_term)
                    @if($faculty->course_term == 1)
                        PRELIM GRADE
                    @elseif($faculty->course_term == 2)
                        MIDTERM GRADE
                    @elseif($faculty->course_term == 3)
                        PRE-FINALS GRADE
                    @else
                        FINALS GRADE
                    @endif 
                @endisset
            </th>
            <th rowspan="3">Remarks</th>
        </tr>
        <tr style="background-color: rgb(153, 40, 40);">
            <th colspan="{{ isset($attendances) && count($attendances) ? count($quizes) + 3 : 3 }}" style="text-align: center">Attendance/Class Participation</th>
            <th colspan="{{ isset($quizes) && count($quizes) ? count($quizes) + 3 : 3 }}" style="text-align: center">Quizzes</th>
            <th colspan="{{ (isset($activities) ? count($activities) : 0) + (isset($assignments) ? count($assignments) : 0) + (isset($project) ? count($project) : 0) + 4 }}" style="text-align: center">Activity/Project</th>
            <th colspan="{{ isset($major_exams) && count($major_exams) ? count($major_exams) + 3 : 3 }}" style="text-align: center">Midterm Exam</th>
        </tr>
        <tr>
            @isset($attendances)
                @foreach($attendances as $element)
                    <th style="text-align: center;">{{$element->name}}</th>
                @endforeach
            @endisset

             <th style="text-align: center;font-weight: bold;color: blue;">TOTAL</th> 
            <td style="text-align: center;font-weight: bold;color: violet;"><input type="number" id="attendance_percentage" @isset($dynamic_percentage) value="{{ $dynamic_percentage->attendance_percentage }}" @else value="0" @endisset onchange="handleDynamicPercentage()"><span>%</span></td>
            <th style="text-align: center;font-weight: bold;color: green;">equiv</th>

             @isset($quizes)
                @foreach($quizes as $element)
                    <th style="text-align: center;">{{$element->name}}</th>
                @endforeach
            @endisset

             <th style="text-align: center;font-weight: bold;color: blue;">TOTAL</th>
            <td style="text-align: center;font-weight: bold;color: violet;"><input type="number" id="quiz_percentage" @isset($dynamic_percentage) value="{{ $dynamic_percentage->quiz_percentage }}" @else value="0" @endisset onchange="handleDynamicPercentage()"><span>%</span></td>
            <th style="text-align: center;font-weight: bold;color: green;">equiv</th>

             @isset($activities)
                @foreach($activities as $element)
                    <th style="text-align: center;">{{$element->name}}</th>
                @endforeach
            @endisset

            @isset($assignments)
                @foreach($assignments as $element)
                    <th style="text-align: center;">{{$element->name}}</th>
                @endforeach
            @endisset

            @isset($projects)
                @foreach($projects as $element)
                    <th style="text-align: center;">{{$element->name}}</th>
                @endforeach
            @endisset

            <th style="text-align: center;font-weight: bold;color: blue;">TOTAL</th>
            <th style="text-align: center;font-weight: bold;color: violet;">%</th>
            <th style="text-align: center;font-weight: bold;color: green;">equiv</th>

            @isset($major_exams)
                @foreach($major_exams as $element)
                    <th style="text-align: center;"></th>
                @endforeach
            @endisset

            <th style="text-align: center;font-weight: bold;color: blue;">TOTAL</th>
            <th style="text-align: center;font-weight: bold;color: violet;">%</th>
            <th style="text-align: center;font-weight: bold;color: green;">equiv</th>

        </tr>
        <tr>
            <th></th>
            <th></th>
                 <!-- Highest possible score row -->
                         <?php 
                            $quiz_act_att_ass_total = 0;
                            $attendances_total = 0;
                            $quizes_total = 0;
                            $activities_total = 0;
                            $assignments_total = 0;
                            $proj_total = 0;
                            $exam_total = 0;
                         ?> 

                <!-- Attendance HPS-->
                          @isset($attendances)
                            @foreach($attendances as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                    $attendances_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                            <th style="text-align: center;font-weight: bold;color: blue;">{{$attendances_total}}</th>
                          <th style="text-align: center;font-weight: bold;color: violet;">100</th>
                          <th style="text-align: center;font-weight: bold;color: green;">1.0</th>

                <!-- Quizes HPS-->
                          @isset($quizes)
                            @foreach($quizes as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                    $quizes_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                            <th style="text-align: center;font-weight: bold;color: blue;">{{$quizes_total}}</th>
                          <th style="text-align: center;font-weight: bold;color: violet;">100</th>
                          <th style="text-align: center;font-weight: bold;color: green;">1.0</th>

                          {{-- Empty <th> for layout only --}}
                          <th></th>

                 <!-- Activities HPS-->
                           @isset($activities)
                            @foreach($activities as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                    $activities_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                    <!-- Assignments HPS-->
                          @isset($assignments)
                            @foreach($assignments as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $quiz_act_att_ass_total += $element->items_total;
                                    $assignments_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                 <!-- Projects HPS-->
                          @isset($projects)
                            @foreach($projects as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $proj_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                          <th style="text-align: center;font-weight: bold;color: blue;">{{$activities_total + $assignments_total + $proj_total }}</th>
                          <th style="text-align: center;font-weight: bold;color: violet;">100</th>
                          <th style="text-align: center;font-weight: bold;color: green;">1.0</th>

                            {{-- Empty <th> for layout only --}}
                          <th></th>

                          @isset($major_exams)
                            @foreach($major_exams as $element)
                                <th style="text-align: center;">{{$element->items_total}}</th>
                                <?php 
                                    $exam_total += $element->items_total;
                                ?>
                            @endforeach
                          @endisset

                          <th style="text-align: center;font-weight: bold;color: blue;">{{$exam_total}}</th>
                          <th style="text-align: center;font-weight: bold;color: violet;">100</th>
                          <th style="text-align: center;font-weight: bold;color: green;">1.0</th>
                      </tr>
    </thead>
    <tbody>
        @if (!empty($students))
            <?php 
                $x = 0; 
                // Functions for grading logic
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

                   //Calcuate the final Weighted grade         
                 function calculateFinalGrade($attendance_grade, $quiz_grade, $project_score, $exam_score,$attendance_percent, $quiz_percent, $project_percent, $exam_percent):float { 
                    //Define the weights;
                    $attendanceWeights = $attendance_percent / 100;
                    $quizWeights = $quiz_percent / 100;
                    $projectWeights = $project_percent / 100; //Weight for activities, assignments, and projects;
                    $examWeight = $exam_percent / 100; //Weight for exam

                    //Compute the weighted average
                      $finalGrade = (($attendance_grade * $attendanceWeights) + ($quiz_grade * $quizWeights)) +
                                    ($project_score * $projectWeights) +
                                    ($exam_score * $examWeight);

                            return $finalGrade;

                 }

            ?>
            @foreach($students as $stud)
                <?php 
                    $x++; 
                    $quiz_act_att_ass_studtotal = 0;
                    $attendance_studtotal = 0;
                    $quizes_studtotal = 0;
                    $activities_studtotal = 0;
                    $assignments_studtotal = 0;
                    $proj_studtotal = 0;
                    $exam_studtotal = 0;
                ?>
                <tr>
                    {{-- Student row starts here  --}}
                    <td>{{$x}}</td>
                    <td>{{$stud->lastname}}, {{$stud->firstname}} {{$stud->middlename}}</td>

                     @isset($attendances) 
                        @foreach($attendances as $element)
                            <?php 
                                $att = App\AttendanceScore::where('id_no', $stud->id_no)->where('attendance_id', $element->id)->first();
                                $attscore = $att ? $att->score : '';
                                $quiz_act_att_ass_studtotal += ((int)$attscore ?? 0);
                                $attendance_studtotal += ((int)$attscore ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($attscore) value="{{$attscore}}" @else value="0" @endisset onchange="changeattendanceScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset

                    <td style="text-align: center;font-weight: bold;color: blue;">{{$attendance_studtotal}}</td>
                    <?php 
                       $attendance_ass_percent = $attendance_studtotal > 0 ? round((round($attendance_studtotal) / $attendances_total) * 50 + 50) : 0;
                       $attendance_ass_grade = $collection->course->board_exam == 1 ? getGradewithBoard($attendance_ass_percent) : getGradewithoutBoard($attendance_ass_percent);
                    ?>
                    <td style="text-align: center;font-weight: bold;color: violet;">{{$attendance_ass_grade}}</td>
                    <td style="text-align: center;font-weight: bold;color: {{ $attendance_ass_grade > 3 ? 'red' : 'green' }};">{{number_format($attendance_ass_grade ?? 0, 1)}}</td>
                     

                    @isset($quizes)
                        @foreach($quizes as $element)
                            <?php 
                                $quiz = App\QuizScore::where('id_no', $stud->id_no)->where('quiz_id', $element->id)->first();
                                $qscore = $quiz ? $quiz->score : '';
                                $quiz_act_att_ass_studtotal += ((int)$qscore ?? 0);
                                $quizes_studtotal +=((int)$qscore ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($qscore) value="{{$qscore}}" @else value="0" @endisset onchange="changequizScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset

                     <td style="text-align: center;font-weight: bold;color: blue;">{{$quizes_studtotal}}</td>
                    <?php 
                       $quizes_ass_percent = $quizes_studtotal > 0 ? round((round($quizes_studtotal) / $quizes_total) * 50 + 50) : 0;
                       $quizes_ass_grade = $collection->course->board_exam == 1 ? getGradewithBoard($quizes_ass_percent) : getGradewithoutBoard($quizes_ass_percent);
                    ?>
                    <td style="text-align: center;font-weight: bold;color: violet;">{{$quizes_ass_grade}}</td>
                    <td style="text-align: center;font-weight: bold;color: {{ $quizes_ass_grade > 3 ? 'red' : 'green' }};">{{number_format($quizes_ass_grade ?? 0, 1)}}</td>
                     
                    <td></td>
                    
                    @isset($activities)
                        @foreach($activities as $element)
                            <?php 
                                $act = App\ActivityScore::where('id_no', $stud->id_no)->where('activity_id', $element->id)->first();
                                $actscore = $act ? $act->score : '';
                                $quiz_act_att_ass_studtotal += ((int)$actscore ?? 0);
                                $activities_studtotal += ((int)$actscore ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($actscore) value="{{$actscore}}" @else value="0" @endisset onchange="changeactivityScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset

                    @isset($assignments)
                        @foreach($assignments as $element)
                            <?php 
                                $ass = App\AssignmentScore::where('id_no', $stud->id_no)->where('assignment_id', $element->id)->first();
                                $ass_score = $ass ? $ass->score : '';
                                $quiz_act_att_ass_studtotal += ((int)$ass_score ?? 0);
                                $assignments_studtotal += ((int)$ass_score ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($ass_score) value="{{$ass_score}}" @else value="0" @endisset onchange="changeassignmentScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset
              
                    @isset($projects)
                        @foreach($projects as $element)
                            <?php 
                                $proj = App\ProjectScore::where('id_no', $stud->id_no)->where('project_id', $element->id)->first();
                                $proj_score = $proj ? $proj->score : '';
                                $proj_studtotal += ((int)$proj_score ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($proj_score) value="{{$proj_score}}" @else value="0" @endisset onchange="changeaprojectScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset

                    <td style="text-align: center;font-weight: bold;color: blue;">{{$activities_studtotal + $assignments_studtotal + $proj_studtotal}}</td>
                    <?php 
                        $act_ass_proj_total = $activities_total + $assignments_total + $proj_total;
                        $act_ass_proj_studtotal = $activities_studtotal + $assignments_studtotal + $proj_studtotal;

                        $activities_assignments_projects_percent = $act_ass_proj_total > 0 ? round((round($act_ass_proj_studtotal) / $act_ass_proj_total) * 50 + 50) : 0;
                        $activities_assignments_projects_percent_grade = $collection->course->board_exam == 1 ? getGradewithBoard($activities_assignments_projects_percent) : getGradewithoutBoard($activities_assignments_projects_percent);
                    ?>
                    <td style="text-align: center;font-weight: bold;color: violet;">{{$activities_assignments_projects_percent}}</td>
                    <td style="text-align: center;font-weight: bold;color: {{ $activities_assignments_projects_percent_grade > 3 ? 'red' : 'green' }};">{{number_format($activities_assignments_projects_percent_grade ?? 0, 1)}}</td>
                    <td></td>

                    @isset($major_exams)
                        @foreach($major_exams as $element)
                            <?php 
                                $exam = App\MajorExamScore::where('id_no', $stud->id_no)->where('major_exam_id', $element->id)->first();
                                $exam_score = $exam ? $exam->score : '';
                                $exam_studtotal += ((int)$exam_score ?? 0);
                            ?>
                            <td style="text-align: center;"><input type="number" @isset($exam_score) value="{{$exam_score}}" @else value="0" @endisset onchange="changeaexamScore(this, {{$stud->id_no}}, {{$element->id}}, {{$element->items_total}})" max="{{$element->items_total}}" style="text-align: center;"></td>
                        @endforeach
                    @endisset

                    <td style="text-align: center;font-weight: bold;color: blue;">{{$exam_studtotal}}</td>
                    <?php 
                        $exam_percent = $exam_studtotal > 0 ? round((round($exam_studtotal) / $exam_total) * 50 + 50) : 0;
                        $exam_grade = $collection->course->board_exam == 1 ? getGradewithBoard($exam_percent) : getGradewithoutBoard($exam_percent);
                    ?>
                    <td style="text-align: center;font-weight: bold;color: violet;">{{$exam_percent}}</td>
                    <td style="text-align: center;font-weight: bold;color: {{ $exam_grade > 3 ? 'red' : 'green' }};">{{number_format($exam_grade ?? 0, 1)}}</td>
                    <td></td>

                    <?php 
                    
                     $grade = calculateFinalGrade($attendance_ass_grade, $quizes_ass_grade, $activities_assignments_projects_percent_grade, $exam_grade, $dynamic_percentage->attendance_percentage ?? 0, $dynamic_percentage->quiz_percentage ?? 0, $percentage->projects, $percentage->exams);
                      
                    ?>
                    <td style="text-align: center;font-weight: bold;color: {{ $grade > 3 ? 'red' : 'green' }};">{{number_format($grade ?? 0, 1)}}</td>
                    <td style="text-align: center;font-weight: bold;color: {{ $grade > 3 ? 'red' : 'black' }};">{{ $grade > 3 ? 'Failed' : 'Passed' }}</td>
                    <td></td>
                    <td></td>
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

        function changequizScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        function changeactivityScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/activity-upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        function changeattendanceScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/attendance-upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        function changeassignmentScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/assignment-upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        function changeaprojectScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/project-upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        function changeaexamScore(inputElement, id_no, quiz_id, limit) {

            var score = inputElement.value;

            if (!score) return;

            if(score > limit){
                swal(
                'INFO',
                'Score must not be greater than '+limit,
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            if(score < 0){
                swal(
                'INFO',
                'Score must not be greater than or equal 0',
                'info'
                )
                $(inputElement).val(0);
                return;
            }

            // AJAX request
            $.ajax({
                url: '/major_exam-upload_score', // URL of the route in Laravel
                type: 'POST',
                data: {
                    quiz_id: quiz_id,
                    id_no: id_no,
                    score: score, // Data to send to the server
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    swal(
                    'INFO',
                    'Score has not been saved successfully',
                    'info'
                    )
                }
            });
        }

        


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

      function handleDynamicPercentage() {
          // Get the values from the input fields
          var quiz_percentage = parseFloat(document.getElementById('quiz_percentage').value);
          var attendance_percentage = parseFloat(document.getElementById('attendance_percentage').value);

          const data = {
            id: "{{ $dynamic_percentage->id ?? '' }}",
            curriculum_subject_id: {{ $faculty->curriculum_subject_id }},
            quiz_percentage: quiz_percentage,
            attendance_percentage: attendance_percentage,
            schoolyear_id: {{ $sy->id }},
            semester_id: {{ $faculty->course_term }},
            course_term: {{ $faculty->course_term }},
            class_id: {{ $faculty->curriculum_subject_id }},
            section_id: "{{ $section_activ }}",
            _token: '{{ csrf_token() }}' // CSRF token for Laravel

          };
        
          // Validate the sum of percentages
          if (quiz_percentage + attendance_percentage !== 40) {
              swal(
                  'ERROR',
                  "The sum of Attendance and Quiz percentages must equal {{ $percentage->classwork }}%.",
                  'error'
              );
              return;
          }

          // AJAX request to save the percentages
          $.ajax({
              url: '/save-dynamic-percentage', // URL of the route in Laravel
              type: 'POST',
              data: data,
              success: function(response) {
                  swal(
                      'SUCCESS',
                      'Dynamic percentages saved successfully.',
                      'success'
                  );
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
                  swal(
                      'ERROR',
                      'An error occurred while saving dynamic percentages.',
                      'error'
                  );
              }
          });
      }
  </script>
  
@endsection