<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post\Services\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $list = (new PostService())->listPosts();

        return (new Response($list));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request): Response
    {
        $user = $request->user();
        $DTO = $request->getDTO();
        (new PostService())->createPost($DTO, $user);

        return (new Response([], 201));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $post = (new PostService())->getPost($id);

        return (new Response($post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PostRequest $request, int $id): Response
    {
        $DTO = $request->getDTO();
        (new PostService())->updatePost($DTO, $id);

        return (new Response());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return Response
     */
    public function destroy(PostRequest $request, int $id): Response
    {
        (new PostService())->deletePost($id);

        return (new Response());
    }
}
