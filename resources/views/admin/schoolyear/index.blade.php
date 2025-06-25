@extends('layouts.admin')
@section('schoolyear')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">School Year
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
            <form method="POST" id="schoolyearsubmitform" action="{{route('schoolyear.store')}}" enctype="multipart/form-data" style="font-size: 12px;">
              {{csrf_field()}}

              <div class="form-group">
                  <label class=" form-control-label">Start Year <span style="color: red; font-weight: bold;">*</span></label>
                  @php
                      $today = today();
                      $tod = $today->subYear(2);
                      $dates = [];
                      
                      for ($i = 1; $i < 10 + 1; ++$i) {
                          $tod_ = \Carbon\Carbon::parse($tod)->addYear();
                          $dates[] = $tod_;
                          $tod = $tod_;
                      }
                  @endphp

                  <select name="start_year" id="start_year" class="form-control">
                      @foreach ($dates as $date)
                          <option value="{{$date->year}}" @if(Carbon\Carbon::now()->year == $date->year) selected @endif>{{$date->year}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label class=" form-control-label">End Year <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="end_year" class="form-control" name="end_year" value="{{Carbon\Carbon::now()->addYear()->year}}" readonly>
              </div>
              
              <br>
              <div class="form-group">
                  <input type="submit" id="schoolyearsubmit" class="form-control btn btn-success" value="Submit">
              </div>
          </form>
      </div>
        <div class="col-md-6">
            <div class="table-responsive m-b-40">
              <table id="table" class="table table-borderless table-data3" style="width: 100%;">
                <thead style="background-color: #330066;">
                    <tr>
                        <th width="40%" style="font-size: 12px; color: white;">SCHOOL YEAR</th>
                        <th width="40%" style="font-size: 12px; color: white;">STATUS</th>
                        <th width="10%" style="font-size: 12px; color: white;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                  @isset($model)
                    @foreach($model as $element)
                      <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                        <td>{{$element->name}}</td>
                        <td>@if($element->status == 1) <b style="color: green;">ACTIVE</b> @else <b style="color: red;">INACTIVE</b>  @endif</td>
                        <td style="padding: 0px;">
                          <div class="table-data-feature">
                            <!-- <a style=" margin-right: 40px; margin-top: 10px;" href="{{route('schoolyear.edit', $element->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                              <i class="zmdi zmdi-edit"></i>
                            </a> -->
                            <!-- <a style=" margin-right: 40px; margin-top: 5px;" href="{{route('schoolyear_delete', $element->id)}}" class="item btnDel" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                            </a>
                            <form action="#" method="POST" style="display:none" class="formDelete">
                              {{csrf_field()}}
                               @method('DELETE')
                              <button class="btn btn-danger" type="submit" autofocus=""></button> 
                            </form>-->
                            
                            @if(($element->start_year == Carbon\Carbon::now()->year || $element->end_year == Carbon\Carbon::now()->year) && $element->status == 0)
                            <a href="#" style=" margin-right: 40px; margin-top: 10px;" class="item btnAct" data-toggle="tooltip" data-placement="top" title="ACTIVATE">
                              <i class="fs-3 bi bi-check-circle-fill" style="color: green;"></i>
                            </a>
                            <form action="{{route('schoolyear_show', $element->id)}}" method="POST" style="display:none" class="formActivate">
                              {{csrf_field()}}
                              <button class="btn btn-danger" type="submit" autofocus=""></button> 
                            </form>
                            @endif
                            
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  @endisset
                </tbody>
              </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      $.validate();
  </script>
  <script>
      $(document).ready(function(){
          $('#start_year').on('change', function(){
            var end_year = parseInt(this.value) + 1;
            $('#end_year').val(end_year);
          });

          $('a.btnAct').click(function (event) {
              event.preventDefault();
              swal({
                  title: 'CONFIRM ACTION',
                  text: 'Are you sure you want to change the active School Year?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'CHANGE',
                  reverseButtons: true,
                  focusConfirm: false,
              }).then((result) => {
                  if(result.value){
                      $('.formActivate').submit();
                  }
              });
          });
          @if(  Session::has('Inserted') )
            swal(
              'Saved',
              'New School Year added successfully.',
              'success'
            )
          @elseif( Session::has('Activated') )
            swal(
              'Activated',
              'School Year has been activated successfully.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'School Year deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'School Year updated successfully.',
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