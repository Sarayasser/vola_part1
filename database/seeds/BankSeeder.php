<?php

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'bank_name'=>'HSBC' ,
        ]);
        DB::table('banks')->insert([
            'bank_name'=>'CIB',
        ]);
        DB::table('banks')->insert([
            'bank_name'=>'QNB',
        ]);
    }
}
