<?php

use Illuminate\Database\Seeder;

class PurchaseOrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$purchOrderDetails = array(
            array(
                'order_no'=>1,
                'item_code'=>'HP',
                'description'=>'HP Pro Book',
                'qty_invoiced'=>1000,
                'unit_price'=>80,
                'tax_type_id'=>3,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>1,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>1000,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>1,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>2,
                'item_code'=>'LENEVO',
                'description'=>'LED TV',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ), 
            array(
                'order_no'=>2,
                'item_code'=>'LG',
                'description'=>'LG Refrigeretor',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>2,
                'item_code'=>'SINGER',
                'description'=>'Singer Refrigerator',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>2,
                'item_code'=>'SONY',
                'description'=>'Sony experia 5',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>2,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>3,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>3,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>1000,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>4,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>4,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>4,
                'item_code'=>'SINGER',
                'description'=>'Singer Refrigerator',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>100
            ),
            array(
                'order_no'=>4,
                'item_code'=>'SONY',
                'description'=>'Sony experia 5',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>100
            ),                                     
            array(
                'order_no'=>5,
                'item_code'=>'LG',
                'description'=>'LG Refrigeretor',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>5,
                'item_code'=>'SINGER',
                'description'=>'Singer Refrigerator',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>6,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>7,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>3000,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>3000,
                'quantity_received'=>3000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>7,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>3000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>3000,
                'quantity_received'=>3000,
                'qty_received'=>0
            ),
            array(
                'order_no'=>8,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>500,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>500,
                'quantity_received'=>500,
                'qty_received'=>0
            ),
            array(
                'order_no'=>9,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>9,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>1000,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>9,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>1,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>10,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'qty_invoiced'=>1000,
                'unit_price'=>50,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            ),
            array(
                'order_no'=>10,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'qty_invoiced'=>1000,
                'unit_price'=>100,
                'tax_type_id'=>2,
                'quantity_ordered'=>1000,
                'quantity_received'=>1000,
                'qty_received'=>1000
            )

        );
        DB::table('purch_order_details')->truncate();
		DB::table('purch_order_details')->insert($purchOrderDetails);
    }
}