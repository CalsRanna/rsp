<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/3
 * Time: 23:08
 */

namespace Cals\RSPArchitecture\Services\Implementations;


use Cals\RSPArchitecture\Repositories\Interfaces\RepositoryInterface;
use Cals\RSPArchitecture\Services\Interfaces\ServiceInterface;

/**
 * Class Service
 *
 * @package Cals\RSPArchitecture\Services\Implementations
 */
class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Store something.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        return $this->repository->store($inputs);
    }

    /**
     * Get something by $credentials. Show columns provided in $columns.
     *
     * @param array $columns
     * @param array|null $credentials
     * @return mixed
     */
    public function get(array $columns = ['*'], array $credentials = null)
    {
        return $this->repository->get($columns, $credentials);
    }

    /**
     * Update something by $credentials.
     *
     * @param array $inputs
     * @param array $credentials
     * @return mixed
     */
    public function update(array $inputs, array $credentials)
    {
        return $this->repository->update($inputs, $credentials);
    }

    /**
     * Destroy something by $credentials.
     *
     * @param array $credentials
     * @return mixed
     */
    public function destroy(array $credentials)
    {
        return $this->repository->destroy($credentials);
    }

}