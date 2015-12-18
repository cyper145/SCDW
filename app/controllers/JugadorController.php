<?php

class JugadorController extends \BaseController
{
    public function listar()
    {
        $codequipo = Session::get('user_codequipo');
        $jugadores = Jugador::where('codequipo','=',$codequipo)->get();
        return View::make('user_equipo.jugador.list')
            ->with('jugadores',$jugadores);
    }

    public function insertar_get()
    {
        return View::make('user_equipo.jugador.insert');
    }

    public function insertar_post()
    {
        $coddocente = substr(Input::get('Nombre'), 0,5);
        if($docente = Docente::where('coddocente', '=', $coddocente)->first())
        {
            $haydocenteenequipo = Jugador::where('coddocente','=',$coddocente)->where('codequipo','=',Session::get('user_codequipo'))->first();
            if($haydocenteenequipo == '')//no hay todavia este jugador
            {
                if(Input::hasFile('foto'))
                {
                    $fullnamedocente = $docente->apellidopaterno.' '.$docente->apellidomaterno.' '.$docente->nombre;
                    $file = Input::file('foto');
                    $extension = $file->getClientOriginalExtension();
                    $namefotocomplete = $fullnamedocente.'.'.$extension;
                    $file->move('storage/jugador', $namefotocomplete);

                    $newjugador = new Jugador();
                    $newjugador->foto = $namefotocomplete;
                    $newjugador->estado = 'habilitado';//el jugador se crea por defecto en habilitado
                    $newjugador->codequipo = Session::get('user_codequipo');
                    $newjugador->coddocente = $coddocente;
                    $newjugador->save();

                    Session::flash('message','Jugador agregado correctamente');
                    return Redirect::to('jugador/listar.html');
                }
                else
                {
                    $error = ['wilson'=>'No ha ingresado ninguna foto'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
            }
            else
            {
                $error = ['wilson'=>'Este jugador ya existe'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
        else
        {
            $error = ['wilson'=>'Este docente no existe'];
            return Redirect::back()->withInput()->withErrors($error);
        }
    }

    public function delete($idjugador)
    {
        $jugador = Jugador::findOrFail($idjugador);
        $jugador->delete();
        Session::flash('message', 'Jugador elimnado correctamente');
        return Redirect::to('jugador/listar.html');
    }

    public function detail($idjugador)
    {
        $jugador = Jugador::where('idjugador','=',$idjugador)->first();
        return View::make('user_equipo.jugador.detail')
            ->with('jugador',$jugador);
    }

    public function edit_get($idjugador)
    {
        $jugadoraeditar = Jugador::where('idjugador','=',$idjugador)->first();
        return View::make('user_equipo.jugador.edit')->with('jugadoraeditar',$jugadoraeditar);
    }

    public function edit_post()
    {
        $idjugador = Input::get('idjugador');
        $coddocente = substr(Input::get('Nombre'), 0,5);
        if($docente = Docente::where('coddocente', '=', $coddocente)->first())//el docente es valido
        {
            if($haydocenteenequipo = Jugador::where('idjugador','=',$idjugador)->first())
            {
                if(Input::hasFile('foto'))//hay foto
                {
                    $fullnamedocente = $docente->apellidopaterno.' '.$docente->apellidomaterno.' '.$docente->nombre;
                    $file = Input::file('foto');
                    $extension = $file->getClientOriginalExtension();
                    $namefotocomplete = $fullnamedocente.'.'.$extension;
                    if($haydocenteenequipo->coddocente == $coddocente)//no se ha cambiado el nombre del jugador
                    {
                        $file->move('storage/jugador', $namefotocomplete);
                        Jugador::where('idjugador','=',$idjugador)->update(['foto'=>$namefotocomplete]);

                        Session::flash('message','Jugador agregado correctamente');
                        return Redirect::to('jugador/listar.html');
                    }
                    else//se ha cambiado el nombre del jugador entonces se tine que validar
                    {
                        $haydocenteenequipo = Jugador::where('coddocente','=',$coddocente)->where('codequipo','=',Session::get('user_codequipo'))->first();
                        if($haydocenteenequipo == '')//jugador no existe todavia
                        {
                            $file->move('storage/jugador', $namefotocomplete);
                            Jugador::where('idjugador','=',$idjugador)->update(['foto'=>$namefotocomplete,'codequipo'=>$coddocente]);
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
                    $error = ['wilson'=>'No ha ingresado ninguna foto'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
            }
            else
            {
                $error = ['wilson'=>'No se encontro jugador en la base de datos'];
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
