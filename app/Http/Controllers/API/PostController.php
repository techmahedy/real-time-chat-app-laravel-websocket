<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {

        // $this->middleware('auth:api');
    }

    public function index()
    {
        $posts = Post::with('user', 'category')->orderBy('id', 'desc')->get();

        return response()->json([
            "posts" => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'photo' => 'required',
        ]);

        $user = auth('api')->user();
        $user_id = $user->id;

        if ($request->photo) {

            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/') . $name);
            $request->merge(['photo' => $name]);
        }

        Post::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'photo' => $request->photo,
            'user_id' => $user_id,
            'status' => $request->status,
        ]);
        return ['message' => 'Success'];
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'post' => $post
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'photo' => 'required',
        ]);

        $user = auth('api')->user();
        $user_id = $user->id;

        $post = Post::find($id);
        $currentPhoto = $post->photo;

        if ($request->photo != $currentPhoto) {

            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/') . $name);
            $request->merge(['photo' => $name]);

            $postPhoto = public_path('img/profile/') . $currentPhoto;

            if (file_exists($postPhoto)) {

                @unlink($postPhoto);
            }
        }

        $post->update($request->all());

        return ['message' => 'Updated'];
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        $currentPhoto = $post->photo;

        if (file_exists($currentPhoto)) {

            @unlink($currentPhoto);
        }

        $post->delete();
        return ['message' => 'Deleted'];
    }
}
