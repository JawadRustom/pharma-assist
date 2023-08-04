<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
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
    public function medicineDetails(): HasMany
    {
        return $this->HasMany(MedicineDetail::class,'medicine_type_id','id');
    }
    public function languages(): BelongsTo
    {
        return $this->BelongsTo(Language::class,'language_id','id');
    }
}
