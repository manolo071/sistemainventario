<?php

use Illuminate\Database\Seeder;

class ReceiveOrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$receiveOrderDetails = array(
            array(
                'order_no'=>4,
                'receive_id'=>1,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>4,
                'receive_id'=>1,
                'item_code'=>'SINGER',
                'description'=>'Singer Refrigerator',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>100
               
            ),
            array(
                'order_no'=>4,
                'receive_id'=>1,
                'item_code'=>'SONY',
                'description'=>'Sony experia 5',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>100
               
            ),
            array(
                'order_no'=>4,
                'receive_id'=>1,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>1,
                'receive_id'=>2,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'tax_type_id'=>2,
                'unit_price'=>100,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>1,
                'receive_id'=>3,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>9,
                'receive_id'=>4,
                'item_code'=>'SAMSUNG',
                'description'=>'Samsung G7',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>9,
                'receive_id'=>5,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'tax_type_id'=>2,
                'unit_price'=>100,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>9,
                'receive_id'=>5,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'tax_type_id'=>1,
                'unit_price'=>50,
                'quantity'=>1000
               
            ),
            array(
                'order_no'=>10,
                'receive_id'=>6,
                'item_code'=>'APPLE',
                'description'=>'Iphone 7+',
                'tax_type_id'=>2,
                'unit_price'=>100,
                'quantity'=>1000
               
            ),
           
            array(
                'order_no'=>10,
                'receive_id'=>6,
                'item_code'=>'WALTON',
                'description'=>'Walton Primo GH',
                'tax_type_id'=>2,
                'unit_price'=>50,
                'quantity'=>1000
               
            )
            
        );
        DB::table('receive_order_details')->truncate();
		DB::table('receive_order_details')->insert($receiveOrderDetails);
    }
}