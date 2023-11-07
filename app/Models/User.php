<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'email',
        'password',
        'first_name',
        'last_name',
        'provider',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role_id'=>'integer',
        'phone_number'=>'integer',
    ];

    protected function  password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Hash::make($value),
        );
    }

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
    public function profiles() : HasMany
    {
        return $this->HasMany(Profile::class,'user_id','id');
    }
    public function categories() : HasMany
    {
        return $this->HasMany(Category::class,'user_id','id');
    }
    public function companies() : HasMany
    {
        return $this->HasMany(Company::class,'user_id','id');
    }
    public function medicines() : HasMany
    {
        return $this->HasMany(Medicine::class,'user_id','id');
    }
    public function medicineDetails() : HasMany
    {
        return $this->HasMany(MedicineDetail::class,'user_id','id');
    }
    public function medicineTypes() : HasMany
    {
        return $this->HasMany(MedicineType::class,'user_id','id');
    }

    /**
     * The medicines that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class);
    }
}
