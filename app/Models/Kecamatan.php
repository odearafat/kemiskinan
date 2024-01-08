<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $guarded=['idkecamatan'];
    public $timestamps = false;
    public function kabkot(){
        return $this->belongsTo(Kabkot::class);
    }
    public function desa(){
        return $this->hasMany(Desa::class);
    }

}
