@if (count($errors) > 0)
    <div class="alert bg-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul class="error_list">
            @foreach ($errors->all() as $error)
                <li >
                    <span class="glyphicon glyphicon glyphicon-check"></span>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif