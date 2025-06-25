@extends('layouts.admin')
@section('college')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">College
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
            <form method="POST" action="{{route('college.store')}}" enctype="multipart/form-data" style="font-size: 12px;" autocomplete="off">
              {{csrf_field()}}

              <div class="form-group">
                  <label class=" form-control-label">College <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="company"  class="form-control"  name="name" aria-required="true" aria-invalid="false" data-validation="required" autocomplete="off">
              </div>

              <div class="form-group">
                  <label class=" form-control-label">Description <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="description"  class="form-control"  name="description" aria-required="true" aria-invalid="false" data-validation="required" autocomplete="off">
              </div>

              <div class="form-group">
                  <label class=" form-control-label">Dean <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="dean"  class="form-control"  name="dean" aria-required="true" aria-invalid="false" data-validation="required" autocomplete="off">
              </div>
              <br>
              <div class="form-group">
                  <input type="submit" id="country" class="form-control btn btn-success" value="Submit">
              </div>
          </form>
      </div>
        <div class="col-md-9">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Active</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Archive</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive m-b-40">
                  <table id="table2" class="table table-borderless table-data3" style="width: 100%;">
                      <thead style="background-color: #330066;">
                          <tr>
                              <th width="10%" style="font-size: 12px; color: white;">College</th>
                              <th width="50%" style="font-size: 12px; color: white;">Description</th>
                              <th width="30%" style="font-size: 12px; color: white;">Dean</th>
                              <th width="10%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @isset($model)
                          @foreach($model as $element)
                            <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                              <td>{{$element->name}}</td>
                              <td>{{$element->description}}</td>
                              <td>{{$element->dean}}</td>
                              <td>
                                  <div class="table-data-feature">
                                      @if($element->status == 1)
                                          <a href="{{route('college.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                          <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                          </a>
                                          <b style="color: green;">
                                              <a href="{{route('college.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnRem" data-toggle="tooltip" data-placement="top" title="Put in ARCHIVE">
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
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="table-responsive m-b-40">
                  <table id="table" class="table table-borderless table-data3" style="width: 100%;">
                    <thead style="background-color: #330066;">
                        <tr>
                            <th width="10%" style="font-size: 12px; color: white;">College</th>
                            <th width="50%" style="font-size: 12px; color: white;">Description</th>
                            <th width="30%" style="font-size: 12px; color: white;">Dean</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                      @isset($inactive)
                        @foreach($inactive as $element)
                          <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>{{$element->name}}</td>
                            <td>{{$element->description}}</td>
                            <td>{{$element->dean}}</td>
                            <td>
                              <div class="table-data-feature">
                                  @if($element->status == 1)
                                      <a href="{{route('college.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                      <i class="fs-5 bi bi-pencil-fill" style="color: blue;"></i>
                                      </a>
                                      <b style="color: green;">
                                          <a href="{{route('college.destroy', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="Put in ARCHIVE">
                                          <i class="fs-5 bi bi-trash-fill" style="color: red;"></i>
                                          </a>
                                      </b> 
                                  @else 
                                          <a href="{{route('college.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip" data-placement="top" title="Remove from ARCHIVE">
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
              'New College added successfully.',
              'success'
            )
          @elseif( Session::has('Activated') )
            swal(
              'Unarchived',
              'College has been removed from archive successfuly.',
              'success'
            )
          @elseif( Session::has('Archived') )
            swal(
              'Archived',
              'College has been added to archive.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'College deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'College updated successfully.',
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