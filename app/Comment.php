<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = [
      'title',
      'body',
      'user_id',
      'article_id',
    ];
    public function post()
    {
      return $this->belongsTo('\App\Article');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
