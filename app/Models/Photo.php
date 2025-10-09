<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    protected $table = "photo";
    protected $fillable = ['file_path', 'mime_type'];

    public function complaint(): BelongsTo {
        return $this->belongsTo(Complaint::class);
    }
}
