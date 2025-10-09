<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reporter extends Model
{
    protected $table = "reporter";

    protected $fillable = ['name', 'email'];

    public function complaint(): HasMany {
        return $this->hasMany(Complaint::class);
    }
}
