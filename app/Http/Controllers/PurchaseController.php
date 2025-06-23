<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Http\Requests;
use DB;
use PDF;
use App\Http\Start\Helpers;
use Session;
use Auth;

class PurchaseController extends Controller
{
    public function __construct(EmailController $email) {
       $this->email = $email;
    }

    public function index()
    {
        $data['menu'] = 'purchase';
        $data['sub_menu'] = 'purchase';
        $data['purchData'] = (new Purchase)->getAllPurchOrder();
        //d($data['purchData'],1);
        return view('admin.purchase.purch_list', $data);
    }

    public function create()
    {
        $data['menu'] = 'purchases';
        $data['sub_menu'] = 'purchase'; 

        $data['itemList'] = DB::table('item_code')->where(['inactive'=>0,'deleted_status'=>0])->get();

        $data['suppData'] = DB::table('suppliers')->where(['inactive'=>0])->get();
        $data['locData'] = DB::table('location')->get();
        $data['order'] = DB::table('purch_orders')->select('order_no')->orderBy('order_no', 'desc')->limit(1)->first();
        $order_count = DB::table('purch_orders')->count();

        if($order_count>0){
        $orderReference = DB::table('purch_orders')->select('reference')->orderBy('order_no','DESC')->first();

        $ref = explode("-",$orderReference->reference);
        $data['order_count'] = (int) $ref[1];
        }else{
            $data['order_count'] = 0 ;
        }

        $taxTypeList = DB::table('item_tax_types')->get();
        $taxOptions = '';
        $selectStart = "<select class='form-control taxList' name='tax_id[]'>";
        $selectEnd = "</select>";
        
        foreach ($taxTypeList as $key => $value) {
            $taxOptions .= "<option value='".$value->id."' taxrate='".$value->tax_rate."'>".$value->name.'('.$value->tax_rate.')'."</option>";          
        }
        $data['tax_type'] = $selectStart.$taxOptions.$selectEnd;
      
        return view('admin.purchase.purch_add', $data);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $this->validate($request, [
            'reference'=>'required|unique:purch_orders',
            'into_stock_location' => 'required',
            'ord_date' => 'required',
            'supplier_id' => 'required',
            'item_quantity' => 'required',
        ]);


        $itemQty = $request->item_quantity;        
        $itemIds = $request->item_id;
        $taxIds = $request->tax_id;
        $itemPrice = $request->item_price;
        $stock_id = $request->stock_id;
        $description = $request->description;
        $unitPrice = $request->unit_price; 
        
        foreach ($itemQty as $key => $value) {
            $product[$itemIds[$key]] = $value;
        }

        $orderReferenceNo = DB::table('purch_orders')->count();
        $data['ord_date'] = DbDateFormat($request->ord_date);
        $data['supplier_id'] = $request->supplier_id;
        $data['person_id'] = $user_id;
        $data['reference'] = 'PO-'. sprintf("%04d", $orderReferenceNo+1);
        $data['total'] = $request->total;
        $data['into_stock_location'] = $request->into_stock_location;
        $data['comments'] = $request->comments;
        $data['created_at'] = date('Y-m-d H:i:s');
        $order_id = DB::table('purch_orders')->insertGetId($data);

        for ($i=0; $i < count($itemIds); $i++) {
            foreach ($product as $key => $value) {
                if($itemIds[$i] == $key){
                    // purchOrderdetail information
                    $purchOrderdetail[$i]['order_no'] = $order_id;
                    $purchOrderdetail[$i]['item_code'] = $stock_id[$i];
                    $purchOrderdetail[$i]['description'] = $description[$i];
                    $purchOrderdetail[$i]['quantity_ordered'] = $value;
                    $purchOrderdetail[$i]['quantity_received'] = $value;
                    $purchOrderdetail[$i]['qty_invoiced'] = $value;
                    $purchOrderdetail[$i]['unit_price'] = $unitPrice[$i];
                    $purchOrderdetail[$i]['tax_type_id'] = $taxIds[$i];
                     // stockMove information
                    $stockMove[$i]['stock_id'] = $stock_id[$i];
                    $stockMove[$i]['trans_type'] = PURCHINVOICE;
                    $stockMove[$i]['loc_code'] = $request->into_stock_location;
                    $stockMove[$i]['tran_date'] = DbDateFormat($request->ord_date);
                    $stockMove[$i]['person_id'] = $user_id;
                    $stockMove[$i]['reference'] = 'store_in_'.$order_id;
                    $stockMove[$i]['transaction_reference_id'] =$order_id;
                    $stockMove[$i]['qty'] = $value;
                    $stockMove[$i]['price'] = $unitPrice[$i];
                }

                $purchaseDataInfo = DB::table('purchase_prices')->where('stock_id',$stock_id[$i])->count(); 
               
                //d($purchaseDataInfo,1);
                if($purchaseDataInfo == false){
                    $purchaseData['supplier_id'] = $request->supplier_id;
                    $purchaseData['stock_id'] = $stock_id[$i];
                    $purchaseData['price'] = $itemPrice[$i];
                    DB::table('purchase_prices')->insert($purchaseData);
                }

            }
        }

        for ($i=0; $i < count($purchOrderdetail); $i++) {
            DB::table('purch_order_details')->insertGetId($purchOrderdetail[$i]);
            //DB::table('stock_moves')->insertGetId($stockMove[$i]);
        }

        if (!empty($order_id)) {
            Session::flash('success',trans('message.success.save_success'));
            return redirect()->intended('purchase/list');
        }

    }

