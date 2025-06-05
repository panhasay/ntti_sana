<?php

namespace Database\Seeders;

use App\Models\CertMainModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CertMainModuleSeeder extends Seeder
{
    public function run(): void
    {
        CertMainModule::updateOrCreate(
            ['id' => 1],
            [
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់',
                'name_eng' => 'Certificate Management System',
                'icon' => '/asset/NTTI/images/modules/group-grads-cap-gown-with-graduation-certificate_53876-75182.avif',
                'url' => 'certificate',
                'created_at' => '2024-12-03 11:53:53',
                'active' => 1,
            ]
        );
    }
}
