<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EndToEndTest extends TestCase
{
    use DatabaseTransactions; // rollback after test to not pollute DB

    public function test_full_application_flow()
    {
        // 1. Create Admin
        $adminUser = User::create([
            'name' => 'Admin Test E2E',
            'email' => 'admin.e2e@sigaji.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Login as Admin
        $response = $this->post('/login', [
            'email' => 'admin.e2e@sigaji.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect('/admin/dashboard');

        // 3. Create Employee Budi
        $response = $this->actingAs($adminUser)->post('/admin/karyawan', [
            'nip' => '1001-E2E',
            'nama' => 'Budi Tester E2E',
            'email' => 'budi.e2e@sigaji.com',
            'password' => 'password123',
            'jabatan' => 'Staff',
            'tanggal_masuk' => '2026-01-01',
            'gaji_pokok' => 5000000,
            'tunjangan_1' => 0,
            'tunjangan_2' => 0,
            'potongan' => 0,
        ]);
        $response->assertRedirect();
        
        $this->assertDatabaseHas('users', ['email' => 'budi.e2e@sigaji.com']);
        $this->assertDatabaseHas('employees', ['nip' => '1001-E2E']);

        // 4. Generate Payroll
        $currentMonth = str_pad(Carbon::now()->month, 2, '0', STR_PAD_LEFT);
        $currentYear = Carbon::now()->year;

        $response = $this->actingAs($adminUser)->post('/admin/payroll/generate', [
            'periode_bulan' => $currentMonth,
            'periode_tahun' => $currentYear,
        ]);
        $response->assertRedirect();
        
        $budiUser = User::where('email', 'budi.e2e@sigaji.com')->first();
        $budiEmployee = $budiUser->employee;
        
        $this->assertDatabaseHas('payrolls', [
            'employee_id' => $budiEmployee->id,
            'periode_bulan' => $currentMonth,
            'periode_tahun' => $currentYear,
            'gaji_bersih' => 5000000,
        ]);

        // 5. Logout
        $this->post('/logout');

        // 6. Login as Employee Budi
        $response = $this->post('/login', [
            'email' => 'budi.e2e@sigaji.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect('/employee/dashboard');

        // 7. Cek Dashboard Karyawan
        $response = $this->actingAs($budiUser)->get('/employee/dashboard');
        $response->assertStatus(200);
        $response->assertSee('5.000.000'); // Memastikan angka gaji muncul di tampilan
    }
}
