<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategory extends Model
{
    use HasFactory;
    protected $table = 'kategory';
    protected $fillable = [
        'code_kategory','nama','description'
    ];
}
