<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
// 別のところ(https://github.com/morawskim/faker-images)から画像取得
use Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory {
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() {
		// 別のところから画像取得
		$faker = Faker\Factory::create();
		$faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
		$faker->addProvider(new \Mmo\Faker\LoremSpaceProvider($faker));
		$url = $faker->picsumUrl();

		//ディレクトリがなければ作成
		if (!Storage::exists('public/images')) {
			Storage::makeDirectory('public/images');
		}
		return [
			'name' => $url
		];
	}
}
