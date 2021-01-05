<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function like()
    {
        return $this->hasMany('App\Like')->where('LIKE', '=', '1');
    }
    public function category(){
        return $this->belongsToMany('App\Category', 'post_categories');
    }
    public function relationPostCategory($categories){
        foreach ($categories as $category){
            $rel = new PostCategories();
            $rel->category_id = $category;
            $rel->post_id = $this->id;
            $rel->save();
        }
    }
}
