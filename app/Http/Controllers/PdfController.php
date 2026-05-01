<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    // Direct download from your browser
    public function download(){
        $datos = [
            'titulo' => 'Listado de Alumnos',
            'alumnos' => [
                ['nombre' => 'Ana García', 'correo' => 'ana@mail.com'],
                ['nombre' => 'Luis Martinez', 'correo' => 'luis@mail.com'],
            ],
        ];

        $pdf = Pdf::loadView('pdf.reporte', $datos);
        return $pdf->download('reporte-alumnos.pdf');
    }

    // Display pdf on your browser (inLine)
    public function display(){
        $datos = ['titulo' => 'Listado', 'alumnos' => []];
        return Pdf::loadView('pdf.reporte', $datos)->stream('reporte.pdf');
    }

    // Save pdf in storage
    public function save(){
        $datos = ['titulo' => 'Reporte Guardado', 'alumnos' => []];
        $pdf =Pdf::loadView('pdf.reporte', $datos);
        $ruta = 'pdfs/reporte-' . now()->format('Ymd-His') . 'pdf';
        \Storage::put($ruta, $pdf->output());
        return response()->json(['ruta' => $ruta]);
    }

}
