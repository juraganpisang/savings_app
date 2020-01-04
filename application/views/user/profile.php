<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    <div class="card shadow">
      <a class="btn btn-primary" href="<?php echo base_url('user/edit_profile'); ?>">
        <i class="fas fa-edit fa-fw"></i>
        Edit profile
      </a>
    </div>
  </div>

  <?php echo $this->session->flashdata('message'); ?>

  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>" class="card-img border">
            </div>
            <div class="col-lg-3"></div>
          </div>
          <div class="text-center" style="padding-top: 1vw;">
            <h4 class="text-dark"><?php echo $user['username']; ?></h4>
          </div>
          <div class="container">
            <div class="form-group row mb-0" style="font-size: 1.5vw;">
              <label for="username" class="col-lg-4 col-form-label">Username</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="username" style="border:none; background-color: white; font-size: 1.5vw;" value="<?php echo $user['username']; ?>" disabled>
              </div>
            </div>
            <div class="form-group row mb-0" style="font-size: 1.5vw;">
              <label for="email" class="col-lg-4 col-form-label">Email</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="email" style="border:none; background-color: white; font-size: 1.5vw;" value="<?php echo $user['email']; ?>" disabled>
              </div>
            </div>
            <div class="form-group row" style="font-size: 1.5vw;">
              <label for="created" class="col-lg-4 col-form-label">Created on</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="created" style="border:none; background-color: white; font-size: 1.5vw;" value="<?php echo $user['register_date']; ?>" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3"></div>
    <!-- <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-body">
          <p></p>
        </div>
      </div>
    </div> -->
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->