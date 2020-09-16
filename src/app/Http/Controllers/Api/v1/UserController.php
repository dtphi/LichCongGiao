<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRequest;
use App\Services\Contracts\UserContract as UsSv;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    /**
     * @var null|UsSv
     */
    protected $usSv = null;

    /**
     * @author : Phi .
     * UserController constructor.
     * @param UsSv $userService
     */
    public function __construct(UsSv $userService)
    {
        $this->usSv = $userService;
        parent::__construct();
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data       = $this->data;
        $conditions = [];

        $json = $this->usSv->apiGetLists($conditions, $this->getLimit());

        return $json->mergeDataJson($data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param null $id
     * @return mixed
     */
    public function show(Request $request, $id = null)
    {
        $data = $this->data;

        $json = $this->usSv->apiGetDetail($id);

        return $json->mergeDataJson($data);
    }

    /**
     * @author : Phi .
     * @param UserRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $errors = $this->usSv->errors;
        $json   = [
            'errors' => [],
            'status' => Response::HTTP_OK
        ];

        try {
            $result = $this->usSv->apiInsert($request);
            $json   = $result->mergeDataJson($json);

        } catch (\PDOException $e) {
            $errors['db_error'][] = $e->getMessage();
        } catch (\Exception $e) {
            $errors['db_error'][] = $e->getMessage();
        }
        $json['errors'] = $errors;
        if (!empty($errors)) {
            $json['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response([
            'data' => $json,
        ], Response::HTTP_CREATED);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required|email',
            'password'   => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }
        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken(config('app.name'))->accessToken;

        return response()->json(['success' => $success], Response::HTTP_OK);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return array
     */
    public function checkAppVersion(Request $request)
    {
        try {
            if (! $this->is121round($request)) {
                $json = $this->apiGetError();
            } else {
                $json = $this->usSv->apiCheckAppVersion();
            }
        } catch (\Exception $e) {
            $json = $this->apiGetError();
        }

        return $json;
    }
}
