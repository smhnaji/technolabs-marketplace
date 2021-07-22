<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Instanceof_;
use Symfony\Component\HttpFoundation\Response;

class SellerOwnsShop
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
            is_null($request->route('shop')) ||
            !($request->route('shop') instanceof Shop) ||
            $request->route('shop')->seller_id != $request->user()->id
        ) {
            throw new Exception('Only shop owners can access this content.', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
