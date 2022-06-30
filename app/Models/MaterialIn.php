<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialIn extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id_materials', 'qty', 'date', 'remark'];
}
