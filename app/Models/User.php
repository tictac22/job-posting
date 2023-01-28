<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasFactory;
	const UPDATED_AT = null;
	protected $primaryKey = 'user_id';
	protected $table = 'user';
	protected $fillable = ['name','lastname','email','password'];
}
