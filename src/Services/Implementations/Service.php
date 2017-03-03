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

class Service implements ServiceInterface
{
    private $repository;

    /**
     * ServiceImplementation constructor.
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

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