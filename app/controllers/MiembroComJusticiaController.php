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
        $iddocente = substr(Input::get('docente'), 0,5);
        if($docente = Docente::where('coddocente', '=', $iddocente)->first())
        {
            $miembro = new MiembroComJusticia;
            $miembro->rol = Input::get('rol');
            $miembro->codcampeonato = Input::get('campeonato');
            $miembro->coddocente = $iddocente;
            $miembro->save();
            return Redirect::to('miembrocomjusticia/listar');
        }
        else
        {
            $error = ['wilson'=>'Este docente no existe'];
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
        $iddocente = substr(Input::get('docente'), 0,5);
        if($docente = Docente::where('coddocente', '=', $iddocente)->first())
        {
            $datosformulario = Input::all();
            DB::table('tmiembrocomjusticia')
                ->where('id', $id)
                ->update(array(
                    'rol' => $datosformulario['rol'],
                    'codcampeonato' => $datosformulario['campeonato'],
                    'coddocente' => $iddocente));
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
        DB::table('tmiembrocomjusticia')
            ->where('id', $id)
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
