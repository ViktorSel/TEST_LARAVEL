<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Rpc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = Http::retry(3, 100)->post('172.24.0.1:8002/api/data', [
                'jsonrpc'   => '2.0',
                'method'    => 'DataProcedure@create',
                'params'    => [
                    'url'           => $request->url(),
                    'visited_at'    => now(),
                ],
                'id'        => (string) Str::uuid(),
            ]);
            }
        catch(\Exception $ex) {

        }
        return $next($request);
    }
}
