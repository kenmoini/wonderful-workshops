<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FierceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Catalogs
        //Red Hat
        $redHatCatalog = DB::table('catalogs')->insertGetId([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'Red Hat',
            'slug' => 'red-hat',
            'description' => '',
            'font_awesome_icon' => 'fab fa-redhat',
            'status' => '1'
        ]);
        //Create Workshops
        $devsecopsForOperators = DB::table('workshops')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'DevSecOps for Operators',
            'slug' => 'devsecops-for-operators',
            'description' => '',
            'font_awesome_icon' => 'fas fa-user-astronaut',
            'status' => '1'
        ]);
        $devsecopsForDevelopers = DB::table('workshops')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'DevSecOps for Developers',
            'slug' => 'devsecops-for-developers',
            'description' => '',
            'font_awesome_icon' => 'fas fa-user-ninja',
            'status' => '1'
        ]);
        $devsecopsForSecurity = DB::table('workshops')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'DevSecOps for Security',
            'slug' => 'devsecops-for-security',
            'description' => '',
            'font_awesome_icon' => 'fas fa-user-shield',
            'status' => '1'
        ]);
        //Associate Workshops to Catalogs

        //Create Bastion Host Asset
        //Create Login Instruction Asset
        //Create OpenShift Asset
        //Associate assets to workshops
        //Create God-Mode Event Voucher Code
    }
}
