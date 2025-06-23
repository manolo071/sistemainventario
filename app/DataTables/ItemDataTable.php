<?php
namespace App\DataTables;
use Yajra\Datatables\Services\DataTable;
use DB;
use Auth;
use Helpers;
use Session;
class ItemDataTable extends DataTable
{
    public function ajax()
    {
        $item = $this->query();
        return $this->datatables
            ->of($item)
            ->addColumn('action', function ($item) {

                $edit = Helpers::has_permission(Auth::user()->id, 'edit_item') ? '<a href="'.url('edit-item/item-info/'.$item->item_id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;':'';

                $delete = Helpers::has_permission(Auth::user()->id, 'delete_item') ? '<a href="'.url('item/delete/'.$item->item_id).'" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>':'';

                return $edit.$delete;
            })

            ->addColumn('img', function ($item) {
                $img = !empty($item->img) ? '<img src='.url("public/uploads/itemPic/$item->img").' alt="" width="50" height="50">' : "<img src=".url('public/uploads/default-image.png')." alt='' width='50' height='50'>";

                return $img;
            })

            
            ->addColumn('description', function ($item) {
                return '<a href="'.url('edit-item/item-info/'.$item->item_id).'">'.$item->description.'</a>';
            })


            ->addColumn('item_qty', function($item){
                $qty = ($item->item_qty != null || $item->item_qty>0 ) ? $item->item_qty : 0;
                return $qty;
            })

            ->addColumn('inactive', function ($item) {
                $status = ($item->inactive == 0) ? 'Active' : 'Inactive';
                return ucfirst($status);
            })

            ->make(true);
    }
 
    public function query()
    {
        $items = DB::table('item_code as items')
                   

                  ->leftJoin('purchase_prices as pp','pp.stock_id','=','items.stock_id')
                  
                  ->leftJoin('stock_category as sc','sc.category_id','=','items.category_id')
                
                  ->leftJoin(DB::raw("(SELECT stock_id,sum(qty) as item_qty FROM stock_moves GROUP BY stock_id
                    ) as sm"),function($join_sm){
                      $join_sm->on("sm.stock_id","=","items.stock_id");
                    })

                  ->leftJoin(DB::raw("(SELECT stock_id,price FROM sale_prices WHERE sales_type_id = 2) as sph"),function($join_sph){
                    $join_sph->on('sph.stock_id', '=', 'items.stock_id');
                   })

                  ->leftJoin(DB::raw("(SELECT stock_id,price FROM sale_prices WHERE sales_type_id = 1) as spr"), function($join_spr){
                    $join_spr->on('spr.stock_id', '=', 'items.stock_id');
                  })
                  ->select("items.id as item_id","items.inactive","items.stock_id","items.description","items.category_id","items.item_image as img","pp.price as purchase_price","sc.description as category","sm.item_qty as item_qty","sph.price as whole_sale_price","spr.price as retail_sale_price")


                   ->where(['deleted_status'=>0]);

        return $this->applyScopes($items);
    }
    
    public function html()
    {
        return $this->builder()
            
            ->addColumn(['data' => 'img', 'name' => 'items.item_image', 'title' => 'Picture'])

            ->addColumn(['data' => 'description', 'name' => 'items.description', 'title' => 'Name'])
            
            ->addColumn(['data' => 'category', 'name' => 'sc.description', 'title' => 'Category'])
           
            ->addColumn(['data' => 'item_qty', 'name' => 'sm.item_qty', 'title' => 'On Hand'])

            ->addColumn(['data' => 'purchase_price', 'name' => 'pp.price', 'title' => 'Purchase('.Session::get('currency_symbol').')'])
            
            ->addColumn(['data' => 'whole_sale_price', 'name' => 'sph.price', 'title' => 'Wholesale('.Session::get('currency_symbol').')'])
            
            ->addColumn(['data' => 'retail_sale_price', 'name' => 'spr.price', 'title' => 'Retail('.Session::get('currency_symbol').')'])
            
            ->addColumn(['data' => 'inactive', 'name' => 'items.inactive', 'title' => 'Status'])
            
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])

            ->parameters([
            'pageLength'=>Session::get('row_per_page'),
             'order' => [1, 'asc']
            ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename()
    {
        return 'itemdatatables_' . time();
    }
}
