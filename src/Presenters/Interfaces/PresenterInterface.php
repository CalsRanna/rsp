<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/4
 * Time: 0:21
 */

namespace Cals\RSPArchitecture\Presenters\Interfaces;


use Carbon\Carbon;

/**
 * Interface PresenterInterface
 *
 * @package Cals\RSPArchitecture\Presenters\Interfaces
 */
interface PresenterInterface
{
    /**
     * Limit the length of the specified field.
     *
     * @param $field
     * @param int $length
     * @return mixed
     */
    public function limitLength($field, $length = 40);

    /**
     * Differentiate the specified time form now for humans.
     *
     * @param Carbon $carbon
     * @return mixed
     */
    public function differentiateForHumans(Carbon $carbon);
}