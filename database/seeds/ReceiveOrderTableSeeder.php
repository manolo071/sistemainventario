<?php

use Illuminate\Database\Seeder;

class ReceiveOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$receiveOrder = array(
            array(
            	'id'=>1,
            	'order_no'=>4,
                'person_id'=>1,
                'supplier_id'=>3,
                'reference'=>'PO-0004',
                'location'=>'JA',
                'receive_date'=>date("Y-m-d", strtotime("-336 days"))
                
            ),
            array(
            	'id'=>2,
            	'order_no'=>1,
                'person_id'=>1,
                'supplier_id'=>1,
                'reference'=>'PO-0001',
                'location'=>'PL',
                'receive_date'=>date("Y-m-d",strtotime("-39 days"))
                
            ),
            array(
                'id'=>3,
                'order_no'=>1,
                'person_id'=>1,
                'supplier_id'=>5,
                'reference'=>'PO-0001',
                'location'=>'JA',
                'receive_date'=>date("Y-m-d",strtotime("-37 days"))
                
            ),
            array(
                'id'=>4,
                'order_no'=>9,
                'person_id'=>1,
                'supplier_id'=>1,
                'reference'=>'PO-0009',
                'location'=>'PL',
                'receive_date'=>date("Y-m-d",strtotime("-32 days"))
                
            ),
            array(
                'id'=>5,
                'order_no'=>9,
                'person_id'=>1,
                'supplier_id'=>5,
                'reference'=>'PO-0009',
                'location'=>'JA',
                'receive_date'=>date("Y-m-d",strtotime("-31 days"))
                
            ),
            array(
                'id'=>6,
                'order_no'=>10,
                'person_id'=>1,
                'supplier_id'=>1,
                'reference'=>'PO-0010',
                'location'=>'PL',
                'receive_date'=>date("Y-m-d",strtotime("-33 days"))
                
            )
            

        );
        DB::table('receive_orders')->truncate();
		DB::table('receive_orders')->insert($receiveOrder);
    }
}