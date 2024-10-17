<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Valida la entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Obtiene el correo y nombre del usuario autenticado
        $user = Auth::user();
        $userEmail = $user->email;
        $userName = $user->name;  // Asegúrate de que tengas el campo 'name' en la tabla de usuarios

        // Asigna el correo del vendedor
        $vendedorEmail = 'carlitostaracenacoronado@gmail.com'; // Cambia esto al correo del vendedor

        // Construye el contenido del correo
        $correoMensaje = "Has recibido un nuevo mensaje de contacto.\n\n";
        $correoMensaje .= "De: {$userName} ({$userEmail})\n";
        $correoMensaje .= "Título: {$request->title}\n\n";
        $correoMensaje .= "Mensaje:\n{$request->message}\n";

        // Envía el correo
        Mail::raw($correoMensaje, function ($message) use ($userEmail, $userName, $vendedorEmail) {
            $message->to($vendedorEmail)
                    ->from($userEmail, $userName) // Desde el correo y nombre del usuario autenticado
                    ->replyTo($userEmail)         // Configura el "reply-to" al correo del usuario
                    ->subject('Nuevo mensaje de contacto');
        });

        // Redirige a la página de inicio con un mensaje de éxito
        return redirect('/')->with('success', 'Mensaje enviado con éxito.');
    }
}
