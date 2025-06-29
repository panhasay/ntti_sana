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
        $now = now();

        CertSubModule::insert([
            [
                'id' => 1,
                'code' => 'MD_DE',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងសញ្ញាបត្រ',
                'name_eng' => 'Degree Management System',
                'icon' => 'online-certification-illustrated-concept_23-2148570824.avif',
                'route' => 'degree',
                'controller' => 'DegreeManagement',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 1,
            ],
            [
                'id' => 2,
                'code' => 'MD_ID',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងវិញ្ញាបនបត្របណ្តោះអាសន្ន',
                'name_eng' => 'ProvisionalCertificate System',
                'icon' => 'distance-learning-infographic-concept_1284-17948.avif',
                'route' => 'provisional_certificate',
                'controller' => 'ProvisionalCertificate',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 1,
            ],
            [
                'id' => 3,
                'code' => 'MD_CARD',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងកាតសិស្ស',
                'name_eng' => 'Student Card Management System',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'student_card',
                'controller' => 'StudentCard',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 1,
            ],
            [
                'id' => 4,
                'code' => 'MD_TRANSCP',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងបញ្ជាក់ប្រតិបត្តិពិន្ទុ',
                'name_eng' => 'Official Transcript',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'transcript',
                'controller' => 'OfficialTranscript',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 1,
            ],
            [
                'id' => 5,
                'code' => 'MD_PER',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងការចូលប្រើ',
                'name_eng' => 'Access Management System',
                'icon' => 'student-id-card-identification-data-information-education-concept_53876-132190.avif',
                'route' => 'permission',
                'controller' => 'permissionCertificate',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 0,
            ],
            [
                'id' => 7,
                'code' => 'MD_COSS',
                'name_kh' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់ការសិក្សា',
                'name_eng' => 'Certification Of Student Status',
                'icon' => 'distance-learning-infographic-concept_1284-17948.avif',
                'route' => 'student-status',
                'controller' => 'StudentStatusCertificate',
                'create_at' => $now,
                'updated_at' => $now,
                'active' => 1,
            ],
        ]);
    }
}
