@extends('layouts.admin')
@section('evaluation')
active
@endsection
@section('content')
  <!-- WELCOME-->
  <section class="welcome p-t-30 p-b-10" >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="title-3">Evaluation Settings
                  </h1>
              </div>
          </div>
      </div>
  </section>
  <div class="container">
    <form action="{{route('evaluationsettings_update' , $element->id)}}" method="POST">
    <div class="row">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="col-md-10">
            <div class="pull-right" style="padding-right: 2px;padding-top: 20px;padding-bottom: 5px;">
                <div class="form-group">
                    <button type="submit" id="country" class="form-control btn btn-success" value="Save" style="font-size: 12px; padding: 4px;"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" style="width: 100%;">
                    <thead style="background-color: #1a8cff;">
                        <tr>
                            <th width="50%"></th>
                            <th width="50%" style="text-align: right;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Evaluate By Self</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s1" type="checkbox" name="s1" class="promoted-input-checkbox"  @if($element->self_enabled == 1) checked @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s1">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Evaluate By Peer</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s2" type="checkbox" name="s2" class="promoted-input-checkbox" @if($element->peer_enabled == 1) checked @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s2">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Evaluate By Student</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s3" type="checkbox" name="s3" class="promoted-input-checkbox" @if($element->students_enabled == 1) checked @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s3">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Evaluate By Supervisor</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s4" type="checkbox" name="s4" class="promoted-input-checkbox" @if($element->dean_enabled == 1) checked @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s4">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Self Evaluation Percentage (%)</td>
                            <td>
                                <input type="number" name="self_percentage" class="form-control" min="0" max="100" value="{{$element->self_percentage}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Peer Evaluation Percentage (%)</td>
                            <td>
                                <input type="number" name="peer_percentage" class="form-control" min="0" max="100" value="{{$element->peer_percentage}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Student Evaluation Percentage (%)</td>
                            <td>
                                <input type="number" name="student_percentage" class="form-control" min="0" max="100" value="{{$element->students_percentage}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Supervisor Evaluation Percentage (%)</td>
                            <td>
                                <input type="number" name="supervisor_percentage" class="form-control" min="0" max="100" value="{{$element->dean_percentage}}" aria-required="true">
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Turn on evaluation for Semester 1</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s5" type="checkbox" name="s5" class="promoted-input-checkbox" @if($element->firstsem_enabled == 1) checked disabled @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s5">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Turn on evaluation for Semester 2</td>
                            <td style="padding-right: 101px;text-align: left;">
                                <div class="checkbox-wrapper-28" style="margin-left: 15px;">
                                    <input id="tmp-s6" type="checkbox" name="s6" class="promoted-input-checkbox"  @if($element->secondsem_enabled == 1) checked disabled @endif @if($element->secondsem_enabled == 1) checked @endif/>
                                    <svg><use xlink:href="#checkmark-28" /></svg>
                                    <label for="tmp-s6">
                                    Enabled   
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                        <symbol id="checkmark-28" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-miterlimit="10" fill="none"  d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                        </path>
                                        </symbol>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;display: none;">
                            <td>Department</td>
                            <td>
                                <input type="text" name="department" class="form-control" value="{{$element->department}}" aria-required="true" required>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;display: none;">
                            <td>Reviewer</td>
                            <td>
                                <input type="text" name="reviewer" class="form-control" value="{{$element->reviewer}}" aria-required="true" required>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;display: none;">
                            <td>Reviewer Designation</td>
                            <td>
                                <input type="text" name="reviewer_designation" class="form-control" value="{{$element->reviewer_designation}}" aria-required="true" required>
                            </td>
                        </tr>
                        <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                            <td>Campus Director</td>
                            <td>
                                <input type="text" name="campus_director" class="form-control" value="{{$element->campus_director}}" aria-required="true" required>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
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
              'Evaluation settings has been updated successfully.',
              'success'
            )
           @elseif(  Session::has('Greatertohundred') )
            swal(
              'Error',
              'Percentage settings is greater than 100.',
              'info'
            )
            @elseif(  Session::has('lesstohundred') )
            swal(
              'Error',
              'Percentage settings is lesser than 100.',
              'info'
            )
          @endif
      });
  </script>
@endsection