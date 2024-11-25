<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyWebUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return ResponseHelper::fail(
                'Unauthenticated.',
                Response::HTTP_UNAUTHORIZED
            );
        } else {
            $token = $user->currentAccessToken();

            if (!$token) {
                return ResponseHelper::fail(
                    'Unauthorized.',
                    Response::HTTP_UNAUTHORIZED
                );
            }

            if ($token->name !== 'user' || !($user instanceof User)) {
                return ResponseHelper::fail(
                    'Forbidden.',
                    Response::HTTP_FORBIDDEN
                );
            }
        }  

        return $next($request);
    }
}
