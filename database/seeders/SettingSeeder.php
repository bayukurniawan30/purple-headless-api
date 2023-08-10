<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['id' => Str::orderedUuid(), 'key' => 'timezone', 'value' => '(UTC+08:00) Asia/Makassar'],
            ['id' => Str::orderedUuid(), 'key' => 'dateformat', 'value' => 'F d, Y'],
            ['id' => Str::orderedUuid(), 'key' => 'timeformat', 'value' => 'g:i a'],
            ['id' => Str::orderedUuid(), 'key' => 'maintenance', 'value' => 'disabled'],
        ];

        DB::table('settings')->insert($settings);
    }
}
