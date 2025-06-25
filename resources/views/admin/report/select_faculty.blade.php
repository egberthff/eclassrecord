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
		<div class="row  justify-content-center">
			<div class="col-md-8" style="padding-top: 20px;">
				<div class="card">
					<div class="card-header" style="background-color: #330066;color: white;">
						Select Faculty to Generate Report
					</div>
					<div class="card-body">
            
            <?php
                $schoolyear = App\Schoolyear::where('status', 1)->first();
                if($id != 1 && $id != 2) {
                    $semester = 1;
                }else{
                    $semester = $id;
                }

                $evaluated = App\EvaluationValue::where('schoolyear_id', $schoolyear->id)->where('semester', $semester)->get();
                $evaluated_faculty = [];
            
                if($evaluated){
                    foreach($evaluated as $evaluate){
                        $evaluated_faculty[] = $evaluate->faculty_id;
                    }
                }

                $evaluatedfaculties = App\Faculty::whereIn('id', $evaluated_faculty)->get();
                $faculties = App\Faculty::where('status', '1')->get();
                
            ?>
						<form action="{{route('evaluation_report')}}" target="_blank" method="POST" enctype="multipart/form-data" autocomplete="off">
							@csrf
							<div class="row">
                <div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Semester</label>
                    <input type="text" name="semester" class="form-control" value="{{$semester}}" readonly>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">Faculty</label>
										<select class="form-control  js-example-basic-single" name="faculty_id" aria-required="true" aria-invalid="false" data-validation="required">
											<option value="">Select Faculty</option>
                      
                      @isset($evaluatedfaculties)
												@foreach($evaluatedfaculties as $faculty)
                        <option value="{{$faculty->id}}">{{$faculty->lname}}, {{$faculty->fname}} {{$faculty->mname}}</option>
												@endforeach
											@endisset
											
		                  </select>
									</div>
								</div>

                <div class="col-md-4">
									<div class="form-group">
										<label class="control-label" style="color: black !important;">College</label>
										<select class="form-control" name="college_id" aria-required="true" aria-invalid="false" data-validation="required">
                      <?php $colleges = App\College::where('status', 1)->get(); ?>
                      @isset($colleges)
                        @foreach($colleges as $college)
                          <option value="{{$college->id}}">{{$college->name}}</option>
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
    <div class="row">
      <div class="table-responsive m-b-40">
        <table id="table" class="table table-borderless table-data3" style="width: 100%;">
          <thead style="background-color: #330066;">
              <tr>
                  <th width="10%" style="font-size: 12px; color: white;">ID Number</th>
                  <th width="30%" style="font-size: 12px; color: white;">Name</th>
                  <th width="20%" style="font-size: 12px; color: white;">Rank</th>
                  <th width="10%" style="font-size: 12px; color: white;">Evaluated</th>
                  <th width="30%" style="font-size: 12px; color: white;text-align: left;">Percentage</th>
              </tr>
          </thead>
          <tbody>
            @isset($faculties)
              @foreach($faculties as $element)
                <?php 
                  $results = Illuminate\Support\Facades\DB::table('course_coordinators')
                            ->select('course_id', 'yearlevel','faculty_id', DB::raw('COUNT(*) as count'))
                            ->distinct()  
                            ->where('schoolyear_id', $schoolyear->id)
                            ->where('semester', $semester)
                            ->where('faculty_id', $element->id)
                            ->groupBy('course_id', 'yearlevel','faculty_id') 
                            ->get();

                  $tot_studs = 0;
                  $percentage = 0;
                  if($results->count() > 0){
                    foreach($results as $res){
                      $tot_ = App\Student::where('course_id', $res->course_id)->where('yearlevel', $res->yearlevel)->where('status', 'REGULAR')->count();

                      $tot_studs = $tot_studs + $tot_;
                    }
                  }

                  $no_evaluated_ = App\EvaluationValue::where('schoolyear_id', $schoolyear->id)->where('semester', $semester)->where('faculty_id', $element->id)->where('user_id', '<>', 1)->count();

                  if($no_evaluated_ > 0){
                    $percentage = ($no_evaluated_ / $tot_studs) * 100;
                  }

                  
                ?>
                <tr class="tr-shadow" style="font-size: 12px; padding: 5px;">
                  <td>{{$element->id_no}}</td>
                  <td>{{$element->lname}}, {{$element->fname}} @if($element->mname){{substr($element->mname, 0, 1)}}.@endif</td>
                  <td>{{$element->rank}}</td>
                  <td>{{$no_evaluated_}} of {{$tot_studs}}</td>
                  <td>
                    <div class="progress mb-2">
											<div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
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