<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePost;
use App\Post;
use App\PostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('user', 'category')->latest()->paginate(5);
        return view('posts.index', ['posts'=>$posts], ['categories'=>$categories]);
    }
    public function postByCategory($category)
    {
        $posts = Post::with('user', 'category')
            ->leftJoin('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->where('post_categories.category_id', '=', $category)
            ->paginate(5);
        $categories = Category::all();
        return view('posts.index', ['posts' => $posts], ['categories' => $categories]);

    }

    public function article($id)
    {
        $post = Post::with('like')->find($id);
        return view('posts.article', ['post'=>$post]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('posts.create')->with('categories', $categories);
    }

    public function addPost(CreatePost $request)
    {
        $data = $request->all();
        $image = $request->image->store('uploads', 'public');

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
        $post->description =  $data['description'];
        $post->content =  $data['content'];
        $post->image =  $image;
        $post->qr_code = QrCode::generate(URL::route('article_by_id', [$post->id]));
        $post->save();
        $post->relationPostCategory($data['categories']);
        return redirect(route('article_by_id', $post->id ));
    }
}
