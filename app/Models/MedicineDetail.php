<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'medicine_type_id',
        'content',
        'medicine_id',
        'language_id',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'medicine_type_id'=>'integer',
        'medicine_id'=>'integer',
        'language_id'=>'integer',
        'user_id'=>'integer',
    ];
    public function medicineTypes(): BelongsTo
    {
        return $this->BelongsTo(MedicineType::class,'medicine_type_id','id');
    }

    public function medicines(): BelongsTo
    {
        return $this->BelongsTo(Medicine::class,'medicine_id','id');
    }
    public function languages(): BelongsTo
    {
        return $this->BelongsTo(Language::class,'language_id','id');
    }
    public function users(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }
}
