<?php

class FechasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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

    public  function detail($idfecha,$codcampeonato,$idtorneo)
    {
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        $fecha = Fechas::where('idfecha','=',$idfecha)->first();
        $fixture = Fixture::where('idfecha','=',$idfecha)->get();
        return View::make('user_com_organizing.fecha.detail',compact('fecha'))
            ->with('fixture',$fixture)
            ->with('torneo',$torneo)
            ->with('codcampeonato',$codcampeonato);
    }
}
