<?php

use Illuminate\Database\Seeder;

class ShipmentDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$ShipmentDetail = array(
            array(
                'shipment_id'=>1,
                'order_no'=>3,
                'stock_id'=>'APPLE',
                'tax_type_id'=>1,
                'unit_price'=>160,
                'quantity'=>19,
                'discount_percent'=>0
            ),
            array(
                'shipment_id'=>1,
                'order_no'=>3,
                'stock_id'=>'WALTON',
                'tax_type_id'=>1,
                'unit_price'=>85,
                'quantity'=>20,
                'discount_percent'=>0
            ), 
            array(
                'shipment_id'=>2,
                'order_no'=>2,
                'stock_id'=>'SAMSUNG',
                'tax_type_id'=>1,
                'unit_price'=>90,
                'quantity'=>50,
                'discount_percent'=>0
            )
        );
        DB::table('shipment_details')->truncate();
		DB::table('shipment_details')->insert($ShipmentDetail);
    }
}