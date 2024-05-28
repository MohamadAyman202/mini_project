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
        Setting::query()->create([
            'title' => 'توريداتي',
            'facebook' => 'https://www.facebook.com',
            'instagram' => 'https://www.instagram.',
            'twitter' => 'https://www.twitter.com',
        ]);
    }
}
