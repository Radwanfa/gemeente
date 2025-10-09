<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessKey extends Model
{
    protected $table = "access_key";

    protected $fillable = ["key"];

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }
}
