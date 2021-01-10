<?php


namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePost;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($title)
    {
        Category::whereSlug($title)->firstOrFail();
//        Получить все посты для определенной категории
//        $posts = DB::table('category_post')
//            ->leftJoin('categories', 'categories.id', '=', 'category_post.category_id')
//            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
//            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
//            ->where('categories.title', $title)
//            ->get();

// Как сделать так же только с моделями
        $posts = Post::with('user', 'categories')->paginate(5);


        return view('categories.category', ['posts' => $posts]);
    }

}
