<?php

namespace App\Models;

use App\Models\Bp;
use Carbon\Carbon;
use App\Models\Kfs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fps extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'tanggal'
    ];

    public function getTanggalAttribute($value) {
        return Carbon::parse($value)->format("d F Y");
    }

    public function kf(){
        return $this->belongsTo(Kfs::class, 'kf_id');
    }

    public function bp(){
        return $this->belongsTo(Bp::class, 'bps_id');
    }
}
