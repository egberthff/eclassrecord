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
            <div class="row justify-content-left">
                <div class="card">
                    <div class="card-header" style="text-align: right;">
                        <a href="/Import Faculty Template.xlsx" target="_blank" class="btn btn-sm btn-success"> <span
                                class="fa fa-download"></span> Download Template</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('faculty_upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Upload a CSV or Excel file</label>
                                <p style="color: red;">Note: This will override existing faculty with the same ID</p>
                                <br>
                                <input type="file" id="btnFacultyInsertFileIMPORTACTION" name="file_upload"
                                    class="form-control" accept=".csv,.xlsx" required="">
                                <input type="hidden" id="FacultyInsertFileIMPORTACTIONGO" name="faculties" value="">
                            </div>
                            <br>
                            <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Upload Faculties">
                        </form>

                    </div>
                </div>
            </div>
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