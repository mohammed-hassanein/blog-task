<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminUser
{
  private const ADMIN_EMAIL = 'admin@gmail.com';

  public function handle(Request $request, Closure $next): Response
  {
    if (! $request->user() || $request->user()->email !== self::ADMIN_EMAIL) {
      abort(Response::HTTP_FORBIDDEN, 'You are not authorized to access this area.');
    }

    return $next($request);
  }
}