    public function edit($id)
    {
        $data['menu'] = 'purchase';
        $data['sub_menu'] = 'purchase';
        $data['taxType'] = (new Purchase)->calculateTaxRow($id);
        $data['supplierData'] = DB::table('suppliers')->get();
        $data['locData'] = DB::table('location')->get();
        $data['invoiceData'] = (new Purchase)->getPurchaseInvoiceByID($id);
        $data['purchData'] = DB::table('purch_orders')->where('order_no', '=', $id)->first();
        
        $taxTypeList = DB::table('item_tax_types')->get();
        $taxOptions = '';
        $selectStart = "<select class='form-control taxList' name='tax_id_new[]'>";
        $selectEnd = "</select>";
        
        foreach ($taxTypeList as $key => $value) {
            $taxOptions .= "<option value='".$value->id."' taxrate='".$value->tax_rate."'>".$value->name.'('.$value->tax_rate.')'."</option>";          
        }
        $data['tax_type_new'] = $selectStart.$taxOptions.$selectEnd;
        $data['tax_types'] = $taxTypeList;

        return view('admin.purchase.purch_edit', $data);
    }

    public function update(Request $request)
    {

        $user_id = Auth::user()->id;
        $this->validate($request, [
            'into_stock_location' => 'required',
            'ord_date' => 'required',
            'supplier_id' => 'required',
        ]);

      // d($request->all(),1);
        $order_id = $request->order_no;        
        $data['ord_date'] = DbDateFormat($request->ord_date);
        $data['supplier_id'] = $request->supplier_id;
        //$data['reference'] = $request->reference;
        $data['into_stock_location'] = $request->into_stock_location;
        $data['comments'] = $request->comments;
        $data['total'] = $request->total;
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('purch_orders')->where('order_no', $order_id)->update($data);

        if(isset($request->item_quantity)) {
            
            $itemQty = $request->item_quantity;        
            $itemIds = $request->item_id;
            $taxIds = $request->tax_id;
            $itemPrice = $request->item_price;
            $stock_id = $request->stock_id;
            $description = $request->description;
            $unitPrice = $request->unit_price;            

            $invoiceData = (new Purchase)->getPurchaseInvoiceByID($order_id);
            $invoiceData = objectToArray($invoiceData);

            for ($i=0;$i<count($invoiceData);$i++) {
                
                if (!in_array($invoiceData[$i]['item_id'],$itemIds)) {
                    DB::table('purch_order_details')->where([['order_no','=',$invoiceData[$i]['order_no']],['item_code','=',$invoiceData[$i]['item_code']],])->delete();
                    //DB::table('stock_moves')->where([['stock_id','=',$invoiceData[$i]['item_code']],['reference','=','store_in_'.$order_id],])->delete();
                }
            }

            foreach ($itemQty as $key => $value) {
                
                $product[$itemIds[$key]] = $value;

            }

            for ($i=0; $i < count($itemIds); $i++) {
                foreach ($product as $key => $value) {
                    if($itemIds[$i] == $key){
                        // Order Details
                        $purchaseOrderDetails[$i]['item_code'] = $stock_id[$i];
                        $purchaseOrderDetails[$i]['description'] = $description[$i];
                        $purchaseOrderDetails[$i]['quantity_ordered'] = $value;
                        $purchaseOrderDetails[$i]['quantity_received'] = $value;
                        $purchaseOrderDetails[$i]['qty_invoiced'] = $value;
                        $purchaseOrderDetails[$i]['unit_price'] = $unitPrice[$i];
                        // Order Details
                        $stockMove[$i]['stock_id'] = $stock_id[$i];
                        $stockMove[$i]['trans_type'] = PURCHINVOICE;
                        $stockMove[$i]['loc_code'] = $request->into_stock_location;
                        $stockMove[$i]['tran_date'] = DbDateFormat($request->ord_date);
                        $stockMove[$i]['person_id'] = $user_id;
                        $stockMove[$i]['reference'] = 'store_in_'.$order_id;
                        $stockMove[$i]['transaction_reference_id'] = $order_id;
                        $stockMove[$i]['qty'] = $value;
                        $stockMove[$i]['price'] = $itemPrice[$i];
                    }
                }
            }

            for ($i=0; $i < count($purchaseOrderDetails); $i++) {
                DB::table('purch_order_details')->where([['item_code','=',$purchaseOrderDetails[$i]['item_code']],['order_no','=',$order_id],])->update($purchaseOrderDetails[$i]);
                //DB::table('stock_moves')->where([['stock_id','=',$stockMove[$i]['stock_id']],['reference','=','store_in_'.$order_id],])->update($stockMove[$i]);
            }
        } else {                           
            $invoiceData = (new Purchase)->getPurchaseInvoiceByID($order_id);
            $invoiceData = objectToArray($invoiceData);
            for ($i=0;$i<count($invoiceData);$i++) {
                DB::table('purch_order_details')->where([['order_no','=',$invoiceData[$i]['order_no']],['item_code','=',$invoiceData[$i]['item_code']],])->delete();
                //DB::table('stock_moves')->where([['stock_id','=',$invoiceData[$i]['item_code']],['reference','=','store_in_'.$order_id],])->delete(); 
            }
        }

        if(isset($request->item_quantity_new)) 
        {
            $item_quantity_new = $request->item_quantity_new;        
            $ids_new = $request->item_id_new;
            $taxIds_new = $request->tax_id_new;
            $itemPrice_new = $request->item_price_new;
            $unitPrice_new = $request->unit_price_new;
            $stock_id_new = $request->stock_id_new;
            $description_new = $request->description_new;
            
            foreach ($item_quantity_new as $key => $value) {
                $product_new[$ids_new[$key]] = $value;

            }
            

            for ($i=0; $i < count($ids_new); $i++) {
                foreach ($product_new as $key => $value) {
                    if ($ids_new[$i]== $key) {
                        // Order
                        $purchOrderdetailNew[$i]['order_no'] = $order_id;
                        $purchOrderdetailNew[$i]['item_code'] = $stock_id_new[$i];
                        $purchOrderdetailNew[$i]['description'] = $description_new[$i];
                        $purchOrderdetailNew[$i]['quantity_ordered'] = $value;
                        $purchOrderdetailNew[$i]['quantity_received'] = $value;
                        $purchOrderdetailNew[$i]['qty_invoiced'] = $value;
                        $purchOrderdetailNew[$i]['unit_price'] = $itemPrice_new[$i];
                        $purchOrderdetailNew[$i]['tax_type_id'] = $taxIds_new[$i];
                        $purchOrderdetailNew[$i]['unit_price'] = $unitPrice_new[$i];
                       
                        // Order Details
                        $stockMoveNew[$i]['stock_id'] = $stock_id_new[$i];
                        $stockMoveNew[$i]['trans_type'] = PURCHINVOICE;
                        $stockMoveNew[$i]['loc_code'] = $request->into_stock_location;
                        $stockMoveNew[$i]['tran_date'] = DbDateFormat($request->ord_date);
                        $stockMoveNew[$i]['person_id'] = $user_id;
                        $stockMoveNew[$i]['reference'] = 'store_in_'.$order_id;
                        $stockMoveNew[$i]['transaction_reference_id'] =$order_id;
                        $stockMoveNew[$i]['qty'] = $value;
                        $stockMoveNew[$i]['price'] = $itemPrice_new[$i];
                    }
                }
            }
            //d($purchOrderdetailNew,1);
            for ($i=0; $i<count($purchOrderdetailNew); $i++) { 
                DB::table('purch_order_details')->insertGetId($purchOrderdetailNew[$i]);
               // DB::table('stock_moves')->insertGetId($stockMoveNew[$i]);
            }
        }

        \Session::flash('success',trans('message.success.save_success'));
            return redirect()->intended('purchase/list');
    }

