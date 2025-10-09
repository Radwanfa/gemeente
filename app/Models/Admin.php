<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    protected $table = "admin";

    public function accessKey(): HasMany {
        return $this->hasMany(AccessKey::class);
    }
}
