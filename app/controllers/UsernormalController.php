<?php

class UsernormalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            //AQUI VA TODOS LOS ELEMENTOS QUE APARECERAN EN LA PANTALLA 
            //DE INICIO SIN INICIAR SESION DE NINGUN TIPO :)
            
            $tablaposiones = 'Wilson. aqui va el contenido de inico para todos los usuarios. '
                    . 'Ejemplo. la tabla de posiones falta mostrar :) este es un parametro desde el '
                    . 'controlador :)';
            return View::make('user_normal.index')->with('tablaposiones', $tablaposiones);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

    public function tablaposiciones()
    {

        $tabla= DB::select('call TABLAPOSICIONES');
        $ultimafecha = Campeonato::max('fechacreacion');
        $campeonatoactual = Campeonato::where('fechacreacion','=',$ultimafecha)->first();
        $idcomision = $campeonatoactual->idcom_orgdor;
        $idcamponato = $campeonatoactual->codcampeonato;
        $estadocampeonato = $campeonatoactual->estado;
        //echo $campeonatoactual->idcom_orgdor;
        //print_r($campeonatoactual->nombre);
        return View::make('user_normal.tablaposicion')->with('campeonatoactual',$campeonatoactual)
            ->with('tabla',$tabla);
    }

}
