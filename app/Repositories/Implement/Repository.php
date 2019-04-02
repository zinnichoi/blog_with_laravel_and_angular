<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 10:23
 */

namespace App\Repositories\Implement;

use App\Models\BaseModel;
use App\Repositories\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

abstract class Repository implements RepositoryInterface
{
    private $app;

    private $model;

    /**
     * Repository constructor.
     * @param $app
     * @throws \Exception
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }


    abstract public function model();

    /**
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception();
        }
        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function all(array $columns = [])
    {
        $columns = (empty($columns) ? Config::get('constants.ALL_COLUMN') : $columns);
        try {
            return $this->model->get($columns);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function paginate(int $perPage = 0, array $columns = [])
    {
        $perPage = ($perPage == 0) ? Config::get('constants.PER_PAGE_NUMBER') : $perPage;
        $columns = (empty($columns) ? Config::get('constants.ALL_COLUMN') : $columns);
        try {
            return $this->model->paginate($perPage, $columns);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @param $data
     * @return bool|null
     * @throws \Exception
     */
    public function create($data)
    {
        try {
            if ($data instanceof BaseModel) {
                return $data->save();
            }
            if (is_array($data)) {
                return $this->model->create($data);
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return null;
    }

    public function createBulk(array $data): bool
    {
        // TODO: Implement createBulk() method.
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function update($data, $id): bool
    {
        try {
            $model = $this->find($id);
            return $model->update($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateBulk(array $data): bool
    {
        // TODO: Implement updateBulk() method.
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $data['is_deleted'] = 1;
        return $this->update($data, $id);
    }

    /**
     * @param int $id
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function find(int $id, array $columns = [])
    {
        $columns = (empty($columns) ? Config::get('constants.ALL_COLUMN') : $columns);
        try {
            return $this->model->find($id, $columns);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $ids
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findIn(array $ids, array $columns = [])
    {
        $columns = (empty($columns) ? Config::get('constants.ALL_COLUMN') : $columns);
        try {
            return $this->model->whereIn(Config::get('constants.ID_COLUMN'), $ids)->get($columns);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param string $field
     * @param string $value
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findBy(string $field, string $value, array $columns = [])
    {
        $columns = (empty($columns) ? Config::get('constants.ALL_COLUMN') : $columns);
        try {
            return $this->model->where($field, $value)->first($columns);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}