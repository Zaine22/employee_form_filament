<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class RPerson extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'relationship',
        'date_of_birth',
        'occupation'];
}
