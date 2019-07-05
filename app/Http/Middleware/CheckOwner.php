<?php

namespace App\Http\Middleware;

use Closure;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->list && !$request->list->is_public && $request->list->user_id != \Auth::user()->id) {
            return redirect()->route('list.index')->with('message', 'У вас нет прав на просмотр запрошенного списка');
        }

        return $next($request);
    }
}
