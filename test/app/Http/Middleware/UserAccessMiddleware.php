<?php

namespace App\Http\Middleware;

use App\Http\Services\TokenValidationService;
use Closure;
use Illuminate\Http\Request;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var TokenValidationService $tokenValidationService */
        $tokenValidationService = app(TokenValidationService::class);
        if (!$tokenValidationService->isValid($request->all())) {
            return response()->json([
                'error' => 'Ошибка авторизации в приложении',
                'error_key' => 'signature error'
            ]);
        }

        return $next($request);
    }
}
