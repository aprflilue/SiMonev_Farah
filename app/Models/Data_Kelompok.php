<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Kelompok extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function tps()
    {
        return $this->hasMany(Tp::class);
    }
}
