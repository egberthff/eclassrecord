@extends('layouts.admin')
@section('head')
	<style>
		.form-error{
			color: red !important;
		}
        .pass_show{position: relative} 

        .pass_show .ptxt { 
            position: absolute; 
            top: 50%;
            right: 25px;
            z-index: 1; 
            color: #f36c01; 
            margin-top: -10px; 
            cursor: pointer; 
            transition: .3s ease all; 
        } 

        .pass_show .ptxt:hover{color: #333333;} 
	</style>
@endsection
@section('content')
<div class="container" style="padding-top: 20px;">
    <form method="POST" action="{{route('myaccountupdate')}}" enctype="multipart/form-data" style="font-size: 12px;">
        {{csrf_field()}}
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #330066;">
                    <b style="color: white;">User Account</b>
                </div>
                <div class="card-body card-block">
                    <form action="" method="post" class="form-horizontal">

                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label class=" form-control-label">Name</span></label>
                                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" @if(Auth::user()->role_id != 0) readonly @endif class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label class=" form-control-label">Username</span></label>
                                    <input type="text" id="id_no" name="id_no" placeholder="Email" value="{{Auth::user()->email}}" readonly class="form-control" aria-required="true" aria-invalid="false" data-validation="required">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-12">
                                <div class="form-group pass_show">
                                    <label class=" form-control-label">Password</span></label>
                                    <input type="password" id="password" name="password" class="form-control" aria-required="true" aria-invalid="false" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <div class="form-group pass_show">
                                    <label class=" form-control-label">Confirm Password</span></label>
                                    <input id="password-confirm" type="password" data-validation="confirmation" data-validation-confirm="password" name="password_confirmation" class="form-control" aria-required="true" aria-invalid="false" value="">
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form> 
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
      $.validate({
        modules : 'security',
        onModulesLoaded : function() {

          $('input[name="password"]').displayPasswordStrength(optionalConfig);
          $('input[name="password_confirmation"]').displayPasswordStrength(optionalConfig);
        }
      });

    //   $(document).ready(function(){
    //         $('.pass_show').append('<span class="ptxt">Show</span>');  
    //         });
            

    //         $(document).on('click','.pass_show .ptxt', function(){ 

    //             $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

    //             $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

    //         });  
  </script>
@endsection