<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB ;
class UserTableSeeder extends Seeder {

  public function run() {

    $clients = [
      ['name' => 'ali','email'=>'ali@gmail.com'],
      ['name'=>'mohamed','email'=>'mohamed@gmail.com'],
      ['name'=>'saad','email'=>'saad@gmail.com'],
      ['name'=>'sara','email'=>'sara@gmail.com'],
      ['name'=>'ahmed','email'=>'ahmed@gmail.com'],
      ['name'=>'hamed','email'=>'hamed@gmail.com'],
      ['name'=>'adam','email'=>'adam@gmail.com'],
      ['name'=>'khaled','email'=>'khaled@gmail.com'],
      ['name'=>'abdallah','email'=>'abdallah@gmail.com'],
      ['name'=>'hamza','email'=>'hamza@gmail.com'],
    ];
    for ($i = 0; $i < 10; $i++) {
      $users [] = [
        'name'         => $clients[$i]['name'],
        'phone'        => "51111111$i",
        'email'        => $clients[$i]['email'],
        'password'     => bcrypt(123456),
        'is_blocked'      => rand(0, 1),
        'active'       => rand(0, 1),
      ];
    }

    DB::table('users')->insert($users) ; 
  }
}
