<?php

namespace App\Http\Middleware;

use App\Models\AccessLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccessLinkIsValid
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $link = $request->route('accessLink');

        if (! $link instanceof AccessLink || ! $link->isValid()) {
            abort(404);
        }

        return $next($request);
    }
}
