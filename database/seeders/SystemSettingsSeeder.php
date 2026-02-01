<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::updateOrCreate(
            [],
            [
                'sitename' => 'Blog Management System',
                'sitelogo' => '',
                'favicon' => '',
                'supportemail' => 'support@gmail.com',
                'contactnumber' => '+91 9876543210',
                'address' => '123 Main Street, City, State 12345',
            ]
        );
    }
}
