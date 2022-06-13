<?php
namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Seeder;

class EntityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        There are two (maybe three) entity types currently
        $entityTypes = [
            [
                "title" => "Software",
                "slug" => "software"
            ], [
                "title" => "Service",
                "slug" => "service"
            ]];

        foreach ($entityTypes as $entityType) {
            if (!EntityType::where('slug', $entityType['slug'])->first())
                print("Seeding: (EntityType) " . $entityType['slug'] . "\n");
                (new EntityType)->fill($entityType)->save();
        }


    }
}
