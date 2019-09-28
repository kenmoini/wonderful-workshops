<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginIdentitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Just spin up 101 dalmations
        for ($i=0; $i <= 100; $i++) {
            DB::table('login_identities')->insert([
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'name' => 'Student User ' . $i,
                'username' => 'student' . $i,
                'password' => 'Tiger123!'
            ]);
        }
    }
}
