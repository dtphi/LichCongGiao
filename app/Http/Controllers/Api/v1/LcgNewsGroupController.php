<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/23/2020
 * Time: 9:06 AM
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\LcgServices\LcgContracts\LcgNewsGroupContract as NewsGrSv;

class LcgNewsGroupController
{
    /**
     * @var UserSv|null
     */
    private $nwGrSv = null;

    /**
     * LcgNewsGroupController constructor.
     * @param NewsGrSv $nwGrSv
     */
    public function __construct(NewsGrSv $nwGrSv)
    {
        $this->nwGrSv = $nwGrSv;
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $json   = [
            'message' => '',
            'errors'  => '',
            'code'    => 200,
            'results'    => []
        ];
        $results = $this->nwGrSv->apiGetLists([], 2);
        $data = [
            'newsGroup' => $results
        ];

        $json['results'] = $data;

        return \response()->json($json);
    }
}
