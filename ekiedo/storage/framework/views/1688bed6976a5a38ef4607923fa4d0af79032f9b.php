<?php $__env->startSection('content'); ?>
<style>
    button.ui-datepicker-trigger {
    display: none;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<div class="breadcrumbs">
   <div class="col-sm-4 float-right-1">
      <div class="page-header float-left float-right-1">
         <div class="page-title">
            <h1><?php echo e(__('messages.report')); ?></h1>
         </div>
      </div>
   </div>
   <div class="col-sm-8 float-left-1">
      <div class="page-header float-right float-left-1">
         <div class="page-title">
            <ol class="breadcrumb text-right">
               <li class="active"><?php echo e(__('messages.report')); ?></li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="content mt-3">

      <div class="col-md-12 col-lg-3">
         <div class="card">
            <div class="card-body">
               <div id="pay-invoice">
                  <div class="form-group has-success">
                     <label for="report" class="control-label mb-1">
                     <?php echo e(__('messages.report')); ?> <?php echo e(__('messages.type')); ?>

                     </label>
                     <select class="form-control" name="report" id="report" onchange="filterreport(this.value)" >
                        <option value="1" selected><?php echo e(__('messages.coupon_report')); ?></option>
                        <option value="2"><?php echo e(__('messages.customer_order_report')); ?></option>
                        <option value="3"><?php echo e(__('messages.pro_pur_report')); ?></option>
                        <option value="4"><?php echo e(__('messages.pro_stock_report')); ?></option>
                        <option value="5"><?php echo e(__('messages.sales_report')); ?></option>
                        <option value="6"><?php echo e(__('messages.shipping_report')); ?></option>
                        <option value="7"><?php echo e(__('messages.tax_report')); ?></option>
                        <option value="8"><?php echo e(__('messages.add_product_report')); ?></option>
                        <option value="9"><?php echo e(__('messages.top_seller_report')); ?></option>
                        <option value="10"><?php echo e(__('messages.add_customer_report')); ?></option>
                        <option value="11"><?php echo e(__('messages.add_coupon_report')); ?></option>
                     </select>
                  </div>
                  <div id="filter_section">
                     <div class="form-group has-success report-date">
                        <label for="start_date" class="control-label mb-1">
                        <?php echo e(__('messages.start_date')); ?>

                        </label>
                        <input type="text" class="form-control" name="start_date" id="start_date" >
                     </div>
                     <div class="form-group has-success report-date1">
                        <label for="start_date" class="control-label mb-1">
                        <?php echo e(__('messages.end_date')); ?>

                        </label>
                        <input type="text" class="form-control" name="end_date" id="end_date">
                     </div>
                     <div class="form-group has-success">
                        <label for="status" class="control-label mb-1">
                        <?php echo e(__('messages.order_status')); ?>

                        </label>
                        <select name="order_status" id="order_status" class="form-control">
                           <option value=""><?php echo e(__("messages.select")); ?></option>
                           <option value="6"><?php echo e(__("messages.canceled")); ?></option>
                           <option value="5"><?php echo e(__("messages.completed")); ?></option>
                           <option value="2"><?php echo e(__("messages.on_hold")); ?></option>
                           <option value="3"><?php echo e(__("messages.pending")); ?></option>
                           <option value="1"><?php echo e(__("messages.processing")); ?></option>
                           <option value="7"><?php echo e(__("messages.refunded")); ?></option>
                           <option value="4"><?php echo e(__("messages.out_of_delivery")); ?></option>
                        </select>
                     </div>
                     <div class="form-group has-success">
                        <label for="coupon_code" class="control-label mb-1">
                        <?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.code')); ?>

                        </label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                     </div>
                  </div>
                  <div class="form-group florig" >
                     <button class="btn btn-primary btn-flat m-b-30 m-t-30" onclick="filterdata()"><?php echo e(__('messages.filter')); ?></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 col-lg-9">
         <div class="card">
            <div class="card-body">
               <div id="pay-invoice">
                  <div id="result_section">
                     <div class="table-responsive dtdiv repo">
                        <table id="coupon_report" class="table table-striped table-bordered dttablewidth">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.code')); ?></th>
                                 <th><?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.name')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                                 <th><?php echo e(__('messages.total')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="customer_order_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.cus_name')); ?></th>
                                 <th><?php echo e(__('messages.cus_email')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                                 <th><?php echo e(__('messages.total')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="product_purchase_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.product')); ?></th>
                                 <th><?php echo e(__('messages.qty')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="product_stock_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.product')); ?></th>
                                 <th><?php echo e(__('messages.SKU')); ?></th>
                                 <th><?php echo e(__('messages.stock_avilable')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="sales_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                                 <th><?php echo e(__('messages.product')); ?></th>
                                 <th><?php echo e(__('messages.subtotal')); ?></th>
                                 <th><?php echo e(__('messages.shipping')); ?></th>
                                 <th><?php echo e(__('messages.taxes')); ?></th>
                                 <th><?php echo e(__('messages.total')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="shipping_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.shipping_method')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                                 <th><?php echo e(__('messages.total')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="tax_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.tax_name')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                                 <th><?php echo e(__('messages.total')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="add_product_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.product')); ?></th>
                                 <th><?php echo e(__('messages.SKU')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="top_seller_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.product')); ?></th>
                                 <th><?php echo e(__('messages.SKU')); ?></th>
                                 <th><?php echo e(__('messages.orders')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="add_customer_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.cus_name')); ?></th>
                                 <th><?php echo e(__('messages.cus_email')); ?></th>
                              </tr>
                           </thead>
                        </table>
                        <table id="add_coupon_report" class="table table-striped table-bordered dttablewidth disno">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('messages.date')); ?></th>
                                 <th><?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.code')); ?></th>
                                 <th><?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.name')); ?></th>
                                 <th><?php echo e(__('messages.coupon')); ?> <?php echo e(__('messages.rate')); ?></th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

</div>
<input type="hidden" id="report_not_select" value="<?php echo e(__('messages_error_successs.report_not_select')); ?>">
<input type="hidden" id="start_date_txt" value='<?php echo e(__("messages.start_date")); ?>'>
<input type="hidden" id="end_date_txt" value='<?php echo e(__("messages.end_date")); ?>'>
<input type="hidden" id="order_status_txt" value='<?php echo e(__("messages.order_status")); ?>'>
<input type="hidden" id="select_txt" value='<?php echo e(__("messages.select")); ?>'> 
<input type="hidden" id="canceled_txt" value='<?php echo e(__("messages.canceled")); ?>'>
<input type="hidden" id="completed_txt" value='<?php echo e(__("messages.completed")); ?>'>
<input type="hidden" id="on_hold_txt" value='<?php echo e(__("messages.on_hold")); ?>'>
<input type="hidden" id="pending_txt" value='<?php echo e(__("messages.pending")); ?>'>
<input type="hidden" id="processing_txt" value='<?php echo e(__("messages.processing")); ?>'>
<input type="hidden" id="refunded_txt" value='<?php echo e(__("messages.refunded")); ?>'>
<input type="hidden" id="out_of_delivery_txt" value='<?php echo e(__("messages.out_of_delivery")); ?>'>
<input type="hidden" id="coupon_code_txt" value='<?php echo e(__("messages.coupon")); ?> <?php echo e(__("messages.code")); ?>'>
<input type="hidden" id="cus_name_txt" value='<?php echo e(__("messages.cus_name")); ?>'>
<input type="hidden" id="cus_email_txt" value='<?php echo e(__("messages.cus_email")); ?>'>
<input type="hidden" id="product_txt" value='<?php echo e(__("messages.product")); ?>'>
<input type="hidden" id="SKU_txt" value='<?php echo e(__("messages.SKU")); ?>'>
<input type="hidden" id="product_name_txt" value='<?php echo e(__("messages.product_name")); ?>'>
<input type="hidden" id="stock_avilable_txt" value='<?php echo e(__("messages.stock_avilable")); ?>'>
<input type="hidden" id="in_stock_txt" value='<?php echo e(__("messages.in_stock")); ?>'>
<input type="hidden" id="outstock_txt" value='<?php echo e(__("messages.outstock")); ?>'>
<input type="hidden" id="shipping_method_txt" value='<?php echo e(__("messages.shipping_method")); ?>'>
<input type="hidden" id="home_delivery_txt" value='<?php echo e(__("messages.home_delivery")); ?>'>
<input type="hidden" id="local_pickup_txt" value='<?php echo e(__("messages.local_pickup")); ?>'>
<input type="hidden" id="tax_name" value='<?php echo e(__("messages.tax_name")); ?>'>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ekiedo\resources\views/admin/report.blade.php ENDPATH**/ ?>