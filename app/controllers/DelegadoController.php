<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14/02/2016
 * Time: 19:11
 */
class DelegadoController extends \BaseController {


    public function listar()
    {
        $codequipo = Session::get('user_codequipo');
        $jugadores = Delegado::where('codEquipo','=',$codequipo)->get();
        return View::make('user_equipo.delegado.list')
            ->with('jugadores',$jugadores);
    }
    public function insertar_get()
    {
        return View::make('user_equipo.delegado.insert');
    }

    public function insertar_post()
    {
        $coddocente = substr(Input::get('Nombre'), 0,6);
        if($docente = Docente::where('codDocente', '=', $coddocente)->first())
        {
            $haydocenteenequipo = Delegado::where('codDocente','=',$coddocente)->where('codEquipo','=',Session::get('user_codequipo'))->first();
            if($haydocenteenequipo == '')//no hay todavia este jugador
            {

                    $equipo = Equipo::where('codEquipo','=',Session::get('user_codequipo'))->first();
                    $codcampeonato = $equipo->codCampeonato;
                    $jugadorenequipo = DB::table('tdelegando')
                        ->join('tequipo','tequipo.codEquipo','=','tdelegando.codEquipo')
                        ->where('tequipo.codCampeonato','=',$codcampeonato)
                        ->where('tdelegando.codDocente','=',$coddocente)
                        ->First();
                    if($jugadorenequipo == '')
                    {


                        $newjugador = new Delegado();
                        $newjugador->dni=Input::get('DNI');
                        $newjugador->rol=Input::get('rol');
                        $newjugador->estado = 'habilitado';//el jugador se crea por defecto en habilitado
                        $newjugador->codEquipo = Session::get('user_codequipo');
                        $newjugador->codDocente = $coddocente;
                        $newjugador->save();

                        Session::flash('message','delegado agregado correctamente');
                        return Redirect::to('delegado/listar.html');
                    }
                    else
                    {
                        $error = ['wilson'=>'Este delegado ya es de otro equipo por favor ingrese otro jugador'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
            }

            else
            {
                $error = ['wilson'=>'Este delegado ya existe'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
        else
        {
            $error = ['wilson'=>'Este docente no existe'];
            return Redirect::back()->withInput()->withErrors($error);
        }
    }

    public function edit_get($idjugador)
    {
        $jugadoraeditar = Delegado::where('dni','=',$idjugador)->first();
        return View::make('user_equipo.delegado.edit')->with('jugadoraeditar',$jugadoraeditar);
    }

    public function edit_post()
    {
        $idjugador = Input::get('idjugador');
        $coddocente = substr(Input::get('Nombre'), 0,6);
        if($docente = Docente::where('codDocente', '=', $coddocente)->first())//el docente es valido
        {
            if($haydocenteenequipo = Delegado::where('dni','=',$idjugador)->first())
            {


                    if($haydocenteenequipo->codDocente == $coddocente)//no se ha cambiado el nombre del jugador
                    {

                        $edad=Input::get('rol');
                        Delegado::where('dni','=',$idjugador)->update(['rol'=>$edad
                        ]);

                        Session::flash('message','delegado actualizado correctamente');
                        return Redirect::to('delegado/listar.html');
                    }
                    else//se ha cambiado el nombre del jugador entonces se tine que validar
                    {
                        $haydocenteenequipo = Jugador::where('codDocente','=',$coddocente)->where('codEquipo','=',Session::get('user_codequipo'))->first();
                        if($haydocenteenequipo == '')//jugador no existe todavia
                        {
                            $file->move('storage/jugador', $namefotocomplete);
                            Jugador::where('dni','=',$idjugador)->update(['foto'=>$namefotocomplete,'codDocente'=>$coddocente]);
                        }
                        else//jugador ya existe
                        {
                            $error = ['wilson'=>'Este jugador ya es parte del equipo. por favor ingrese otro jugador'];
                            return Redirect::back()->withInput()->withErrors($error);
                        }
                    }

            }
            else
            {
                $error = ['wilson'=>'No se encontro delegado en la base de datos'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
        else
        {
            $error = ['wilson'=>'Este docente no existe'];
            return Redirect::back()->withInput()->withErrors($error);
        }
    }





}