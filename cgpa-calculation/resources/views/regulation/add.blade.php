@extends('layouts.app')
@section('content')
<form method="post" action="{{url('/addregulation')}}">		 
	@csrf
	<div class="col-md-3 mb-3">
		<div id="subject1">
		<input type="text" id="regulation" name="regulation" class="form-control" placeholder="regulation">
		</div>
		<input type="submit" class="btn btn-success btn-sm" name="submit" value="Add" >
	</div>
</form>
@endsection