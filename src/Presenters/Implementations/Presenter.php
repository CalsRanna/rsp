<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/4
 * Time: 0:34
 */

namespace Cals\RSPArchitecture\Presenters\Implementations;

use Cals\RSPArchitecture\Presenters\Interfaces\PresenterInterface;
use Carbon\Carbon;

/**
 * Class Presenter
 *
 * @package Cals\RSPArchitecture\Presenters\Implementations
 */
class Presenter implements PresenterInterface
{
    /**
     * Limit the length of the specified field.
     *
     * @param $field
     * @param int $length
     * @return mixed
     */
    public function limitLength($field, $length = 40)
    {
        return str_limit($field, $length);
    }

    /**
     * Differentiate the specified time form now for humans.
     *
     * @param Carbon $carbon
     * @return mixed
     */
    public function differentiateForHumans(Carbon $carbon)
    {
        return $carbon->diffForHumans(Carbon::now());
    }

}