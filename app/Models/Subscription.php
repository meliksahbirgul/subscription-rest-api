<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'user_id',
        'renewed_at',
        'expired_at',
    ];

    protected $dates = [
        'renewed_at',
        'expired_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
