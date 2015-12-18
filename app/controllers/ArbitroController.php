<?php

class ArbitroController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $arbitros = Arbitro::paginate(2);
        return View::make('user_com_organizing.arbitros.list')->with('arbitros',$arbitros);
    }

    public  function insertar_get()
    {
        return View::make('user_com_organizing.arbitros.new');
    }

    public  function insertar_post()
    {
        $respuesta = Arbitro::isertar(Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('Arbitros/insertar.html')->withErrors($respuesta['mensaje'])->withInput();
        }
        return Redirect::to('Arbitros/list.html')->withErrors($respuesta['mensaje']);
    }

    public function eliminar($dni)
    {
        Arbitro::find($dni)->delete();
        $error = ['wilson'=>'Arbitro eliminado correctamente'];
        return Redirect::back()->withInput()->withErrors($error);
    }
}
