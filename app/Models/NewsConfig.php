<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsConfig extends Model
{
    protected $table = "news_config";

    protected $fillable = [
        "news_draf_id",
        "tone_style",
        "prompt_mode",
        "custom_prompt_text",
        "strict_fact_mode"
    ];

    public function newsDraf():BelongsTo {
        return $this->belongsTo(NewsDraf::class,"news_draf_id","id");
    }


}
