<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
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
        $posts = Post::with('user')->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    public function article($id)
    {
        $pageQR = $this->articleQRCode();

        $post = Post::find($id);
        return view('posts.article', ['post' => $post, 'pageQR' => $pageQR]);
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
        return view('posts.create');
    }

    public function addPost(CreatePost $request)
    {
        $data = $request->all();

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
        //image
        $post->image = $request->file('image')->store('', 'public');

        $post->save();

        return redirect(route('article_by_id', $post->id));
    }

}
