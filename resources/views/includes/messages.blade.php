@if (session('deleted'))
<div class="alert alert-info">
    {{session('deleted')}}
</div>
@endif
@if (session('created'))
<div class="alert alert-success">
    {{session('created')}}
</div>
@endif