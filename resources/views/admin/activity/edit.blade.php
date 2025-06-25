@extends('layouts.admin')
@section('activities')
active
@endsection
@section('content')
<section class="welcome p-t-30 p-b-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-3">Activities
                </h1>
            </div>
        </div>
    </div>
</section>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-4">
        <form method="POST" action="{{route('activity.update', $model->id)}}" enctype="multipart/form-data"
                style="font-size: 12px;">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label class=" form-control-label">Date <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="date" id="company" class="form-control" name="date" aria-required="true"
                        aria-invalid="false" data-validation="required" value="{{$model->date}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Name <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" id="company" class="form-control" name="name" aria-required="true"
                        aria-invalid="false" data-validation="required" value="{{$model->name}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Description</label>
                    <input type="text" id="company" class="form-control" name="description" aria-required="true"
                        aria-invalid="false" value="{{$model->description}}">
                </div>

                <div class="form-group">
                    <label class=" form-control-label">Total Items Score <span
                            style="color: red; font-weight: bold;">*</span></label>
                    <input type="number" id="company" class="form-control" name="items_total" aria-required="true"
                        aria-invalid="false" data-validation="required" min="1" value="{{$model->items_total}}">
                </div>
                <br>

                <div class="form-group">
                    <input type="submit" id="country" class="form-control btn btn-success" value="Submit">
                </div>
            </form>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script>
    $(document).ready(function() {
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
            'Unable to update. There are input scores greater than the new Total Items Score inputted',
            'info'
        )
        @elseif(Session::has('Duplicate'))
        swal('Duplicate Record.', 'This record already exist.', 'info');
        @endif
    });
    </script>
    @endsection