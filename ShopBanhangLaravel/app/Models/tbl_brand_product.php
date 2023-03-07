<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_brand_product extends Model
{
    protected $primarykey='id';
    protected $table='tbl_brand_product';
    protected $timestamp=true;
    protected $fillable=[
        'brand_code','brand_name','brand_desc','brand_status'
    ];
    // public function product()
    // {
    //     return $this->hasMany(tbl_product::class,'brand_id');
    //     //return $this->hasMany('App\Models\tbl_product','brand');
    // }
}
