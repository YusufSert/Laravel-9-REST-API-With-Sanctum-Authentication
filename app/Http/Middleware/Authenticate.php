<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    
    //frontend not need to store token with this
    public function handle($request, Closure $next, ...$guards)
    {
        if($jwt = $request->cookie( 'JWT'))
        {
            $request->headers->set('Authorization', 'Bearer '. $jwt); // İn every request set Authorizatiom header: with cookie esy
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
