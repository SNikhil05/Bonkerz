<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsdkPoint extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
