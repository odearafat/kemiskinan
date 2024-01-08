<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sls extends Model
{
    use HasFactory;
    protected $guarded=['idsls'];
    public $timestamps = false;
    public function kec(){
        return $this->belongsTo(Desa::class);
    }
}
