<?php
class MovimientoController extends BaseController {
	public function index()
	{
		$movimientos = Movimiento::where('idcom_orgdor','=',Session::get('user_idcom_orgdor'))->paginate(2);
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
        $idmovimiento = DB::table('tmovimiento')->insertGetId([
							'tipo'=>"ingreso",
							'montototal' => Input::get('montototal'),
                            'descripcion' => Input::get('descripcion'),
							'fecha' => Input::get('fecha'),
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
		$idmovimiento = DB::table('tmovimiento')->insertGetId([
							'tipo'=>"Egreso",
							'montototal' => Input::get('montototal'),
							'descripcion' => Input::get('descripcion'),
                            'fecha' => Input::get('fecha'),
                            'idcom_orgdor'=>Session::get('user_idcom_orgdor')
							]);
		$newingreso = new Egreso;
		$newingreso -> nromovimiento =$idmovimiento;
		$newingreso -> save();
		return Redirect::to('movimientos');
	}
	public function listaI()
	{
		$todoingresos = Ingreso::all();
		return View::make('movimiento.ingresos.listar')->with('todoingresos',$todoingresos);
	}
	public function listaE()
	{
		$egresos = Egreso::all();
		return View::make('movimiento.egresos.listar')->with('egresos',$egresos);
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

	public function destroy($id)
	{
		
		$movi=DB::table('tmovimiento')->where('idconcepto','=',$id)->delete();
		return Redirect::to('Mov');
	}

	
}