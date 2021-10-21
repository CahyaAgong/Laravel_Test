<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $data = array(
          array(
            'name'     => 'admin',
            'email'    => 'admin@grtech.com.my',
            'password' => 'password'
          ),
          array(
            'name'     => 'user',
            'email'    => 'user@grtech.com.my',
            'password' => 'password'
          )
        );

        foreach($data as $user){
          DB::table('users')->insert(
            array(
              'name'      => $user['name'],
              'email'     => $user['email'],
              'password'  => bcrypt($user['password'])
            )
          );
        }
    }

}
