<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoles extends Resources
{
    use HasFactory, SoftDeletes;
}
