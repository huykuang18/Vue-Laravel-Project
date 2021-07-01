<?php
namespace App\Repositories\Post;

use App\Repositories\InterfaceBaseRepository;

interface InterfacePostRepository extends InterfaceBaseRepository
{
    public function all();

    public function create($data = []);

    public function update($id, $data = []);
 
    public function delete($id);
    
    public function find($id);
}