<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventType;
class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//      View event
        $view = new EventType([
            "type" => "view"
        ]);
        $view->save();

//        Share event
        $share = new EventType([
            "type" => "share"
        ]);
        $share->save();
    }
}
