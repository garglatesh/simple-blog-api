<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\PostController;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
use Tests\TestCase;
use Mockery;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class PostControllerTest
 *
 * Unit tests for the PostController.
 */
class PostControllerTest extends TestCase
{
    protected $postService;
    protected $postController;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Mock the ResponseFactory to simulate JSON responses.
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->andReturnUsing(function ($data, $status) {
            return new JsonResponse($data, $status);
        });

        // Bind the mock ResponseFactory to the application container.
        $this->app->instance(ResponseFactory::class, $responseFactory);

        // Mock the PostService used by the PostController.
        $this->postService = Mockery::mock(PostService::class);

        // Initialize the PostController with the mocked PostService.
        $this->postController = new PostController($this->postService);
    }

    /**
     * Tear down the test environment.
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test that the index method returns all posts.
     */
    public function testIndexReturnsAllPosts()
    {
        // Create a collection of mock Post models.
        $posts = new Collection([
            new Post(['id' => 1, 'title' => 'Post 1', 'content' => 'Content 1']),
            new Post(['id' => 2, 'title' => 'Post 2', 'content' => 'Content 2']),
        ]);
        $this->postService->shouldReceive('getAllPosts')
            ->once()
            ->andReturn($posts);

        // Call the index method and capture the response.
        $response = $this->postController->index();

        // Assert that the response is a JSON response with the correct status and data.
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($posts->toArray(), $response->getData(true));
    }

    /**
     * Test that the show method returns a specific post by ID.
     */
    public function testShowReturnsPostById()
    {
        // Create a mock Post model.
        $post = new Post(['id' => 1, 'title' => 'Post 1', 'content' => 'Content 1']);

        $this->postService->shouldReceive('getPostById')
            ->once()
            ->with(1)
            ->andReturn($post);

        // Call the show method with a valid ID and capture the response.
        $response = $this->postController->show(1);

        // Assert that the response is a JSON response with the correct status and data.
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($post->toArray(), $response->getData(true));
    }

    /**
     * Test that the show method returns a 404 error if the post is not found.
     */
    public function testShowReturnsNotFoundIfPostDoesNotExist()
    {
       
        $this->postService->shouldReceive('getPostById')
            ->once()
            ->with(999)
            ->andThrow(new \Exception('Post not found'));

        // Call the show method with an invalid ID and capture the response.
        $response = $this->postController->show(999);

        // Assert that the response is a JSON response with a 404 status and error message.
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('Post not found', $response->getData(true)['message']);
    }
}
