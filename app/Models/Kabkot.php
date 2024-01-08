<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    use HasFactory;
    public $timestamps = false;
    //protected $fillable=['idkabkot','nama'];
    protected $guarded=['idkabkot'];

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class);
    }
}
