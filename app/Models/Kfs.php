<?php

namespace App\Models;

use App\models\Bp;
use App\models\fps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kfs extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function fps() {
        return $this->hasMany(fps::class);
    }
}
