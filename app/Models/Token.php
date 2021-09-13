<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\PersonalAccessToken;

class Token extends PersonalAccessToken
{
    use HasFactory;

    public function model()
    {
        return $this->morphTo('model');
    }

    public function tokenable()
    {
        return $this->model();
    }
}
