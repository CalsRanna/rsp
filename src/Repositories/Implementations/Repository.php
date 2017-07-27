<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 20:52
 */

namespace Cals\RSP\Repositories\Implementations;

use Cals\RSP\Repositories\Exceptions\RepositoryException;
use Cals\RSP\Repositories\Interfaces\RepositoryInterface;
use Cals\RSP\Repositories\RepositoryTrait;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 *
 * @package Cals\RSP\Repositories\Implementations
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Container
     */
    private $app;
    /**
     * @var
     */
    protected $model;

    /**
     * Repository constructor.
     *
     * @param $app
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
