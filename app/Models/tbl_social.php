<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_social extends Model
{
    protected $table='tbl_social';
    protected $primarykey='id';
    public $timestamps=true;
    protected $fillable=['provider','provider_id','email','username'];
}
