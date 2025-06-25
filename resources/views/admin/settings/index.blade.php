@extends('layouts.admin')
@section('settings')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">Grading Percentage
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <form action="{{route('settings.update' , $element->id)}}" method="POST">
    <div class="row">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="col-md-6">
            <div>
                <table style="width: 50%;">
                      <thead>
                        <tr>
                            <th width="70%"></th>
                            <th width="30%" style="text-align: right;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Classwork Percentage(%)</td>
                            <td>
                                <input type="number" name="classwork" class="form-control" min="0" max="100" value="{{$element->classwork}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Projects Percentage (%)</td>
                            <td>
                                <input type="number" name="projects" class="form-control" min="0" max="100" value="{{$element->projects}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Exams Percentage (%)</td>
                            <td>
                                <input type="number" name="exams" class="form-control" min="0" max="100" value="{{$element->exams}}" aria-required="true">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2">
                <div class="pull-right" style="padding-right: 2px;padding-top: 20px;padding-bottom: 5px;">
                    <div class="form-group">
                        <button type="submit" id="country" class="form-control btn btn-success" value="Save" style="font-size: 12px; padding: 4px;"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
  </div>
@endsection
@section('scripts')
  <script>
      $(document).ready(function(){
          @if(  Session::has('Updated') )
            swal(
              'Saved',
              'Grading Percentage has been updated successfully.',
              'success'
            )
           @elseif(  Session::has('Greatertohundred') )
            swal(
              'Error',
              'Grading Percentage is greater than 100.',
              'info'
            )
            @elseif(  Session::has('lesstohundred') )
            swal(
              'Error',
              'Grading Percentage is lesser than 100.',
              'info'
            )
          @endif
      });
  </script>
@endsection