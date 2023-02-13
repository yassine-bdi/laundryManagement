<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    public function User() 
    {
        return $this->belongsTo(User::class); 
    }

    protected $casts = [
        'age' => "integer"
    ]; 
}
