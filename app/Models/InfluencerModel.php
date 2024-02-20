<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerModel extends Model
{
    use HasFactory;
    protected $table = 'data_influencer';
    protected $primaryKey = 'id_influencer';
    protected $fillable = ['nama', 'no_wa', 'pekerjaan'];
}
