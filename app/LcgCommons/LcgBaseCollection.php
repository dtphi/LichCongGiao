<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/9/2020
 * Time: 2:06 PM
 */

namespace App\LcgCommons;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LcgBaseCollection extends ResourceCollection
{
    /**
     * @var array
     */
    public $json = [
        "code"    => 0,
        "message" => "",
        "result"  => []
    ];

    /**
     * @author : Phi .
     * BaseCollection constructor.
     * @param mixed $resource
     * @param array $data
     */
    public function __construct($resource, $data = [])
    {
        parent::__construct($resource);

        self::withoutWrapping();
        if (!empty($data)) {
            $this->json['result'] = array_merge($this->json['result'], $data);
        }
    }

    /**
     * @author : Phi .
     * @param array $data
     * @return $this
     */
    public function mergeDataJson($data = [])
    {
        $this->json['result'] = array_merge($this->json['result'], $data);

        return $this;
    }
}
