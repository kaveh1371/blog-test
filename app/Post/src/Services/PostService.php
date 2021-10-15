<?php

namespace App\Post\Services;

use App\Models\Post;
use App\Models\User;
use App\Post\DataContracts\PostDTO;
use App\Post\Transformers\PostTransformer;

class PostService
{
    public function listPosts()
    {
        $postsList = Post::query()
            ->orderByDesc("created_at")
            ->get();

        return (new PostTransformer())->transformList($postsList);
    }

    public function getPost($id)
    {
        $post = Post::query()->findOrFail($id);

        return (new PostTransformer())->transformSingle($post);
    }

    public function createPost(PostDTO $DTO, User $user)
    {
        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $DTO->title;
        $post->content = $DTO->content;
        $post->save();
        $post->addMediaFromRequest("thumbnail")
            ->preservingOriginal()
            ->toMediaCollection();
    }

    public function updatePost(PostDTO $DTO, $id)
    {
        $post = Post::query()->findOrFail($id);
        $post->title = $DTO->title;
        $post->content = $DTO->content;
        $post->save();
        $post->addMediaFromRequest("thumbnail")
            ->preservingOriginal()
            ->toMediaCollection();
    }

    public function deletePost($id)
    {
        Post::query()->findOrFail($id)->delete();
    }
}
