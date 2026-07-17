<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jabatan',
        'tanggal_masuk',
        'gaji_pokok',
        'tunjangan_1',
        'tunjangan_2',
        'potongan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
