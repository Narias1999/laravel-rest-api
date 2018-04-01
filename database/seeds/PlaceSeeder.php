<?php
use App\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Place::create([
                'name' => $faker->name,
                'lat' => '12.4',
                'lng' => '12.8',
                'image_path' => $faker->imageUrl($width = 640, $height = 480),
                'description' => $faker->text
            ]);
        }
    }
}
