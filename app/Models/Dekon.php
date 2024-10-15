<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekon extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function data__kelompoks()
    {
        return $this->belongsTo(Data_Kelompok::class);
    }
}
