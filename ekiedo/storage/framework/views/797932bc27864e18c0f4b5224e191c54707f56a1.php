<?php $__env->startSection('content'); ?>
<div class="breadcrumbs">
   <div class="col-sm-4 float-right-1">
      <div class="page-header float-left float-right-1">
         <div class="page-title">
            <h1><?php echo e(__('messages.users')); ?></h1>
         </div>
      </div>
   </div>
   <div class="col-sm-8 float-left-1">
      <div class="page-header float-right float-left-1">
         <div class="page-title">
            <ol class="breadcrumb text-right">
               <li class="active"><?php echo e(__('messages.users')); ?></li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="content mt-3">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <?php if(Session::has('message')): ?>
            <div class="col-sm-12">
               <div class="alert  <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            </div>
            <?php endif; ?>
            <button  data-toggle="modal" data-target="#adduser" class="btn btn-primary btn-flat m-b-30 m-t-30" ><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.users')); ?></button>
            <div class="table-responsive dtdiv">
               <table id="userTable" class="table table-striped table-bordered dttablewidth">
                  <thead>
                     <tr>
                        <th><?php echo e(__('messages.id')); ?></th>
                        <th><?php echo e(__('messages.name')); ?></th>
                        <th><?php echo e(__('messages.email')); ?></th>
                        <th><?php echo e(__('messages.phone')); ?></th>
                        <th><?php echo e(__('messages.action')); ?></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel"><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.users')); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?php echo e(url('admin/adduser')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="user_type" value="1"/>
            <div class="modal-body">
               <div class="form-group col-md-12 paddiv">
                  <div class="col-md-12">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.first_name')); ?><span class="reqfield">*</span></label>
                     <input id="first_name" name="first_name" type="text" class="form-control" required  placeholder="<?php echo e(__('messages.first_name')); ?>">
                  </div>
               </div>
               <div class="form-group col-md-12 paddiv">
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.email')); ?><span class="reqfield">*</span></label>
                     <input id="email" name="email" type="text" class="form-control" required placeholder="<?php echo e(__('messages.email')); ?>">
                  </div>
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.phone')); ?></label>
                     <input id="phone" name="phone" type="text" class="form-control"  placeholder="<?php echo e(__('messages.phone')); ?>">
                  </div>
               </div>
               <div class="form-group col-md-12">
                  <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.address')); ?></label>
                  <textarea class="form-control" placeholder="<?php echo e(__('messages.address')); ?>" name="address" id="address" ></textarea>
               </div>
               <div class="form-group col-md-12 paddiv">
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.password')); ?><span class="reqfield">*</span></label>
                     <input id="password" name="password" type="password" class="form-control" required placeholder="****">
                  </div>
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.confirm_password')); ?><span class="reqfield">*</span></label>
                     <input id="confirm_password" name="confirm_password" type="password" class="form-control" required placeholder="***" onchange="checkbothpwd(this.value)">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('messages.cancel')); ?></button>
                     <?php if(Session::get("is_demo")=='1'): ?>
                         <button type="button" onclick="return alert('This function is currently disable as it is only a demo website, in your admin it will work perfect')" class="btn btn-primary">
                                 <?php echo e(__('messages.submit')); ?>

                        </button>
                     <?php else: ?>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.submit')); ?></button>
                     <?php endif; ?>               
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">
               <?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.users')); ?>

            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?php echo e(url('admin/updateuser')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="id" id="id" />
            <div class="modal-body">
               <div class="form-group col-md-12 paddiv">
                  <div class="col-md-12">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.first_name')); ?><span class="reqfield">*</span></label>
                     <input id="edit_first_name" name="first_name" type="text" class="form-control" required  placeholder="<?php echo e(__('messages.first_name')); ?>">
                  </div>
               </div>
               <div class="form-group col-md-12 paddiv">
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.email')); ?><span class="reqfield">*</span></label>
                     <input id="edit_email" name="email" type="text" class="form-control" readonly placeholder="<?php echo e(__('messages.email')); ?>">
                  </div>
                  <div class="col-md-6">
                     <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.phone')); ?></label>
                     <input id="edit_phone" name="phone" type="text" class="form-control"  placeholder="<?php echo e(__('messages.phone')); ?>">
                  </div>
               </div>
               <div class="form-group col-md-12">
                  <label for="cc-payment" class="control-label mb-1"><?php echo e(__('messages.address')); ?></label>
                  <textarea class="form-control" placeholder="<?php echo e(__('messages.address')); ?>" name="address" id="edit_address" ></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('messages.cancel')); ?></button>
                     <?php if(Session::get("is_demo")=='1'): ?>
                         <button type="button" onclick="return alert('This function is currently disable as it is only a demo website, in your admin it will work perfect')" class="btn btn-primary">
                                 <?php echo e(__('messages.submit')); ?>

                        </button>
                     <?php else: ?>
                         <button type="submit" class="btn btn-primary"><?php echo e(__('messages.submit')); ?></button>
                     <?php endif; ?>
            </div>
         </form>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ekiedo\resources\views/admin/user/default.blade.php ENDPATH**/ ?>