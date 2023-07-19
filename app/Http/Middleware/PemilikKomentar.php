<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikKomentar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $comment = Comment::findOrFail($request->id);

        if ($comment->user_id != $user->id) {
            return response()->json(['message'=>'Data Not Found'], 404);
        }

        return $next($request);
    }
}
