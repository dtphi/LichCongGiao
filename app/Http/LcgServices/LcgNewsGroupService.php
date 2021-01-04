<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/24/2020
 * Time: 4:31 PM
 */

namespace App\Http\LcgServices;

use App\Http\LcgServices\LcgContracts\LcgNewsGroupContract;
use App\Http\LcgServices\LcgModels\LcgNewsGroup;
use App\Http\Resources\LcgNewsGroup\LcgNewsGroupCollection;

class LcgNewsGroupService implements LcgNewsGroupContract
{
    private $newsGr = null;

    /**
     * @author : Phi .
     * LcgUserService constructor.
     */
    public function __construct()
    {
        $this->newsGr = new LcgNewsGroup();
    }

    /**
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return LcgUserCollection
     */
    public function apiGetLists($filters = [], $limit = 0)
    {
        // TODO: Implement apiGetLists() method.
        $query = $this->newsGr->orderByCreatedAtDesc();

        $results = new LcgNewsGroupCollection(LcgNewsGroup::paginate());

        return $results;
    }
}
