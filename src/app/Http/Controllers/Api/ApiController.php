<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\CheckApp;
use App\Http\Utils\ActionHistory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ActionHistory;

    /**
     * @var string
     */
    public $appName = '121round';

    /**
     * @var int
     */
    protected $limit = 20;

    /**
     * @var string
     */
    protected $noImage = '/img/admin/no_image.png';

    /**
     * @var array
     */
    protected $data = [
    ];

    /**
     * @author : Phi .
     * BaseController constructor.
     * @param array $middleware
     */
    public function __construct($middleware = [])
    {
        $this->limit           = get_limit();
        $this->data['noImage'] = $this->noImage;
        $middleware[]          = CheckApp::class;

        return $this->middleware($middleware);
    }

    /**
     * @author : Phi.
     * @return int app limit .
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @author : Phi .
     * @param string $message
     * @return array
     */
    public function apiGetError($message = '入力項目に誤りがあります')
    {
        return [
            'code'    => Response::HTTP_BAD_REQUEST,
            'message' => $message,
            'result'  => []
        ];
    }

    /**
     * @author : Phi .
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function is121round(&$request)
    {
        $validator = Validator::make([
            'app'      => $request->get('app'),
            'app_name' => $this->appName
        ], [
            'app' => 'required|string|same:app_name'
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
