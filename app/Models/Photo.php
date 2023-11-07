<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'file_name',
    ];
    public function imageable():MorphTo
    {
      return $this->morphTo();
    }
}
