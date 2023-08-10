<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function service() 
    {
        return $this->belongsTo(Service::class); 
    }

    public function laundry()
    {
        return $this->belongsTo(Laundry::class); 
    }

    protected $fillable = [
        'service_id',
        'laundry_id',
        'price'
    ]; 

}
