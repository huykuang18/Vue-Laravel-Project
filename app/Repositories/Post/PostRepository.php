<?php
namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements InterfacePostRepository
{
    protected $post;
 
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
 
    public function all()
    {
        return $this->post->get();
    }

    public function create($data = [])
    {
        return $this->post->create($data);
    }

    public function update($id, $data = [])
    {
        $record = $this->post->findOrFail($id);
 
        return $record->update($data);
    }
 
    public function delete($id)
    {
        return $this->post->destroy($id);
    }
 
    public function find($id)
    {
        return $this->post->find($id);
    }
}