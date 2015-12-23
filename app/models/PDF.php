<?php
use Anouar\Fpdf\Fpdf as baseFpdf;
class PDF extends baseFpdf
{
    function Header()
    {
        $this->Image("bg/logo/escudo3.png",170,6,10);
        $this->Image("bg/logo/balon2.png",30,6,12);
        $this->SetFont('Arial','B',16);
        $this->Cell(55);
        $this->Cell(30,10,'Campeonato de docentes UNSAAC');
        $this->Ln(5);
        $this->Cell(80);
        $this->Cell(30,10,'_______________________________________________________',0,1,'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode ('Página '.$this->PageNo()),0,0,'C');
    }

    function docentes($header, $data)
    {
        $this->SetFillColor(100,100,100);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        $w = array(13, 23, 158);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();

        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $fill = false;
        $gg=1;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$gg++,'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row->coddocente,'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row->apellidopaterno.' '.$row->apellidomaterno.' - '.$row->nombre,'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }

    function reportes($header, $data)
    {
        $this->SetFillColor(100,100,100);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        $w = array(13,40,13,13,13,13,13,13,13,28 );
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();

        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $fill = false;
        $gg=1;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$gg++,'LR',0,'L',$fill);
            $this->Cell($w[1],6,Equipo::find($row->equipo)->nombre,'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row->PJ,'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row->PG,'LR',0,'L',$fill);
            $this->Cell($w[4],6,$row->PE,'LR',0,'L',$fill);
            $this->Cell($w[5],6,$row->PP,'LR',0,'L',$fill);
            $this->Cell($w[5],6,$row->GF,'LR',0,'L',$fill);
            $this->Cell($w[6],6,$row->GE,'LR',0,'L',$fill);
            $this->Cell($w[7],6,$row->DG,'LR',0,'L',$fill);
            $this->Cell($w[8],6,$row->puntaje,'LR',0,'c',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }

    function planilla($header, $data)
    {
        $this->SetFillColor(100,100,100);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        $w = array(13,80,53,50 );
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();

        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $fill = false;
        $gg=1;
        foreach($data as $row)
        {
            $jugador=Jugador::find($row->idjugador)->coddocente;
            $docente=Docente::find($jugador);
            $this->Cell($w[0],6,$gg++,'LR',0,'L',$fill);
            $this->Cell($w[1],6,$docente->nombre." ".$docente->apellidopaterno." ".$docente->apellidomaterno,'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row->condicion,'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row->nombre,'LR',0,'L',$fill);

            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }

}
