<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmumModel extends Model
{
    use HasFactory;
    protected $table = 'data_umum';
    protected $primaryKey = 'id_umum';
    protected $fillable = ['description_wa'];
}
