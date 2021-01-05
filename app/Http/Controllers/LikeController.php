<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
    public function actionLike(Request $request)
    {
        $post_id = $request->id;
        $like = Like::where([['user_id', Auth::id()],['post_id', $post_id]])->first();


        if ($like)
        {
            $like->likePost();
        }
        else
        {
            $like = new Like([
                'user_id' => Auth::id(),
                'post_id' => $post_id,
                'like' => 1
            ]);
            $like->save();
        }

        return response()->json(['count_likes' => Like::where([['like', 1],['post_id', $post_id]])->count()]);
    }
}
