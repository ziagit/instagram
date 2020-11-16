<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Constructor.
     */
    public function _construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Ammount to fetch
        $count = 20;

        Request::validate([
            'page' => 'nullable|numeric',
        ]);

        //$_GET ?page=count, default 1
        $page = intval(Request::query('page', 1));
        $pageCount = Post::count();

        //Posts
        $posts = Post::with(['likes', 'user'])
        ->orderBy('id', 'desc')
        ->skip($count * ($page - 1))
        ->take($count)
        ->get();

        return view('posts.index', [
            'posts' => $posts,
            'pagination' => [
                'current' => $page,
                'count' => intval(ceil($pageCount / $count)),
            ],
        ]);
    }

    /**
     * Display liked posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function liked()
    {
        //Ammount to fetch
        $count = 20;

        Request::validate([
            'page' => 'nullable|numeric',
        ]);

        //$_GET ?page=count, default 1
        $page = intval(Request::query('page', 1));
        $pageCount = Post::whereIn('id', function ($query) {
            return $query->select('post_id')->from('likes')->where('user_id', Auth::id());
        })->count();


        //Posts
        $posts = Post::with(['likes', 'user'])
            ->whereIn('id', function ($query) {
                return $query->select('post_id')->from('likes')->where('user_id', Auth::id());
            })
            ->orderBy('id', 'desc')
            ->skip($count * ($page - 1))
            ->take($count)
            ->get();

        return view('posts.index', [
            'posts' => $posts,
            'pagination' => [
                'current' => $page,
                'count' => intval(ceil($pageCount / $count)),
            ],
        ]);
    }

    /**
     * Display listings posted by followed users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        //Ammount to fetch
        $count = 20;

        Request::validate([
            'page' => 'nullable|numeric',
        ]);

        //$_GET ?page=count, default 1
        $page = intval(Request::query('page', 1));
        $pageCount = Post::whereIn('user_id', function ($query) {
            return $query->select('user_2')->from('follows')->where('user_1', Auth::id());
        })->count();

        //Posts
        $posts = Post::with(['likes', 'user'])
        ->whereIn('user_id', function ($query) {
            return $query->select('user_2')->from('follows')->where('user_1', Auth::id());
        })
        ->orderBy('id', 'desc')
        ->skip($count * ($page - 1))
        ->take($count)
        ->get();

        return view('posts.index', [
            'posts' => $posts,
            'pagination' => [
                'current' => $page,
                'count' => intval(ceil($pageCount / $count)),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Request::validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:128',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images').'/posts/', $imageName);

        $post = new Post();

        $post->user_id = Auth::id();
        $post->image = $imageName;
        $post->description = request()->description;

        $post->save();

        return redirect('posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.index', [
            'posts' => [Post::findOrFail($id)],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post = Post::find($id);

        //Only save if currently logged in users id matches orginal posters user id (Might not be needed)
        if (intval($post->user_id) === Auth::id()) {
            Request::validate([
                'description' => 'required|max:255',
            ]);

            $post->description = request()->description;

            $post->save();
        }

        return redirect('posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (intval($post->user_id) === Auth::id()) {
            $post->delete();
        }

        return redirect('posts/');
    }

    /**
     * Like a listing of the resource.
     *
     * @param int $id
     */
    public function like($id)
    {
        $record = Like::where([
            ['user_id', Auth::id()],
            ['post_id', $id],
        ]);

        //If our record doesn't exist we create it
        if (null === $record->first()) {
            $like = new Like();

            $like->user_id = Auth::id();
            $like->post_id = $id;
            $like->save();

        //If it exists we delete it
        } else {
            $record->delete();
        }

        return response()->json(null, 200);
    }
}
