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
        'generated_at',
        'status_pembayaran',
        'dibayar_at',
    ];

    protected $casts = [
        'dibayar_at' => 'datetime',
    ];

    /**
     * Cek apakah payroll ini sudah dibayar.
     */
    public function isSudahDibayar(): bool
    {
        return $this->status_pembayaran === 'sudah_dibayar';
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed();
    }
}
