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
        $torneos = Torneo::where('codCampeonato','=',$codcampeonato)->get();
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

    function nroequipos($codcampeonato)
    {
        $nro=DB::table('tequipo')->where( 'codCampeonato', '=', $codcampeonato)->count();
        //$nro=Equipo::where('estado', '=', 'habilitado')->count(
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
    function coordinar($campeonato)
    {
        $todopartido=Equipo::where('estado', '=', 'habilitado')->get();
        //$todopartido=Equipoxtorne::where('estado', '=', 'habilitado')->get();
        $nro=$this->nroequipos($campeonato);
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

            $cod=$value->codEquipo;
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
    function establecer($campeonato,$idtorneo)
    {
        $nro=$this->nroequipos($campeonato);
        $fixture=$this->programacion($nro);
        $arr=$this->coordinar($campeonato);
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
                $countfixture=DB::table('tfixtureaux')->count();
                $codFixture=substr($idtorneo,3,strlen($idtorneo));;
                $rueda = new Fixtureaux;
                $rueda->codFixture="FIX".$codFixture.($countfixture+1);
                $rueda->nroFecha = $i+1;

                $uno=$rueda->codEquipo2 =$this->obtenercodigo($arr,$s);
                $dos=$rueda->codEquipo1 =$this->obtenercodigo($arr,$p);
                //$rueda->equipo2 =$this->obtenercodigo($arr,$s);
                //$rueda->partido=$this->generar();
                $rueda->nroPartido=$codigo++;// generar
                $rueda->codRueda = $idtorneo;
                $rueda->save();
                $k++;

            }
        }

    }
    function fixture($idcampeonato,$idtorneo)
    {
        $this->establecer($idcampeonato,$idtorneo);
        $fixtureaux=Fixtureaux::all();
        foreach($fixtureaux as $val ) {
            if (($val->codEquipo1) && ($val->codEquipo2)) {
                $id=$val->codFixture;
                $equipo1=$val->codEquipo1;
                $equipo2=$val->codEquipo2;
                $nropartido=$val->nroPartido;
                $fecha=$val->nroFecha;
                $hora=$val->hora;
                $torneo = $val->codRueda;
                $elemento=Fixtureaux::find($id);
                $elemento->delete();
                $nuevo=new Fixture();
                $nuevo->codFixture=$id;
                $nuevo->codEquipo1=$equipo1;
                $nuevo->codEquipo2=$equipo2;
                $nuevo->nroPartido=$nropartido;
                $nuevo->nroFecha=$fecha;
                $nuevo->hora=$hora;
                $nuevo->codRueda=$torneo;
                $nuevo->save();
            }
        }
        return Redirect::to('torneo/'.$idtorneo.'/'.$idcampeonato.'/detail.html');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($codcampeonato,$idtorneo)
    {
        $jugador = Torneo::where('codRueda','=',$idtorneo)->where('codCampeonato','=',$codcampeonato)->first();
        $jugador->delete();
        $respuesta['mensaje'] = 'Torneo elimnado correctamente';
        return Redirect::to('torneo/'.$codcampeonato)->withErrors($respuesta['mensaje']);
    }


    public  function detail($codcampeonato,$idtorneo)
    {


        //$tabla = DB::select('call TABLAPOSICIONES');
        $fixture = Fixture::where('codRueda', '=', $idtorneo)->get();
        $fechas = Fechas::where('codRueda', '=', $idtorneo)->get();
        //$equipos = Equipoxtorneo::where('codRueda', '=', $idtorneo)->get();
        $fechasdeltorneo = Fechas::where('codRueda', '=', $idtorneo)->get();
        $campeonato = Campeonato::where('codCampeonato', '=', $codcampeonato)->first();
        $torneo = Torneo::where('codRueda', '=', $idtorneo)->first();
        $nroequipos = $this->nroequipos($codcampeonato);
        return View::make('user_com_organizing.torneo.detail', compact('fechasdeltorneo'))
            ->with('codcampeonato', $codcampeonato)
            //->with('equipos', $equipos)
            ->with('torneo', $torneo)
           // ->with('tabla', $tabla)
            ->with('nroequipos', $nroequipos);








    }


    public function agregarE($idcampeonato,$idtorneo)
    {
        $equipo=Equipo::where('estado', '=', 'habilitado')->get();
        foreach($equipo as $value)
        {
            $cod=$value->codequipo;

            if(!Equipoxtorneo::where('codequipo', '=', $cod)->first())
            {
                $nuevo= new Equipoxtorneo();
                $nuevo->codequipo=$cod;
                $nuevo->idtorneo=$idtorneo;
                $nuevo->save();
            }
        }
        return Redirect::to('torneo/'.$idtorneo.'/'.$idcampeonato.'/detail.html');

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
