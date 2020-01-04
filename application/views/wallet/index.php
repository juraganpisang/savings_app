 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
         <div class="card shadow">
             <a class="btn btn-primary" href="<?php echo base_url('wallet/withdraw'); ?>">
                 <i class="fas fa-money-check-alt fa-fw"></i>
                 Withdraw
             </a>
         </div>
     </div>

     <?php echo $this->session->flashdata('message'); ?>

     <div class="row">
         <div class="col-lg-6">
             <div class="card border-left-primary shadow py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="text-center">
                             <h1 class="mb-0 font-weight-bold text-primary">
                                 <i class="fas fa-money-check-alt fa-fw"></i>
                                 Rp. <?php echo number_format($wallet_value, 0, '', '.'); ?>
                             </h1>
                         </div>
                     </div>
                 </div>
             </div>
             <br><br>
             <div class="row no-gutters align-items-center">
                 <div class="container text-center">
                     <div class="text-center">
                         <img class="img-fluid px-2 px-4 mt-5 mb-2" style="width: 30rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_wallet_aym5.svg" alt="">
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Wallet History</h6>
                 </div>
                 <div class="card-body">
                     <?php if (($deposit_activities == false) && ($withdraw_activities == false)) { ?>
                         <div class="row no-gutters align-items-center">
                             <div class="container text-center">
                                 <div class="text-center">
                                     <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
                                 </div>
                                 <p>
                                     No wallet activities yet.
                                 </p>
                             </div>
                         </div>
                     <?php } else { ?>
                         <?php if ($deposit_activities == false) { ?>
                             <div class="row no-gutters align-items-center">
                                 <div class="container text-center">
                                     <div class="text-center">
                                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
                                     </div>
                                     <p>
                                         No deposit activities yet.
                                     </p>
                                 </div>
                             </div>
                         <?php } else { ?>
                             <h6 class="ml-2 font-weight-bold text-primary">Deposit activities</h6>
                             <div class="row">
                                 <?php foreach ($deposit_activities as $value) { ?>
                                     <div class="container">
                                         <p class="mb-1"><span class="m-0 font-weight-bold text-primary">- <?php echo $value['done_on']; ?></span> You <?php echo $value['activity']; ?>.</p>
                                     </div>
                                 <?php }; ?>
                             </div>
                         <?php }; ?>
                         <hr>
                         <?php if ($withdraw_activities == false) { ?>
                             <div class="row no-gutters align-items-center">
                                 <div class="container text-center">
                                     <div class="text-center">
                                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
                                     </div>
                                     <p>
                                         No withdraw activities yet.
                                     </p>
                                 </div>
                             </div>
                         <?php } else { ?>
                             <h6 class="m-2 font-weight-bold text-primary">Withdraw activities</h6>
                             <div class="row">
                                 <?php foreach ($withdraw_activities as $value) { ?>
                                     <div class="container">
                                         <p class="mb-1"><span class="m-0 font-weight-bold text-primary">- <?php echo $value['done_on']; ?></span> You <?php echo $value['activity']; ?>.</p>
                                     </div>
                                 <?php }; ?>
                             </div>
                         <?php }; ?>
                     <?php }; ?>
                 </div>
                 <a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url('user/history'); ?>">See more</a>
             </div>

         </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->