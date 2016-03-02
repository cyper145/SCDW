<?php

class CuentasController extends \BaseController {
    
    
    //=============================PARA EL ADMINISTRADOR==================================        
    //funcion para que se autoconplete los datos de los docentes
    function autocompletedocente()
    {
        $term = Str::lower(Input::get('term'));
        //convertimos los datos a un arreglo puro
        $data = DB::table('tdocente')->select('codDocente','nombre','apellidoP','apellidoM')->get();
        $arregloDocente = [];
        foreach($data as $docente)
        {
            $codigo = $docente->codDocente;
            $nombre = $docente->nombre;
            $ap = $docente->apellidoP;
            $am = $docente->apellidoM;
            $aux = [$codigo=>$codigo.' '.$nombre.' '.$ap.' '.$am];
            $arregloDocente = array_merge($aux,$arregloDocente);
        }
        //filtramos
        $result = [];
        foreach($arregloDocente as $valor)
        {
            if(strpos(Str::lower($valor),$term) !== false)
            {
                $result[] = ['value' => $valor];
            }
        }
        return Response::json($result);
    }
    //abre el formulario para crear un nuevo administrador
    public function  crear_get(){
        return View::make('user_administrator.admin.crear');
    }
    //escribe en la base datos el administrador ingresado
    public function crear_post(){
        $input = Input::all();
        $regla = [  'usuario'=>'required',
                    'password'=>'required',
                    'password2'=>'required',
                    'docente'=>'required',
                    'estado'=>'required'
                 ];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        }
        else
        {
            //verificamos que el docente exista
            $iddocente = substr(Input::get('docente'), 0,6);
            if($docente = Docente::where('codDocente', '=', $iddocente)->first())
            {
                //verificamos si este docente no tiene una cuenta todavia
                if($administrador = Administrador::where('codDocente', '=', $iddocente)->first())
                {
                    $error = ['wilson'=>'Este docente ya tiene una cuenta de administrador'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
                else
                {
                    //vefificamos password y confirmar password
                    $password1 = Input::get('password');
                    $password2 = Input::get('password2');
                    if($password1 == $password2)
                    {
                        $username = Input::get('usuario');
                        $password = Hash::make(Input::get('password'));
                        $tipo = 'administrador';
                        $estado = Input::get('estado');
                        
                        $idusuario = DB::table('tusuarios')->insertGetId([
                            'username'=>$username,
                            'password'=>$password,
                            'tipo'=>$tipo,
                            'estado'=>$estado
                            ]);

                        $price = DB::table('tadministrador')->max('idAdministrador');
                        $price++;
                        $admin = new Administrador;
                        $admin->idAdministrador=$price;
                        $admin -> codDocente = $iddocente;
                        $admin -> idUsuario = $idusuario;
                        $admin -> save();
                        return Redirect::to('usuario/listar');
                    }
                    else
                    {
                        
                        $error = ['wilson'=>'Las contraseñas no coinsiden'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                }
            }
            else
            {
                $error = ['wilson'=>'Docente no válido'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
    }        
    //listar toda las cuentas de administrador
    public function listar()
    {
        $useralladmin = DB::table('tusuarios')          
                ->join('tadministrador', 'tusuarios.idusuario', '=', 'tadministrador.idusuario')
                ->join('tdocente','tadministrador.coddocente','=','tdocente.coddocente')
                ->groupBy('tusuarios.idusuario')->paginate(3);

        return View::make('user_administrator.admin.listar')->with('useralladmin',$useralladmin);
    }
    public function editaradmin($idusuario)
    {
        $usuarioaeditar = User::where('idUsuario', '=', $idusuario)->first();
        $administrador = Administrador::where('idUsuario','=',$idusuario)->first();
        $coddocente = $administrador->codDocente;
        $docente = Docente::where('codDocente','=',$coddocente)->first();
        return View::make('user_administrator.admin.editar')
                ->with('usuarioaeditar',$usuarioaeditar)
                ->with('docente',$docente)
                ->with('administrador',$administrador);
    }
    
    public function updateadmin($idusuario)
    { 
        $respuesta = Administrador::editar($idusuario,Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('usuarioeditar'.$idusuario)->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuario/listar')->withErrors($respuesta['mensaje']);
    }
    
    public function eliminaradmin($idusuario)
    {
       // los usuarios no se pueden eliminar de la base de datos solo se pueden poner en estado de bloqueado
        //primero se elimina el administrador luego el usuario
        $respuesta = Administrador::eliminar($idusuario);
        if($respuesta['error']==true)
        {
            return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuario/listar')->withErrors($respuesta['mensaje']);
    }
    //=============================PARA LA COMISION ORGANIZADORA==================================
    //abre el formulario para crear una nueva comision organizadora
    public function crearco_get()
    {
        return View::make('user_administrator.Corganizador.crear');
    }
    //escribe en la base de datos el nuevo usuario de la comision organizadora
    public function crearcodcomision($id)
    {
        $users = DB::table('tcom_org')->count();
        $users++;
        return  "COM0".$id."0".$users;
    }
    public function crearco_post()
    {

        $input = Input::all();
        $regla = [  'usuario'=>'required',
                    'password'=>'required',
                    'password2'=>'required',
                    'Comision'=>'required',
                    'estado'=>'required'
                 ];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        }
        else
        {
            //verificamos si ya existe una comision organizadora con el mismo nombre
            $nombreco = Input::get('Comision');
            $username = Input::get('usuario');
            if(!$comision = Comision::where('nombre', '=', $nombreco)->first())
            {
                //verificamos si ya hay un usuraio con este nombre
                if($administrador = User::where('username', '=', $username)->first())
                {
                    $error = ['wilson'=>'Ya existe un usuraio con este nombre elija otro usuario'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
                else
                {
                    //vefificamos password y confirmar password
                    $password1 = Input::get('password');
                    $password2 = Input::get('password2');
                    if($password1 == $password2)
                    {
                        $username = Input::get('usuario');
                        $password = Hash::make(Input::get('password'));
                        $tipo = 'comision organizadora';
                        $estado = Input::get('estado');
                        //agregamos un nuevo usurio en la tabla tusuarios y recupramos su id                       
                        $idusuario = DB::table('tusuarios')->insertGetId(
                                array(
                                    'username'=>$username,
                                    'password'=>$password,
                                    'tipo'=>$tipo,
                                    'estado'=>$estado
                                ));
                        //ahora como son relacionales este id ingresamos tambien en la tabla comision
                        $cod=$this->crearcodcomision($idusuario);
                        $newComision = new Comision;
                        $newComision -> codCom_Org=$cod;
                        $newComision -> nombre = $nombreco;
                        $newComision -> idUsuario = $idusuario;
                        $newComision -> save();                        
                        return Redirect::to('usuariocorg/listar');
                    }
                    else
                    {
                        $error = ['wilson'=>'Las contraseñas no coinsiden'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                }
            }
            else
            {
                $error = ['wilson'=>'Ya existe una comision organizadora con este nombre'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
    }    
    //lista los usuarios de tipo comision organizador 
    public function listarcorg()
    {
        $userallcomorgdor = DB::table('tusuarios')
                ->join('tcom_org', 'tusuarios.idUsuario', '=', 'tcom_org.idUsuario')
                //->where('tipo','=','comision organizadora')
                ->groupBy('tusuarios.idUsuario')
                ->paginate(3);
        return View::make('user_administrator.Corganizador.listar')
                ->with('userallcomorgdor',$userallcomorgdor);
    }
    
    public function editarcorg($idusuario)
    {
        $usuarioaeditar = User::where('idUsuario', '=', $idusuario)->first();
        $comision = Comision::where('idUsuario','=',$idusuario)->first();
        return View::make('user_administrator.Corganizador.editar')
                ->with('usuarioaeditar',$usuarioaeditar)
                ->with('comision',$comision);
    }
    
    public function updatecorg($idusuario)
    { 
        $respuesta = Comision::editar($idusuario,Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('usuariocorg/editar/'.$idusuario)->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuariocorg/listar')->withErrors($respuesta['mensaje']);
    }
    
    public function eliminarcorg($idusuario)
    {
       // los usuarios no se pueden eliminar de la base de datos solo se pueden poner en estado de bloqueado
        //primero se elimina la cuenta de comision luego el usuario que corresponde
        $respuesta = Administrador::eliminar($idusuario);
        if($respuesta['error']==true)
        {
            return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuariocorg/listar')->withErrors($respuesta['mensaje']);
    }
    //=============================PARA EL EQUIPO==================================
    public function creareq_get()
    {
        return View::make('user_administrator.Equipo.crear');
    }

    public function crearcodequipo($id)
    {
        $users = DB::table('tequipo')->count();
        $users++;
        return  "EQU0".$id."0".$users;
    }

    public function creareq_post()
    {
        $input = Input::all();
        $regla = [  'usuario'=>'required',
                    'password'=>'required',
                    'password2'=>'required',
                    'Equipo'=>'required',
                    'estado'=>'required'
                 ];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        }
        else
        {
            //verificamos si ya existe un equipo con el mismo nombre en este campeonato (no en todo)
            $nombreequipo = Input::get('Equipo');
            $username = Input::get('usuario');
            if(!$equipo = Equipo::where('nombre', '=', $nombreequipo)->first())
            {
                //verificamos si ya hay un usuraio con este nombre
                if($usuario = User::where('username', '=', $username)->first())
                {
                    $error = ['wilson'=>'Ya existe un usuraio con este nombre elija otro usuario'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
                else
                {
                    //vefificamos password y confirmar password
                    $password1 = Input::get('password');
                    $password2 = Input::get('password2');
                    if($password1 == $password2)
                    {
                        $username = Input::get('usuario');
                        $password = Hash::make(Input::get('password'));
                        $tipo = 'equipo';
                        $estado = 'bloqueado';//este campo se debe crear como bloqueado cuando pague recien se debe activar
                        $ultimafecha = Campeonato::max('fechaCreacion');
                        $campeonatoactual = Campeonato::where('fechaCreacion','=',$ultimafecha)->first();
                        //agregamos un nuevo usurio en la tabla tusuarios y recupramos su id                       
                        $idusuario = DB::table('tusuarios')->insertGetId(
                                [
                                    'username'=>$username,
                                    'password'=>$password,
                                    'tipo'=>$tipo,
                                    'estado'=>$estado
                                ]);
                        //ahora como son relacionales este id ingresamos tambien en la tabla equipo
                        $cod=$this->crearcodequipo($idusuario);
                        $newEquipo = new Equipo;
                        $newEquipo -> codEquipo = $cod;
                        $newEquipo -> nombre = $nombreequipo;
                        $newEquipo -> logo = "";
                        $newEquipo -> coloresUniforme = "";
                        $newEquipo -> coloresAlternos = "";
                        $newEquipo -> estado = "habilitado";
                        $newEquipo -> codCampeonato = $campeonatoactual->codCampeonato;
                        $newEquipo -> idUsuario = $idusuario;
                        $newEquipo -> save();
                        return Redirect::to('usuarioequipo/listar');
                    }
                    else
                    {
                        $error = ['wilson'=>'Las contraseñas no coinsiden'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                }
            }
            else
            {
                $error = ['wilson'=>'Ya existe un equipo con este nombre'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
    }
    //lista los usuarios de tipo equipo
    public function listarequipo()
    {        
        $userallequipo = DB::table('tusuarios')
                ->join('tequipo', 'tusuarios.idUsuario', '=', 'tequipo.idUsuario')
                ->groupBy('tusuarios.idUsuario')
                ->select('tusuarios.idUsuario','tusuarios.username', 'tusuarios.tipo', 'tusuarios.estado','tequipo.nombre')
                ->paginate(6);
        return View::make('user_administrator.Equipo.listar')
                ->with('userallequipo',$userallequipo);
    }    
    public function editarequipo($idusuario)
    {        
        $usuarioaeditar = User::where('idUsuario', '=', $idusuario)->first();
        $equipo = Equipo::where('idUsuario','=',$idusuario)->first();
        return View::make('user_administrator.Equipo.editar')
                ->with('usuarioaeditar',$usuarioaeditar)
                ->with('equipo',$equipo);
    }    
    public function updateequipo($idusuario)
    { 
        $respuesta = Equipo::editar($idusuario,Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('usuarioequipo/editar/'.$idusuario)->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuarioequipo/listar')->withErrors($respuesta['mensaje']);
    }
    
    public function eliminarequipo($idusuario)
    {
       // los usuarios no se pueden eliminar de la base de datos solo se pueden poner en estado de bloqueado
        //primero eliminar equipo
        $respuesta = Administrador::eliminar($idusuario);
        if($respuesta['error']==true)
        {
            return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('usuarioequipo/listar')->withErrors($respuesta['mensaje']);
    }
}
