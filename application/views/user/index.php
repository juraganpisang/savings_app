 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     <?php if ($ongoing != false) { ?>
       <div class="card shadow">
         <a class="btn btn-primary" href="<?php echo base_url('wishlist/choose_plan'); ?>">
           <i class="fas fa-plus fa-fw"></i>
           Create a new plan
         </a>
       </div>
     <?php }; ?>
   </div>

   <div class="row">

     <div class="col-lg-6">
       <div class="justify-content-center">
         <?php if ($ongoing == false) { ?>
           <div class="text-center">
             <div class="text-center">
               <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_savings_hjfl.svg" alt="">
             </div>
             <p>
               You currently have no on-going plans. Start saving now.
             </p>
             <a href="<?php echo base_url('wishlist/choose_plan'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-plus-circle"></i></a>
           </div>
         <?php } else { ?>
           <a href="<?php echo base_url('wishlist'); ?>" style="text-decoration: none;">
             <div class="card border-left-primary shadow h-100 py-2">
               <div class="card-body">
                 <div class="row">
                   <div class="col-lg-4">
                     <img class="img-fluid px-3 px-sm-4 mt-2 mb-2" style="width: 13rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_site_stats_l57q.svg" alt="">
                   </div>
                   <div class="col-lg-8">
                     <p class="font-weight-bold text-primary mt-3" style="font-size: 1.5vw;">You seem to have something in your wishlists. Check it out now.</p>
                   </div>
                 </div>
               </div>
             </div>
           </a>
           <br>
           <a href="<?php echo base_url('wallet'); ?>" style="text-decoration: none;">
             <div class="card border-left-success shadow h-100 py-2">
               <div class="card-body">
                 <div class="row">
                   <div class="col-lg-8">
                     <p class="font-weight-bold text-primary mt-3" style="font-size: 1.5vw;">Find out what you can do with your wallet.</p>
                   </div>
                   <div class="col-lg-4">
                     <img class="img-fluid px-3 px-sm-4 mt-2 mb-2" style="width: 13rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_wallet_aym5.svg" alt="">
                   </div>
                 </div>
               </div>
             </div>
           </a>
         <?php }; ?>
       </div>
       <br>
     </div>

     <div class="col-lg-6">
       <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Recent activities</h6>
         </div>
         <div class="card-body">
           <?php if ($activities == false) { ?>
             <div class="container-fluid justify-content-center text-center">
               <div class="text-center">
                 <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
               </div>
               <p>
                 No activities yet.
               </p>
             </div>
           <?php } else { ?>
             <?php $i = 0; ?>
             <?php foreach ($activities as $value) { ?>
               <div>
                 <p class="mb-1"><span class="m-0 font-weight-bold text-primary">- <?php echo $value['done_on']; ?></span> You <?php echo $value['activity']; ?>.</p>
               </div>
               <?php $i++; ?>
               <?php if ($i == 7) { ?>
                 <?php break; ?>
               <?php }; ?>
             <?php }; ?>
             <a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url('user/history'); ?>">See more</a>
           <?php }; ?>
         </div>
       </div>
     </div>
   </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->