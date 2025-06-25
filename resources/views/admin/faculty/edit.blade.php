@extends('layouts.admin')
@section('faculty')
active
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
            <form method="POST" action="{{route('faculty.update' , $collection->id)}}" enctype="multipart/form-data"
                style="font-size: 12px;">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">

                <div class="form-group">
                    <label class=" form-control-label">ID Number <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="id_no" class="form-control" name="id_no" aria-required="true"
                        aria-invalid="false" data-validation="required" value="{{$collection->id_no}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">First Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="fname" class="form-control" name="fname" aria-required="true"
                        aria-invalid="false" data-validation="required" value="{{$collection->fname}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Middle Name</label>
                    <input type="text" id="mname" class="form-control" name="mname" aria-required="true"
                        aria-invalid="false" value="{{$collection->mname}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Last Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="lname" class="form-control" name="lname" aria-required="true"
                        aria-invalid="false" data-validation="required" value="{{$collection->lname}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Rank <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <select class="form-control select2" name="rank" id="company" aria-required="true"
                        aria-invalid="false" data-validation="required">
                        <option value="" selected>Choose option</option>

                        <option value="Instructor I" @if($collection->rank == "Instructor I") selected @endif>Instructor
                            I</option>
                        <option value="Instructor II" @if($collection->rank == "Instructor II") selected
                            @endif>Instructor II</option>
                        <option value="Instructor III" @if($collection->rank == "Instructor III") selected
                            @endif>Instructor III</option>
                        <option value="Professor I" @if($collection->rank == "Professor I") selected @endif>Professor I
                        </option>
                        <option value="Professor II" @if($collection->rank == "Professor II") selected @endif>Professor
                            II</option>
                        <option value="Professor III" @if($collection->rank == "Professor III") selected
                            @endif>Professor III</option>
                        <option value="Professor IV" @if($collection->rank == "Professor IV") selected @endif>Professor
                            IV</option>
                        <option value="Professor V" @if($collection->rank == "Professor V") selected @endif>Professor V
                        </option>
                        <option value="Assistant Professor I" @if($collection->rank == "Assistant Professor I") selected
                            @endif>Assistant Professor I</option>
                        <option value="Assistant Professor II" @if($collection->rank == "Assistant Professor II")
                            selected @endif>Assistant Professor II</option>
                        <option value="Assistant Professor III" @if($collection->rank == "Assistant Professor III")
                            selected @endif>Assistant Professor III</option>
                        <option value="Associate Professor I" @if($collection->rank == "Associate Professor I") selected
                            @endif>Associate Professor I</option>
                        <option value="Associate Professor II" @if($collection->rank == "Associate Professor II")
                            selected @endif>Associate Professor II</option>
                        <option value="Associate Professor III" @if($collection->rank == "Associate Professor III")
                            selected @endif>Associate Professor III</option>
                        <option value="Associate Professor IV" @if($collection->rank == "Associate Professor IV")
                            selected @endif>Associate Professor IV</option>
                        <option value="Associate Professor V" @if($collection->rank == "Associate Professor V") selected
                            @endif>Associate Professor V</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Email Address </label>
                    <input type="text" id="email" class="form-control" name="email" aria-required="true"
                        aria-invalid="false" value="{{$collection->email}}">
                </div>
                <br>

                <div class="form-group">
                    <input type="submit" id="country" class="form-control btn btn-success" value="Submit">
                </div>
            </form>
        </div>


    </div>
</div>
@endsection
@section('scripts')
<script>
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

    //   $('a.btnRem').click(function (event) {
    //       event.preventDefault();
    //       swal({
    //           title: 'CONFIRM ACTION',
    //           text: 'Are you sure you want to put in the archive?',
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


    @if(Session::has('Inserted'))
    swal(
        'Saved',
        'New Faculty added successfully.',
        'success'
    )
    @elseif(Session::has('Activated'))
    swal(
        'Activated',
        'Faculty has been removed from archive successfuly.',
        'success'
    )
    @elseif(Session::has('Deleted'))
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