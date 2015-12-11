<?php

class GolController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function eliminar($id)
	{
		echo "esto es una prueba de eliminar";
		$test = Arbitro::where('coddocente','=',$id)->delete($id);
		//print_r($test);
		echo "elimiado";
		//return $this->showUsers();
		return Redirect::to('arbitros/listar');
	}
	public function index()
	{
		$todoarbitros = Arbitro::all();
        return View::make('arbitro.ver')->with('todoarbitros',$todoarbitros);
	}
	public function nuevoArbitro()
    {
        return View::make('arbitros.crear');
    }
    public function agregarArbitro()
    {
    	return View::make('arbitros.insertar');
    }
    /**
     * Crear el usuario nuevo
     */
    public function crearArbitro()
    {
        Arbitro::create(Input::all());
    // el método create nos permite crear un nuevo usuario en la base de datos, este método es proporcionado por Laravel
    // create recibe como parámetro un arreglo con datos de un modelo y los inserta automáticamente en la base de datos
    // en este caso el arreglo es la información que viene desde un formulario y la obtenemos con el metodo Input::all()

        return Redirect::to('arbitros');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios

    }
    public function editarArbitro($id)
	{
        $arbitro = Arbitro::where('coddocente', '=', $id)->get();
		return View::make('arbitros.editar')->with('arbitro',$arbitro);
	}

    /**
     * Ver usuario con id
     */
    public function verArbitro($id)
    {
    // en este método podemos observar como se recibe un parámetro llamado id
    // este es el id del usuario que se desea buscar y se debe declarar en la ruta como un parámetro

        $arbitro = Arbitro::find($id);
        // para buscar al usuario utilizamos el metido find que nos proporciona Laravel
        // este método devuelve un objete con toda la información que contiene un usuario

        return View::make('arbitros.ver', array('arbitros' => $arbitro));
    }
    public function buscar($id)
    {
    // en este método podemos observar como se recibe un parámetro llamado id
    // este es el id del usuario que se desea buscar y se debe declarar en la ruta como un parámetro

        $arbitro = Arbitro::find($id);
        // para buscar al usuario utilizamos el metido find que nos proporciona Laravel
        // este método devuelve un objete con toda la información que contiene un usuario

        return View::make('arbitros.busca', array('arbitros' => $arbitro));
    }
	public function insertarArbitro($id)
	{
        $docente = Docente::where('coddocente', '=', $id)->get();
		return View::make('arbitros.insertar')->with('arbitros',$docente);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$gol = new Gol;
		//$gol->dni = Input::get('DNI');
		$arbitro->minuto = Input::get('Minuto');
		$arbitro->observaciones = Input::get('Observaciones');
		$arbitro->idjugadorenjuego = Input::get('ID');
		$arbitro->save();
		return Redirect::to('gol/listar');
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$entra = Input::all();
		$arbitro = DB::table('tarbitros')
            ->where('coddocente', $id)
            ->update(array(
		'nombre' => $entra['Nombre'],
		'categoria' => $entra['Categoria'],
		'idarbitropartido' => $entra['ID']));
        return Redirect::to('arbitros/listar');

        $docente = DB::table('tdocente')
            ->where('coddocente', $id)
            ->update(array(
		'nombre' => $entra['Nombre'],
		'categoria' => $entra['Categoria']));

        return Redirect::to('arbitros/listar');
	}
	public function insertar()
	{
		//$todocampeonato = Campeonato::all();
      return View::make('gol.insertar');
	}
	public function asignar()
	{
		//$arbitros = Arbitro::all(); 
		$docentes = Docente::all();
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array

        //return View::make('arbitros.asigna', array('docentes' => $docentes));
        return View::make('arbitros.asigna', array('docentes' => $docentes));

        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todos los usuarios
	}
	public function mostrar()
    {
        $goles = Gol::all(); 

        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array

        return View::make('gol.lista', array('goles' => $goles));

        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todos los usuarios
    }

}
