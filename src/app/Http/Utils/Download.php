<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 5/22/2020
 * Time: 11:54 AM
 */

namespace App\Http\Utils;

use Illuminate\Http\UploadedFile;

trait Download
{
    /**
     * @author : Phi .
     * @param string $pathFile
     * @param string $pathUrl
     * @return array
     */
    protected function _getFileInfo($pathFile = '', $pathUrl = '')
    {
        $result = [
            'href'          => '',
            'name'          => '',
            'backgroundUrl' => ''
        ];
        if (empty($pathUrl)
            && method_exists($this, 'getPathFileUrl')) {
            $pathUrl = $this->getPathFileUrl();
        }
        if (!empty($pathFile)) {
            $arrName = explode('.', $pathFile);
            $time    = $arrName[0];
            unset($arrName[0]);
            $imgName = implode('.', $arrName);

            $result['href']          = url($pathUrl . $time . '?' . http_build_query(['name' => $imgName]));
            $result['name']          = $imgName;
            $result['backgroundUrl'] = url($this->imgPath . $pathFile);
        }

        return $result;
    }

    /**
     * @author : Phi .
     * @param UploadedFile|null $file
     * @param string $dir
     * @param string $secondSeed
     * @return string
     */
    protected function _uploadFile(UploadedFile $file = null, $dir = '', $secondSeed = null)
    {
        if ($file instanceof UploadedFile && !empty($dir)) {
            $fileName = (time() + (int)$secondSeed) . '.' . $file->getClientOriginalName();

            $file->move($dir, $fileName);

            return $fileName;
        }

        return '';
    }

    /**
     * @author : Phi .
     * @param string $memoryLimit
     * @param int $maxExecutionTime
     */
    protected function _configDownload($memoryLimit = '512M', $maxExecutionTime = 0)
    {
        ini_set('memory_limit', $memoryLimit);
        ini_set('max_execution_time', $maxExecutionTime);

        if (config('app.debug')) {
            error_reporting(E_ALL);
            ini_set('display_errors', true);
            ini_set('display_startup_errors', true);
        } else {
            error_reporting(0);
        }
    }

    /**
     * @author : Phi .
     * @param array $params
     * $params['action'] = 'download' return true.
     * @return bool
     */
    protected function _isDownload($params = [])
    {
        $flagDownload = false;
        if (isset($params['_action']) && $params['_action'] == 'download') {
            $this->limit  = 0;
            $flagDownload = true;
        }

        return $flagDownload;
    }

    /**
     * @author : Phi .
     * @param string $pathUrl
     * @param array $queryString
     * @return string
     */
    protected function _getDownloadUrl($pathUrl = '/', $queryString = [])
    {
        if (empty($queryString)) {
            return url($pathUrl) . '?_action=download';
        }

        return url($pathUrl) . '?_action=download&' . http_build_query($queryString);
    }
}
