 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-6">
                 <div class="card bg-primary text-white shadow">
                     <div class="card-body">
                         <div class="text-white-900">
                             <h3>Strict Saving Plan</h3>
                         </div>
                         <hr>
                         <div class="text-white-500 medium" style="padding-bottom: .8vw;">
                             Decide how much you want to save for your wishlist, how often you plan to save and when you want to achieve it. 
                             We will do the calculations for you. You cannot withdraw any cents from this plan before it is completed.
                             So consider everything carefully. This plan is great for you if you want to be discipline. That is the key.  
                         </div>
                         <div class="text-right">
                             <a href="<?php echo base_url('wishlist/create_plan_1'); ?>" class="btn btn-info">Choose this plan</a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="card bg-info text-white shadow">
                     <div class="card-body">
                         <div class="text-white-900">
                             <h3>Flexible Saving Plan</h3>
                         </div>
                         <hr>
                         <div class="text-white-500 medium" style="padding-bottom: .8vw;">
                            A more flexible way of saving. Decide how much you want to save for your wishlist then save whenever and how much you need to. 
                            It is up to you. You can withdraw your savings from this plan. We will tell you whenever it is completed. Just relax!
                         </div>
                         <div class="text-right">
                             <a href="<?php echo base_url('wishlist/create_plan_2'); ?>" class="btn btn-primary">Choose this plan</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->