@extends('layouts.admin')
@section('head')
	<style>
		.form-error{
			color: red !important;
		}
	</style>
@endsection
@section('selectfaculty_evaluate')
active
@endsection
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5" style="padding-top: 20px;">
				<div class="card">
					<div class="card-header" style="background-color: #330066;color: white;">
						Select Faculty to Evaluate
					</div>
					<div class="card-body">
            
          <?php
            $schoolyear = App\Schoolyear::where('status', 1)->first();

            if($schoolyear){
                $settings = App\EvaluationSetting::where('schoolyear_id', $schoolyear->id)->first();
            }
    
            if($settings->secondsem_enabled == 1) {
                $semester = 2;
            }else{
                $semester = 1;
            }
            $evaluated = App\EvaluationValue::where('user_id', Auth::user()->id)->where('schoolyear_id', $schoolyear->id)->where('semester', $semester)->get();
            $evaluated_faculty = [];
          
            if($evaluated){
              foreach($evaluated as $evaluate){
                $evaluated_faculty[] = $evaluate->faculty_id;
              }
            }
            
          ?>
						<form action="{{route('selectedfacultytoevaluate')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Faculty</label>
										<select class="form-control  js-example-basic-single" name="faculty_id" aria-required="true" aria-invalid="false" data-validation="required">
											<option value="">Select Faculty</option>
                      
                      @isset($faculties)
												@foreach($faculties as $faculty)
                          @if(in_array($faculty->id, $evaluated_faculty))
                            <option value="{{$faculty->id}}" disabled="disabled">{{$faculty->lname}}, {{$faculty->fname}} {{$faculty->mname}}</option>
                          @else
                            <option value="{{$faculty->id}}">{{$faculty->lname}}, {{$faculty->fname}} {{$faculty->mname}}</option>
                          @endif
												@endforeach
											@endisset
											
		                </select>
									</div>
								</div>
							</div>

							<input id="submit_btn" class="btn btn-sm btn-primary" type="submit" name="submit" value="Proceed">
							
							
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
      $('.js-example-basic-single').select2();
          @if(  Session::has('EvaluateFinish') )
            swal(
              'Saved',
              'Your evaluation has been saved successfully.',
              'success'
            )
          @endif
        });
  </script>
@endsection