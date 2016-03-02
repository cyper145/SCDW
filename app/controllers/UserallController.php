<?php

class UserallController extends \BaseController {
    
        
        public function get_login()
	{
            if(User::isLogged())//SI YA ESTA LOGUEADO
                return Redirect::to('/');
            else
                return View::make('login.login');
	}
        
        public function post_login()
	{
            $input = Input::all();
            $rules = array(
			'username' => 'required|exists:tusuarios,username',
			'password' => 'required'
                    );
            $validator = Validator::make($input, $rules);            
            if($validator->fails())
            {
                return Redirect::back()->withErrors($validator);
            }
            else
            {
                $username = Input::get('username');
                $password = Input::get('password');
                if($user = User::where('username', '=', $username)->first())
                {
                    if(Hash::check($password, $user->password))
                    {
                        Session::put('user_id', $user->idUsuario);
                        Session::put('user_username', $user->username);
                        Session::put('user_type', $user->tipo);
                        Session::put('user_estado',$user->estado);
                        if(Session::get('user_estado') == 'activo')
                        {
                            if(User::isAdministrator())
                            {
                                Session::put('user_name',$user->username);
                                return Redirect::to('/');
                            }
                            else
                            {
                                if(User::isOrganizingCommittee())
                                {
                                    Session::put('user_name',$user->DataComision[0]->nombre);
                                    Session::put('user_idcom_orgdor',$user->DataComision[0]->codCom_Org);
                                    return Redirect::to('comision/index.html');
                                }
                                else
                                {
                                    if(User::isEquipo())
                                    {
                                        Session::put('user_name',$user->DataEquipo[0]->nombre);
                                        Session::put('user_codequipo',$user->DataEquipo[0]->codEquipo);
                                        return Redirect::to('equipo/index.html');
                                    }
                                    else
                                    {
                                        Session::flush();
                                        $error = ['wilson'=>'tipo de usuario invalido'];
                                        return Redirect::back()->withInput()->withErrors($error);
                                    }
                                }
                            }
                        }
                        else
                        {
                            Session::flush();
                            $error = ['wilson'=>'Este usuario esta desactivado'];
                            return Redirect::back()->withInput()->withErrors($error);
                        }
                    }
                    else
                    {
                        //return Redirect::to('/login');
                        $error = ['wilson'=>'Contraseña incorrecta'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                }
                else
                {
                    $error = ['wilson'=>'este usuario no existe'];
                    return Redirect::back()->withInput()->withErrors($error);
                    //return Redirect::to('/login');
                }
            }
	}
        
        public function logout()
	{
            Session::flush();
            return Redirect::to('/');
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


}
