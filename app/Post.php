<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Post extends Model
{

    use Searchable;
    protected $guarded = array();
    protected $fillabel=[
       'user_id','category_id',
       'slug','title','body','featured',
       'status','published_at'
    ];


    public function user(){
      return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Categories::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function searchableAs()
    {
        return 'posts_index';
    }

}
