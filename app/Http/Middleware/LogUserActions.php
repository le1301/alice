<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogUserActions
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check()) {
            // Registra a ação
            $user = auth()->user();
            $method = $request->method();
            $uri = $request->path();
            $ip = $request->ip();
            $time = now();

            $parameters = $request->all();
Log::info("Ação executada por usuário:", [
    'usuário_id' => $user->id,
    'nome' => $user->name,
    'método' => $method,
    'rota' => $uri,
    'ip' => $ip,
    'parâmetros' => $parameters,
    'timestamp' => $time,
]);

        }

        return $response;
    }
}
