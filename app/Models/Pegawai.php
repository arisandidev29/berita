<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pegawai extends Model
{
    protected $table = "pegawai";    
    protected $fillable = [
        "nama",
        "jabatan",
        "user_id"
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,"user_id","id");
    }
}
