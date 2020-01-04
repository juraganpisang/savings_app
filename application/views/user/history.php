 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>

     <div class="container-fluid justify-content-center">
         <div class="row">
             <div class="col-lg-6">
                 <div class="text-center">
                     <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_reminders_697p.svg" alt="">
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         <h6 class="m-0 font-weight-bold text-primary">User activities</h6>
                     </div>

                     <div class="card-body">
                         <?php if ($recent_activities == false) { ?>
                             <div class="container-fluid justify-content-center text-center">
                                 <div class="text-center">
                                     <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_no_data_qbuo.svg" alt="">
                                 </div>
                                 <p>
                                     No activities yet.
                                 </p>
                             </div>
                         <?php } else { ?>
                             <div style="overflow-y: scroll; height:270px;">
                                 <?php foreach ($recent_activities as $value) { ?>
                                     <div>
                                         <p class="mb-1"><span class="m-0 font-weight-bold text-primary">- <?php echo $value['done_on']; ?></span> You <?php echo $value['activity']; ?>.</p>
                                     </div>
                                 <?php }; ?>
                             </div>
                         <?php }; ?>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->