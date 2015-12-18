@if(Session::has('message'))
<div class="alert bg-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('message') }}
</div>
@endif