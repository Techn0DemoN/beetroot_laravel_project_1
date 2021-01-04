<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function changeLikeAjax(Request $request)
    {
        $postId = $request->id;

        $like = Like::where([
            ['user_id', Auth::id()],
            ['post_id', $postId]
        ])->first();


        if ($like) {
            $like->changeStatus();
        } else {
            $like = new Like([
                'user_id' => Auth::id(),
                'post_id' => $postId,
                'like' => 1
            ]);
            $like->save();
        }

        return response()->json([
            'likeCount' => Like::where([
                ['like', 1],
                ['post_id', $postId]
            ])->count()
        ]);
    }
}
