@extends('layouts.admin')
@section('subject')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">Edit Subject
                  </h1>
              </div>
          </div>
      </div>
  </section>
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <form method="POST" action="{{route('subject.update' , $collection->id)}}" enctype="multipart/form-data" style="font-size: 12px;">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <label class=" form-control-label">Year & Semester</label>
            <input type="text" id="year_sem" class="form-control" name="year_sem" style="font-weight: bold;" value="Year : {{$collection->year}} Sem : {{$collection->semester}}" readonly>
        </div>

        <div class="form-group">
            <label class=" form-control-label">Subject Code<span style="color: red; font-weight: bold;">*</span></label>
            <input type="text" id="subject_code" class="form-control" name="subject_code" style="font-weight: bold;" value="{{$collection->subject_code}}" readonly>
        </div>

        <div class="form-group">
            <label class=" form-control-label">Subject Desc<span style="color: red; font-weight: bold;">*</span></label>
            <input type="text" id="subject_desc" class="form-control" name="subject_desc" aria-required="true" aria-invalid="false" data-validation="required" value="{{$collection->subject_desc}}">
        </div>



        <div class="form-group">
            <label class=" form-control-label">Lec Units<span style="color: red; font-weight: bold;">*</span></label>
            <input type="number" id="lec_units" class="form-control" name="lec_units" aria-required="true" aria-invalid="false" data-validation="required" value="{{$collection->lec_units}}">
        </div>

        <div class="form-group">
            <label class=" form-control-label">Lab Units<span style="color: red; font-weight: bold;">*</span></label>
            <input type="number" id="lab_units" class="form-control" name="lab_units" aria-required="true" aria-invalid="false" data-validation="required" value="{{$collection->lab_units}}">
        </div>

        <div class="form-group">
            <label class=" form-control-label">Total Units<span style="color: red; font-weight: bold;">*</span></label>
            <input type="number" id="total_units" class="form-control" name="total_units" aria-required="true" aria-invalid="false" data-validation="required" value="{{$collection->total_units}}">
        </div>

        <div class="form-group">
          <label class=" form-control-label">Assigned Faculty</label>
          <select name="faculty_id" id="faculty_id" class="form-control" aria-required="true" aria-invalid="false" data-validation="required">
            <option value="">Select Faculty</option>
            @isset($faculties)
              @foreach ($faculties as $faculty)
                  <option value="{{$faculty->id_no}}" @if($collection->faculty_id == $faculty->id_no) selected @endif>{{$faculty->lname}}, {{$faculty->fname}} @if($faculty->mname) {{substr($faculty->mname, 0, 1)}}.@endif </option>
              @endforeach
            @endisset
          </select>
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
              'New Subject added successfully.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'Subject deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Subject updated successfully.',
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
  </script>
@endsection