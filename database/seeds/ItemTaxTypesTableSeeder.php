<?php

use Illuminate\Database\Seeder;

class ItemTaxTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$itemTaxTypes = [
            array('name' => 'Tax Exempt','tax_rate'=>0, 'exempt' => 1, 'defaults' => 0),
            array('name' => 'Sales Tax','tax_rate'=>15, 'exempt' => 0, 'defaults' => 1)
        ];

        DB::table('item_tax_types')->truncate();
		DB::table('item_tax_types')->insert($itemTaxTypes);
    }
}