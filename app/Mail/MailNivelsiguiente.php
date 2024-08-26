<?php

namespace App\Mail;
use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class MailNivelsiguiente extends Mailable
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
    public function build()
    {

        //$id = $request;
        $tipoNotif = "NextLevel";

        $usuario = auth()->user();

        $emailCliente = $usuario->email;
      
        //dd($id);
        return $this->view('correos.email')->with(compact('tipoNotif', 'emailCliente'));
    }
}
