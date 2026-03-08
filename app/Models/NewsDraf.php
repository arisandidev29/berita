<?php

namespace App\Models;

use App\Observers\NewsDrafObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([NewsDrafObserver::class])]
class NewsDraf extends Model
{
    protected $table = "news_draf"; 

    protected $fillable = [
        "user_id",
        "title",
        "tokoh",
        "peristiwa",
        "lokasi",
        "waktu",
        "kronologi",
        "content_berita",
        "data_pendukung",
        "status",
        "image"
    ];

    protected $attributes = [
        "status" => "draft"
    ];

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function newsDrafConfig():HasOne {
        return $this->hasOne(NewsConfig::class,"news_draf_id","id");
    }

    public function newsResult():HasOne {
        return $this->hasOne(NewsResult::class,"news_draft_id","id");
    }
}
