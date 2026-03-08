<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewsResult extends Model
{
    protected $table = "news_result";

    protected $fillable = [
        "news_draft_id",
        "title",
        "body",
        "is_published",
        "slug"
    ];

    public function newsDraf():BelongsTo {
        return $this->belongsTo(NewsDraf::class,"news_draft_id","id");
    }
}
