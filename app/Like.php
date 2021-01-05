<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'post_id', 'like'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function changeStatus()
    {
        $this->update([
            'like' => $this->like ? 0 : 1
        ]);

        return true;
    }
}