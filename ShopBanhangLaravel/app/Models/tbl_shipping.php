<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_shipping extends Model
{
    protected $table='tbl_shipping';
    protected $primarykey='shipping_id';
    public $timestamps=true;
    protected $fillable=['shipping_name','shipping_email','shipping_address','shipping_phone','shipping_note'];
}
