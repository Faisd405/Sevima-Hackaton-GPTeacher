<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CurriculumController extends Controller
{
    public function generatePDF($id)
    {
        $curriculum = Curriculum::with('curriculumDetails')->find($id);

        $pdf = PDF::loadView('pdf.curriculum', compact('curriculum'));

        return $pdf->stream('curriculum.pdf');
    }
}
