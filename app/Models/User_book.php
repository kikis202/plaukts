<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_book extends Model
{
    use HasFactory;

    public function plaukts(){
        return $this->belongsTo(Plaukts::class);
    }
    
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
