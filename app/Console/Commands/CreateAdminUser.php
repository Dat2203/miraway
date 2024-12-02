<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');

        // Nhập mật khẩu và xác nhận mật khẩu
        do {
            $password = $this->secret('Enter admin password');
            $confirmPassword = $this->secret('Confirm admin password');

            if ($password !== $confirmPassword) {
                $this->error('Passwords do not match. Please try again.');
            }
        } while ($password !== $confirmPassword);

        // Kiểm tra email đã tồn tại chưa
        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists.');
            return;
        }

        // Tạo tài khoản admin
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true, // Đảm bảo bảng users có cột này
        ]);

        $this->info('Admin user created successfully!');
    }
}
