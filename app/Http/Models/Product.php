<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'category_id',
            'location_id',
            'brand_id',
            'thumbnail',
            'title',
            'sub_title',
            'keywords',
            'description',
            'price_origin',
            'price',
            'price_express',
            'point_max',
            'sale_min',
            'sale_max',
            'storage',
            'unit',
            'is_top',
            'is_hot',
            'is_new',
            'is_recommend',
    ];

    /**
    * 相册,
    * author  mhl,
    * relation  1_n,
    * date    2018-01-29 09:07:29,
    * @return @return \Illuminate\Database\Eloquent\Relations\
    */
    function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }


}
