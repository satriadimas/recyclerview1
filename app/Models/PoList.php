<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoList extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id_po', 'id_supplier_good', 'qty', 'delivery_date'];
}
