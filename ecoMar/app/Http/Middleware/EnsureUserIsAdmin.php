<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !in_array($user->type, ['A', 'F'], true)) {
            abort(403, 'Acesso reservado à administração.');
        }

        return $next($request);
    }
}
