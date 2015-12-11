<?php

class ActaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$todoAsitencia = DB::select('call resumen_asistente');
		
		//$todoAgenda = Agenda::all();	
		$todoReunion = Reunion::paginate(3);	
		//$todoConclusion = DB::select('call resumen_conclusion');
		
        return View::make('user_com_organizing.acta.ver')->with('todoReunion',$todoReunion);
	}

    public function conclusiones_all()
	{
		//$categories = Category::all();
		$todoConclusion = DB::select('select * from treunion');
		return View::make('user_com_organizing.acta.verc')->with('todoConclusion', $todoConclusion);
	}

	public function conclusiones_add()
	{
		$input = Input::all();

		$rules = array(

			'idreunion' => 'required',
			'fecha' => 'required',
			'idfecha' => 'required',
			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$category = new Reunion;
				$category->idreunion = Input::get('idreunion');
				$category->fecha = Input::get('fecha');
				$category->nrofecha = Input::get('idfecha');
			$category->save();

			return Redirect::to('/acta/verc');
		}
	}

	public function conclusiones_get_edit($id)
	{
		$todoConclusion = Reunion::all();

		//$category = DB::table('treunion')->where('id', '=', $id)->get();

		$category = Reunion::find($id);
//		$category = DB::select('select * from  treunion where id=?',array($id));
		return View::make('user_com_organizing.acta.verc')->with('todoConclusion', $todoConclusion)->with('category', $category);
	}

	public function conclusiones_post_edit($id)
	{
		$input = Input::all();
		$rules = array(
			'fecha' => 'required',
			'idfecha' => 'required',
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			//$category = DB::select('select * from  treunion where id=?',array($id));	

		$category = Reunion::find($id);
			$category->fecha = Input::get('fecha');
			$category->nrofecha = Input::get('idfecha');
			$category->save();

			return Redirect::to('/acta/verc');
		}
	}

	public function conclusiones_delete($id)
	{
		//$category = DB::select('select * from  treunion where id=?',array($id));
		$category = Reunion::find($id);
		$category->delete();
		return Redirect::to('/acta/verc');
	}
	

	public function actare_all($id)
	{
		//$category = DB::select('select * from Tcambio where idreunion=? ',array($id));
		$category=Reunion::find($id);
		$buscar=$id;
		$todoasistente=DB::select('call resumen_asistente(?)',array($id));
		$todoAgenda=DB::select('select * from tagenda where idreunion=?',array($id));
		$todoConclusion=DB::select('call resumen_conclusion(?)',array($id));



		return View::make('user_com_organizing.acta.verAs')->with('category', $category)->with('todoasistente', $todoasistente)
		->with('todoAgenda',$todoAgenda)->with('todoConclusion',$todoConclusion)->with('buscar',$buscar);
		


	}
	public function actareunion_all($id)
	{
		//$category = DB::select('select * from Tcambio where idreunion=? ',array($id));
		$category=Reunion::find($id);
		$buscar=$id;
		$todoasistente=DB::select('call resumen_asistente(?)',array($id));
		$todoAgenda=DB::select('select * from tagenda where idreunion=?',array($id));
		$todoConclusion=DB::select('call resumen_conclusion(?)',array($id));



		return View::make('user_com_organizing.acta.verA')->with('category', $category)->with('todoasistente', $todoasistente)
		->with('todoAgenda',$todoAgenda)->with('todoConclusion',$todoConclusion)->with('buscar',$buscar);
		


	}
	public function actareunion_add1()
	{
		$input = Input::all();

		$rules = array(

			'codigo' => 'required',
			'nombre' => 'required',
			'idreunion' => 'required',

			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$nobre = Input::get('codigo');
 			$codigo = Input::get('nombre');
 			$idreunion = Input::get('idreunion');
 			//$category = DB::select('select * from Tcambio where tdocente=? ',array($id));
 			$cc=Docente::find($codigo);
			//$reunio=Asistente::find($codigo);
			//$reunio=DB::select('select * from tasistente where coddocente=? and idreunion=?',array($codigo,$idreunion));
			//echo gettype($reunio) ;
 			//$nombre1=$cc->nombre." ".$cc->apellidopaterno." ".$cc->apellidomaterno;
 			//echo $nombre1;
 			
 			
 				$price = DB::table('tasistente')->max('idasistente');
				$nuevo =(int)$price+1;
				$category = new Asistente;
				$category->idasistente= $nuevo;
				$category->coddocente = $codigo;
				$category->idreunion = $idreunion;
				
			$category->save();

			return Redirect::to('/acta/verA/'.$idreunion);
				
		}
	}
	public function actareunion_add2()
	{
		$input = Input::all();

		$rules = array(
			'nroAgenda' => 'required',
			'tema' => 'required',
			'idreunion2' => 'required',
			
			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
				$nroAge = Input::get('nroAgenda');
				$tem = Input::get('tema');
				$idnion = Input::get('idreunion2');	
			$validar=DB::select('select * from tagenda where nroagenda=? and idreunion=?',array($nroAge,$idnion));
			$ver=null;
			foreach ($validar as $key) {
				$ver=$key->nroagenda;
			}
			if($ver!=null)
 			{
 				return Redirect::to('/acta/verA/'.$idnion);
 			}
 			else{	
  				$category = new Agenda;
				$category->nroagenda = $nroAge;
				$category->tema = $tem;
				$category->idreunion = $idnion;
			$category->save();

			return Redirect::to('/acta/verA/'.$idnion);
		  }
		}
	}
	public function actareunion_add3()
	{
		$input = Input::all();

 
		$rules = array(

			'idconclusion' => 'required',
			'conclusion' => 'required',
			'agenda' => 'required',
			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$idcon = Input::get('idconclusion');
			$conclu = Input::get('conclusion');
			$idage = Input::get('agenda');
			$reunion=	Input::get('idreunion3');
			$validar=DB::select('select * from tconclusion where nroconclusion=? and nroagenda=?',array($idcon,$idage));
            $ver=null;
			foreach ($validar as $key) {
				$ver=$key->idconclusion;
			}

			if($validar!=null)
 			{
 				return Redirect::to('/acta/verA/'.$reunion);
 			}
 			else{	
			$category = new Conclusion;
				$category->nroconclusion = $idcon;
				$category->conclusion = $conclu;
				$category->nroagenda = $idage;
			$category->save();

			return Redirect::to('/acta/verA/'.$reunion);
		  }
			
		}
	}

	public function actareunion_delete1($id1,$id2)
	{
		//$category = DB::select('select * from  tasistente where idasistente=?',array($id));
		$category=Asistente::find($id2);
		$category->delete();
		return Redirect::to('/acta/verA/'.$id1);
	}
	public function actareunion_delete2($id1,$id2)
	{
		$category=Agenda::find($id2);
		$category->delete();
		return Redirect::to('/acta/verA/'.$id1);
	}
	public function actareunion_delete3($id1,$id2)
	{
		//$category = DB::select('select * from  treunion where nroconclusion=?',array($id));
		$category=Conclusion::find($id2);
		$category->delete();
		return Redirect::to('/acta/verA/'.$id1);
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


}