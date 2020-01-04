 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>

     <?php echo $this->session->flashdata('invalidamount'); ?>
     
     <div class="card border-left-primary shadow py-2">
         <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <h5 class="mb-0 font-weight-bold text-primary">
                     Withdraw details</h5>
             </div>
             <hr>
             <form method="post" action="<?= base_url('wallet/ok_withdraw/' . $wallet_id_details['list_id']); ?>">
                 <div class="form-group row">
                     <label for="title" class="col-lg-5 col-form-label">Title</label>
                     <div class="col-lg-7">
                         <input type="text" name="title" class="form-control" id="title" placeholder="" value="<?= $wallet_id_details['title']; ?>" disabled>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="saving_goal" class="col-lg-5 col-form-label">Estimated cost</label>
                     <div class="col-lg-7">
                         <input type="text" name="saving_goal" class="form-control" id="saving_goal" placeholder="" value="Rp. <?php echo number_format($wallet_id_details['est_cost'], 0, '', '.'); ?>" disabled>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="saved_total" class="col-lg-5 col-form-label">Saved total</label>
                     <div class="col-lg-7">
                         <input type="text" name="saved_total" class="form-control" id="saved_total" placeholder="" value="Rp. <?php echo number_format(($wallet_id_details['detail_amount'] - $wallet_id_details_withdraw['detail_amount']), 0, '', '.'); ?>" disabled>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="est_cost" class="col-lg-5 col-form-label">Withdraw amount</label>
                     <div class="col-lg-7">
                         <input type="text" name="est_cost" class="form-control" id="est_cost" placeholder="">
                     </div>
                 </div>
                 <div class="form-group row">
                     <div class="col-lg-12">
                         <div class="text-right">
                             <button type="submit" class="btn btn-primary" style="width: 30%;">Proceed</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->