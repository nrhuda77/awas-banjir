<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanjirModel extends Model
{
    use HasFactory;
    protected $table = 'data_banjir';
    protected $primaryKey = 'id_banjir';
    protected $fillable = ['wa', 'foto', 'tanggal_banjir', 'awal_banjir', 'akhir_banjir', 'height', 'status'];
}
