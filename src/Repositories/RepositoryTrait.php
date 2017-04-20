<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 21:21
 */

namespace Cals\RSPArchitecture\Repositories;

use Illuminate\Foundation\Application;

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
    public function get(array $columns = ['*'], array $credentials = null)
    {
        $query = $this->model;
        foreach ($credentials as $key => $credential) {
            $query = $query->where($key, $credential);
        }
        $versions = explode('.', Application::VERSION);
        if ($versions[1] === '1') {
            return $query->lists($columns);
        } else {
            return $query->pluck($columns);
        }
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
        $query = $this->model;
        foreach ($credentials as $key => $credential) {
            $query = $query->where($key, $credential);
        }
        $models = $query->get();
        foreach ($models as $model) {
            $model->update($inputs);
        }
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
        $query = $this->model;
        foreach ($credentials as $key => $credential) {
            $query = $query->where($key, $credential);
        }
        return $query->delete();
    }

    /**
     * Provide the Eloquent builder.
     *
     * @return mixed
     */
    public function builder()
    {
        return $this->model;
    }
}