 <?php $__env->startSection('content'); ?>
<div class="breadcrumbs">
    <div class="col-sm-4 float-right-1">
        <div class="page-header float-left float-right-1">
            <div class="page-title">
                <h1><?php echo e(__('messages.notification')); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8 float-left-1">
        <div class="page-header float-right float-left-1">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li>                     
                         <?php echo e(__('messages.notification')); ?>                 
                    </li> 
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
                    <div class="alert  <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert">
                        <?php echo e(Session::get('message')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                
                <button class="btn btn-primary btn-flat m-b-30 m-t-30" data-toggle="modal" data-target="#addsubcategorymodal">
                    <?php echo e(__('messages.notification')); ?>

                </button>
                <div class="table-responsive dtdiv">
                    <table id="notificationTable" class="table table-striped table-bordered dttablewidth">
                        <thead>
                            <tr>
                                <th><?php echo e(__('messages.id')); ?></th>
                                <th><?php echo e(__('messages.msg')); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="addsubcategorymodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">
               <?php echo e(__('messages.add_notification')); ?>

            </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(url('admin/sendnotification')); ?>" method="post">
               <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">
                            <?php echo e(__('messages.msg')); ?>

                        </label>
                        <input id="msg" name="msg" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" placeholder="<?php echo e(__('messages.msg')); ?>" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <?php echo e(__('messages.cancel')); ?>

                    </button>
                             <?php if(Session::get("is_demo")=='1'): ?>
                                     <button type="button" onclick="return alert('This function is currently disable as it is only a demo website, in your admin it will work perfect')" class="btn btn-lg btn-info btn-block">
                                              <?php echo e(__('messages.update')); ?>

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
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ekiedo\resources\views/admin/notification.blade.php ENDPATH**/ ?>