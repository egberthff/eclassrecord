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
						Add Student
					</div>
					<div class="card-body">
                        
						<form action="{{route('add_student_store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group" id="email_div">
										<label class="control-label" style="color: black !important;">ID No. <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="email" id="email" class="form-control" aria-required="true" aria-invalid="false" data-validation="number" data-validation="required" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Password <span style="color: red; font-weight: bold;">*</span></label>
										<input type="password" name="password" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" data-validation="required">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Confirm Password <span style="color: red; font-weight: bold;">*</span></label>
										<input id="password-confirm" type="password" data-validation="confirmation" data-validation-confirm="password" name="password_confirmation" class="form-control" aria-required="true" aria-invalid="false" value="" data-validation="required">
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Lastname <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="last_name" class="form-control" aria-required="true" aria-invalid="false" data-validation="required" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Firstame <span style="color: red; font-weight: bold;">*</span></label>
										<input type="text" name="first_name" class="form-control" aria-required="true" aria-invalid="false" data-validation="required">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Middlename</label>
										<input type="text" name="middle_name" class="form-control" >
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1" style="color: black !important;">Sex <span style="color: red; font-weight: bold;">*</span></label>
		                                <select class="form-control" name="sex" aria-required="true" aria-invalid="false" data-validation="required">
	                                      <option value="Male" selected="">
	                                        Male
	                                      </option>
	                                      <option value="Female">
	                                        Female
	                                      </option>
		                                </select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Address</label>
										<input type="text" name="address" class="form-control" aria-required="true">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Date of Birth <span style="color: red; font-weight: bold;">*</span></label>
										<input type="date" name="birthdate" class="form-control" min="{{Carbon\Carbon::now()->subYears(100)->toDateString()}}" max="{{Carbon\Carbon::now()->subYears(10)->toDateString()}}" aria-required="true" aria-invalid="false" data-validation="required" >
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
												<option value="{{$course->id}}">{{$course->course}}</option>
												@endforeach
											@endisset
		                                </select>
									</div>
	                            </div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Year Level <span style="color: red; font-weight: bold;">*</span></label>
										<select class="form-control" name="year_level" aria-required="true" aria-invalid="false" data-validation="required">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
		                                </select>
									</div>
								</div>
                                <div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Units</label>
										<input type="text" name="units" class="form-control" aria-required="true">
									</div>
								</div>
                                <div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Section</label>
										<input type="text" name="section" class="form-control" aria-required="true" style="text-transform: uppercase;" >
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Email Address</label>
										<input type="email" name="email_address" class="form-control" aria-required="true" style="text-transform: uppercase;" >
									</div>
								</div>
							</div>
              				<br>
							
							<input id="submit_btn" class="btn btn-sm btn-primary" type="submit" name="submit" value="Create Student">
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
	<script type="text/javascript">
      $(document).ready(function(){
        $('#email').on('keyup', function() {
            var email = $('#email').val();
            $.ajax({
              url: '/checkidno',
              type: 'post',
              data: {'email': email, '_token': $('input[name=_token]').val()},
              dataType: 'json',
              success:function(result){
                if(result.user == '1'){
                    $('#email_div').append('<span id="err" class="help-block form-error">This is a required field</span>');
                    $('#email').css('border-color', 'rgb(185, 74, 72)');
                    $('#email').addClass('error');
                    $('#email').removeClass('valid');
                    $('#submit_btn').prop('disabled', true);
                }else{
                    $('#email').css('border-color', 'none');
                    $('#email').removeClass('error');
                    $('#err span').remove();
                    $('#submit_btn').prop('disabled', false);
                }
              }
            });
        });
      });
  </script>
@endsection