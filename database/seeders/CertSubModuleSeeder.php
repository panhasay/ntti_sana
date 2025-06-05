<?php

namespace Database\Seeders;

use App\Models\Certificates\CertSubModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CertSubModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertSubModule::insert([
            [
                'id' => 1,
                'code' => 'MD_DE',
                'name_kh' => 'ប្រព័ន្ធគ្រប់គ្រងសញ្ញាបត្រ',
                'name_eng' => 'Degree Management System',
                'icon' => 'online-certification-illustrated-concept_23-2148570824.avif',
                'route' => 'degree',
                'controller' => 'DegreeManagement',
                'create_at' => '2025-01-27 19:22:40',
                'updated_at' => '2025-01-27 19:22:40',
                'active' => 1,
            ],
            [
                'id' => 2,
                'code' => 'MD_ID',
                'name_kh' => 'ប្រព័ន្ធគ្រប់គ្រងសញ្ញាបត្របណ្តោះអាសន្ន',
                'name_eng' => 'Interim degree management system',
                'icon' => 'distance-learning-infographic-concept_1284-17948.avif',
                'route' => 'interim_degree',
                'controller' => 'card',
                'create_at' => '2024-12-16 21:00:30',
                'updated_at' => '2024-12-16 21:00:30',
                'active' => 1,
            ],
            [
                'id' => 3,
                'code' => 'MD_CARD',
                'name_kh' => 'ប្រព័ន្ធគ្រប់គ្រងកាតសិស្ស',
                'name_eng' => 'Student Card Management System',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'student_card',
                'controller' => 'StudentCard',
                'create_at' => '2024-12-16 21:05:52',
                'updated_at' => '2024-12-16 21:05:52',
                'active' => 1,
            ],
            [
                'id' => 4,
                'code' => 'MD_TRANSCP',
                'name_kh' => 'Official Transcript',
                'name_eng' => 'Official Transcript',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'transcript',
                'controller' => 'OfficialTranscript',
                'create_at' => '2025-02-06 00:16:55',
                'updated_at' => '2025-02-06 00:16:55',
                'active' => 1,
            ],
            [
                'id' => 5,
                'code' => 'MD_PER',
                'name_kh' => 'ប្រព័ន្ធគ្រប់គ្រងការចូលប្រើ',
                'name_eng' => 'Access Management System',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'permission',
                'controller' => 'permissionCertificate',
                'create_at' => '2024-12-17 09:22:36',
                'updated_at' => '2024-12-17 09:22:36',
                'active' => 1,
            ],
        ]);
    }
}
