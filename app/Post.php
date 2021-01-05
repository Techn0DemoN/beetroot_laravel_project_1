<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany(Like::class)
            ->where('like','=', '1');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function createRelation(array $categories)
    {
        foreach ($categories as $category){
            $relation = new PostCategory();
            $relation->post_id = $this->id;
            $relation->category_id = $category;
            $relation->save();
        }

        return true;
    }

    public function addQrCode()
    {
        $this->qr = QrCode::generate(route('article_by_id', ['id' => $this->id]));
        $this->save();

        return true;
    }
}
