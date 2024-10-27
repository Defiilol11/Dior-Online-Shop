<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::user();
        $userEmail = $user->email;
        $userName = $user->name;

        $vendedorEmail = 'carlitostaracenacoronado@gmail.com';

        $correoMensaje = "Has recibido un nuevo mensaje de contacto.\n\n";
        $correoMensaje .= "De: {$userName} ({$userEmail})\n";
        $correoMensaje .= "Título: {$request->title}\n\n";
        $correoMensaje .= "Mensaje:\n{$request->message}\n";

        Mail::raw($correoMensaje, function ($message) use ($userEmail, $userName, $vendedorEmail) {
            $message->to($vendedorEmail)
                    ->from($userEmail, $userName)
                    ->replyTo($userEmail)
                    ->subject('Nuevo mensaje de contacto');
        });

        return redirect('/')->with('success', 'Mensaje enviado con éxito.');
    }
}
