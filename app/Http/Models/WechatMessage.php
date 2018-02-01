<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'keywords',
            'message',
            'is_open',
    ];

    /**
    * 相册,
    * author  mhl,
    * relation  1_n,
    * date    2018-02-01 10:08:19,
    * @return @return \Illuminate\Database\Eloquent\Relations\
    */
    function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }


}
