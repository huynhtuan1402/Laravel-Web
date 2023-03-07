<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_admin extends Model
{
    protected $primarykey = 'admin_id';
    protected $table = 'tbl_admin';
    public $timestamps = false;
}
