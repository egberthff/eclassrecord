@extends('layouts.admin')
@section('head')
	<style>
		.form-error{
			color: red !important;
		}
	</style>
@endsection
@section('selectfaculty_generate')
active
@endsection
@section('content')
	<div class="container">
		<div class="row  justify-content-left">
			<div class="col-md-4" style="padding-top: 20px;">
				<div class="card">
					<div class="card-header" style="background-color: #330066;color: white;">
						Select Semester to Generate Report
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
                            
                        ?>
						
							<div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" style="color: black !important;">Semester</label>
                                        <select class="form-control" name="semester" aria-required="true" aria-invalid="false" data-validation="required" id="semester">
                                         @isset($semester)
                                            @if($semester == 2)
                                            <option value="1">1</option>
                                            <option value="2" selected>2</option>
                                            @else
                                            <option value="1" selected>1</option>
                                            @endif
                                        @endisset
                                                            
                                        </select>
									</div>
								</div>

							</div>

							<input id="submit_btn" class="btn btn-sm btn-primary" type="submit" name="submit" value="Proceed" onclick="openLink()">
							
							
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
        function openLink() {
            var sem = $('#semester').val();
            var url = '/selectfaculty_generate/'+sem;

            window.location.href = url;
        }
  </script>
@endsection