<?php

use Illuminate\Database\Seeder;
use App\booth;
class BoothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(booth::class, $count)->create();
    }
}
