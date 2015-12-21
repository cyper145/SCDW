<?php

class FechasController extends \BaseController 
{    
    
    function obtener1($vs)
    {
        $bandera=false;
        $i=0;
        while(!$bandera)
        {
            $p=substr($vs,$i,1);
            if($p=="-"){
                $bandera=true;
                $p=substr($vs,0,$i);
            }

            $i++;

        }
        return trim($p);

    }
    function obtener2($vs)
    {
        //User::where('votos', '>', 100)->count();
        $bandera=false;
        $i=strlen($vs)-1;
        $k=0;
        $nro=strlen($vs);
        while(!$bandera)
        {
            $p=substr($vs,$i,1);
            if($p=="-"){
                $bandera=true;
                $p=substr($vs,$i+1,$k);
            }
            $k++;
            $i--;

        }
        return trim($p);
    }
    public function generrar( $nro,$idcampeonato,$idtorneo)
    {
        $base1=pow(10,$idcampeonato)*100;
        $base2=pow( 10,$idtorneo)*10;
        $nro2=$base1+$base2+$nro;
        $cod=$nro2;
        return $cod;
    }
    public function actualizarfechas($idcampeonato,$idtorneo)
    {
        $campeonato = Campeonato::where('codcampeonato','=',$idcampeonato)->first();
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        $fixture=Fixture::all();
        return View::make('user_com_organizing.fecha.actualizar')->with('fixture',$fixture)->with('torneo',$torneo)->with('campeonato',$campeonato);

    }
    public function add($idcampeonato,$idtorneo)
    {
        $input = Input::all();

        $rules = array(

            'nrofecha' => 'required',
            'fecha' => 'required',
            'horainicio' => 'required',
            'lugar' => 'required'
            );
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        else
        {
            $cadena = Input::get('nrofecha');
            $fecha = Input::get('fecha');
            $horaincio = Input::get('horainicio');
            $lugar=input::get('lugar');
            $hora=substr($horaincio,0,2);

            $min=substr($horaincio,4,2);
            $horaI=(int)$hora;
            $minI=(int)$min;

            $nrofecha=$this->obtener1($cadena);
            $cod=$this->obtener2($cadena);

            //$nropartidos = Fixture::all()->max('idfecha');
            $fixturefecha=Fixture::where('idfecha','=',$nrofecha)->get();;
            $i=1;

            foreach( $fixturefecha as $value)
            {
                $mas=0;
                $minI=$minI+30;
                if($minI>=60)
                {
                    $mas=1;
                    $minI=$minI % 60;
                }
                $horaI=$horaI+1+$mas;
                $siguiente=$horaI.":".$minI;
                $value->hora=$siguiente;
                $value->nropartido=$i;
                $value->save();
                $i++;
            }

            $category = new Fechas;
            $category->idfecha= $cod;
            $category->nrofecha = $nrofecha;
            $category->lugar = $lugar;
            $category->diafecha = $fecha;
            $category->idtorneo=$idtorneo;

            $category->save();
            return Redirect::to('fecha/edit/'.$idcampeonato.'/'.$idtorneo);
        }
    }
    
    
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
