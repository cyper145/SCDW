<?php

class AutocompletadoController extends \BaseController
{


    //=============================PARA EL ADMINISTRADOR==================================
    //funcion para que se autoconplete los datos de los docentes
    function autocompletedocente()
    {
        $term = Str::lower(Input::get('term'));
        //convertimos los datos a un arreglo puro
        $data = DB::table('tdocente')->select('coddocente', 'nombre', 'apellidopaterno', 'apellidomaterno')->get();
        $arregloDocente = [];
        foreach ($data as $docente) {
            $codigo = $docente->coddocente;
            $nombre = $docente->nombre;
            $ap = $docente->apellidopaterno;
            $am = $docente->apellidomaterno;
            $aux = [$codigo => $codigo . ' ' . $nombre . ' ' . $ap . ' ' . $am];
            $arregloDocente = array_merge($aux, $arregloDocente);
        }
        //filtramos
        $result = [];
        foreach ($arregloDocente as $valor) {
            if (strpos(Str::lower($valor), $term) !== false) {
                $result[] = ['value' => $valor];
            }
        }
        return Response::json($result);
    }
}