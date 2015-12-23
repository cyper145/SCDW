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

    function nroequipos($idtorneo)
    {
        //User::where('votos', '>', 100)->count();
        //$listaE=DB::Select("CALL listaequipo(?)",array($idtorneo));
        $listaE=DB::select('CALL listaequipo(?)', array($idtorneo));
        $nro=count($listaE);
        //$nro=Equipo::where('estado', '=', 'habilitado')->count();


        return $nro;

    }
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
        return $p;

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
        return $p;
    }
    function reordenar($players)
    {
        //$players = array('A','B','C','g','e',null);
        $n = count($players);
        $m = $n - 1;
        $k = 0;

        $temp = $players[$n - 1];
        $primero = $players[0];
        $arr = array();
        $arr[] = $primero;
        $arr[] = $temp;
        for ($i = 1; $i < $n - 1; $i++) {
            $arr[] = $players[$i];
            # code...
        }
    }
    function determinar($array)
    {

        $nroplayer=count($array);
        $n=count($array);
        $parejas=array();
        $players=$array;
        $w=0;
        $n=count($players);
        $m=$n-1;
        $k=0;
        $temp=$players[$n-1];
        $primero=$players[0];
        $arr=array();
        $arr[]=$primero;
        $arr[]=$temp;
        for ($i=1; $i <$n-1 ; $i++) {
            $arr[]=$players[$i];

        }

        for ($i=0; $i <$n-1 ; $i++) {
            $m=$n-1;
            $k=0;
            while(($k<$n/2) && ($m>=$n/2))
            {
                $le=(String)$arr[$k];
                $lo=(String)$arr[$m];
                $parejas[$w]=$le."-".$lo;

                $k++;
                $m--;
                $w++;
                if($k==$n/2)
                    break;

            }
            $temp=$arr[$n-1];
            $primero=$arr[0];



            for ($j=1; $j<$n-1 ; $j++) {

                $arr[$n-1+(1-$j)]=$arr[$n-1-$j];

            }
            $arr[0]=$primero;
            $arr[1]=$temp;

        }



        $i=0;

        for($a =0;$a<$nroplayer-1;$a++){
            for($b =0; $b<$nroplayer/2;$b++){
                $MatrizAB[$a][$b]=$parejas[$i++];
            }
        }

        return  $MatrizAB;
    }
    function coordinar($idtorneo)
    {
        $todopartido=Equipo::where('estado', '=', 'habilitado')->get();
        //$todopartido=Equipoxtorne::where('estado', '=', 'habilitado')->get();
        $nro=$this->nroequipos($idtorneo);
        $nro1=0;
        echo $nro."locos";
        //int mt_rand ( 1 , $nro)
        $arra1=array();
        $arraw=array();
        $arra=array();
        $nro2=0;
        $ff=$nro;
        $ideal=array();
        for ($k=0; $k <$ff ; $k++) {
            $ideal[$k]=$k+1;
        }
        for ($m=0; $m < $ff; $m++) {
            $nro2=rand (1,$nro);
            $arraw[$m]=$nro2;
        }
        $dd=$ff;
        for ($i=0; $i<$ff ; $i++) {
            $arraw[$dd++]=$ideal[$i];
        }
        $arraw=array_unique($arraw);
        //sort($arraw);
        $i=0;
        foreach ($arraw as $value) {
            # code...

            $nada1 =new nada();
            $nada1->nro=$value;
            $arra1[$i++]=$nada1;
        }

        $j=0;
        $nada2=new nada();

        foreach ($todopartido as $value) {

            $cod=$value->codequipo;
            echo $j;

            $nada2=$arra1[$j];
            $nada2->cod=$cod;

            $j++;
            if($j==$ff)
            {
                break;
            }
        }


        return $arra1;
        //return $ideal;
    }
    function generarcodigo()
    {
    }
    function generar($n)
    {
        $generado=array();
        for ($i=0; $i <$n ; $i++) {
            $nro=$i+1;
            $generado[$i]=(String)$nro;
        }
        return $generado;

    }
    function obtenercodigo($arr,$nro1)
    {
        $nro=count($arr);
        $cod="";
        for ($i=0; $i <$nro ; $i++) {
            if($arr[$i]->nro==$nro1)
            {
                $cod= $arr[$i]->cod;
                break;
            }

        }
        return $cod;

    }
    function programacion($n)
    {
        $fixture=array();
        $generardo=array();
        if($n % 2== 0)
            // n par
        {
            $generardo=$this->generar($n);


            $fixture=$this->determinar($generardo);

        }
        else
        {
            $generardo=$this->generar($n);
            $generardo[$n]="";
            $fixture=$this->determinar($generardo);

        }
        return $fixture;

    }
    function establecer($idtorneo)
    {
        $nro=$this->nroequipos($idtorneo);
        $fixture=$this->programacion($nro);
        $arr=$this->coordinar($idtorneo);
        $codigo=1;//generar ultimo
        $p=0;
        $s=0;
        if($nro % 2!=0)
            $nro=$nro+1;
        $k=0;
        for($i =0;$i<$nro-1;$i++){

            for($j =0; $j<$nro/2;$j++){
                $vs=$fixture[$i][$j];
                $p=$this->obtener1($vs);
                $s=$this->obtener2($vs);
                $rueda = new Fixtureaux;

                $rueda->idfecha = $i+1;

                $uno=$rueda->equipo2 =$this->obtenercodigo($arr,$s);
                $dos=$rueda->equipo1 =$this->obtenercodigo($arr,$p);
                //$rueda->equipo2 =$this->obtenercodigo($arr,$s);
                //$rueda->partido=$this->generar();
                $rueda->nropartido=$codigo++;// generar
                $rueda->idtorneo = $idtorneo;
                $rueda->save();
                $k++;

            }
        }

    }
    function fixture($idcampeonato,$idtorneo)
    {
        $this->establecer($idtorneo);
        $fixtureaux=Fixtureaux::all();
        foreach($fixtureaux as $val ) {
            if (($val->equipo1) && ($val->equipo2)) {
                $id=$val->id;
                $equipo1=$val->equipo1;
                $equipo2=$val->equipo2;
                $nropartido=$val->nropartido;
                $fecha=$val->idfecha;
                $hora=$val->hora;
                $torneo = $val->idtorneo;
                $elemento=Fixtureaux::find($id);
                $elemento->delete();
                $nuevo=new Fixture();
                $nuevo->idfixture=$id;
                $nuevo->equipo1=$equipo1;
                $nuevo->equipo2=$equipo2;
                $nuevo->nropartido=$nropartido;
                $nuevo->idfecha=$fecha;
                $nuevo->hora=$hora;
                $nuevo->idtorneo=$torneo;
                $nuevo->save();
            }
        }
        return Redirect::to('torneo/'.$idtorneo.'/'.$idcampeonato.'/detail.html');
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
        $tabla= DB::select('call TABLAPOSICIONES');
        $fixture=Fixture::where('idtorneo','=',$idtorneo);
        $fechas = Fechas::where('idtorneo','=',$idtorneo)->get();
        $equipos = Equipoxtorneo::where('idtorneo','=',$idtorneo)->get();
        $fechasdeltorneo = Fechas::where('idtorneo','=',$idtorneo)->get();
        $campeonato = Campeonato::where('codcampeonato','=',$codcampeonato)->first();
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        $nroequipos=$this->nroequipos($idtorneo);
        return View::make('user_com_organizing.torneo.detail',compact('fechasdeltorneo'))
            ->with('campeonato',$campeonato)
            ->with('codcampeonato',$codcampeonato)
            ->with('equipos',$equipos)
            ->with('fechas',$fechas)
            ->with('torneo',$torneo)
            ->with('fixture',$fixture)
            ->with('tabla',$tabla)
            ->with('nroequipos',$nroequipos);
    }
    public function reportes($idcampeonato,$idtorneo)
    {
        //$pdf=new PDF('P', 'mm', '200, 300');
        //$pdf=new FPDF('L','mm','A4');
        $fpdf = new PDF();
        $tabla= DB::select('call TABLAPOSICIONES');
        $columnas = ['NRO','EQUIPO','PJ','PG','PE','PP','GF','GE','DG','PUNTAJE'];
        $fpdf->AddPage();
        $fpdf->Cell(80);
        $fpdf->Cell(30,5,'TABLA DE POSICIONES',0,1,'C');
        $fpdf->SetFont('Arial','B',9);
        $fpdf->Ln(2);
        $fpdf->SetFont('Arial','B',16);

        $fpdf->reportes($columnas,$tabla);
        $fpdf->Output();
        exit;
    }
}
