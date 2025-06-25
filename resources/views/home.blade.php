@extends('layouts.admin')
@section('home')
active
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" >
        <div class="col-md-4"></div>
        <div class="col-md-4 animation-container" style="margin: 0px;padding: 0px;">
          <img class="d-block w-20" width="90%" src="{{url('/background1.png')}}" style="margin-top: 130px;">
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection