@if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <ul>
        <li>{{ Session::get('success') }}</li>
    </ul>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <ul>
        <li>{!! Session::get('error') !!}</li>
    </ul>
</div>
@endif