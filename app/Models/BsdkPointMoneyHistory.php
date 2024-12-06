<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsdkPointMoneyHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'description', 'order_code', 'point', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
