<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'language_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'language_id'=>'integer',
    ];

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class,'company_id','id');
    }
    public function languages(): BelongsTo
    {
        return $this->BelongsTo(Language::class,'language_id','id');
    }
    public function photos()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }
}
