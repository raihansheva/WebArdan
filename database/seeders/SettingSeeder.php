<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'site_title'], ['value' => 'Default Title']);
        Setting::updateOrCreate(['key' => 'site_description'], ['value' => 'Default Description']);
        Setting::updateOrCreate(['key' => 'site_keyword'], ['value' => 'Default Keyword']);
        Setting::updateOrCreate(['key' => 'site_logo'], ['value' => null]);
        Setting::updateOrCreate(['key' => 'site_icon'], ['value' => null]);
    }
}
