<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class DebugHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        $executionTime = round(($endTime - $startTime) * 1000, 2);

        $memoryUsages = round(($endMemory - $startMemory) / 1024, 2);

        $response->headers->set('X-Debug-Time', $executionTime . ' ms');
        $response->headers->set('X-Debug-Memory', $memoryUsages . ' KB');

        return $response;
    }
}
