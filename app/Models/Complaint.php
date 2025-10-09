<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    protected $table = 'complaint';

    protected $fillable = ['title', 'description', 'category', 'status', 'longitude', 'latitude'];

    public function reporter(): BelongsTo {
        return $this->belongsTo(Reporter::class);
    }

    public function photo(): HasMany {
        return $this->hasMany(Photo::class);
    }
}