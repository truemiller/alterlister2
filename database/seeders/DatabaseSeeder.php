<?php
namespace Database\Seeders;
    use App\Models\Entity;
    use App\Models\Category;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run ()
        {
            (new PlatformSeeder())->run();
            //Seed users
            $this->call(UserTableSeeder::class);
            // Seed publishers
            $this->call(PublisherSeeder::class);
            //Seed entities
            $this->call(CategoryTableSeeder::class);
            $this->call(EntityTableSeeder::class);
            //Seed events
            $this->call(EventTypeSeeder::class);
            //Seed platforms
            $this->call(EventSeeder::class);
        }
    }
