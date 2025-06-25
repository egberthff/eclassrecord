@extends('layouts.admin')
@section('course')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">Course
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
            <form method="POST" action="{{route('course.update' , $collection->id)}}" enctype="multipart/form-data" style="font-size: 12px;">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PATCH">

              <div class="form-group">
                  <label class=" form-control-label">College <span style="color: red; font-weight: bold;">*</span></label>
                  <select class="form-control select2" name="college_id" id="company" aria-required="true" aria-invalid="false" data-validation="required">
                    @isset($options)
                      @foreach($options as $option)
                        <option value="{{$option->id}}" @if($collection->college_id == $option->id) selected @endif>{{$option->name}}</option>
                      @endforeach
                    @endisset
                  </select>
              </div>

              <div class="form-group">
                  <label class=" form-control-label">Course <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="company" class="form-control" name="course" value="{{$collection->course}}" aria-required="true" aria-invalid="false" data-validation="required">
              </div>

              <div class="form-group">
                  <label class=" form-control-label">Code <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="company" class="form-control" name="code" value="{{$collection->code}}" aria-required="true" aria-invalid="false" data-validation="required">
              </div>
              <br>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="board_exam" id="flexSwitchCheckChecked" @if($collection->board_exam == 1) checked="" @endif/>
                <label class="form-check-label" for="flexSwitchCheckChecked">Board Course</label>
              </div>
              <br>

              <div class="form-group">
                  <input type="submit" id="country" class="form-control btn btn-success" value="Submit">
              </div>
          </form>
      </div>
      <div class="col-md-8">
          <div class="custom-tab">

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                aria-selected="true">Active</a>
                <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                aria-selected="false">Archive</a>
              </div>
            </nav>
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <div class="table-responsive m-b-40">
                    <table id="table2" class="table table-borderless table-data3" style="width: 100%;">
                      <thead style="background-color: #330066;">
                          <tr>
                              <th width="20%" style="font-size: 12px; color: white;">Code</th>
                              <th width="30%" style="font-size: 12px; color: white;">Course</th>
                              <th width="20%" style="font-size: 12px; color: white;">College</th>
                              <th width="20%" style="font-size: 12px; color: white;">Board Course</th>
                              <th width="10%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @isset($model)
                          @foreach($model as $element)
                            <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                              <td>{{$element->code}}</td>
                              <td>{{$element->course}}</td>
                              <td>{{$element->college->name}}</td>
                              <td>@if($element->board_exam == 1) YES @endif</td>
                              <td>
                                  <div class="table-data-feature">
                                    @if($element->status == 1)
                                        <a href="{{route('course.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                        <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                        </a>
                                        <b style="color: green;">
                                            <a href="{{route('course.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnRem" data-toggle="tooltip" data-placement="top" title="Put in ARCHIVE">
                                            <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                            </a>
                                        </b> 
                                    @else 
                                            <a href="#" style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip" data-placement="top" title="Remove from ARCHIVE">
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

                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                  <div class="table-responsive m-b-40">

                    <table id="table" class="table table-borderless table-data3" style="width: 100%;">
                      <thead style="background-color: #330066;">
                          <tr>
                              <th width="20%" style="font-size: 12px; color: white;">Code</th>
                              <th width="30%" style="font-size: 12px; color: white;">Course</th>
                              <th width="20%" style="font-size: 12px; color: white;">College</th>
                              <th width="20%" style="font-size: 12px; color: white;">Board Course</th>
                              <th width="10%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @isset($inactive)
                          @foreach($inactive as $element)
                            <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                              <td>{{$element->code}}</td>
                              <td>{{$element->course}}</td>
                              <td>{{$element->college->name}}</td>
                              <td>@if($element->board_exam == 1) YES @endif</td>
                              <td>
                                  <div class="table-data-feature">
                                      @if($element->status == 1)
                                          <a href="{{route('course.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                          <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                          </a>
                                          <b style="color: green;">
                                              <a href="{{route('course.destroy', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="Put in ARCHIVE">
                                              <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                              </a>
                                          </b> 
                                      @else 
                                              <a href="{{route('course.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip" data-placement="top" title="Remove from ARCHIVE">
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
              'New Course added successfully.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'Course deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Course updated successfully.',
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