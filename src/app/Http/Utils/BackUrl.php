<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 5/22/2020
 * Time: 1:12 PM
 */

namespace App\Http\Utils;


trait BackUrl
{
    /**
     * @var string
     */
    protected static $strQuery = 'strQuery';

    /**
     * @var string
     */
    protected static $textBackUrl = 'strQuery';

    /**
     * @var string
     */
    public static $textQueryString = 'queryString';

    /**
     * @author : Phi .
     * @param string $path
     * @return string
     */
    protected function _getSuccessPathRedirect($path = '')
    {
        $strQ = \request()->get(self::$strQuery);
        if (!empty($strQ)) {
            return $path . '?' . $strQ;
        }

        return $path;
    }

    /**
     * @author : Phi .
     * @param string $path
     * @param array $strQuery
     * @return string
     */
    public function urlHttpBuildQuery($path = '', $strQuery = '')
    {
        if (!empty($path) && !empty($strQuery) && is_array($strQuery)) {
            return url($path . '?' . http_build_query($strQuery));
        } elseif (empty($strQuery) && !empty($this->data[self::$strQuery])) {
            if (is_array($this->data[self::$strQuery])) {
                return url($path . '?' . http_build_query($this->data[self::$strQuery]));
            } else {
                return url($path . '?' . $this->data[self::$strQuery]);
            }
        }

        return url($path);
    }

    /**
     * @author : Phi .
     * @param string $rName
     * @return $this
     */
    protected function _setCurBackUrl($rName = '')
    {
        $queryTarget = explode('?', back()->getTargetUrl());
        $strQuery    = isset($queryTarget[1]) ? explode('&',$queryTarget[1]) : [];
        $curStrQuery = (request()->getQueryString() ? explode('&', request()->getQueryString()): []);
        $backUrl     = isset($queryTarget[0]) ? trim($queryTarget[0], '/') : '';
        $curUrl      = route($rName);

        if (empty(array_diff($strQuery, $curStrQuery))
            && ($backUrl == $curUrl)) {
            $this->data[self::$strQuery] = request()->getQueryString();
        }

        return $this;
    }

    /**
     * @author : Phi .
     * @return array|null|string
     */
    public function getInputBackUrl()
    {
        return \request()->input(self::$textBackUrl);
    }

    /**
     * @author : Phi .
     * @param array $queryString
     */
    protected function _setQueryString($queryString = [])
    {
        \request()->session()->put(self::$textQueryString, $queryString);
    }

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getQueryString()
    {
        return request()->session()->get(self::$textQueryString);
    }
}
