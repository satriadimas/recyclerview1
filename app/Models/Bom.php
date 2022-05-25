<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id_product', 'id_supplier_good', 'qty'];
}
