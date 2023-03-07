<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_payment extends Model
{
    protected $primarykey='id';
    protected $table = 'tbl_payment';
    public $timestamp = true;
    protected $fillable = ['payment_method','payment_status'];
}
