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
    <div class="pull-right" style="padding-right: 2px;padding-top: 20px;padding-bottom: 5px;">
        <a href="{{route('faculty.create')}}" class="btn btn-success" style="font-size: 12px; padding: 4px;">
            <i class="fa fa-plus"></i> Add Faculty</a>
        <a href="{{route('faculty_uploadcsv')}}" class="btn btn-success" style="font-size: 12px; padding: 4px;">
            <i class="fa fa-plus"></i> Import Faculty</a>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                        <table id="table" class="table table-borderless table-data3" style="width: 100%;">
                            <thead style="background-color: #330066;">
                                <tr>
                                    <th width="20%" style="font-size: 12px; color: white;">ID Number</th>
                                    <th width="30%" style="font-size: 12px; color: white;">Name</th>
                                    <th width="20%" style="font-size: 12px; color: white;">Rank</th>
                                    <th width="20%" style="font-size: 12px; color: white;">Email Address</th>
                                    <th width="10%" style="font-size: 12px; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($model)
                                @foreach($model as $element)
                                <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                    <td>{{$element->id_no}}</td>
                                    <td>{{$element->lname}}, {{$element->fname}} @if($element->mname)
                                        {{substr($element->mname, 0, 1)}}.@endif</td>
                                    <td>{{$element->rank}}</td>
                                    <td>{{$element->email}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($element->status == 1)
                                            <a href="{{route('faculty.edit', $element->id)}}" style="margin-top: 10px;"
                                                class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                                <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                            </a>
                                            <b style="color: green;">
                                                <a href="{{route('faculty.destroy', $element->id)}}"
                                                    style="margin-top: 10px;" class="item btnRem" data-toggle="tooltip"
                                                    data-placement="top" title="Put in ARCHIVE">
                                                    <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                </a>
                                            </b>
                                            @else
                                            <a href="#" style="margin-top: 10px;" class="item btnAct"
                                                data-toggle="tooltip" data-placement="top" title="Remove from ARCHIVE">
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
                        <table id="table2" class="table table-borderless table-data3" style="width: 100%;">
                            <thead style="background-color: #330066;">
                                <tr>
                                    <th width="20%" style="font-size: 12px; color: white;">ID Number</th>
                                    <th width="30%" style="font-size: 12px; color: white;">Name</th>
                                    <th width="20%" style="font-size: 12px; color: white;">Rank</th>
                                    <th width="20%" style="font-size: 12px; color: white;">Email Address</th>
                                    <th width="10%" style="font-size: 12px; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($archived)
                                @foreach($archived as $element)
                                <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                                    <td>{{$element->id_no}}</td>
                                    <td>{{$element->lname}}, {{$element->fname}} @if($element->mname)
                                        {{substr($element->mname, 0, 1)}}.@endif</td>
                                    <td>{{$element->rank}}</td>
                                    <td>{{$element->email}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($element->status == 1)
                                            <a href="{{route('faculty.edit', $element->id)}}" style="margin-top: 10px;"
                                                class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                                <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                            </a>
                                            <b style="color: green;">
                                                <a href="{{route('faculty.destroy', $element->id)}}"
                                                    style="margin-top: 10px;" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="Put in ARCHIVE">
                                                    <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                                </a>
                                            </b>
                                            @else
                                            <a href="{{route('faculty.destroy', $element->id)}}"
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