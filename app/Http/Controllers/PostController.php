<?php

namespace App\Http\Controllers;

use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPost()
    {
        $posts = $this->postRepository->all();
        return $this->sendSuccess('All post', $posts, 200);
    }

    public function createPost(Request $request)
    {
        $post = $this->postRepository->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return $this->sendSuccess('Post created successfully',$post,200);
    }

    public function showPost($id)
    {
        $post = $this->postRepository->find($id);
        return $this->sendSuccess('Information',$post,200);
    }

    public function editPost($id,Request $request)
    {
        $post = $this->postRepository->update($id,[
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return $this->sendSuccess('Post updated successfully',$post,201);
    }

    public function deletePost($id)
    {
        $this->postRepository->delete($id);

        return $this->sendSuccess('Post number '.$id.' has deleted',[],200);
    }
}
