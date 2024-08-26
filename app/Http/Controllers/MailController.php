<?php

namespace App\Http\Controllers;
use App\Models\Incident;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Apoyosaldo;
use App\Mail\NotificacionMail;
use DateTime;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;
use Mail;
use DB;
use Storage;
use Illuminate\Support\Facades\View;


class MailController extends Controller
{
    //
    public function contactForm()
    {

        $categories = Category::where('project_id', 1)->get();
        //$incidenteNext = Contact::orderBy("created_at","desc")->get();



        //$incidentenext = Contact::all();

     
        $incidentelast = DB::table('incidents')->orderBy('created_at', 'desc')->first();
        

        if ($incidentelast != null) {
            $incidentenext = $incidentelast->id+1;
            return view('reportar')->with(compact('categories', 'incidentenext'));
        } else {
            $incidentenext = 1;
            return view('reportar')->with(compact('categories', 'incidentenext'));
        }
        

        
        //return view('reportar')->with(compact('categories', 'incidentenext'));
    }

    
    /*if ($request->hasFile('archivo')) {
        $file = $request->file('archivo');
        $name = 'public/imagenes/slider/'.time().$file->getClientOriginalName();
        $file->move(public_path().'/imagenes/slider/', $name);
    }


    $eventapp = new Event();
    $eventapp->evento = $request->input('evento');
    $eventapp->imagen = $name;
    $eventapp->estado_id = $request->input('id_estado');
    $eventapp->save();*/

    public function subirArchivo(Request $request)
    {
        $folderuser = explode("@", auth()->user()->email);
        $date = new DateTime();
        $fechacarga = $date->getTimestamp();

        

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $name = '/private/'.$folderuser[0].'/'.$folderuser[0]."-".$fechacarga.".pdf";
            $file->move(storage_path()."/app/private/".$folderuser[0].'/', $name);
            $urlFile = "https://siliconvilla.io/bunpalmira".$name;
            
            //dd($urlFile);
            //view('reportar')->share('urlfile', $urlFile);

            $apoyo = Apoyosaldo::find($request->input('id_saldo'));
            //->where('actividad', 'Gestión Alimentaria')->orderBy('fecha', 'ASC')->get()
            //Pasando reservas a la vista
                    


            if ($file = true) {

                
                
                $nombrearchivo = explode("-", $name);
                //return back()->with('notificationArchivo', $urlFile);
                $apoyo->soportepago = 'CargadoCliente_'.$folderuser[0]."-".$nombrearchivo[1];
                $apoyo->save();

                ///return Storage::download(storage_path()."/app/private/".$folderuser[0]."-".$nombrearchivo[1]);
                
                return back()->with('notification', $urlFile);
            }

          

            
        }
        //return dd($apoyo);

        //return back();
    }

    public function verArchivo(Request $request, $path, $file)
    {
        $namefile = $path."/".$file;

        abort_if(
            ! Storage::disk('private') ->exists($namefile),
            404,
            "The file doesn't exist. Check the path."
        );

        //dd($namefile);
        return Storage::disk('private')->response($namefile);
    }

    public function storeContactForm(Request $request)
    {

        $incident = new Incident();
        $incident->severidad = $request->input('severity');
        $incident->descripcion = $request->input('description');
        $incident->category_id = $request->input('category_id');
        
        $incident->tipo_id = $request->input('tipo_id');

        

        $usuario = auth()->user();

                
        $incident->cliente_id = $usuario->id;

       
        $incident->project_id = $usuario->seleccionar_proyecto_id;
        $incident->level_id =  1;

        if($incident->project_id == null){
            $incident->project_id = 1;    
        }

       

        $incident->save();
    
        /*$contacto = new Contact();
        $contacto->name = $request->input('name');
        $contacto->email = $request->input('email');
        $contacto->phone = $request->input('phone');
        $contacto->subject = $request->input('subject');
        $contacto->message = $request->input('message');

        $usuario = auth()->user();*/

                
        //$incident->cliente_id = $usuario->id;

       
        /*$incident->project_id = $usuario->seleccionar_proyecto_id;
        $incident->level_id =  1;

        if($incident->project_id == null){
            $incident->project_id = 1;    
        }*/

        //$contacto->save();

        //$emails = ['bunpalmira@siliconvilla.online', $usuario->email ];

        //Mail::to($emails)->send(new NotificacionMail());
        /*$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);*/

        //$input = $request->all();

        //Contact::create($input);*/

        return redirect('home')->with('notification', 'Incidencia Creada Correctamente');
    }
}


