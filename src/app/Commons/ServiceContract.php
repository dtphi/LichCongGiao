<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:43 AM
 */

namespace App\Commons;


interface ServiceContract
{
    /**
     * @author : Phi .
     * @return mixed
     */
    public function apiCheckAppVersion();

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getLastVersionByCreatedAt();

    /**
     * @author : Phi .
     * @param array $data
     * @return mixed
     */
    public function adInsertVersion($data = []);

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getDropOrg();

    /**
     * @author : Phi .
     * @param array $options
     * @return mixed
     */
    public function getSettingUser($options = []);

    /**
     * @author : Phi .
     * @param $name
     * @return mixed
     */
    public function adInsertLog($name);
}
