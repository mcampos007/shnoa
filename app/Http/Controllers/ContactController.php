<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    //
    public function sendContactForm(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string|max:1000',
        ]);

        // Preparar los datos para el correo
        $data = [
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'mensaje' => $validated['mensaje'],
        ];

        // Enviar el correo
        Mail::send([], [], function ($message) use ($data) {
            $message->to(env('MAIL_USERNAME')) // Cambia por tu correo
                ->subject('Nuevo mensaje de contacto')
                ->text("Nombre: {$data['nombre']}\nCorreo: {$data['email']}\n\nMensaje:\n{$data['mensaje']}")
                ->replyTo($data['email']);
        });


        // Redirigir con un mensaje de éxito
        return back()->with('success', '¡Tu mensaje ha sido enviado correctamente!');
    }
}


