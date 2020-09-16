<?php

namespace App\Http\Controllers;

use App\Http\Utils\ActionHistory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ActionHistory;

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
     * Controller constructor.
     */
    public function __construct()
    {
        $this->limit           = get_limit();
        $this->data['noImage'] = $this->noImage;
    }

    /**
     * @author : Phi.
     * @return int app limit .
     */
    public function getLimit()
    {
        return $this->limit;
    }
}
