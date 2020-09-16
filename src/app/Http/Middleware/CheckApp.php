<?php

namespace App\Http\Middleware;

use App\Exceptions\JsonMsgCommon;
use Closure;
use Validator;

class CheckApp
{
    /**
     * @var string
     */
    public $appName = '121round';

    /**
     * @author : Phi .
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make([
            'app'      => $request->get('app'),
            'app_name' => $this->appName
        ], [
            'app' => 'required|string|same:app_name'
        ]);

        if ($validator->fails()) {
            throw new JsonMsgCommon();
        }

        return $next($request);
    }
}
