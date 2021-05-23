@extends('layouts.app')
@section('content')
@section('js')
<script>
$(document).ready(function(){
	var c=2;
  $("#addsubject").click(function(){
    $("#subject"+(c-1)).after("<div id='subject"+c+"'><input type='text' id='name"+c+"' name='subject"+c+"'  class='form-control' placeholder='subject "+c+"'><input type='text' name='credits"+c+"' placeholder='credits'></div>");
    $('#count').val(c);
    console.log($('#count'));
    c=c+1;
  });
});
</script>
@endsection('js')
<form method="get" action="{{url('/addsubjects')}}">	
	 <div class="col-md-3 mb-3">
      <label for="validationTooltip04">Semester</label>
      <select class="custom-select" id="validationTooltip04" required name="sem">
        <option selected="" value="1-1">1-1</option>
		<option value="1-2">1-2</option>
		<option value="2-1">2-1</option>
		<option value="2-2">2-2</option>
		<option value="3-1">3-1</option>
		<option value="3-2">3-2</option>
		<option value="4-1">4-1</option>
		<option value="4-2">4-2</option>
      </select>
  </div>
  <div class="col-md-3 mb-3">
      <label for="validationTooltip04">Branch</label>
      <select class="custom-select" id="validationTooltip04" required name="branch">
        @foreach($branches as $branch)
        	<option value="{{$branch->id}}" @if($branch->id==1) selected="true" @endif>{{$branch->branch}}</option>
        @endforeach
      </select>
  </div>
  <div class="col-md-3 mb-3">
	<label for="validationTooltip04">Regulation</label>
	<select class="custom-select" id="validationTooltip04" required name="regulation">
	  @foreach($regulations as $regulation)
        <option value="{{$regulation->id}}" @if($regulation->id==1) selected="true" @endif>{{$regulation->regulation}}</option>
      @endforeach
	</select>
</div>
<div class="col-md-3 mb-3">
	<div id="subject1">
	<input type="text" id="name1" name="subject1" class="form-control" placeholder="subject 1"><input type="text" name="credits1" placeholder="credits">
	</div>
	<input type="submit" name="submit">
	<input type="text" name="count" id="count" hidden="" value=1>
</div>
</form>
	<p id="addsubject">Add Subject</p>
@endsection