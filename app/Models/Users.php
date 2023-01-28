<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{
    use HasFactory;
	const UPDATED_AT = null;

	protected $fillable = ['name','lastname','email','password'];
}
