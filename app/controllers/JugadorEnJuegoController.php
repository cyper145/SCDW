<?php

class JugadorEnJuegoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jugador_juego = JugadorEnJuego::paginate(2);
        return View::make('user_com_organizing.jugador_juego.index',compact('jugador_juego'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('user_com_organizing.jugador_juego.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$jugador = new JugadorEnJuego();
		$objJugador=Input::all();
		if(!isset($objJugador['escapitan'])){
        	$objJugador['escapitan']= "si";
        }
        else
        {
            $objJugador['escapitan']= "no";
        }
        $jugador->create($objJugador);

        Session::flash('message','Jugador en juego agregado correctamente');
        return Redirect::to('/jugador_juego');
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
	public function edit($id)
	{
		 $jugador_juego = JugadorEnJuego::find($id);
        return View::make('user_com_organizing.jugador_juego.edit',array('jugador_juego'=>$jugador_juego));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		/*
		$rules= array
                (
					'capacidad' => 'required|numeric|min:15',
					'estado' => 'required',
					'capacidad' => 'required',
                );
        $validator=Validator::make(Input::All(),$rules);
        */

        $jugador_juego = JugadorEnJuego::findOrFail($id);

        /* if ($validator->passes()) { */
        $dataObj=Input::all();
        if(!isset($dataObj['escapitan'])){
        	$dataObj['escapitan']=0;
        }

        //obtenemos el campo file definido en el formulario
        /* $foto = $request->file('Foto'); */
        $jugador_juego->update($dataObj);
        
        /*}
        else
        {*/
        	Session::flash('message','Jugador en juego actualizado correctamente');
        	return Redirect::to('/jugador_juego');
    	/* } */
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$jugador_juego = JugadorEnJuego::findOrFail($id);
    	$jugador_juego->delete();
    	Session::flash('message', 'Jugador en juego elimnado correctamente');
    	//return redirect()->route('tasks.index');
    	return Redirect::to('/jugador_juego');
	}


}
