<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 5/22/2020
 * Time: 11:58 AM
 */

namespace App\Http\Utils;

use Illuminate\Pagination\LengthAwarePaginator;

trait Paginator
{
    /**
     * @var string
     */
    public static $textPerPage = 'textPerPage';

    /**
     * @var string
     */
    public static $textStartNo = 'startNo';

    /**
     * @author : Phi .
     * @param int $count
     * @param int $total
     * @return mixed
     */
    protected function _getTextPerPage($count = 0, $total = 0)
    {
        if ($count > 1) {
            $this->data[self::$textPerPage] = '1〜' . $count . '件 / 全' . $total . '件';
        } else {
            if ($count == 1) {
                $this->data[self::$textPerPage] = $count . '件 / 全' . $total . '件';
            }
        }

        return $this->data[self::$textPerPage];
    }

    /**
     * @author : Phi .
     * @param LengthAwarePaginator $paginator
     * @return mixed
     */
    protected function _getTextPagination(LengthAwarePaginator $paginator)
    {
        if ($paginator instanceof LengthAwarePaginator && $paginator->count()) {
            $data = $paginator->toArray();
            if ($data['total'] > 1) {
                $this->data[self::$textPerPage] = $data['from'] . '〜' . $data['to'] . '件 / 全' . $data['total'] . '件';
                $this->data[self::$textStartNo] = $data['from'];
            } elseif ($data['total'] == 1) {
                $this->data[self::$textPerPage] = '1件 / 全1件';
            }
        }

        return $this->data[self::$textPerPage];
    }

    /**
     * @author : Phi .
     * @param LengthAwarePaginator $paginator
     * @return mixed
     *
     */
    protected function _getTextTotalPagination(LengthAwarePaginator $paginator)
    {
        if ($paginator instanceof LengthAwarePaginator) {
            $data = $paginator->toArray();
            if ($data['total']) {
                $this->data[self::$textPerPage] = '全' . $data['total'] . '件';
                $this->data[self::$textStartNo] = $data['from'];
            }
        }

        return $this->data[self::$textPerPage];
    }

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getStartNo()
    {
        return $this->data[self::$textStartNo];
    }
}
