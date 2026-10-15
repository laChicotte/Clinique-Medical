<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ask privately instead of keeping a shared administrator password in source.
        $password = $this->command?->secret('Mot de passe administrateur (12 caractères minimum, lettres et chiffres)');

        Validator::make(['password' => $password], [
            'password' => ['required', 'string', 'max:72', Password::min(12)->letters()->numbers()],
        ])->validate();

        (new \App\Models\User())->forceFill([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'employee_id' => 1,
            'role' => 'admin',
            'password' => Hash::make($password),
        ])->save();
    }
}
