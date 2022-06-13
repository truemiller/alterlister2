<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach ([
                     [
                         "title" => "Microsoft",
                         "slug" => "microsoft",
                         "link_1" => "//microsoft.com"
                     ],
                     [
                         "title" => "Google",
                         "slug" => "google",
                         "link_1" => "//google.com"
                     ],
                     [
                         "title" => "Apache Software Foundation",
                         "slug" => "apache",
                         "link_1" => "//apache.org/"
                     ],
                     [
                         "title" => "Mozilla Foundation",
                         "slug" => "mozilla",
                         "link_1" => "//mozilla.org/"
                     ],
                     [
                         "title" => "Discord",
                         "slug" => "discord",
                         "link_1" => "//discord.org/"
                     ],
                 ] as $publisher) {
            if(!\App\Models\Publisher::firstWhere("slug", $publisher["slug"])){
                (new \App\Models\Publisher)->fill($publisher)->save();
            } else {
                \App\Models\Publisher::firstWhere("slug", $publisher["slug"])->fill($publisher)->save();
            }
        }

    }
}
