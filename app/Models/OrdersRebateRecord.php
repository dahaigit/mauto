<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersRebateRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'invite_code',
            'id_code',
            'cart_id',
            'order_id',
            'status',
            'babysitter_rebate',
            'remark',
            'company_rebate',
    ];


}
