<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function categories(): HasMany
    {
        return $this->HasMany(Category::class,'language_id','id');
    }
    public function companies(): HasMany
    {
        return $this->HasMany(Company::class,'language_id','id');
    }
    public function medicines(): HasMany
    {
        return $this->HasMany(Medicine::class,'language_id','id');
    }
    public function medicineDetails(): HasMany
    {
        return $this->HasMany(MedicineDetail::class,'language_id','id');
    }
    public function medicineTypes(): HasMany
    {
        return $this->HasMany(MedicineType::class,'language_id','id');
    }

}
