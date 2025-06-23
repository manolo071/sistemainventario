
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <ul class="sidebar-menu">
        
        <li <?= $menu == 'dashboard' ? ' class="active"' : ''?> >
          <a href="<?php echo e(url('dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('message.sidebar.dashboard')); ?> </span>
          </a>
        </li>

        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_customer')): ?>
        <li <?= $menu == 'customer' ? ' class="active"' : ''?> >
          <a href="<?php echo e(url('customer/list')); ?>">
            <i class="fa fa-users"></i> <span><?php echo e(trans('message.extra_text.customers')); ?></span>
          </a>
        </li>
        <?php endif; ?>

         <?php if(Helpers::has_permission(Auth::user()->id, 'manage_item')): ?>
        <li <?= $menu == 'item' ? ' class="active"' : ''?> >
          <a href="<?php echo e(url('item')); ?>">
            <i class="fa fa-cubes"></i>
            <span><?php echo e(trans('message.sidebar.item')); ?></span>
          </a>
        </li>
        <?php endif; ?>
        
         <?php if(Helpers::has_permission(Auth::user()->id, 'manage_sale')): ?>
        <li <?= $menu == 'sales' ? ' class="treeview active"' : 'treeview'?> >
          <a href="#">
            <i class="fa fa-list-ul"></i>
            <span><?php echo e(trans('message.sidebar.sales')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(Helpers::has_permission(Auth::user()->id, 'manage_order')): ?>
            <li <?= isset($sub_menu) && $sub_menu == 'order/list' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('order/list')); ?>">
                <span><?php echo e(trans('message.table.sales_order_no')); ?></span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_invoice')): ?>

            <li <?= isset($sub_menu) && $sub_menu == 'sales/direct-invoice' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('sales/list')); ?>">
                <span><?php echo e(trans('message.table.invoices')); ?></span>
              </a>
            </li>  
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_payment')): ?>
            <li <?= isset($sub_menu) && $sub_menu == 'payment/list' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('payment/list')); ?>">
                <span><?php echo e(trans('message.extra_text.payments')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_shipment')): ?>
            <li <?= isset($sub_menu) && $sub_menu == 'shipment/list' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('shipment/list')); ?>">
                <span><?php echo e(trans('message.extra_text.shipments')); ?></span>
              </a>
            </li> 
            <?php endif; ?>

          </ul>
        </li>
        <?php endif; ?>

        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_supplier')): ?>
        <li <?= $menu == 'supplier' ? ' class="active"' : ''?> >
          <a href="<?php echo e(url('supplier')); ?>">
            <i class="fa fa-users"></i> <span><?php echo e(trans('message.extra_text.supplier')); ?></span>
          </a>
        </li>
        <?php endif; ?>
        


       <?php if(Helpers::has_permission(Auth::user()->id, 'manage_purchase')): ?>
        <li <?= $menu == 'purchase' ? ' class="treeview active"' : 'treeview'?>>
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span><?php echo e(trans('message.extra_text.purchase')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= isset($sub_menu) && $sub_menu == 'purchase' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('purchase/list')); ?>">
                 <span><?php echo e(trans('message.extra_text.purchases')); ?></span>
              </a>
            </li>  
            <li <?= isset($sub_menu) && $sub_menu == 'purchase_receive' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('purchase_receive/list')); ?>">
                <span><?php echo e(trans('message.sidebar.purchase_received')); ?></span>
              </a>
            </li>  
          </ul>
        </li>
        <?php endif; ?>

        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_transfer')): ?>
        <li <?= $menu == 'transfer' ? ' class="active"' : ''?> >
          <a href="<?php echo e(url('transfer/list')); ?>">
            <i class="fa fa-truck"></i> <span><?php echo e(trans('message.sidebar.stock-move-list')); ?></span>
          </a>
        </li>
        <?php endif; ?>

        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_report')): ?>
        <li <?= $menu == 'report' ? ' class="treeview active"' : 'treeview'?> >
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span><?php echo e(trans('message.sidebar.report')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_stock_on_hand')): ?>
            <li <?= isset($sub_menu) && $sub_menu == 'report/inventory-stock-on-hand' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('report/inventory-stock-on-hand')); ?>">
                <span><?php echo e(trans('message.sidebar.inventory_stock_on_hand')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_sale_report')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'report/sales-report' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('report/sales-report')); ?>">
                
                <span><?php echo e(trans('message.sidebar.sales_report')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_sale_history_report')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'sales-history-report' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('report/sales-history-report')); ?>">
                
                <span><?php echo e(trans('message.sidebar.sales_history_report')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_purchase_report')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'purchase-report' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('report/purchase-report')); ?>">
                <span><?php echo e(trans('message.purchase_report.purchase_report')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_team_report')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'member-report' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('report/member-report')); ?>">
                <span><?php echo e(trans('message.purchase_report.member_report')); ?></span>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </li>
        <?php endif; ?>
        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_setting')): ?>
        <li <?= $menu == 'setting' ? ' class="treeview active"' : 'treeview'?> >
          <a href="#">
            <i class="fa fa-gears"></i>
            <span><?php echo e(trans('message.form.settings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=isset($sub_menu) && $sub_menu == 'company' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('company/setting')); ?>">
                <span><?php echo e(trans('message.table.company_details')); ?></span>
              </a>
            </li>

            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_general_setting')): ?>
            <li <?= isset($sub_menu) && $sub_menu == 'general' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('item-category')); ?>">
                <span><?php echo e(trans('message.table.general_settings')); ?></span>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_finance')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'finance' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('tax')); ?>">
                <span><?php echo e(trans('message.table.finance')); ?></span>
              </a>
            </li>
            <?php endif; ?>

            
            <li <?=isset($sub_menu) && $sub_menu == 'mail-temp' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('customer-invoice-temp/5')); ?>">
                <span><?php echo e(trans('message.email.email_template')); ?></span>
              </a>
            </li>
           

             <?php if(Helpers::has_permission(Auth::user()->id, 'manage_preference')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'preference' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('setting-preference')); ?>">
                <span><?php echo e(trans('message.table.preference')); ?></span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(Helpers::has_permission(Auth::user()->id, 'manage_barcode')): ?>
            <li <?=isset($sub_menu) && $sub_menu == 'barcode' ? ' class="active"' : ''?> >
              <a href="<?php echo e(url('barcode/create')); ?>">
                <span><?php echo e(trans('message.barcode.print_menu')); ?></span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>