<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        return view('posts.index', [
            'posts' => Post::where('title', 'like', '%' . $search . '%')
                ->latest()
                ->paginate(5)
                ->setPath('')
                ->appends([
                    'search' => $search
                ]),
            'categories' => Category::all(),
            'characterSearch' => $search
        ]);
    }

    public function getSearchOptionsAjax(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->value . '%')
            ->take(5)
            ->get();

        $firstFive = '';
        foreach ($posts as $post){
            $firstFive .= '<a class="dropdown-item" href="javascript:void(0)"
            style=" overflow: hidden; text-overflow: ellipsis;" onclick="submit(\''.$post->title.'\')">'.$post->title.'</a>';
        }

        return response()->json([
            'result' => $firstFive,
        ]);
    }
}