    public function destroy($id)
    {
        if(isset($id)) {
            $record = \DB::table('purch_orders')->where('order_no', $id)->first();
            if($record) {
                DB::table('purch_orders')->where('order_no', '=', $record->order_no)->delete();
                DB::table('purch_order_details')->where('order_no', '=', $record->order_no)->delete();
                DB::table('stock_moves')->where('reference', '=', 'store_in_'.$record->order_no)->delete();

                DB::table('receive_orders')->where('order_no', '=', $record->order_no)->delete();
                DB::table('receive_order_details')->where('order_no', '=', $record->order_no)->delete();
                
                \Session::flash('success',trans('message.success.delete_success'));
                return redirect()->intended('purchase/list');
            }
        }
    }

    public function pdfview($id, $r='')
    {
        $supp_id = \DB::table('purch_orders')->where('order_no', $id)->first();
        $data['supplierData'] = \DB::table('suppliers')->where('supplier_id', $supp_id->supplier_id)->first();
        $data['invoiceData'] = \DB::table('purch_order_details')->where('order_no', $id)->get();
        
        $data['id'] = $id;

        $pdf = PDF::loadView('pdfviewIn', $data);
       $pdf->setPaper(array(0,0,750,1060), 'portrait');
        
        return $pdf->stream('invoice_check_in_'.time().'.pdf',array("Attachment"=>0));
    }

