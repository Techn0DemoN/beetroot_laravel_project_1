<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy("id", 'desc')->paginate(5);
        return view('posts.index', ['posts'=>$posts]);
    }

    public function article($id)
    {
        $post = Post::find($id);
        return view('posts.article', ['post'=>$post]);
    }

    public function add()
    {
        return view('posts.create');
    }

    public function addPost(CreatePost $request)
    {
        $data = $request->all();
        $filePath = $request->file('file')->store('uploads');
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
        $post->image = $filePath;
        //$file->move($destinationPath,$file->getClientOriginalName());
        $post->save();

        return redirect(route('article_by_id', $post->id ));
    }

}
