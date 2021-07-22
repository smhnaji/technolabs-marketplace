<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerOwnsProduct
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
        if (
            $request->user()->role != 'seller' ||
            !($request->product instanceof Product) ||
            $request->product->user_id != $request->user()->id
        ) {
            throw new Exception('Only product owners can access this content.', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
