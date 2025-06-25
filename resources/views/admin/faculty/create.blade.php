@extends('layouts.admin')
@section('faculty')
active
@endsection
@section('head')
<script type="text/javascript" src="{{URL::to('js/jquery-1.11.3.min.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{URL::to('js/xlsx.core.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/index.js')}}"></script>
@endsection
@section('content')
<!-- WELCOME-->
<section class="welcome p-t-30 p-b-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-3">Faculty
                </h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <form method="POST" id="schoolyearsubmitform" action="{{route('faculty.store')}}"
                enctype="multipart/form-data" style="font-size: 12px;">
                {{csrf_field()}}

                <div class="form-group">
                    <label class=" form-control-label">ID Number <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="id_no" class="form-control" name="id_no" aria-required="true"
                        aria-invalid="false" data-validation="required">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">First Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="fname" class="form-control" name="fname" aria-required="true"
                        aria-invalid="false" data-validation="required">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Middle Name</label>
                    <input type="text" id="mname" class="form-control" name="mname" aria-required="true"
                        aria-invalid="false">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Last Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="lname" class="form-control" name="lname" aria-required="true"
                        aria-invalid="false" data-validation="required">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Rank <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <select class="form-control select2" name="rank" id="company" aria-required="true"
                        aria-invalid="false" data-validation="required">
                        <option value="" selected>Choose option</option>
                        <option value="Instructor I">Instructor I</option>
                        <option value="Instructor I">Instructor II</option>
                        <option value="Instructor I">Instructor III</option>
                        <option value="Professor I">Professor I</option>
                        <option value="Professor II">Professor II</option>
                        <option value="Professor III">Professor III</option>
                        <option value="Professor IV">Professor IV</option>
                        <option value="Professor V">Professor V</option>
                        <option value="Associate Professor I">Assistant Professor I</option>
                        <option value="Associate Professor II">Assistant Professor II</option>
                        <option value="Associate Professor III">Assistant Professor III</option>
                        <option value="Associate Professor I">Associate Professor I</option>
                        <option value="Associate Professor II">Associate Professor II</option>
                        <option value="Associate Professor III">Associate Professor III</option>
                        <option value="Associate Professor IV">Associate Professor IV</option>
                        <option value="Associate Professor V">Associate Professor V</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Email Address </label>
                    <input type="text" id="email" class="form-control" name="email" aria-required="true"
                        aria-invalid="false">
                </div>
                <br>

                <div class="form-group">
                    <input type="submit" id="schoolyearsubmit" class="form-control btn btn-success" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#btnFacultyInsertFileIMPORTACTION').on('change', function() {
    onbtnFacultyInsertFileIMPORTACTION();
});
$(document).ready(function() {
    // $('a.btnAct').click(function (event) {
    //       event.preventDefault();
    //       swal({
    //           title: 'CONFIRM ACTION',
    //           text: 'Are you sure you want to remove it from archive?',
    //           type: 'warning',
    //           showCancelButton: true,
    //           confirmButtonColor: '#d33',
    //           cancelButtonColor: '#3085d6',
    //           confirmButtonText: 'Yes',
    //           reverseButtons: true,
    //           focusConfirm: false,
    //       }).then((result) => {
    //           if(result.value){
    //               $('.formActivate').submit();
    //           }
    //       });
    //   });

    // $('a.btnRem').click(function (event) {
    //     event.preventDefault();
    //     swal({
    //         title: 'CONFIRM ACTION',
    //         text: 'Are you sure you want to put in the archive?',
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         confirmButtonText: 'Yes',
    //         reverseButtons: true,
    //         focusConfirm: false,
    //     }).then((result) => {
    //         if(result.value){
    //             $('.formActivate').submit();
    //         }
    //     });
    // });


    @if(Session::has('Inserted'))
    swal(
        'Saved',
        'New Faculty added successfully.',
        'success'
    )
    @elseif(Session::has('Uploaded'))
    swal(
        'Saved',
        'Faculties added successfuly.',
        'success'
    )
    @elseif(Session::has('Activated'))
    swal(
        'Activated',
        'Faculty has been removed from archive successfuly.',
        'success'
    )
    @elseif(Session::has('Archived'))
    swal(
        'Deleted',
        'Faculty has been added to archive.',
        'success'
    )
    @elseif(Session::has('Updated'))
    swal("SUCCESS!", "{!! session('Updated') !!}", "success");
    swal(
        'Updated',
        'Faculty updated successfully.',
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