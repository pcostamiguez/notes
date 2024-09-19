<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateSubmissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->generateKey($request);
        if (Cache::has($key)) {
            Log::info("Várias submissões detectadas. Key: $key");
            return response()->redirectToRoute("note.index")->with(['warning' => 'Várias submissões detectadas.']);
        }

        Cache::put($key, true, 5);

        return $next($request);
    }

    private function generateKey(Request $request): string
    {
        return md5($request->fullUrl() . '|' . $request->ip() . '|' . $request->session()->token());
    }


}
