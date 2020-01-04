<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block">
            <div class="text-center">
              <img class="img-fluid px-3 mt-3" style="width: 100%; height: 100%; padding-top: 2vw;" src="<?php echo base_url('assets/img/svg/'); ?>undraw_press_play_bx2d.svg" alt="">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <img class="img-fluid px-2 px-sm-4 mt-0 mb-1" src="<?php echo base_url('assets/img/'); ?>logo.png" alt="">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="<?php echo base_url('auth/register'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="fname" name="fname" placeholder="Full Name">
                  <?php echo form_error('fname', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                  <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <p>Already have an account? <span><a class="small" href="<?php echo base_url('auth/login'); ?>">Login!</a></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>