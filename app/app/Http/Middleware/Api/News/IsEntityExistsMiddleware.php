<?php

namespace App\Http\Middleware\Api\News;

use App\Models\News;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEntityExistsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $entityIdOrSlug = $request->route()->parameter('entity');

        if (
            !$entityIdOrSlug
            ||
            News::query()->where('id', $entityIdOrSlug)->orWhere('slug', $entityIdOrSlug)->doesntExist()
        ) {
            throw new ModelNotFoundException();
        }

        return $next($request);
    }
}
