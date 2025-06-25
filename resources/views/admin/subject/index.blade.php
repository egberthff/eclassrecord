@extends('layouts.admin')
@section('subject')
active
@endsection
@section('content')
<!-- WELCOME-->
<section class="welcome p-t-30 p-b-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-3">Subjects
                </h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class=" form-control-label"> <i class="bi bi-filter fs-5"></i>College</label>
                        <?php $colleges = App\College::where('status', 1)->get();?>
                        <select class="form-control select2" name="college_id" id="college_id" aria-required="true"
                            aria-invalid="false" data-validation="required" onchange="handleChangeCollege(this.value)">
                            <option value="" selected>Choose option</option>
                            @isset($colleges)
                            @foreach($colleges as $option)
                            <option value="{{$option->id}}" @isset(Auth::user()->college_active) @if(Auth::user()->college_active == $option->id) selected @endif @endisset>{{$option->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label" style="color: black !important;"><i class="bi bi-filter fs-5"></i>Course</label>
                        <select id="course_id" class="form-control" name="course_id" aria-required="true"
                            aria-invalid="false" data-validation="required" onchange="handleChangeCourse(this.value)">
                            <option value="">Choose option</option>
                            @isset($courses)
                            @foreach($courses as $course)
                            <option value="{{$course->id}}" @isset(Auth::user()->course_active) @if(Auth::user()->course_active == $course->id) selected @endif @endisset>{{$course->course}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" style="color: black !important;"><i class="bi bi-filter fs-5"></i>Year
                            Level </label>
                        <select id="yearlevel" class="form-control" name="yearlevel" aria-required="true" aria-invalid="false"
                            data-validation="required" onchange="handleChangeYearlevel(this.value)">
                            <option value="">Choose option</option>
                            <option value="1" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '1')
                                selected @endif @endisset>1</option>
                            <option value="2" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '2')
                                selected @endif @endisset>2</option>
                            <option value="3" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '3')
                                selected @endif @endisset>3</option>
                            <option value="4" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '4')
                                selected @endif @endisset>4</option>
                            <option value="5" @isset(Auth::user()->yearlevel_active) @if(Auth::user()->yearlevel_active == '5')
                                selected @endif @endisset>5</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" style="color: black !important;"><i class="bi bi-filter fs-5"></i>Semester </label>
                        <select id="semester" class="form-control" name="semester" aria-required="true"
                            aria-invalid="false" data-validation="required" onchange="handleChangeSemester(this.value)">
                            <option value="">Choose option</option>
                            <option value="1" @isset(Auth::user()->semester_active) @if(Auth::user()->semester_active == '1') selected @endif @endisset>1</option>
                            <option value="2" @isset(Auth::user()->semester_active) @if(Auth::user()->semester_active == '2') selected @endif @endisset>2</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>


            <div class="custom-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Active</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Archive</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive m-b-40">
                            <table id="tablesubj1" class="table table-borderless table-data3" style="width: 100%;">
                                <thead style="background-color: #330066;">
                                    <tr>
                                        <th width="20%" style="font-size: 12px; color: white;">Course</th>
                                        <th width="10%" style="font-size: 12px; color: white;">Subject Code</th>
                                        <th width="30%" style="font-size: 12px; color: white;">Subject Description</th>
                                        <th width="5%" style="font-size: 12px; color: white;">Units</th>
                                        <th width="10%" style="font-size: 12px; color: white;">Year & Semester</th>
                                        <th width="15%" style="font-size: 12px; color: white;">Assigned Faculty</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($model)
                                    @foreach($model as $element)
                                    <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                        <?php 
                                    $faculty = App\Faculty::where('id_no', $element->faculty_id)->first();
                                  ?>
                                        <td><b>{{$element->course->code}}</b></td>
                                        <td><b>{{$element->subject_code}}</b></td>
                                        <td>{{$element->subject_desc}}</td>
                                        <td>{{$element->total_units}}</td>
                                        <td><b>Year : {{$element->year}} Sem : {{$element->semester}}</b></td>
                                        <td><b>@isset($faculty){{$faculty->lname}}, {{$faculty->fname}}
                                                @if($faculty->mname) {{substr($faculty->mname, 0, 1)}}.@endif
                                                @endisset</b></td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if($element->status == 1)
                                                <a href="{{route('subject.edit', $element->id)}}"
                                                    style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="EDIT">
                                                    <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                                </a>
                                                <b style="color: green;">
                                                    <a href="{{route('removesubj', $element->id)}}"
                                                        style="margin-top: 10px;" class="item btnRem"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Put in ARCHIVE">
                                                        <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                    </a>
                                                </b>
                                                @else
                                                <a href="{{route('removesubj', $element->id)}}"
                                                    style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip"
                                                    data-placement="top" title="Remove from ARCHIVE">
                                                    <i class="fs-5 bi bi-trash-fill" style="color: green;"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive m-b-40">
                            <table id="tablesubj2" class="table table-borderless table-data3" style="width: 100%;">
                                <thead style="background-color: #330066;">
                                    <tr>
                                        <th width="20%" style="font-size: 12px; color: white;">Course</th>
                                        <th width="10%" style="font-size: 12px; color: white;">Subject Code</th>
                                        <th width="30%" style="font-size: 12px; color: white;">Subject Description</th>
                                        <th width="5%" style="font-size: 12px; color: white;">Units</th>
                                        <th width="10%" style="font-size: 12px; color: white;">Year & Semester</th>
                                        <th width="15%" style="font-size: 12px; color: white;">Assigned Faculty</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($inactive)
                                    @foreach($inactive as $element)
                                    <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                        <?php 
                                    $faculty = App\Faculty::where('id_no', $element->faculty_id)->first();
                                  ?>
                                        <td><b>{{$element->course->code}}</b></td>
                                        <td><b>{{$element->subject_code}}</b></td>
                                        <td>{{$element->subject_desc}}</td>
                                        <td>{{$element->total_units}}</td>
                                        <td><b>Year : {{$element->year}} Sem : {{$element->semester}}</b></td>
                                        <td><b>@isset($faculty){{$faculty->lname}}, {{$faculty->fname}}
                                                @if($faculty->mname) {{substr($faculty->mname, 0, 1)}}.@endif
                                                @endisset</b></td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if($element->status == 1)
                                                <a href="{{route('subject.edit', $element->id)}}"
                                                    style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="EDIT">
                                                    <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                                </a>
                                                <b style="color: green;">
                                                    <a href="{{route('removesubj', $element->id)}}"
                                                        style="margin-top: 10px;" class="item btnRem"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Put in ARCHIVE">
                                                        <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                    </a>
                                                </b>
                                                @else
                                                <a href="{{route('removesubj', $element->id)}}"
                                                    style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip"
                                                    data-placement="top" title="Remove from ARCHIVE">
                                                    <i class="fs-5 bi bi-trash-fill" style="color: green;"></i>
                                                </a>
                                                @endif
                                            </div>
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
        </div>
    </div>
    @endsection
    @section('scripts')
    <script>
    $('#tablesubj1').DataTable({
        "pageLength": 100
    });
    $('#tablesubj2').DataTable({
        "pageLength": 100
    });
    function handleChangeCollege(selectedValue) {
        // Check if a value is selected

        // AJAX request
        $.ajax({
            url: '/handle-change-college', // URL of the route in Laravel
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

    function handleChangeCourse(selectedValue) {
        // Check if a value is selected

        // AJAX request
        $.ajax({
            url: '/handle-change-course', // URL of the route in Laravel
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

    function handleChangeYearlevel(selectedValue) {
        // Check if a value is selected

        // AJAX request
        $.ajax({
            url: '/handle-change-yearlevel', // URL of the route in Laravel
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

    function handleChangeSemester(selectedValue) {
        // Check if a value is selected

        // AJAX request
        $.ajax({
            url: '/handle-change-semester', // URL of the route in Laravel
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
            'New Subject added successfully.',
            'success'
        )
        @elseif(Session::has('Activated'))
        swal(
            'Activated',
            'Subject has been removed from archive.',
            'success'
        )
        @elseif(Session::has('Archived'))
        swal(
            'Deleted',
            'Subject has been moved to archive.',
            'success'
        )
        @elseif(Session::has('Deleted'))
        swal(
            'Deleted',
            'Subject deleted successfully.',
            'success'
        )
        @elseif(Session::has('Updated'))
        swal("SUCCESS!", "{!! session('Updated') !!}", "success");
        swal(
            'Updated',
            'Subject updated successfully.',
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