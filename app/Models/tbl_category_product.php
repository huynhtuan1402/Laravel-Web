<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_category_product extends Model
{
    protected $primarykey = 'category_id';
    protected $table = 'tbl_category_product';
    public $timestamps = true;
    protected $fillable = [
        'category_code','category_name', 'category_desc', 'category_status', 'created_at', 'updated_at'
    ];
    public function product()
    {
        return $this->hasMany(tbl_product::class);
    }
}