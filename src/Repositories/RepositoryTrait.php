<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 21:21
 */

namespace Cals\RSPArchitecture\Repositories;

/**
 * Trait RepositoryTrait
 *
 * @package Cals\RSPArchitecture\Repositories
 */
trait RepositoryTrait
{
    /**
     * Store one record into database.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        return $this->model->create($inputs);
    }

    /**
     * Get all records from the database.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Paginate the records which satisfied credentials.
     *
     * @param null $credentials
     * @param int $perPage
     * @return mixed
     */
    public function paginate($credentials = null, $perPage = 15)
    {
        $builder = $this->builder($credentials);
        return $builder->paginate($perPage);
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
        $builder = $this->builder($credentials);
        return $builder->get($columns);
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
        $builder = $this->builder($credentials);
        $sortedBuilder = $builder->orderBy($field, 'asc');
        if (!$asc) {
            $sortedBuilder = $builder->orderBy($field, 'desc');
        }
        return $sortedBuilder->get($columns);
    }

    /**
     * Find the record which satisfied credentials.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function find(array $credentials = null)
    {
        $builder = $this->builder($credentials);
        return $builder->first();
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
        $builder = $this->builder($credentials);
        $builder->update($inputs);
        return true;
    }

    /**
     * Destroy some records satisfied by credentials.
     *
     * @param array $credentials
     * @return boolean
     */
    public function destroy(array $credentials)
    {
        $builder = $this->builder($credentials);
        $builder->delete();
        return true;
    }

    /**
     * Provide an Eloquent builder with sure credentials.
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