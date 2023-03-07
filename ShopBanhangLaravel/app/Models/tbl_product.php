<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tbl_product extends Model
{
    protected $primarykey = 'id';
    protected $table = 'tbl_product';
    public $timestamps = true;
    protected $fillable = [
        'product_code', 'product_name', 'category_code', 'brand_code', 'product_desc', 'product_content', 'product_price', 'product_image', 'product_status','brand_id','category_id'
    ];

    /**
     * Get the user that owns the tbl_product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(tbl_brand_product::class, 'brand_id');
    }
}
