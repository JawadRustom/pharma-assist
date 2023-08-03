<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company_id',
        'category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'company_id'=>'integer',
        'category_id'=>'integer',
    ];

    public function companies(): BelongsTo
    {
        return $this->BelongsTo(Company::class,'company_id','id');
    }

    public function categories(): BelongsTo
    {
        return $this->BelongsTo(Category::class,'category_id','id');
    }

}
