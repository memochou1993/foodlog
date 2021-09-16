<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Post::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::query()
            ->where('is_archived', false)
            ->paginate();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return PostResource
     */
    public function store(PostStoreRequest $request): PostResource
    {
        /** @var User $user */
        $user = $request->user();

        collect($request->file('files'))->each(function (UploadedFile $file) {
            $key = Str::uuid()->getHex();
            $ext = $file->extension();
            $file->store("$key.$ext");
        });

        $post = $user->posts()->create($request->input());

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param PostShowRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function show(PostShowRequest $request, Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post): PostResource
    {
        $post->update($request->input());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
