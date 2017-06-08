<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 21:21
 */

namespace Cals\RSPArchitecture\Repositories;

/**
 * Class RepositoryTrait
 *
 * @package Cals\RSPArchitecture\Repositories
 */
trait RepositoryTrait
{
    /**
     * Store something.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        return $this->model->create($inputs);
    }

    /**
     * Get something by $credentials. Show columns provided in $columns.
     *
     * @param array $columns
     * @param array|null $credentials
     * @return mixed
     */
    public function get(array $credentials = null, array $columns = ['*'])
    {
        $builder = $this->builder($credentials);
        return $builder->get($columns);
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
        $builder = $this->builder($credentials);
        $builder->update($inputs);
        return true;
    }

    /**
     * Destroy something by $credentials.
     *
     * @param array $credentials
     * @return mixed
     */
    public function destroy(array $credentials)
    {
        $builder = $this->builder($credentials);
        return $builder->delete();
    }

    /**
     * Provide the Eloquent builder.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function builder(array $credentials = null)
    {
        $builder = $this->model;
        foreach ($credentials as $key => $credential) {
            $builder = $builder->where($key, $credential);
        }
        return $builder;
    }
}