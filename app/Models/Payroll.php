<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'periode_bulan',
        'periode_tahun',
        'gaji_pokok',
        'total_tunjangan',
        'total_potongan',
        'gaji_bersih',
        'status',
        'generated_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
