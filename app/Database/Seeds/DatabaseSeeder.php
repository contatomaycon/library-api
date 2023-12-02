<?php

namespace App\Database\Seeds;

class DatabaseSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('BookSeeder');
    }
}
