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
     * Store one record into database.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        return $this->repository->store($inputs);
    }

    /**
     * Get all records from the database.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Get some records with columns provided which satisfied credentials.
     *
     * @param array|null $credentials
     * @param array $columns
     * @return mixed
     */
    public function get(array $credentials = null, array $columns = ['*'])
    {
        return $this->repository->get($credentials, $columns);
    }

    /**
     * Get some records with columns provided which satisfied credentials, and sort by the field.
     *
     * @param array|null $credentials
     * @param array $columns
     * @param $field
     * @param $asc
     * @return mixed
     */
    public function getRecordsSortBy(array $credentials = null, array $columns = ['*'], $field = 'id', $asc = true)
    {
        return $this->repository->getRecordsSortBy($credentials, $columns, $field, $asc);
    }

    /**
     * Find the record which satisfied credentials.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function find(array $credentials = null)
    {
        return $this->repository->find($credentials);
    }

    /**
     * Update some records satisfied by credentials to new values provided.
     *
     * @param array $credentials
     * @param array $inputs
     * @return boolean
     */
    public function update(array $credentials, array $inputs)
    {
        return $this->repository->update($credentials, $inputs);
    }

    /**
     * Destroy some records satisfied by credentials.
     *
     * @param array $credentials
     * @return boolean
     */
    public function destroy(array $credentials)
    {
        return $this->repository->destroy($credentials);
    }
}
