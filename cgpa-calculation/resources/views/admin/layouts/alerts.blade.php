@if(Session::get('alert-type') == "default")
<div class="alert alert-default" role="alert">
    <strong>Default!</strong> This is a default alert—check it out!
</div>
@elseif(Session::get('alert-type') == "info")
<div class="alert alert-primary" role="alert">
    <strong>Primary!</strong> This is a primary alert—check it out!
</div>
@elseif(Session::get('alert-type') == "success")
<div class="alert alert-success" role="alert">
    <strong>Success!</strong> This is a success alert—check it out!
</div>
@elseif(Session::get('alert-type') == "danger")
<div class="alert alert-danger" role="alert">
    <strong>Danger!</strong> This is a danger alert—check it out!
</div>
@endif