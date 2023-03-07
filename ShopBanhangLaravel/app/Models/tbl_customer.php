<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_customer extends Model
{
    protected $primarykey='customer_id';
    protected $table ='tbl_customer';
    public $timestamps=true;
    public $fillable=['customer_name','customer_email','customer_password','customer_phone'];
}
