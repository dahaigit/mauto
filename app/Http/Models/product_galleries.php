<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGalleries extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'id',
            'product_id',
            'image',
    ];


}
