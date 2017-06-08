<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 20:49
 */

namespace Cals\RSPArchitecture\Repositories\Interfaces;

/**
 * Interface RepositoryInterface
 *
 * @package Cals\RSPArchitecture\Repositories\Interfaces
 */
interface RepositoryInterface
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
     * @param array|null $credentials
     * @param array $columns
     * @return mixed
     */
    public function get(array $credentials = null, array $columns = ['*']);

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

    /**
     * Provide the query builder.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function builder(array $credentials = null);
}
