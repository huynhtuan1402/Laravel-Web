<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order_details extends Model
{
    protected $primarykey = 'id';
    protected $table = 'tbl_order_details';
    public $timestamp = true;
    protected $fillable = ['order_id','product_id','product_name','product_price','product_sales_quantity'];
}
