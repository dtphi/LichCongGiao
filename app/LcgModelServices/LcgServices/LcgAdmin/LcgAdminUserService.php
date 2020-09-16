<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/27/2020
 * Time: 2:50 PM
 */

namespace App\LcgModelServices\LcgServices\LcgAdmin;

use App\LcgModels\LcgAdmin;
use App\LcgModelServices\LcgContracts\LcgAdmin\LcgAdminUserContract;

class LcgAdminUserService implements LcgAdminUserContract
{
    private $user = null;

    public $sorts = [
        'registDateDesc'  => '新着順',
        'nameKanaAsc'     => 'カナ順',
        'organizationAsc' => '組織順'
    ];

    public function __construct()
    {
        $this->user = new LcgAdmin();
    }

    public function adGetLists($filters = [], $limit = 0)
    {
        // TODO: Implement adGetLists() method.
        $query = $this->user->select();

        if (isset($filters['name'])) {
            $query->filterLikeName($filters['name']);
        }

        if (isset($filters['sort']) && array_key_exists($filters['sort'], $this->sorts)) {
            $this->{$filters['sort']}($query);
        }

        if ($limit) {
            return $query->paginate($limit);
        }

        return $query;
    }

}
