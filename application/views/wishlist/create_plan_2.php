 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
   </div>
   <div class="container-fluid">
     <div class="card shadow mb-4">
       <!-- Card Header - Dropdown -->
       <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <h6 class="m-0 font-weight-bold text-primary">New Flexible Saving plan</h6>
       </div>
       <!-- Card Body -->
       <div class="card-body">

         <?php echo $this->session->flashdata('invalidcost'); ?>

         <form method="post" action="<?= base_url('wishlist/create_plan_2'); ?>">
           <div class="form-group row">
             <label for="title" class="col-sm-2 col-form-label">Title</label>
             <div class="col-sm-10">
               <input type="text" name="title" class="form-control" id="title" placeholder="" value="<?= set_value('title'); ?>">
               <?php echo form_error('title', '<small class="text-danger pl-1">', '</small>'); ?>
             </div>
           </div>
           <div class="form-group row">
             <label for="description" class="col-sm-2 col-form-label">Description</label>
             <div class="col-sm-10">
               <textarea name="description" class="form-control" id="description" placeholder="" value="<?= set_value('description'); ?>" rows="3"></textarea>
             </div>
           </div>
           <div class="form-group row">
             <label for="est_cost" class="col-sm-2 col-form-label">Estimated Cost</label>
             <div class="col-sm-10">
               <input type="text" name="est_cost" class="form-control" id="est_cost" placeholder="" value="<?= set_value('est_cost'); ?>">
             </div>
           </div>
           <div class="form-group row">
             <div class="col-sm-12">
               <div class="text-right">
                 <button type="submit" class="btn btn-primary" style="width: 30%;">Create</button>
               </div>
             </div>
           </div>
         </form>
       </div>
     </div>

   </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->