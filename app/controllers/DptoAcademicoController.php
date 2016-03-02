<?php

class DptoAcademicoController extends \BaseController {

    // listar

 public function index()
    {
        $dptotodo = DptoAcademico::all();
        return View::make('user_administrator.DptoAcademico.listar')->with('dptotodo',$dptotodo);
    }

        public function insertarDptoAcademico()
    {
            return View::make('user_administrator.DptoAcademico.insertar');
    }


    public function store()
    {
        $input = Input::all();
        $regla =
            [
                'codigo'=>'required',
                'nombre'=>'required',
                'carrera'=>'required'
            ];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        } 
         else
        {
            $codigo = Input::get('codigo');
            $nombre = Input::get('nombre');
            $carrera = Input::get('carrera');

            $iddepartamento = Input::get('iddepartamento');
            if($ddptoacademico = DptoAcademico::where('nombre', '=', $nombre)->orWhere('coddptoacademico','=',$codigo)->orWhere('carrera','=',$carrera)->first())
            {
                $error = ['wilson'=>'Este departamento ya ha sido insertado'];
                return Redirect::back()->withInput()->withErrors($error);
            }
            else
            {
                $DptoAcademico = new DptoAcademico;
                $DptoAcademico->codDptoAcademico = $codigo;
                $DptoAcademico->nombre = $nombre;
                $DptoAcademico->carrera = $carrera;
                $DptoAcademico->save();
                return Redirect::to('DptoAcademico/listar');
            }
        }
    }


     public function editarDptoAcademico($id)
      {
            $consultatabla = DptoAcademico::where('codDptoAcademico', '=', $id)->get();
            return View::make('user_administrator.DptoAcademico.editar')
                    ->with('consultatabla',$consultatabla);
    }

    public  function update($id)
    {
        $recuperado = Input::all();
        DB::table('tdptoacademico')
            ->where('codDptoAcademico',$id)
            ->update(array(
                    'codDptoAcademico'=> $id,
                    'carrera'=> $recuperado['carrera'],
                    'nombre'=> $recuperado['nombredpto'],)
            );
        return Redirect::to('DptoAcademico/listar');
    }
/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        if($ddocent = Docente::where('codDptoAcademico', '=', $id)->first())
        {
            $error = ['wilson'=>'ERROR! El docente ' .$ddocent['nombre'].' con codigo '.$ddocent['codDocente']. ' pertenece al departamento '. $id];
            return Redirect::back()->withInput()->withErrors($error);
        }
        DptoAcademico::where('codDptoAcademico','=',$id)->delete($id);
        return Redirect::to('DptoAcademico/listar');
    }
}