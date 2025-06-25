@extends('layouts.admin')
@section('head')
	<script type="text/javascript" src="{{URL::to('js/jquery-1.11.3.min.js')}}" charset="utf-8"></script>	
    <script type="text/javascript" src="{{URL::to('js/xlsx.core.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::to('js/index.js')}}"></script>
@endsection
@section('students')
active
@endsection
@section('content')
	<div class="container">
		<div class="row justify-content-left">
			<div class="col-md-6" style="padding-top: 20px;">
				<div class="card">
					<div class="card-header" style="text-align: right;">
						<a href="/Import Students Template.xlsx" target="_blank" class="btn btn-sm btn-success"> <span class="fa fa-download"></span> Download Template</a>
					</div>
					<div class="card-body">
						<form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label class="form-label">Upload a CSV or Excel file</label>
								<p style="color: red;">Note: This will override existing students with the same ID</p> <br>
								<input type="file" id="btnStudentInsertFileIMPORTACTION" name="file_upload" class="form-control" accept=".csv,.xlsx" required="">
								<input type="hidden" id="StudentInsertFileIMPORTACTIONGO" name="students" value="">
							</div>
              				<br>
							
							<input class="btn btn-sm btn-primary" type="submit" name="submit" value="Upload Students">
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('#btnStudentInsertFileIMPORTACTION').on('change', function() {onbtnStudentInsertFileIMPORTACTION();});
	</script>
@endsection