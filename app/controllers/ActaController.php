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

    public function conclusiones_all($codcampeonato)
	{
        $todoConclusion=DB::table('treunion')
            ->join('tfecha', 'treunion.idFecha', '=', 'tfecha.idFecha')
            ->join('trueda', 'tfecha.codRueda', '=', 'trueda.codRueda')
            ->join('tcampeonato', 'trueda.codCampeonato', '=', 'tcampeonato.codCampeonato')
            ->select('treunion.codReunion', 'treunion.fecha')
            ->where( 'tcampeonato.codCampeonato', '=', $codcampeonato)
            ->get();

		//$categories = Category::all();
		//$todoConclusion = DB::select('select * from treunion');
		return View::make('user_com_organizing.acta.verc')->with('todoConclusion', $todoConclusion)->
            with('codcampeonato',$codcampeonato);
	}

	public function conclusiones_add($id)
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
				$category->codReunion = Input::get('idreunion');
				$category->fecha = Input::get('fecha');
				$category->idFecha = Input::get('idfecha');
			$category->save();

			return Redirect::to('/campeonato/detail/'.$id);
		}
	}

	public function conclusiones_get_edit($codcampeonato,$id)
	{
		$todoConclusion = Reunion::all();
        $todoConclusion=DB::table('treunion')
            ->join('tfecha', 'treunion.idFecha', '=', 'tfecha.idFecha')
            ->join('trueda', 'tfecha.codRueda', '=', 'trueda.codRueda')
            ->join('tcampeonato', 'trueda.codCampeonato', '=', 'tcampeonato.codCampeonato')
            ->select('treunion.codReunion', 'treunion.fecha')
            ->where( 'tcampeonato.codCampeonato', '=', $codcampeonato)
            ->get();

		//$category = DB::table('treunion')->where('id', '=', $id)->get();

		$category = Reunion::find($id);

//		$category = DB::select('select * from  treunion where id=?',array($id));
		return View::make('user_com_organizing.acta.verc')->with('todoConclusion', $todoConclusion)->with('category', $category)
            ->with('codcampeonato',$codcampeonato);;
	}

	public function conclusiones_post_edit($codcampeonato,$id)
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
			$category->idFecha = Input::get('idfecha');
			$category->save();

            return Redirect::to('/campeonato/detail/'.$codcampeonato);
        }
	}

	public function conclusiones_delete($codcampeonato,$id)
	{
		//$category = DB::select('select * from  treunion where id=?',array($id));
		$category = Reunion::find($id);
		$category->delete();
        return Redirect::to('/campeonato/detail/'.$codcampeonato);
	}
	

	public function actare_all($codcampeonato,$id)
	{
		//$category = DB::select('select * from Tcambio where idreunion=? ',array($id));
		$category=Reunion::find($id);
		$buscar=$id;
        $todoasistente=DB::table('treunion')
            ->join('tasistente', 'treunion.codReunion', '=', 'tasistente.codReunion')
            ->join('tdelegando', 'tasistente.dni', '=', 'tdelegando.dni')
            ->join('tdocente', 'tdelegando.codDocente', '=', 'tdocente.codDocente')
            ->select('tdocente.codDocente', 'tdocente.nombre','tdocente.apellidoP','tdocente.apellidoM','tdelegando.rol')
            ->where( 'treunion.codreunion', '=', $id)
            ->get();

        //$todoasistente=DB::select('call resumen_asistente(?)',array($id));
		$todoAgenda=DB::select('select * from tagenda where codReunion=?',array($id));
        $todoConclusion=DB::table('tconclusion')
            ->join('tagenda', 'tconclusion.codAgenda', '=', 'tagenda.codAgenda')
            ->join('treunion', 'treunion.codReunion', '=', 'treunion.codReunion')
            ->select('tagenda.codAgenda', 'tconclusion.conclusion')
            ->where( 'treunion.codreunion', '=', $id)
            ->get();
        //$todoConclusion=DB::select('call resumen_conclusion(?)',array($id));
		return View::make('user_com_organizing.acta.verAs')->with('category', $category)->with('todoasistente', $todoasistente)
		->with('todoAgenda',$todoAgenda)->with('todoConclusion',$todoConclusion)->with('buscar',$buscar)
            ->with('codcampeonato',$codcampeonato);
		


	}
	public function actareunion_all($codcampeonato,$id)
	{
		//$category = DB::select('select * from Tcambio where idreunion=? ',array($id));
        $category=Reunion::find($id);
        $buscar=$id;
        $todoasistente=DB::table('treunion')
            ->join('tasistente', 'treunion.codReunion', '=', 'tasistente.codReunion')
            ->join('tdelegando', 'tasistente.dni', '=', 'tdelegando.dni')
            ->join('tdocente', 'tdelegando.codDocente', '=', 'tdocente.codDocente')
            ->select('tasistente.codAsistente','tdocente.codDocente', 'tdocente.nombre','tdocente.apellidoP','tdocente.apellidoM','tdelegando.rol')
            ->where( 'treunion.codreunion', '=', $id)
            ->get();

        //$todoasistente=DB::select('call resumen_asistente(?)',array($id));
        $todoAgenda=DB::select('select * from tagenda where codReunion=?',array($id));
        $todoConclusion=DB::table('tconclusion')
            ->join('tagenda', 'tconclusion.codAgenda', '=', 'tagenda.codAgenda')
            ->join('treunion', 'treunion.codReunion', '=', 'treunion.codReunion')
            ->select('tconclusion.codConclusion','tagenda.codAgenda', 'tconclusion.conclusion')
            ->where( 'treunion.codreunion', '=', $id)
            ->get();




        return View::make('user_com_organizing.acta.verA')->with('category', $category)->with('todoasistente', $todoasistente)
		->with('todoAgenda',$todoAgenda)->with('todoConclusion',$todoConclusion)->with('buscar',$buscar)
            ->with('codcampeonato',$codcampeonato);
		


	}
	public function actareunion_add1($codcampeonato,$id)
	{
        $users = DB::table('tasistente')->count();
        $users++;
        $users1=substr($id,3,strlen($id));
        $codasistente="ASIT".$users1.$users;
		$input = Input::all();


		$rules = array(

			'delegado' => 'required',

		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			    $dni = substr(Input::get('delegado'),0,8);
              if(!$Asi=DB::table('tasistente')->where('dni','=',$dni)->where('codReunion','=',$id)->get()) {

                  $category = new Asistente;
                  $category->codAsistente = $codasistente;
                  $category->dni = $dni;
                  $category->codReunion = $id;

                  $category->save();
              }

			return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);
				
		}
	}
	public function actareunion_add2($codcampeonato,$id)
	{
        $users = DB::table('tagenda')->count();
        $users++;
        //$users1 = DB::table('treunion')->count();
        $users1=substr($id,3,strlen($id));
        $codagenda="AGE".$users1.$users;
		$input = Input::all();

		$rules = array(
			'tema' => 'required',
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{


  				$category = new Agenda;
				$category->codAgenda = $codagenda;
				$category->tema =Input::get('tema');
				$category->codReunion = $id;
			$category->save();

			return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);


		}
	}
	public function actareunion_add3($codcampeonato,$id)
	{
        $users = DB::table('tconclusion')->count();
        $users++;
        $users1=substr($id,3,strlen($id));
        $codconclusion="CON".$users1.$users;
		$input = Input::all();

 
		$rules = array(
			'tema' => 'required',
            'codagenda'=>'required'
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$idcon = Input::get('idconclusion');

			$category = new Conclusion;
				$category->codConclusion = $codconclusion;
				$category->conclusion = Input::get('tema');
				$category->codAgenda = Input::get('codagenda');
			$category->save();

            return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);

			
		}
	}

	public function actareunion_delete1($codcampeonato,$id,$id2)
	{
		//$category = DB::select('select * from  tasistente where idasistente=?',array($id));
		$category=Asistente::find($id2);
		$category->delete();
        return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);
	}
	public function actareunion_delete2($codcampeonato,$id,$id2)
	{
        //elimiminar primero todas las conclusiones  de la agenda
		//$category=Agenda::find($id2);
        $todoconclusion=Conclusion::where('codAgenda','=',$id2)->get();

        foreach($todoconclusion as $value)
        {
            $conclusion=Conclusion::find($value->codConclusion);
            $conclusion->delete();

        }

        $category=Agenda::find($id2);
        //luego recien la agenda
		$category->delete();
        return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);
	}
	public function actareunion_delete3($codcampeonato,$id,$id2)
	{
		//$category = DB::select('select * from  treunion where nroconclusion=?',array($id));
		$category=Conclusion::find($id2);
		$category->delete();
        return Redirect::to('campeonato/detail/'.$codcampeonato.'/abriracta/'.$id);
	}



}