<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PostRepository
 *
 * This repository handles data retrieval and management related to the Post model.
 */
class PostRepository
{
    /**
     * Retrieve all posts.
     *
     * @return Collection|Post[]
     *         A collection of Post models.
     */
    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    /**
     * Find a specific post by its ID.
     *
     * @param int $id The ID of the post to retrieve.
     *
     * @return Post
     *         The Post model associated with the given ID.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *         If the post with the given ID does not exist.
     */
    public function findPostById(int $id): Post
    {
        return Post::findOrFail($id);
    }
}
