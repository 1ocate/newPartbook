<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    // model rection
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function askPriceLines()
    {
        return $this->hasMany(AskPriceLine::class);
        
    } 
}