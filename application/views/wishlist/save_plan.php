 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>
     <div class="container-fluid">

         <?php echo $this->session->flashdata('invalidamount'); ?>

         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary"><?php echo $list_title; ?></h6>
             </div>
             <div class="card-body">
                 <?php if ($list_details['category'] == 'strict') { ?>
                     <p>Save amount: Rp. <?php echo number_format($list_details['save_amount'], 0, '', '.'); ?></p>
                     <a class="btn btn-danger" href="<?php echo base_url('wishlist/view_list_details/' . $id); ?>" style="text-decoration: none;">
                         Cancel
                     </a>
                     <a class="btn btn-info" href="<?php echo base_url('wishlist/pay_plan_1/' . $id); ?>" style="text-decoration: none;">
                         Proceed
                     </a>
                 <?php } else { ?>
                     <form method="post" action="<?php echo base_url('wishlist/pay_plan_2/' . $id); ?>">
                         <div class="form-group row">
                             <label for="est_cost" class="col-sm-2 col-form-label">Save amount</label>
                             <div class="col-sm-10">
                                 <input type="text" name="est_cost" class="form-control" id="est_cost" placeholder="" value="">
                             </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-sm-12">
                                 <div class="text-right">
                                     <a type="button" href="<?php echo base_url('wishlist/'); ?>" class="btn btn-danger"  style="text-decoration: none;">Cancel</a>
                                     <button type="submit" class="btn btn-info">Proceed</button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 <?php }; ?>
             </div>
         </div>

     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->