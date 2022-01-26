<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskPriceLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'ask_price_id',
        'partname',
        'machine',
      //  'quality',
        'qty',
    ];

     // model rection
     public function user()
     {
        return $this->belongsTo(User::class);
     }
     public function askPrice()
     {
        return $this->belongsTo(AskPrice::class);
         
     } 
}
