<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lng',
        'lat',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
