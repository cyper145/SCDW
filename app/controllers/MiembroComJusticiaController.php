<?php

class MiembroComJusticiaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todomiembros = MiembroComJusticia::paginate(2);
        return View::make('user_administrator.miembrocomjusticia.listar')->with('todomiembros',$todomiembros);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
 /*public function create()
	{
		//$todocampeonato = Campeonato::all();
        return View::make('campeonato.insertar');
	}*/

	public function insertarmiembro()
	{
        $camptodo = Campeonato::all();
        return View::make('user_administrator.miembrocomjusticia.insertar')->with('camptodo',$camptodo);;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //verificamos que el docente exista
        $iddocente =Input::get('docente');
        if(!$docente = MiembroComJusticia::where('dni', '=', $iddocente)->first())
        {
            $miembro = new MiembroComJusticia;
            $miembro->dni=$iddocente;
            $miembro->rol = Input::get('rol');
            $miembro->nombre=Input::get('nombre');
            $miembro->apellidoP=Input::get('apellidopaterno');
            $miembro->apellidoM=Input::get('apellidomaterno');
            $miembro->codCampeonato = Input::get('campeonato');
            $miembro->save();
            return Redirect::to('miembrocomjusticia/listar');
        }
        else
        {
            $error = ['wilson'=>'Este miembro ya tiene cargo '];
            return Redirect::back()->withInput()->withErrors($error);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editarmiembro($id)
	{
        $consultatabla = MiembroComJusticia::find($id);
        $camptodo = Campeonato::all();
		return View::make('user_administrator.miembrocomjusticia.editar')
            ->with('consultatabla',$consultatabla)
            ->with('camptodo',$camptodo);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        //verificamos que el docente exista
        $iddocente = Input::get('docente');
        if($docente = MiembroComJusticia::where('dni', '=', $iddocente)->first())
        {
            $datosformulario = Input::all();
            DB::table('tmiembrojusticia')
                ->where('dni', $id)
                ->update(array(
                    'rol' => $datosformulario['rol'],
                    'nombre' => $datosformulario['nombre'],
                    'apellidoP' => $datosformulario['apellidopaterno'],
                    'apellidoM' => $datosformulario['apellidomaterno'],
                    'codCampeonato' => $datosformulario['campeonato'],
                    ));
            return Redirect::to('miembrocomjusticia/listar');
        }

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function delete($id)
	{
        DB::table('tmiembrojusticia')
            ->where('dni', $id)
            ->delete();
        return Redirect::to('miembrocomjusticia/listar');
	}

public function find()
	{
		$Docentestodo=docente::all();

        if(isset($_GET["buscar"]))
        {

        	$buscar = htmlspecialchars(Input::get("buscar"));
        	$fila = docente::select(DB::raw('*'))->where('nombres', 'like', '%'.$buscar.'%')->orwhere('apellidos', 'like', '%'.$buscar.'%')->get();
        	return View::make('docente.listar')->with('Busqueda',$fila);
		
        }
        return View::make('docente.listar')->with('Docentestodo',$Docentestodo);
	}

}
