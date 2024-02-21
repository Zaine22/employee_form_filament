<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory ,HasUuids;
    protected $guarded = [];

    public function address()
    {
        return $this->hasMany(Address::class);
    }
    public function work()
    {
        return $this->hasMany(WorkExp::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function nrcno()
    {
        return $this->belongsTo(Nrc::class);

    }
    public function rpeople(): HasMany
    {
        return $this->hasMany(Rperson::class);
    }
    public function fmember(): HasMany
    {
        return $this->hasMany(Fmember::class);
    }
}
