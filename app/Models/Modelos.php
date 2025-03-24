<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    protected $primaryKey = 'id_modelo';
    public $timestamps = false;
    use HasFactory;
}
