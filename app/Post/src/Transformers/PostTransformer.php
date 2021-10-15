<?php

namespace App\Post\Transformers;

use App\Models\Post;

class PostTransformer
{
    public function transformList($postsList)
    {
        $output = [];
        foreach ($postsList as $post) {
            $output[] = $this->getPostData($post);
        }

        return $output;
    }

    public function transformSingle($post)
    {
        return $this->getPostData($post);
    }

    /**
     * @param $post
     * @return array
     */
    private function getPostData($post)
    {
        $user = $post->user;

        return [
            "title" => $post->title,
            "content" => $post->content,
            "thumbnail_path" => $this->getThumbnailsPath($post),
            "user" => [
                "name" => $user->name,
                "email" => $user->email,
            ],
        ];
    }

    private function getThumbnailsPath(Post $post): array
    {
        $thumbnails = $post->getMedia();
        $output = [];
        foreach ($thumbnails as $thumbnail) {
            $output[] = $thumbnail->getFullUrl();
        }

        return $output;
    }
}
