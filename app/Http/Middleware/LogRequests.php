<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        Log::info('Request received', ['method' => $request->method(), 'url' => $request->url(), 'data' => $request->all(), 'response' => [
            'status' => $response->status(),
            'content' => $response->getContent()
        ]]);
        
        return $response;
    }
}