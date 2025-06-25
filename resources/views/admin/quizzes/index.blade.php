@extends('layouts.admin')
@section('quizzes')
active
@endsection
@section('content')
<section class="welcome p-t-30 p-b-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-3">Quizzes
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

    <br><br><br>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{route('quizzes.store')}}" enctype="multipart/form-data"
                style="font-size: 12px;">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                        $subjs = App\CurriculumSubject::where('faculty_id', Auth::user()->email)->get();
                      ?>
                            <label class=" form-control-label">Current Subject </label>
                            <select class="form-control select2" name="curriculum_subject_id" id="company"
                                aria-required="true" aria-invalid="false" data-validation="required"
                                style="font-weight: bold;" onchange="handleChange(this.value)">
                                @isset($subjs)
                                @foreach($subjs as $subj)
                                <option value="{{$subj->id}}" @if($subj_activ !='' && $subj->id == $subj_activ) selected
                                    @endif>{{$subj->course->code}} [Year : {{$subj->year}} Sem : {{$subj->semester}}]
                                    {{$subj->subject_code}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <br><br>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class=" form-control-label">Section</label>
                            <select class="form-control select2" name="section" id="company" aria-required="true"
                                aria-invalid="false" data-validation="required" style="font-weight: bold;"
                                onchange="handleChangeSection(this.value)">
                                <option value="">Select Section</option>
                                @isset($sections)
                                @foreach($sections as $section)
                                <option value="{{$section->section}}" @if($section_activ !='' && $section->section ==
                                    $section_activ) selected @endif>{{$section->section}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <br><br>
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Date <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="date" id="company" class="form-control" name="date" aria-required="true"
                        aria-invalid="false" data-validation="required">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="company" class="form-control" name="name" aria-required="true"
                        aria-invalid="false" data-validation="required">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Description</label>
                    <input type="text" id="company" class="form-control" name="description" aria-required="true"
                        aria-invalid="false">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Total Items Score <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="number" id="company" class="form-control" name="items_total" aria-required="true"
                        aria-invalid="false" data-validation="required" min="1">
                </div>
                <br>

                <div class="form-group">
                    <input type="submit" id="country" class="form-control btn btn-success" value="Submit"
                        @if($subjs->count() < 1) disabled @endif>
                </div>
            </form>
        </div>
        <div class="col-md-8">
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
                            <table id="table2" class="table table-borderless table-data3" style="width: 100%;">
                                <thead style="background-color: #330066;">
                                    <tr>
                                        <th width="20%" style="font-size: 12px; color: white;">Date</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Name</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Description</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Total Items</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($model)
                                    @foreach($model as $element)
                                    <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                        <td>{{$element->date}}</td>
                                        <td>{{$element->name}}</td>
                                        <td>{{$element->description}}</td>
                                        <td>{{$element->items_total}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if($element->status == 1)
                                                <a href="{{route('quizzes.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="EDIT">
                                                    <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                                </a>
                                                <a href="{{route('add_score', $element->id)}}" style="margin-top: 10px;"
                                                    class="item" data-toggle="tooltip" data-placement="top"
                                                    title="UPLOAD SCORES">
                                                    <i class="fs-5 bi bi-upload" style="color: green;"></i>
                                                </a>
                                                <b style="color: green;">
                                                    <a href="{{route('quizzes.destroy', $element->id)}}"
                                                        style="margin-top: 10px;" class="item btnRem"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Put in ARCHIVE">
                                                        <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                    </a>
                                                </b>
                                                @else
                                                <a href="{{route('quizzes.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnAct"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Remove from ARCHIVE">
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

                            <table id="table" class="table table-borderless table-data3" style="width: 100%;">
                                <thead style="background-color: #330066;">
                                    <tr>
                                        <th width="20%" style="font-size: 12px; color: white;">Date</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Name</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Description</th>
                                        <th width="20%" style="font-size: 12px; color: white;">Total Items</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($inactive)
                                    @foreach($inactive as $element)
                                    <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                        <td>{{$element->date}}</td>
                                        <td>{{$element->name}}</td>
                                        <td>{{$element->description}}</td>
                                        <td>{{$element->items_total}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if($element->status == 1)
                                                <a href="{{route('quizzes.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="EDIT">
                                                    <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                                </a>
                                                <a href="{{route('add_score', $element->id)}}" style="margin-top: 10px;"
                                                    class="item" data-toggle="tooltip" data-placement="top"
                                                    title="UPLOAD SCORES">
                                                    <i class="fs-5 bi bi-upload" style="color: green;"></i>
                                                </a>
                                                <b style="color: green;">
                                                    <a href="{{route('quizzes.destroy', $element->id)}}"
                                                        style="margin-top: 10px;" class="item btnRem"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Put in ARCHIVE">
                                                        <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                    </a>
                                                </b>
                                                @else
                                                <a href="{{route('quizzes.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnAct"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Remove from ARCHIVE">
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