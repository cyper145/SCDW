<?php
class MovimientoController extends BaseController
{
	public function index()
	{
		$movimientos = Movimiento::where('idcom_orgdor','=',Session::get('user_idcom_orgdor'))->paginate(10);
		$ingesototal = Movimiento::where('tipo','=','ingreso')->sum('montototal');
		$egresototal = Movimiento::where('tipo','=','egreso')->sum('montototal');
        $saldototal = $ingesototal - $egresototal;
		return View::make('user_com_organizing.movimiento.index')
            ->with('movimientos',$movimientos)
            ->with('saldototal',$saldototal);
	}

	public function createI()
	{
		$todoEquipos=Equipo::all();
		return View::make('user_com_organizing.movimiento.ingresos.agregar')->with('todoEquipos',$todoEquipos);
		
	}
	public function createE()
	{
		$todoEquipos=Equipo::all();
		$movimientos = Movimiento::all();
		return View::make('user_com_organizing.movimiento.egresos.agregar')->with('todoEquipos',$todoEquipos);
	}
	public function storeI()
	{
        date_default_timezone_set("America/Lima");
        $tiempo = getdate();
        $timefull = date('Y-m-d').' '.$tiempo['hours'].':'.$tiempo['minutes'].':'.$tiempo['seconds'];

        $idmovimiento = DB::table('tmovimiento')->insertGetId([
							'tipo'=>"ingreso",
							'montototal' => Input::get('montototal'),
                            'descripcion' => Input::get('descripcion'),
							'fecha' => $timefull,
                            'idcom_orgdor'=>Session::get('user_idcom_orgdor')
							]);
		$newingreso = new Ingreso;
		$newingreso -> codequipo = Input::get('codequipo');
		$newingreso -> nromovimiento =$idmovimiento;
		$newingreso -> save();
        $equipo = Equipo::where('codequipo','=',Input::get('codequipo'))->first();
        $idusuario = $equipo->idusuario;
        User::where('idusuario','=',$idusuario)
            ->update(['estado'=>'activo']);
		return Redirect::to('movimientos');
	}
	public function storeE()
	{
        date_default_timezone_set("America/Lima");
        $tiempo = getdate();
        $timefull = date('Y-m-d').' '.$tiempo['hours'].':'.$tiempo['minutes'].':'.$tiempo['seconds'];

		$idmovimiento = DB::table('tmovimiento')->insertGetId([
							'tipo'=>"Egreso",
							'montototal' => Input::get('montototal'),
							'descripcion' => Input::get('descripcion'),
                            'fecha' => $timefull,
                            'idcom_orgdor'=>Session::get('user_idcom_orgdor')
							]);
		$newingreso = new Egreso;
		$newingreso -> nromovimiento =$idmovimiento;
		$newingreso -> save();
		return Redirect::to('movimientos');
	}
     public function editarIngreso($id)
      {
           $todoEquipos=Equipo::all();
            $consultatabla = Ingreso::where('nromovimiento', '=', $id)->get();
            return View::make('movimiento.ingresos.editar',
            	['consultatabla'=>$consultatabla,'todoEquipos'=>$todoEquipos]);

    }
	public function update($id)
	{
		if($id<1)
        {
            //error 404
        } 
        else
        {
            $recuperado = Input::all();
            //print_r($recuperado) ;
            $consultatabla = DB::table('tingreso')
                ->where('nromovimiento',$id)
                ->update(array(
                    'nromovimiento'=> $id,
                    'idingreso'=> $recuperado['idingreso'],
                    'codequipo'=> $recuperado['codequipo'],)
                );
            return Redirect::to('movimientos');  
        }   
	}

	public function destroy($nromovimiento)
	{
        $movimiento = Movimiento::where('nromovimiento','=',$nromovimiento)->first();
        if($movimiento->tipo = 'ingreso')
        {
            Ingreso::where('nromovimiento','=',$nromovimiento)->delete();
        }
        if($movimiento->tipo = 'egreso')
        {
            Egreso::where('nromovimiento','=',$nromovimiento)->delete();
        }
        Movimiento::where('nromovimiento','=',$nromovimiento)->delete();
        return Redirect::to('movimientos');
        //Egreso::where('nromovimiento','=',$nromovimiento)->delete();
        //echo Egreso::where('nromovimiento','=',$nromovimiento)->first();
	}

	
}