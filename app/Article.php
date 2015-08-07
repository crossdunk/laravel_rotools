<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	//
    protected $table = 'articles';
    protected $fillable = [
      'title',
      'body',
      'keyword',
      'user_id',
    ];
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
