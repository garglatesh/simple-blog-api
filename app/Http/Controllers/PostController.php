<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class PostController
 * 
 * This controller handles HTTP requests related to the Post model. 
 */
class PostController extends Controller
{
    
    /**
     * PostController constructor.
     * 
     * @param PostService $postService
     */
    public function __construct(private PostService $postService)
    {
       
    }

    /**
     * Fetch all blog posts.
     *
     * @return JsonResponse
     * 
     * @throws \Exception If an error occurs while fetching blog posts.
     */
    public function index(): JsonResponse
    {
        try {
            $posts = $this->postService->getAllPosts();
            return response()->json($posts, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching posts',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified blog post by ID.
     *
     * @param int $id The ID of the post.
     * 
     * @return JsonResponse
     * 
     * @throws \Exception If the blog post is not found or another error occurs.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $post = $this->postService->getPostById($id);
            return response()->json($post, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
