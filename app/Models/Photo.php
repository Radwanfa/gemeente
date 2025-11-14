<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $table = "photo";
    protected $fillable = ['file_path', 'mime_type'];

    public function complaint(): BelongsTo {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Get the URL for the photo
     */
    public function getUrlAttribute(): string
    {
        // Construct the path relative to storage/app/public
        // file_path is 'public/images/', so we remove 'public/' to get 'images/'
        $path = str_replace('public/', '', $this->file_path);
        return asset('storage/' . $path . $this->file_name);
    }
}
