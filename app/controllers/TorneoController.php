<?php

class TorneoController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($codcampeonato)
    {
        return View::make('user_com_organizing.torneo.insert')
            ->with('codcampeonato',$codcampeonato);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $codcampeonato = Input::get('codcampeonato');
        $respuesta = Torneo::crear(Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('torneo/'.$codcampeonato)->withErrors($respuesta['mensaje']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($codcampeonato)
    {
        $torneos = Torneo::where('codcampeonato','=',$codcampeonato)->get();
        return View::make('user_com_organizing.torneo.index',compact('torneos'))
            ->with('codcampeonato',$codcampeonato);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idtorneo,$codcampeonato)
    {
        $jugador = Torneo::where('idtorneo','=',$idtorneo)->where('codcampeonato','=',$codcampeonato)->first();
        $jugador->delete();
        $respuesta['mensaje'] = 'Torneo elimnado correctamente';
        return Redirect::to('torneo/'.$codcampeonato)->withErrors($respuesta['mensaje']);
    }


    public  function detail($idtorneo,$codcampeonato)
    {
        $fechas = Fechas::where('idtorneo','=',$idtorneo)->get();
        $equipos = Equipoxtorneo::where('idtorneo','=',$idtorneo)->get();
        $fechasdeltorneo = Fechas::where('idtorneo','=',$idtorneo)->get();
        $campeonato = Campeonato::where('codcampeonato','=',$codcampeonato)->first();
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        return View::make('user_com_organizing.torneo.detail',compact('fechasdeltorneo'))
            ->with('campeonato',$campeonato)
            ->with('codcampeonato',$codcampeonato)
            ->with('equipos',$equipos)
            ->with('fechas',$fechas)
            ->with('torneo',$torneo);
    }
}
