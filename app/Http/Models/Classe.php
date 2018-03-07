<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'grade_name',
            'alias_name',
            'number',
            'year',
            'status',
    ];


}
