 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
   </div>

   <?php echo $this->session->flashdata('message'); ?>
   
   <div class="container-fluid justify-content-center text-center" style="padding-top: 12vw;">
     <p>
       You don't have any plans yet. Start saving now.
     </p>
     <a href="<?php echo base_url('wishlist/choose_plan'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-plus-circle"></i></a>
   </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->