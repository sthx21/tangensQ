<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    use HasRoles;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'id'                           => 1,
            'title'                        => 'master',
            'first_name'                   => 'dev',
            'last_name'                    => 'shdw',
            'profile_id'                   => 1,
            'email'                        => 'dev@shdw',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        $admin->hasRole('super-admin');
        User::create([
            'id'                           => 3,
            'title'                        => 'controller',
            'first_name'                   => 'Jana',
            'last_name'                    => 'Thies',
            'profile_id'                   => 3,
            'email'                        => 'jana@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        User::create([
            'id'                           => 4,
            'title'                        => 'salesman',
            'first_name'                   => 'Thorsten',
            'last_name'                    => '',
            'profile_id'                   => 4,
            'email'                        => 'thorsten@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        User::create([
            'id'                           => 2,
            'title'                        => 'boss',
            'first_name'                   => 'Gerald',
            'last_name'                    => 'Doose',
            'profile_id'                   => 2,
            'email'                        => 'gerald@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        User::create([
            'id'                           => 5,
            'title'                        => 'officeLead',
            'first_name'                   => 'Andrea',
            'last_name'                    => 'Ahrweiler',
            'profile_id'                   => 5,
            'email'                        => 'andrea@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        User::create([
            'id'                           => 6,
            'title'                        => 'office',
            'first_name'                   => 'Cirsten',
            'last_name'                    => '',
            'profile_id'                   => 6,
            'email'                        => 'cirsten@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
        User::create([
            'id'                           => 7,
            'title'                        => 'guest',
            'first_name'                   => 'guest',
            'last_name'                    => '',
            'profile_id'                   => 1,
            'email'                        => 'guest@tq',
            'email_verified_at'            => now(),
            'password'                     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token'               => \Str::random(10)
        ]);
    }
}
