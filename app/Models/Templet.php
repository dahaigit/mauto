<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Templet extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'name',
            'category_id',
            'body',
            'weight',
    ];


}
