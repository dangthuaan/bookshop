<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'image',
        'title',
        'author',
        'category_id',
        'publisher',
        'publish_date',
        'language',
        'price',
        'user_id'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
