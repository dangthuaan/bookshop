<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'total_price',
        'category_id',
        'description'
    ];

    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot('quantity');
    }
}
