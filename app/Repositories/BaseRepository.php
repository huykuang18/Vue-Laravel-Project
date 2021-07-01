<?php
namespace App\Repositories;

use App\Repositories\InterfaceBaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements InterfaceBaseRepository
{
    protected $model;
 
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
 
    public function all()
    {
        return $this->model->paginate();
    }
 
    public function create($data = [])
    {
        return $this->model->create($data);
    }
 
    public function update($id, $data = [])
    {
        $record = $this->model->findOrFail($id);
 
        return $record->update($data);
    }
 
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
 
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
}