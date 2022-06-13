<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Platform::create([
            'title'=>'Web',
            'slug'=>'web',
            'fa' => 'fab fa-chrome'
        ])->save();

        Platform::create([
            'title'=>'Windows',
            'slug'=>'windows',
            'fa' => 'fab fa-windows'
        ])->save();

        Platform::create([
            'title'=>'Mac',
            'slug'=>'mac',
            'fa' => 'fab fa-apple'
        ])->save();

        Platform::create([
            'title'=>'iOS',
            'slug'=>'ios',
            'fa' => 'fas fa-mobile-alt'
        ])->save();

        Platform::create([
            'title'=>'Android',
            'slug'=>'android',
            'fa' => 'fab fa-android'
        ])->save();

        Platform::create([
            'title'=>'Linux',
            'slug'=>'linux',
            'fa' => 'fab fa-linux'
        ])->save();
    }
}
