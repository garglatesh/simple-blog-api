<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PostService
 *
 * This service handles the business logic of the Post model.
 * Use PostRepository to retrieve and manage post data.
 */
class PostService
{
    /**
     * PostService constructor.
     * 
     * @param PostRepository $postRepository The repository used for data access. 
     */
    public function __construct(private PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Retrieve all posts.
     *
     * This method fetches all posts from the repository.
     *
     * @return Collection|Post[]
     *         A collection of Post models.
     */
    public function getAllPosts(): Collection
    {
        return $this->postRepository->getAllPosts();
    }

    /**
     * Retrieve a specific post by its ID.
     *
     * This method fetches a single post by its ID from the repository.
     *
     * @param int $id The ID of the post to retrieve.
     *
     * @return Post
     *         The Post model associated with the given ID.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *         If the post with the given ID does not exist.
     */
    public function getPostById(int $id): Post
    {
        return $this->postRepository->findPostById($id);
    }
}
