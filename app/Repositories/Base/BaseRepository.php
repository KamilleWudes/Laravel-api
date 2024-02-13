<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interface\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model){

        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }
    /**
     * Sets the relationship to be eagerly loaded.
     *
     * @param string|array $relationship
     * @return self
     */
     
     public function save($data)
     {
         return $this->model->create($data);
     }
    /**
     * Find all models by an array of attributes.
     *  
     * @param  array  $attributes
     * @return array
     */
     
    Public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    
    /**
     * update
     */
    public function update($data, $id)
    {
       return $this->model::where('id', $id)->update($data);
    }

    /**
     * delete
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    
}
