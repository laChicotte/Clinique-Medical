<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Employee::factory()->create([
            'doc_fname' => 'Admin',
            'doc_lname' => 'Admin',
            'doc_email' => 'admin@gmail.com',
            'doc_number' => 'A0000',   
            'doc_dept' => 'root',
            'has_account' => 1,
        ]);
    }
}
