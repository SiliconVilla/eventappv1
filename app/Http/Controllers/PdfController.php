<?php

namespace App\Http\Controllers;
use App\Models\Asistencia;

use Illuminate\Http\Request;
use PDF;

use DB;

class PdfController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {

        //$asistencias = DB:://Asistencia::all();

        $asistencias = DB::table('asistencias')->get();//->orderBy('created_at', 'desc')->first();
        

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        //dd($asistencias->all());
        return view('asistenciaspdf')->with(compact('asistencias'));
        //$pdf = PDF::loadView('asistenciaspdf', $asistencias)->setPaper('letter', 'landscape');
        //return $pdf->download('itsolutionstuff.pdf');
    }


}
