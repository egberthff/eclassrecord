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
                  <h1 class="title-3">Grading Terms
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <form action="{{route('termsettingsupdate')}}" method="POST">
    <div class="row">
        {{csrf_field()}}
        <div class="col-md-6">
            <div>
                <table style="width: 50%;" class="table table-bordered">
                    <tbody>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>PRELIM</td>
                            <td>
                                <input type="checkbox" name="prelim" class="form-check-input" style="font-size: 15px;" @if(Auth::user()->prelim == 1) checked @endif>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>MIDTERM</td>
                            <td>
                            <input type="checkbox" name="midterm" class="form-check-input" style="font-size: 15px;" @if(Auth::user()->midterm == 1) checked @endif>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>SEMIFINAL</td>
                            <td>
                            <input type="checkbox" name="prefi" class="form-check-input" style="font-size: 15px;" @if(Auth::user()->prefi == 1) checked @endif>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>FINAL</td>
                            <td>
                            <input type="checkbox" name="final" class="form-check-input" style="font-size: 15px;" @if(Auth::user()->final == 1) checked @endif>
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
              'Grading Terms has been updated successfully.',
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