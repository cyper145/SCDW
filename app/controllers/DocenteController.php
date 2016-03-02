<?php

class DocenteController extends \BaseController {

    // listar

 public function index()
    {
        $docentetodo = Docente::paginate(7);
        return View::make('user_administrator.Docente.listar')->with('docentetodo',$docentetodo);
    }

       

    public function insertardocente()
    {
            $dptotodo= DptoAcademico::all();
            return View::make('user_administrator.Docente.insertar')->with('dptotodo',$dptotodo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
         $input = Input::all();
         $regla = [ 'codigo'=>'required|max:6',
                    'apellidopaterno'=>'required',
                    'apellidomaterno'=>'required',
                    'nombre'=>'required'
                 ];
        $validacion = Validator::make($input,$regla);
        if($validacion->fails())
        {
            return Redirect::back()->withErrors($validacion);
        } 
         else
        {
                $nombre = Input::get('nombre');
                $apellidopaterno = Input::get('apellidopaterno');
                $apellidomaterno = Input::get('apellidomaterno');
                $codigo = Input::get('codigo');
                if($iddocente = Docente::where('codDocente', '=', $codigo)->first())
                {
                    $error = ['wilson'=>'El codigo '. $codigo. '  ya existe'];
                    return Redirect::back()->withInput()->withErrors($error);
                }
                else
                { 
                    if($ddocente = Docente::where('nombre', '=', $nombre)->where('apellidoP','=',$apellidopaterno)->where('apellidoM','=',$apellidomaterno)->first())
                    {
                        $error = ['wilson'=>'Este docente ya ha sido insertado'];
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                    else
                    {  
                        $Docente = new Docente;
                        $Docente->codDocente = Input::get('codigo');
                        $Docente->nombre = Input::get('nombre');
                        $Docente->apellidoM = Input::get('apellidomaterno');
                        $Docente->apellidoP = Input::get('apellidopaterno');
                        $Docente->categoria = Input::get('categoria');
                        $Docente->email = Input::get('email');
                        $Docente->codDptoAcademico = Input::get('iddepartamento');
                        $Docente->save();
                        return Redirect::to('docente/listar');
                    }
            }
        }
    }


     public function editardocente($id)
     {
            $dptotodo= DptoAcademico::all();
            $consultatabla = Docente::where('codDocente', '=', $id)->get();
            return View::make('user_administrator.docente.editar',['consultatabla'=>$consultatabla,'dptotodo'=>$dptotodo]);
     }

    public  function update($id)
    {
        $recuperado = Input::all();
        DB::table('tdocente')
                ->where('codDocente',$id)
                ->update(array(
                            'nombre'=> $recuperado['nombre'],
                            'apellidomaterno'=> $recuperado['apellidomaterno'],
                            'apellidopaterno'=> $recuperado['apellidopaterno'],
                            'categoria'=> $recuperado['categoria'],
                            'dni'=> $recuperado['dni'],
                            'direccion'=> $recuperado['direccion'],
                            'email'=> $recuperado['email'],
                            'edad'=> $recuperado['edad'],
                            'telefono'=> $recuperado['telefono'],
                            'coddptoacademico'=> $recuperado['iddepartamento']
                            )
                        );
        return Redirect::to('docente/listar');
   }
/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        //
       // echo "esto es una prueba de eliminar";
        //DB::delete('delete from tdocente where id = '.$id);
        //$test = DB::table('tdocente')->where('iddocente',$id);
        $consultatabla = DB::table('tdocente')
            ->where('codDocente', $id)
            ->delete();
        //$test = Docente::where('coddocente','=',$id)->delete($id);
        //print_r($test);
        echo "eliminado satisfactoriamente";
        //return $this->showUsers();
        return Redirect::to('docente/listar');
    }

    public function buscar()
    {
        $coddocente = Input::get('valor');
        $docente = Docente::find($coddocente);
        return View::make('user_administrator.Docente.search')->with('docente',$docente);
    }

    public function getPDF()
    {
        /*$pdf = new PDF();
        $docentes = Docente::all();
        $columnas = ['NRO','CODIGO','APELLIDOS Y NOMBRES'];
        $pdf->SetFont('Arial','B',13);
        $pdf->AddPage();
        $pdf->Cell(80);
        $pdf->Cell(30,5,'Lista de Docentes',0,1,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',10);
        $pdf->docentes($columnas,$docentes);
        $cabe=['Content-Type' => 'application/pdf'];
        return Response::make($pdf->_checkoutput(),200,$cabe);*/

        $fpdf = new PDF();
        $docentes = Docente::all();
        $columnas = ['NRO','CODIGO','APELLIDOS Y NOMBRES'];
        $fpdf->AddPage();
        $fpdf->Cell(80);
        $fpdf->Cell(30,5,'Lista de Docentes',0,1,'C');
        $fpdf->SetFont('Arial','B',9);
        $fpdf->Ln(2);
        $fpdf->SetFont('Arial','B',16);

        $fpdf->docentes($columnas,$docentes);
        $fpdf->Output();
        exit;
    }
}