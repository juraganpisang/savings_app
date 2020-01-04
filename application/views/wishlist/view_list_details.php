 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>
     <div class="container-fluid">
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <div class="col-lg-7">
                     <h5 class="m-0 font-weight-bold text-primary">
                         <?php echo $list_details['category']; ?> | <?php echo $list_details['title']; ?>
                     </h5>
                 </div>
                 <div class="col-lg-4">
                     <div class="text-right">
                         Status: <?php echo $list_details['status']; ?>
                     </div>
                 </div>

                 <?php if ($list_details['status'] == 'on_going') { ?>
                     <div class="dropdown no-arrow">
                         <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-ellipsis-v fa-fw"></i>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                             <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cancelPlanModal"><i class="fas fa-trash fw"></i> Cancel plan</a>
                         </div>
                     </div>
                 <?php }; ?>
             </div>

             <?php if (($list_details['est_cost'] - $currentTotal) < 0) {
                    $needed = 0;
                } else {
                    $needed = $list_details['est_cost'] - $currentTotal;
                }; ?>

             <div class="card-body">
                 <?php if ($list_details['category'] == 'strict') { ?>
                     <div class="row">
                         <div class="col-lg-6">
                             <form>
                                 <div class="form-group row">
                                     <label for="description" class="col-sm-4 col-form-label">Description</label>
                                     <div class="col-sm-8">
                                         <textarea name="description" class="form-control" id="description" placeholder="<?php echo $list_details['description']; ?>" rows="3" disabled></textarea>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="esti_cost" class="col-sm-4 col-form-label">Estimated Cost</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="esti_cost" class="form-control" id="esti_cost" placeholder="Rp. <?php echo number_format($list_details['est_cost'], 0, '', '.'); ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="goal_dat" class="col-sm-4 col-form-label">Goal Date</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="goal_dat" class="form-control" id="goal_dat" placeholder="<?php echo $list_details['goal_date']; ?> (<?php echo $day_interval; ?> day(s) left)" disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="save_freq" class="col-sm-4 col-form-label">Saving Frequency</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="save_freq" class="form-control" id="save_freq" placeholder="Every <?php echo $list_details['save_freq']; ?> day(s)" disabled>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div class="col-lg-6">
                             <form>
                                 <div class="form-group row">
                                     <label for="sav_needed" class="col-sm-4 col-form-label">Saving Needed</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="save_needed" class="form-control" id="save_needed" placeholder="<?php echo $list_details['trans_needed']; ?> more time(s)" disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="save_amount" class="col-sm-4 col-form-label">Saving Amount</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="save_amount" class="form-control" id="save_amount" placeholder="Rp. <?php echo number_format($list_details['save_amount'], 0, '', '.'); ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="cost_needed" class="col-sm-4 col-form-label">Saving amount needed</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="cost_needed" class="form-control" id="cost_needed" placeholder="Rp. <?php echo number_format($needed, 0, '', '.'); ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="text-align">
                                     <h6>
                                         Created on <?php echo $list_details['created_on']; ?>
                                     </h6>
                                 </div>
                             </form>
                         </div>
                     </div>
                 <?php } else { ?>
                     <div class="row">
                         <div class="col-lg-6">
                             <form>
                                 <div class="form-group row">
                                     <label for="description" class="col-sm-4 col-form-label">Description</label>
                                     <div class="col-sm-8">
                                         <textarea name="description" class="form-control" id="description" placeholder="<?php echo $list_details['description']; ?>" rows="3" disabled></textarea>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="esti_cost" class="col-sm-4 col-form-label">Estimated Cost</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="esti_cost" class="form-control" id="esti_cost" placeholder="Rp. <?php echo number_format($list_details['est_cost'], 0, '', '.'); ?>" disabled>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div class="col-lg-6">
                             <form>
                                 <div class="form-group row">
                                     <label for="cost_needed" class="col-sm-4 col-form-label">Saving amount needed</label>
                                     <div class="col-sm-8">
                                         <input type="text" name="cost_needed" class="form-control" id="cost_needed" placeholder="Rp. <?php echo number_format($needed, 0, '', '.'); ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="text-align">
                                     <h6>
                                         Created on <?php echo $list_details['created_on']; ?>
                                     </h6>
                                 </div>
                             </form>
                         </div>
                     </div>
                 <?php }; ?>
                 <div class="row">
                     <div class="col-lg-3">
                     </div>
                     <div class="col-lg-6">
                         <?php if ($list_details['status'] == 'on_going') { ?>
                             <a class="btn btn-primary" href="<?php echo base_url('wishlist/save_plan/' . $list_details['list_id']); ?>" style="text-decoration: none; width: 100%;">
                                 Save now </a>
                         <?php } elseif ($list_details['status'] == 'completed') { ?>
                             Completed on <?php echo $list_details['complete_or_cancel_date']; ?>
                         <?php } elseif ($list_details['status'] == 'cancelled') { ?>
                             Cancelled on <?php echo $list_details['complete_or_cancel_date']; ?>
                         <?php }; ?>
                     </div>
                     <div class="col-lg-3">

                     </div>
                 </div>
             </div>
         </div>

         <!-- History -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">History</h6>
             </div>
             <div class="card-body">
                 <?php if ($list_id_details == false) { ?>
                     <div class="container-fluid justify-content-center text-center">
                         <div class="text-center">
                             <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_empty_xct9.svg" alt="">
                         </div>
                         <p>
                             No transactions yet.
                         </p>
                     </div>
                 <?php } else { ?>
                     <div style="overflow-y: scroll; height:200px;">
                         <table class="table table-striped">
                             <thead>
                                 <tr>
                                     <th scope="col">No. </th>
                                     <th scope="col">Transaction Date</th>
                                     <th scope="col">Detail Amount</th>
                                     <th scope="col">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $index = 1; ?>
                                 <?php foreach ($list_id_details as $value) { ?>
                                     <tr>
                                         <th scope="row"><?php echo $index; ?></th>
                                         <td><?php echo $value['tr_date']; ?></td>
                                         <td>Rp. <?php echo number_format($value['detail_amount'], 0, '', '.'); ?></td>
                                         <td><?php echo $value['action']; ?></td>
                                         <?php $index++; ?>
                                     </tr>
                                 <?php }; ?>
                             </tbody>
                         </table>
                     </div>
                 <?php }; ?>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->