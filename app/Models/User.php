<?php

namespace App\Models;

use App\Models\Traits\HasTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasApiTokens, HasTokens {
        HasTokens::tokens insteadof HasApiTokens;
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
