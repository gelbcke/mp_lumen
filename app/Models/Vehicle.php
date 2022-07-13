<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'plate',
        'user_id'
    ];

    /**
     * Get vehicle owner
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
