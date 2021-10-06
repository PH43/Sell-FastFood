<?php

use Illuminate\Database\Seeder;
use App\Model\Slider;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include 'data_faker/slider/slider.php';
        DB::table('slider')->insert($slide3);
    }
}
