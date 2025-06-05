<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qualification')->insert([
            ['code' => 'បន្តបរិញ្ញាបត្របច្ចេកវិទ្យា', 'name' => 'Bachelor of Technology', 'name_2' => 'បន្តបរិញ្ញាបត្របច្ចេកវិទ្យា', 'name_3' => NULL],
            ['code' => 'បរិញ្ញាបត្រ', 'name' => 'Bachelor Degree', 'name_2' => 'បរិញ្ញាបត្រ', 'name_3' => 'បរិញ្ញាបត្រ​បច្ចេកទេស'],
            ['code' => 'បរិញ្ញាបត្ររង', 'name' => 'Associate Degree', 'name_2' => 'បរិញ្ញាបត្ររង', 'name_3' => 'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស'],
            ['code' => 'សញ្ញាបត្រC1', 'name' => 'C1 degree', 'name_2' => 'សញ្ញាបត្រC1', 'name_3' => NULL],
            ['code' => 'សញ្ញាបត្រC2', 'name' => 'C2 degree', 'name_2' => 'សញ្ញាបត្រC2', 'name_3' => NULL],
            ['code' => 'សញ្ញាបត្រC3', 'name' => 'C3 degree', 'name_2' => 'សញ្ញាបត្រC3', 'name_3' => NULL],
            ['code' => 'អនុបណ្ឌិត', 'name' => 'Master', 'name_2' => 'អនុបណ្ឌិត', 'name_3' => 'បរិញ្ញាបត្រ​ជាន់ខ្ពស់បច្ចេកទេស'],
        ]);
    }
}
