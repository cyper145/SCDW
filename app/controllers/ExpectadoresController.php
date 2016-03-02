<?php
class ExpectadoresController extends \BaseController {

    public function index()
    {
        $docentetodo = Espectador::paginate(2);
        return View::make('user_administrator.espectadores.listar')->with('docentetodo',$docentetodo);
    }



    public function insertardocente()
    {
        $dptotodo= Espectador::all();
        return View::make('user_administrator.espectadores.insertar')->with('dptotodo',$dptotodo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
            $nombre = Input::get('nombre');
            $apellidopaterno = Input::get('nroasiento');

            $nuevo=new Espectador;
            $nuevo->nombre=$nombre;
            $nuevo->nroasiento=$apellidopaterno;
            $nuevo->save();
            return Redirect::to('espectadores/listar');



    }


    public function editardocente($id)
    {
        $dptotodo= Espectador::all();
        $consultatabla = Espectador::find($id);
        return View::make('user_administrator.espectadores.editar')->with('dptotodo',$dptotodo)->with('consultatabla',$consultatabla);
    }

    public  function update($id)
    {
        $nombre = Input::get('nombre');
        $apellidopaterno = Input::get('nroasiento');

        $nuevo = Espectador::find($id);
        $nuevo->nombre=$nombre;
        $nuevo->nroasiento=$apellidopaterno;
        $nuevo->save();


        return Redirect::to('espectadores/listar');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $nuevo = Espectador::find($id);
        $nuevo->delete();
        //return $this->showUsers();
        return Redirect::to('espectadores/listar');
    }

    public function buscar()
    {
        $coddocente = Input::get('valor');

        $docente = Espectador::where('nombre','=',$coddocente)->first();
        //$docente=Espectador::where('like valor')

        return View::make('user_administrator.espectadores.search')->with('docente',$docente);
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