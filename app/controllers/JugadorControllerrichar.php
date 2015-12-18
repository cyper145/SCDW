<?php

class JugadorControllerrichar extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $codequipo = Session::get('user_codequipo');
        $jugador = Jugador::where('codequipo','=',$codequipo)->paginate(2);
        return View::make('user_com_organizing.jugador.index',compact('jugador'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('user_com_organizing.jugador.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$jugador = new Jugador();
		$objJugador=Input::all();
		if(!isset($objJugador['foto']) && $objJugador['foto']==''){
            $objJugador['foto']='sin_foto';
		}else{
			$ext = Input::file('foto')->getClientOriginalExtension();
      		$nombre = 'logo_eq_'.rand(11111,99999).'.'.$ext;
			Input::file('foto')->move('storage/jugador', $nombre);
            $objJugador['foto']=$nombre;
		}
        $jugador->create($objJugador);

        Session::flash('message','Jugador agregado correctamente');
        return Redirect::to('/jugador');
        print_r(Input::all());
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
        $jugador = Jugador::find($id);
        return View::make('user_com_organizing.jugador.edit',array('jugador'=>$jugador));
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

        $jugador = Jugador::findOrFail($id);

        /* if ($validator->passes()) { */
        $dataObj=Input::all();
        if(!isset($dataObj['foto']) && $dataObj['foto']==''){
			$dataObj['foto']='sin_foto';
		}else{
			$ext = Input::file('foto')->getClientOriginalExtension();
      		$nombre = 'logo_eq_'.rand(11111,99999).'.'.$ext;
			Input::file('foto')->move('storage/jugador', $nombre);
			$dataObj['foto']=$nombre;
		}

        //obtenemos el campo file definido en el formulario
        /* $foto = $request->file('Foto'); */
        $jugador->update($dataObj);
        
        /*}
        else
        {*/
        	Session::flash('message','Jugador actualizado correctamente');
        	return Redirect::to('/jugador');
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
		$jugador = Jugador::findOrFail($id);
    	$jugador->delete();
    	Session::flash('message', 'Jugador elimnado correctamente');
    	//return redirect()->route('tasks.index');
    	return Redirect::to('/jugador');
	}


}
