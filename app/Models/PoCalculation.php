<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoCalculation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id_production', 'id_bom'];
}
