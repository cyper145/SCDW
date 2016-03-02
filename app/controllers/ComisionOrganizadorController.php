<?php

class ComisionOrganizadorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $idcomision = Session::get('user_idcom_orgdor');
        $nrointegrantess = IntegrantesCO::where('codCom_Org','=',$idcomision)->count();
        return View::make('user_com_organizing.index')->with('nrointegrantess',$nrointegrantess);
	}
    public function addintegrante_get()
    {
        return View::make('user_com_organizing.integrante.add');
    }


    public function addintegrante_post()
    {
        $input = Input::all();
        $regla = [  'Nombre'=>'required','Rol'=>'required'];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        }
        else {
            //verificamos que el docente exista
            $iddocente = substr(Input::get('Nombre'), 0, 6);
            if ($docente = Docente::where('codDocente', '=', $iddocente)->first())
            {
                //verificamos de que las funcines no se repitan
                $rol = Input::get('Rol');
                $idcom_orgdor = Session::get('user_idcom_orgdor');
                if ($data = IntegrantesCO::where('codCom_Org', '=', $idcom_orgdor)->where('rol','=',$rol)->first())
                {
                    $error = ['wilson' => 'El '.$rol.' es '.$data->DataDocente[0]->nombre.' '.$data->DataDocente[0]
                            ->apellidoP.' '.$data->DataDocente[0]->apellidoM.' nose aceptan dos '.$rol.'s'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
                else
                {
                    if ($data = IntegrantesCO::where('codCom_Org', '=', $idcom_orgdor)->where('codDocente','=',$iddocente)->first())
                    {
                        $error = ['wilson' => 'El docente que ingreso ya es '.$rol.' por favor ingrese otro docente'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                    else
                    {

                        $newIntegrante = new IntegrantesCO();
                        $newIntegrante->dni=Input::get('dni');
                        $newIntegrante->rol = Input::get('Rol');
                        $newIntegrante->codCom_Org = $idcom_orgdor;
                        $newIntegrante->codDocente = $iddocente;
                        $newIntegrante->save();
                        $success = ['wilson' => 'Integrante Agregado Satisfactoriamente'];
                        return Redirect::to('comision/integrantes/list.html')->withErrors($success);
                    }
                }
            }
            else
            {
                $error = ['wilson' => 'Este docente no existe en la base de datos'];
                return Redirect::back()->withInput()->withErrors($error);
            }
        }
    }
    public function listintegrante()
    {
        $integrantesall = IntegrantesCO::where('codCom_Org','=',Session::get('user_idcom_orgdor'))->get();
        return View::make('user_com_organizing.integrante.list')->with('integrantesall',$integrantesall);
    }
    public function deleteintegrante($id)
    {
        IntegrantesCO::find($id)->delete();
        $success = ['wilson' => 'Integrante se elimino Satisfactoriamente'];
        return Redirect::to('comision/integrantes/list.html')->withErrors($success);
    }
}
