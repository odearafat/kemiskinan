<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $guarded=['iddesa'];
    public $timestamps = false;

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }

    public function sls(){
        return $this->hasMany(Sls::class);
    }
}
