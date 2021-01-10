<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePost;
use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostController extends Controller
{
    /**
     * Main route
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('user')->with('categories')->paginate(5);

        $categories = Category::all();

        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    public function article($id)
    {
        $pageQR = $this->articleQRCode();

        $post = Post::with('user')->with('likes')->find($id);

        //Likes
        $likes = Like::where('post_id', $id)->where('liked', 1)->count('liked');

        return view('posts.article', ['post' => $post, 'pageQR' => $pageQR, 'like' => $likes]);
    }

    public function getLike($id)
    {
        $checkLike = Like::where('post_id', $id)->where('user_id', auth()->id())->where('liked', 1)->get();


        if ($checkLike->isEmpty()) {
            //create like
            Like::where('post_id', $id)->where('user_id', auth()->id())->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'post_id' => $id
                ],
                ['liked' => 1]);

        } else {
            // delete like
            Like::where('post_id', $id)->where('user_id', auth()->id())->delete();
        }


        return redirect()->back();
    }

    public function articleQRCode()
    {
        return QrCode::size(428)->generate(url()->current());
    }

    public function getWeather()
    {
        $array = ['temp' => 20, 'city' => 'Odesa', 'wind' => 33.3];

        return response()->json($array);
    }

    public function add()
    {
        $categories = Category::all();

        return view('posts.create', ['categories' => $categories]);
    }

    public function addPost(CreatePost $request)
    {
        $data = $request->all();
        $post = new Post();

        $post->user_id = Auth::id();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->image = $request->file('image')->store('', 'public');
        $post->save();

        $categories = $request->input('categories');

        if (!empty($categories))
            foreach ($categories as $category) {
                $categories = Category::find($category);
                $post->categories()->attach($categories);
            }


        return redirect(route('article_by_id', $post->id));
    }

}
