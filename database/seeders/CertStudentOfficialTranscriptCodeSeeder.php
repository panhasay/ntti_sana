<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Certificates\CertStudentOfficialTranscriptCode;

class CertStudentOfficialTranscriptCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertStudentOfficialTranscriptCode::insert([
            ['code' => 'CD', 'qualification_code' => 'បរិញ្ញាបត្ររង', 'skills_code' => 'CL', 'active' => 1],
            ['code' => 'CE', 'qualification_code' => 'បរិញ្ញាបត្រ', 'skills_code' => 'CL', 'active' => 1],
            ['code' => 'ED', 'qualification_code' => 'បរិញ្ញាបត្ររង', 'skills_code' => 'ET', 'active' => 1],
            ['code' => 'EE', 'qualification_code' => 'បរិញ្ញាបត្រ', 'skills_code' => 'ET', 'active' => 1],
            ['code' => 'IT', 'qualification_code' => 'បរិញ្ញាបត្រ', 'skills_code' => 'IT', 'active' => 1],
            ['code' => 'ITD', 'qualification_code' => 'បរិញ្ញាបត្ររង', 'skills_code' => 'IT', 'active' => 1],
            ['code' => 'MCE', 'qualification_code' => 'អនុបណ្ឌិត', 'skills_code' => 'CL', 'active' => 1],
            ['code' => 'MEE', 'qualification_code' => 'អនុបណ្ឌិត', 'skills_code' => 'ET', 'active' => 1],
        ]);
    }
}
