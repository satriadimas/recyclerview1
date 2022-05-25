<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierGood extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['supplier_id', 'code', 'name', 'price', 'currency', 'unit'];
}
