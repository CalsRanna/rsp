<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/3
 * Time: 23:06
 */

namespace Cals\RSPArchitecture\Services\Interfaces;


interface ServiceInterface
{
    /**
     * Store something.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs);

    /**
     * Get something by $credentials. Show columns provided in $columns.
     *
     * @param array $columns
     * @param array|null $credentials
     * @return mixed
     */
    public function get(array $columns = ['*'], array $credentials = null);

    /**
     * Update something by $credentials.
     *
     * @param array $inputs
     * @param array $credentials
     * @return mixed
     */
    public function update(array $inputs, array $credentials);

    /**
     * Destroy something by $credentials.
     *
     * @param array $credentials
     * @return mixed
     */
    public function destroy(array $credentials);
}