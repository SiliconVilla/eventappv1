<?php

namespace App\Mail;
use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class NotificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {

        $id = $request->input('id');
        $severidad = $request->input('severity');
        $descripcion = $request->input('description');
        $category_id = $request->input('category_id');
        $tipo_id = $request->input('tipo_id');
        

        

        $usuario = auth()->user();

        $emailCliente = $usuario->email;
        




        /*
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');*/


        return $this->view('correos.email')->with(compact('id', 'severidad', 'descripcion', 'category_id', 'tipo_id', 'emailCliente'));
        

        //return $this->view('correos.email')->with(compact('name', 'email', 'phone', 'subject', 'message'));
    }
}
