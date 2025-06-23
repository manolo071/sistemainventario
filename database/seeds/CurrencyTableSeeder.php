<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$currency = [
            array('name' => 'USD','symbol' => '$'),
            array('name' => 'BDT','symbol' => '৳'),
            array('name' => 'EGP','symbol' => '£'),
            array('name' => 'EUR','symbol' => '€'),
            array('name' => 'INR','symbol' => '₨'),
            array('name' => 'LKR','symbol' => 'Rs'),
            array('name' => 'MYR','symbol' => 'RM'),
            array('name' => 'NPR','symbol' => '₨'),
            array('name' => 'PKR','symbol' => '₨')
        ];
        DB::table('currency')->truncate();
		DB::table('currency')->insert($currency);
    }
}