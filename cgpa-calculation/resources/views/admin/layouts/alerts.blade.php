@if(Session::get('alert-type') == "default")
<div class="alert alert-default" role="alert">
    <strong>{{ Session::get('message') }}</strong>
</div>
@elseif(Session::get('alert-type') == "info")
<div class="alert alert-primary" role="alert">
   <strong>{{ Session::get('message') }}</strong>
</div>
@elseif(Session::get('alert-type') == "success")
<div class="alert alert-success" role="alert">
    <strong>{{ Session::get('message') }}</strong>
</div>
@elseif(Session::get('alert-type') == "danger")
<div class="alert alert-danger" role="alert">
    <strong>{{ Session::get('message') }}</strong>
</div>
@endif