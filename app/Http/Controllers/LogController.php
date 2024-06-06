<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function store(Request $request)
    {
        // Valida la solicitud
        $request->validate([
            'level' => 'required|string',
            'message' => 'required|string',
            'context' => 'array',
        ]);

        // Registra el mensaje en el log
        $level = $request->input('level');
        $message = $request->input('message');
        $context = $request->input('context', []);

        Log::log($level, $message, $context);

        return response()->json(['status' => 'success']);
    }
}
