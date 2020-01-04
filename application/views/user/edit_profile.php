 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
     </div>

     <?php echo $this->session->flashdata('msg'); ?>

     <div class="row">
         <div class="col-lg-6">
             <div class="card shadow mb-4">
                 <div class="card-body">
                     <?= form_open_multipart('user/save_profile'); ?>
                     <div class="form-group row">
                         <div class="row">
                             <div class="col-lg-3"></div>
                             <div class="col-lg-6">
                                 <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                             </div>
                             <div class="col-lg-3"></div>
                         </div>
                         <div class="text-center" style="padding-top: 1vw; margin-left: 7vw;">
                             <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="image" name="image" value="<?php echo $user['image']; ?>">
                                 <label class="custom-file-label" for="image">Choose file</label>
                             </div>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="username" class="col-sm-4 col-form-label">Username</label>
                         <div class="col-sm-8">
                             <input type="text" name="username" class="form-control" id="username" value="<?php echo $user['username']; ?>">
                             <?php echo form_error('username', '<small class="text-danger pl-0">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="email" class="col-sm-4 col-form-label">Email</label>
                         <div class="col-sm-8">
                             <input type="text" name="email" class="form-control" id="email" value="<?php echo $user['email']; ?>">
                             <?php echo form_error('email', '<small class="text-danger pl-0">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="text-align-right">
                         <button type="submit" class="btn btn-primary btn-user btn-block">
                             Save profile
                         </button>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="card shadow mb-4">
                 <div class="card-body">
                     <?= form_open_multipart('user/change_password'); ?>
                     <div class="form-group row">
                         <label for="current_pass" class="col-sm-4 col-form-label">Current Password</label>
                         <div class="col-sm-8">
                             <input type="password" name="current_pass" class="form-control" id="current_pass">
                             <?php echo form_error('current_pass', '<small class="text-danger pl-0">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="new_pass1" class="col-sm-4 col-form-label">New Password</label>
                         <div class="col-sm-8">
                             <input type="password" name="new_pass1" class="form-control" id="new_pass1">
                             <?php echo form_error('new_pass1', '<small class="text-danger pl-0">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="new_pass2" class="col-sm-4 col-form-label">Confirm New Password</label>
                         <div class="col-sm-8">
                             <input type="password" name="new_pass2" class="form-control" id="new_pass2">
                         </div>
                     </div>
                     <div class="text-align-right">
                         <button type="submit" class="btn btn-primary btn-user btn-block">
                             Change password
                         </button>
                     </div>
                     </form>
                 </div>
             </div>
         </div>

     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->