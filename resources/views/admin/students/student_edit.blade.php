@extends('layouts.admin')
@section('head')
	<style>
		.form-error{
			color: red !important;
		}
	</style>
@endsection
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10" style="padding-top: 20px;">
				<div class="card">
					<div class="card-header" style="background-color: #330066;color: white;">
						Edit Student
					</div>
					<div class="card-body">
                        
						<form action="{{route('student_upd_store', $model->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
							@csrf

                            <input type="hidden" name="_method" value="PATCH">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group" id="email_div">
										<label class="control-label" style="color: black !important;">ID No. <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="email" id="email" class="form-control" aria-required="true" aria-invalid="false" data-validation="number" data-validation="required" value="{{$model->id_no}}" readonly>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Password</label>
										<input type="password" name="password" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Confirm Password</label>
										<input id="password-confirm" type="password" data-validation="confirmation" data-validation-confirm="password" name="password_confirmation" class="form-control" aria-required="true" aria-invalid="false" value="">
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Lastname <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="last_name" class="form-control" aria-required="true" aria-invalid="false" data-validation="required" value="{{$model->lastname}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Firstame <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="first_name" class="form-control" aria-required="true" aria-invalid="false" data-validation="required" value="{{$model->firstname}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Middlename</label>
										<input type="text" name="middle_name" class="form-control" value="{{$model->middlename}}" >
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1" style="color: black !important;">Sex <span style="color: red; font-weight: bold;">*</span></label>
		                                <select class="form-control" name="sex" aria-required="true" aria-invalid="false" data-validation="required">
	                                      <option value="Male" @if($model->sex == 'Male') selected @endif>
	                                        Male
	                                      </option>
	                                      <option value="Female" @if($model->sex == 'Female') selected @endif>
	                                        Female
	                                      </option>
		                                </select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Address</label>
										<input type="text" name="address" class="form-control" aria-required="true" value="{{$model->address}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Date of Birth <span style="color: red; font-weight: bold;">*</span></label>
										<input type="date" name="birthdate" class="form-control" aria-required="true" aria-invalid="false" data-validation="required" value="{{Carbon\Carbon::parse($model->birthdate)->toDateString()}}">
									</div>
								</div>
							</div>
							<div class="row">
                                <div class="col-md-4">
									<div class="form-group">
		                                <label for="cc-payment" class="control-label mb-1" style="color: black !important;">Course <span style="color: red; font-weight: bold;">*</span></label>
		                                <?php $courses = App\Course::where('status', 1)->get();?>
										<select class="form-control" name="course_id" aria-required="true" aria-invalid="false" data-validation="required">
											@isset($courses)
												@foreach($courses as $course)
												<option value="{{$course->id}}" @if($model->course_id == $course->id) selected @endif>{{$course->course}}</option>
												@endforeach
											@endisset
		                                </select>
									</div>
	                            </div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Year Level <span style="color: red; font-weight: bold;">*</span></label>
										<select class="form-control" name="year_level" aria-required="true" aria-invalid="false" data-validation="required">
											<option value="1"  @if($model->yearlevel == '1') selected @endif>1</option>
											<option value="2" @if($model->yearlevel == '2') selected @endif>2</option>
											<option value="3" @if($model->yearlevel == '3') selected @endif>3</option>
											<option value="4" @if($model->yearlevel == '4') selected @endif>4</option>
											<option value="5" @if($model->yearlevel == '5') selected @endif>5</option>
		                                </select>
									</div>
								</div>
                                <div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Units</label>
										<input type="text" name="units" class="form-control" aria-required="true" value="{{$model->units}}">
									</div>
								</div>
                                <div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Section</label>
										<input type="text" name="section" class="form-control" aria-required="true" style="text-transform: uppercase;" value="{{$model->section}}">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Email Address</label>
										<input type="email" name="email_address" class="form-control" aria-required="true" style="text-transform: uppercase;" value="{{$model->email}}">
									</div>
								</div>
							</div>
							
							<input id="submit_btn" class="btn btn-sm btn-primary" type="submit" name="submit" value="Update Student">
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection
@section('scripts')
<script type="text/javascript">
      $.validate({
        modules : 'security',
        onModulesLoaded : function() {
          var optionalConfig = {
            fontSize: '12pt',
            padding: '4px',
            bad : 'Very bad',
            weak : 'Weak',
            good : 'Good',
            strong : 'Strong'
          };

          $('input[name="password"]').displayPasswordStrength(optionalConfig);
          $('input[name="password_confirmation"]').displayPasswordStrength(optionalConfig);
        }
      });
  </script>
@endsection