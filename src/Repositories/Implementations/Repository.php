<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 20:52
 */

namespace Cals\RSPArchitecture\Repositories\Implementations;


use Cals\RSPArchitecture\Repositories\Exceptions\RepositoryException;
use Cals\RSPArchitecture\Repositories\Interfaces\RepositoryInterface;
use Cals\RSPArchitecture\Repositories\RepositoryTrait;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    private $app;
    protected $model;

    /**
     * Repository constructor.
     *
     * @param $app
     * @param $model
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get the full name of model.
     *
     * @return mixed
     */
    abstract function model();

    /**
     * Make an instance of model.
     *
     * @return Model|mixed
     * @throws RepositoryException
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    use RepositoryTrait;
}
