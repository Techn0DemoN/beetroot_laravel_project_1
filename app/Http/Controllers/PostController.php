<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('user', 'categories')->latest()->paginate(5),
            'categories' => Category::all()
        ]);
    }

    public function indexCategoryFilter($id)
    {
        return view('posts.index', [
            'posts' => Post::with('user', 'categories')
                ->whereHas('categories', function (Builder $query) use ($id) {
                    $query->where('category_id', $id);
                })
                ->latest()
                ->paginate(5),
            'categories' => Category::all()
        ]);
    }

    public function article($id)
    {
        $post = Post::with('likes')->find($id);
        return view('posts.article', ['post' => $post]);
    }

    public function add()
    {
        return view('posts.create', [
            'categories' => Category::all()
        ]);
    }

    public function addPost(CreatePost $request)
    {
        $data = $request->all();
        $image = $request->image->store('picture_for_card', 'public');

// This is validation example 1
//        $validator = Validator::make($data, [
//            'title' => 'required|max:255|min:10',
//            'description' => 'required',
//            'content' => 'required'
//        ]);

// This is validation example 2
//        if ($validator->fails()) {
//            return redirect(route('create_post'))
//                ->withErrors($validator)
//                ->withInput();
//        }

// This is validation example 3
//        $this->validate($request, [
//            'title' => 'required|max:255|min:10',
//            'description' => 'required',
//            'content' => 'required'
//        ],
//        [
//            'title.min' => 'Минимально 10 символов',
//            'description.required' => 'Объязательно заполнить!'
//        ]);
// The validation example 5 is located from other folder (App\Http\Requests\CreatePost)

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->image = $image;

        if ($post->save()) {
            $post->createRelation($data['categories']);
            $post->addQrCode();
        }

        return redirect(route('article_by_id', $post->id));
    }
}
