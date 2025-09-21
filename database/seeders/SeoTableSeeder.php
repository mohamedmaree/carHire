<?php
namespace Database\Seeders;


use App\Models\Seo;
use Illuminate\Database\Seeder;
use DB;

class SeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr= [
            [
                'key' => 'home',
                'meta_title' => [ 'ar' => 'مرحبا بك في تطبيقنا' , 'en' => 'Welcome to our app' ],
                'meta_description' => [ 'ar' => 'مرحبا بك في تطبيقنا' , 'en' => 'Welcome to our app' ],
                'meta_keywords' => [ 'ar' => 'مرحبا بك في تطبيقنا' , 'en' => 'Welcome to our app' ],
            ],
        ];

      foreach ($arr as $key => $value) {
          Seo::create($value);
      }
    }
}
