<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudSchool extends Model
{
    use HasFactory;
	protected $table = 'crud_schools';
	protected $fillable = ['name'];	
}
