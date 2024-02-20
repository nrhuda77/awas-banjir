<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarianModel extends Model
{
    use HasFactory;
    protected $table = 'data_harian';
    protected $primaryKey = 'id_harian';
    protected $fillable = ['date_time', 'tinggi'];
}
