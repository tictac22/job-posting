<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

	protected $fillable = ['company_name','job_title','location','tags','logo','description','user_id'];

	public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
