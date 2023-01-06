<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class Agama extends Model
{
    use HasFactory;

    protected $table = "agama";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_agama'
    ];

    public function detail()
    {
        return $this->hasMany(Detail::class, 'id')->withDefault();
    }
}
