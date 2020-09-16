<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:44 AM
 */

namespace App\LcgCommons;

use App\LcgCommons\LcgContracts\LcgServiceContract;
use Auth;


class LcgService implements LcgServiceContract
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var null
     */
    public $version = null;
}
