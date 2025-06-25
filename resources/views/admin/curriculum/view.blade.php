@extends('layouts.admin')
@section('curriculum')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">Curriculum
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
            <form method="POST" id="schoolyearsubmitform" action="{{route('curriculum.update', $collection->id)}}" enctype="multipart/form-data" style="font-size: 12px;">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PATCH">
              <div class="form-group">
                  <label class=" form-control-label">Curriculum <span style="color: red; font-weight: bold;">*</span></label>
                  <input type="text" id="name" class="form-control" name="name" value="{{$collection->name}}">
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
                        <th width="40%" style="font-size: 12px; color: white;">CURRICULUM</th>
                        <th width="10%" style="font-size: 12px; color: white;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                  @isset($model)
                    @foreach($model as $element)
                      <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                        <td>{{$element->name}}</td>
                        <td>
                            <div class="table-data-feature">
                                @if($element->status == 1)
                                    <a href="{{route('curriculum.edit', $element->id)}}" style="margin-top: 10px;" class="item" data-toggle="tooltip" data-placement="top" title="EDIT">
                                    <i class="fs-3 bi bi-pencil-fill" style="color: blue;"></i>
                                    </a>
                                    <b style="color: green;">
                                        <a href="{{route('curriculum.destroy', $element->id)}}" style="margin-top: 10px;" class="item btnRem" data-toggle="tooltip" data-placement="top" title="Put in ARCHIVE">
                                        <i class="fs-3 bi bi-trash-fill" style="color: red;"></i>
                                        </a>
                                    </b> 
                                @else 
                                        <a href="#" style="margin-top: 10px;" class="item btnAct" data-toggle="tooltip" data-placement="top" title="Remove from ARCHIVE">
                                        <i class="fs-3 bi bi-trash-fill" style="color: green;"></i>
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
          @if(  Session::has('Inserted') )
            swal(
              'Saved',
              'New Curriculum added successfully.',
              'success'
            )
          @elseif( Session::has('Activated') )
            swal(
              'Activated',
              'Curriculum has been activated successfully.',
              'success'
            )
          @elseif( Session::has('Deleted') )
            swal(
              'Deleted',
              'Curriculum deleted successfully.',
              'success'
            )
          @elseif( Session::has('Updated') )
            swal("SUCCESS!", "{!! session('Updated') !!}", "success"); swal(
              'Updated',
              'Curriculum updated successfully.',
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