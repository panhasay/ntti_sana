<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CertMainModuleSeeder::class);
        $this->call(CertSubModuleSeeder::class);
        $this->call(CertStudentOfficialTranscriptCodeSeeder::class);
        $this->call(QualificationSeeder::class);
    }
}