    public function searchItem(Request $request)
    {
        
            $data = array();
            $data['status_no'] = 0;
            $data['message']   ='No Item Found!';
            $data['items'] = array();

            $item = DB::table('stock_master')->where('stock_master.description','LIKE','%'.$request->search.'%')
            ->where(['stock_master.inactive'=>0,'stock_master.deleted_status'=>0])
            ->orWhere('stock_master.stock_id','LIKE','%'.$request->search.'%')
            ->leftJoin('purchase_prices', 'stock_master.stock_id', '=', 'purchase_prices.stock_id')
            ->leftJoin('item_tax_types','item_tax_types.id','=','stock_master.tax_type_id')
            ->leftJoin('item_code','item_code.stock_id','=','stock_master.stock_id')
            ->select('stock_master.*','purchase_prices.price','item_code.id','item_tax_types.tax_rate','item_tax_types.id as tax_id')
            ->get();

            if($item){

                $data['status_no'] = 1;
                $data['message']   ='Item Found';
                $i = 0;

                foreach ($item as $key => $value) {
                    $return_arr[$i]['id'] = $value->id;
                    $return_arr[$i]['stock_id'] = $value->stock_id;
                    $return_arr[$i]['description'] = $value->description;
                    $return_arr[$i]['units'] = $value->units;
                    $return_arr[$i]['price'] = $value->price;
                    $return_arr[$i]['tax_rate'] = $value->tax_rate;
                    $return_arr[$i]['tax_id'] = $value->tax_id;
                    $i++;
                }
                $data['items'] = $return_arr;
                //echo json_encode($return_arr);
            }
            echo json_encode($data);
            exit;     
    }

