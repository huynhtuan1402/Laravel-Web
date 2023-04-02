<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order extends Model
{
    protected $primarykey = 'id';
    protected $table='tbl_order';
    public $timestamp=true;
    protected $fillable=['customer_id','shipping_id','order_total','order_status'];
}
