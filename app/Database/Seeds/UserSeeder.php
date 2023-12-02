<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $data = [
            'name'     => 'Administrator',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);
    }
}
