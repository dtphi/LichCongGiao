<?php

namespace App\Http\Middleware;

use App\Commons\ConstantService;
use Closure;

class CheckRole
{
    /**
     * @var array
     */
    private $routeType = [
        '1' => [],
        '2' => ['dashboard', 'user', 'info', 'faq'],
        '3' => ['dashboard', 'user', 'faq']
    ];

    /**
     * @var array
     */
    private $actionType = [
        '1' => [],
        '2' => [
            'dashboard' => ['*'],
            'user'      => ['*'],
            'base'      => ['*'],
            'info'      => ['*'],
            'exam'      => ['indexMiddlewareExam', 'download'],
            'faq'       => ['*']
        ],
        '3' => [
            'dashboard' => ['*'],
            'user'      => ['*'],
            'exam'      => ['indexMiddlewareExam', 'download'],
            'faq'       => ['*']
        ]
    ];

    /**
     * @var array
     */
    private $ajaxActions = [
        'getBase'
    ];

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
        $user = \Auth::user();
        if (!empty($request->segments())) {
            $segment = isset($request->segments()[1]) ? $request->segments()[1] : '';
            if (in_array($segment, $this->ajaxActions)) {
                return $next($request);
            }
        }
        if (!empty($request->segments()) && ($user->type != ConstantService::USER_TYPE_ADMIN)) {
            $segment = $request->segments()[0];

            $actions     = $this->actionType[$user->type][$segment] ?? [];
            $actionAllow = false;
            if (in_array('*', $actions)) {
                $actionAllow = true;
            } else {
                if (in_array($request->route()->getActionMethod(), $actions)) {
                    $actionAllow = true;
                }
            }

            if (!(in_array($segment,
                    $this->routeType[$user->type])) || !$actionAllow) {
                abort('404');
            }
        }

        return $next($request);
    }
}
