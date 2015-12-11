
<li class="dropdown">
    <a class="dropdown-toggle btn-lg label-success" data-toggle="dropdown" href="#">
        <span>{{Session::get('user_type')}}</span>
        <i class="glyphicon glyphicon-user"></i>
        <span>{{Session::get('user_name')}}</span>
    </a>
    <ul class="dropdown-menu dropdown-alerts">
        @if(!Session::has('user_id'))
            <li><a href="{{URL::to('/login')}}">
                            <div>
                                    <em class="glyphicon glyphicon-log-in"></em> Iniciar sesión
                            </div>
                    </a>
            </li>
        @else
            <li>
                    <a href="{{URL::to('/logout')}}">
                            <div>
                                    <em class="glyphicon glyphicon-log-out"></em> Cerrar sesión
                            </div>
                    </a>
            </li>
        @endif
    </ul>
</li>