<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
