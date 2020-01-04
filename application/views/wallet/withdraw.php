 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>

     <?php echo $this->session->flashdata('message'); ?>

     <div class="card border-left-success shadow h-200 py-2 mb-3">
         <div class="card-body">
             <div class="row no-gutters">
                 <h5 class="mb-3 font-weight-bold text-primary">
                     Saving plan history</h5>
             </div>
             <hr class="mt-0">
             <div class="container">
                 <form method="post" action="<?php echo base_url('wallet/choose_status'); ?>">
                     <div class="form-group row">
                         <label class="col-lg-3" for="select_status">Status</label>
                         <select class="form-control col-lg-6" name="select_status" id="select_status">
                             <option><?php echo $choice; ?> (chosen)</option>
                             <option value="on_going">on_going</option>
                             <option value="completed">completed</option>
                             <option value="cancelled">cancelled</option>
                         </select>
                         <button type="submit" class="btn btn-primary col-lg-3" style="width:20%; ">
                             <i class="fas fa-search fa-fw"></i>
                         </button>
                     </div>
                 </form>
             </div>

             <?php if ($wallet_details == false) { ?>
                 <div class="container-fluid justify-content-center text-center">
                     <div class="text-center">
                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
                     </div>
                     <p>
                         No transactions yet.
                     </p>
                 </div>
             <?php } else { ?>
                 <div style="overflow-y: scroll; height:300px;">
                     <table class="table table-striped" data-link="row">
                         <thead>
                             <tr>
                                 <th scope="col">No. </th>
                                 <th scope="col">Title</th>
                                 <th scope="col">Category</th>
                                 <th scope="col">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $index = 1; ?>
                             <?php foreach ($wallet_details as $value) { ?>
                                 <tr>
                                     <th scope="row"><?php echo $index; ?></th>
                                     <td><?php echo $value['title']; ?></td>
                                     <td><?php echo $value['category']; ?></td>
                                     <?php $index++; ?>
                                     <td><a class="btn btn-success" href="<?php echo base_url('wallet/confirm_withdraw/' . $value['list_id']); ?>">
                                             Choose
                                         </a></td>
                                 </tr>
                             <?php }; ?>
                         </tbody>
                     </table>
                 </div>
             <?php }; ?>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->