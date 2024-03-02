<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkModel extends Model
{
    use HasFactory;
    protected $table = 'check';
    protected $primaryKey = 'id_check';
    protected $fillable = ['next_insert', 'tinggi'];
    public $timestamps = false;
}