    public function viewPurchaseInvoiceDetail($id){
        $data['menu'] = 'purchase';
        $data['sub_menu'] = 'purchase';
        $data['taxType'] = (new Purchase)->calculateTaxRow($id);
        $data['invoiceItems'] = (new Purchase)->getPurchaseInvoiceByID($id);
		
		//dd($data['invoiceItems']);
       
        $data['purchData'] = DB::table('purch_orders')
                            ->where('order_no', '=', $id)
                            ->leftJoin('suppliers','suppliers.supplier_id','=','purch_orders.supplier_id')
                            ->leftJoin('location','location.loc_code','=','purch_orders.into_stock_location')
                            ->select('purch_orders.*','suppliers.supp_name','suppliers.email','suppliers.address','suppliers.contact','suppliers.city','suppliers.state','suppliers.zipcode','suppliers.country','location.location_name')
                            ->first();
        // Rifgt Part Option Start
        $data['receiveData'] = DB::select("SELECT ro.id,ro.reference,ro.receive_date,rod.qty FROM receive_orders  as ro
        LEFT JOIN (SELECT receive_id,SUM(quantity) as qty FROM receive_order_details GROUP BY receive_id) as rod
        ON rod.receive_id = ro.id
        WHERE ro.order_no = $id
        ORDER BY ro.id DESC
        ");

        $orderItemQty = DB::select("select sum(quantity_ordered) as ord_qty,sum(qty_received) as recv_qty from purch_order_details where order_no = $id group by order_no");
       
        $data['orderItemQty'] = $orderItemQty[0];

        $lang = Session::get('dflt_lang');
        $data['emailInfo'] = DB::table('email_temp_details')->where(['temp_id'=>3,'lang'=>$lang])->select('subject','body')->first();
       //d($data['invoiceItems'],1);

        return view('admin.purchase.purchaseInvoiceDetails', $data);       
    }
    
    public function invoicePdf($id){
        $data['taxType'] = (new Purchase)->calculateTaxRow($id);
        $data['invoiceItems'] = (new Purchase)->getPurchaseInvoiceByID($id);
       
        $data['purchData'] = DB::table('purch_orders')
                            ->where('order_no', '=', $id)
                            ->leftJoin('suppliers','suppliers.supplier_id','=','purch_orders.supplier_id')
                            ->select('purch_orders.*','suppliers.supp_name','suppliers.email','suppliers.address','suppliers.contact','suppliers.city','suppliers.state','suppliers.zipcode','suppliers.country')
                            ->first();
      $pref                  = DB::table('preference')->where('category', 'company')->get();
      $companyData            = AssColumn($a=$pref, $column='id');
      $array_data = array();
      foreach($companyData as $row)
      {
        $array_data[$row->category][$row->field] = $row->value;         
      }
      $data['companyInfo'] = $array_data;
       $pdf = PDF::loadView('admin.purchase.invoicePdf', $data);
       $pdf->setPaper(array(0,0,750,1060), 'portrait');
        return $pdf->download('purchase_invoice_'.time().'.pdf',array("Attachment"=>0));               
    }
    
   /**
    * Send email to supplier for Purchase information
    */
    public function sendPurchaseInformationEmail(Request $request){
        $order_no = $request['order_no'];
        $purchaseName = 'purchase_'.time().'.pdf';
         if(isset($request['purchase_pdf']) && $request['purchase_pdf']=='on'){
            $this->purchasePdf($order_no,$purchaseName);
            $this->email->sendEmailWithAttachment($request['email'],$request['subject'],$request['message'],$purchaseName);
         }else{
            $this->email->sendEmail($request['email'],$request['subject'],$request['message']);
         }
        \Session::flash('success',trans('message.email.email_send_success'));
        return redirect()->intended('purchase/view-purchase-details/'.$order_no);
    }



    public function invoicePrint($id){
        $data['taxType'] = (new Purchase)->calculateTaxRow($id);
        $data['invoiceItems'] = (new Purchase)->getPurchaseInvoiceByID($id);
       
        $data['purchData'] = DB::table('purch_orders')
                            ->where('order_no', '=', $id)
                            ->leftJoin('suppliers','suppliers.supplier_id','=','purch_orders.supplier_id')
                            ->select('purch_orders.*','suppliers.supp_name','suppliers.email','suppliers.address','suppliers.contact','suppliers.city','suppliers.state','suppliers.zipcode','suppliers.country')
                            ->first();
      $pref                  = DB::table('preference')->where('category', 'company')->get();
      $companyData            = AssColumn($a=$pref, $column='id');
      $array_data = array();
      foreach($companyData as $row)
      {
        $array_data[$row->category][$row->field] = $row->value;         
      }
      $data['companyInfo'] = $array_data;
        $pdf = PDF::loadView('admin.purchase.invoicePrint', $data);
        $pdf->setPaper(array(0,0,750,1060), 'portrait');
        return $pdf->stream('purchase_invoice_'.time().'.pdf',array("Attachment"=>0));       
    }

   

    public function referenceValidation(Request $request){
        
        $data = array();
        $ref = $request['ref'];
        $result = DB::table('purch_orders')->where("reference",$ref)->first();

        if(count($result)>0){
            $data['status_no'] = 1; 
        }else{
            $data['status_no'] = 0;
        }

        return json_encode($data);       
    }

    public function Filtering()
    {
        $data['menu'] = 'purchase';
        $data['sub_menu'] = 'purchase';
        $data['supplier'] =  'all';
        $data['stock_id'] =  'all';

        $data['suppliers'] = DB::table('suppliers')
                             ->select('supplier_id as id','supp_name as name')->get();
        $data['items']     = DB::table('item_code')
                              ->select('stock_id','description as name')->get();

        if(empty($_GET)){
        $data['purchData'] = (new Purchase)->getAllPurchOrder();
        $from              = DB::table('purch_orders')->select('ord_date')
                             ->orderBy('ord_date','asc')->first();
       if(!empty($from)){
        $data['from'] = formatDate($from->ord_date);
       }else{
        $data['from'] = formatDate(date('d-m-Y'));
       }
        $data['to'] = formatDate(date('d-m-Y'));
     }else{

        $from = $_GET['from'];
        $to   = $_GET['to'];
        $supplier_id = $_GET['supplier'];
        $stock_id = $_GET['item'];

        if ( $supplier_id == 'all' && $stock_id == 'all' ){
           $data['purchData'] = (new Purchase)->getAllPurchOrderFiltering($from,$to,'all','all');
        }elseif ($supplier_id != 'all' && $stock_id == 'all') {
           $data['purchData'] = (new Purchase)->getAllPurchOrderFiltering($from,$to,$supplier_id,'all');
        }
        elseif ($supplier_id == 'all' && $stock_id != 'all') {
           $data['purchData'] = (new Purchase)->getAllPurchOrderFiltering($from,$to,'all',$stock_id);
        }
        elseif ($supplier_id != 'all' && $stock_id != 'all') {
           $data['purchData'] = (new Purchase)->getAllPurchOrderFiltering($from,$to,$supplier_id,$stock_id);
        }

        $data['from'] =  $_GET['from'];
        $data['to'] =  $_GET['to'];
        $data['supplier'] =  $_GET['supplier'];
        $data['stock_id'] =  $_GET['item'];


     }


     return view('admin.purchase.filtering_list', $data);
    }

      public function purchasePdf($order_no,$purchaseName){
        $data['taxType'] = (new Purchase)->calculateTaxRow($order_no);
        $data['invoiceItems'] = (new Purchase)->getPurchaseInvoiceByID($order_no);
       
        $data['purchData'] = DB::table('purch_orders')
                            ->where('order_no', '=', $order_no)
                            ->leftJoin('suppliers','suppliers.supplier_id','=','purch_orders.supplier_id')
                            ->select('purch_orders.*','suppliers.supp_name','suppliers.email','suppliers.address','suppliers.contact','suppliers.city','suppliers.state','suppliers.zipcode','suppliers.country')
                            ->first();
      $pref                  = DB::table('preference')->where('category', 'company')->get();
      $companyData            = AssColumn($a=$pref, $column='id');
      $array_data = array();
      foreach($companyData as $row)
      {
        $array_data[$row->category][$row->field] = $row->value;         
      }
      $data['companyInfo'] = $array_data;
       $pdf = PDF::loadView('admin.purchase.invoicePdf', $data);
       $pdf->setPaper(array(0,0,750,1060), 'portrait');
       
       return $pdf->save(public_path().'/uploads/invoices/'.$purchaseName);               
    }

}
