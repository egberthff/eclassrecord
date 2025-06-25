@extends('layouts.admin')
@section('head')
<style>
.form-error {
    color: red !important;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="padding-top: 20px;">
            <div class="card">
                <div class="card-header" style="background-color: #330066;color: white;">
                    Edit Students Section
                </div>
                <div class="card-body">

                    <form action="{{route('update_sections_store')}}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1"
                                        style="color: black !important;">Course <span
                                            style="color: red; font-weight: bold;">*</span></label>
                                    <?php $courses = App\Course::where('status', 1)->get();?>
                                    <select id="course_id" class="form-control" name="course_id" aria-required="true"
                                        aria-invalid="false" data-validation="required" onchange="fetchStudents()">
                                        <option value="">Select Course</option>
                                        @isset($courses)
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->course}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" style="color: black !important;">Year Level <span
                                            style="color: red; font-weight: bold;">*</span></label>
                                    <select id="year_level" class="form-control" name="year_level" aria-required="true"
                                        aria-invalid="false" data-validation="required" onchange="fetchStudents()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class=" form-control-label">Students</label>
                                    <select id="students" class="form-control js-example-basic-multiple"
                                        name="students[]" multiple="multiple" aria-required="true" aria-invalid="false"
                                        data-validation="required" style="font-weight: bold;">
                                        <option value="all">All</option>
                                        @isset($students)
                                        @foreach($students as $element)
                                        <option value="{{$element->email}}">{{$element->user->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" style="color: black !important;">Section</label>
                                    <input type="text" name="section" class="form-control" aria-required="true"
                                        style="text-transform: uppercase;" aria-invalid="false"
                                        data-validation="required">
                                </div>
                            </div>
                        </div>
                        <br>
                        <input id="submit_btn" class="btn btn-sm btn-primary" type="submit" name="submit"
                            value="Update Students Section">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
function fetchStudents() {
    const courseId = document.getElementById('course_id').value;
    const yearLevel = document.getElementById('year_level').value;

    if (courseId && yearLevel) {
        $.ajax({
            url: '/getstudentsbycourseandyear/' + courseId + '/' + yearLevel,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                const studentSelect = document.getElementById('students');
                studentSelect.innerHTML = '<option value="all">All</option>';

                data.forEach(student => {
                    const option = document.createElement('option');
                    option.value = student.id_no;
                    option.textContent = student.lastname + ', ' + student.firstname + ' ' + student
                        .middlename;
                    studentSelect.appendChild(option);
                });
            }
        });

    }
}
$(document).ready(function() {


    $('.js-example-basic-multiple').select2({
        placeholder: 'Select Students'
    });

    $('#course_id').select2();
});
$.validate({
    modules: 'security',
    onModulesLoaded: function() {
        var optionalConfig = {
            fontSize: '12pt',
            padding: '4px',
            bad: 'Very bad',
            weak: 'Weak',
            good: 'Good',
            strong: 'Strong'
        };

        $('input[name="password"]').displayPasswordStrength(optionalConfig);
        $('input[name="password_confirmation"]').displayPasswordStrength(optionalConfig);
    }
});
</script>
@endsection