<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <div class="text-center">
                  <img class="img-fluid px-3 px-sm-4 mt-3 mb-1" src="<?php echo base_url('assets/img/svg/'); ?>undraw_mobile_login_ikmv.svg" alt="">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                  <img class="img-fluid px-2 px-sm-4 mt-0 mb-1" src="<?php echo base_url('assets/img/'); ?>logo.png" alt="">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>

                  <?php echo $this->session->flashdata('message'); ?>

                  <form class="user" method="post" action="<?php echo base_url('auth/login'); ?>">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email" value="<?php set_value('email'); ?>">
                      <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                      <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <p>Haven't already registered? <span><a class="small" href="<?php echo base_url('auth/register'); ?>">Create an Account!</a></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>