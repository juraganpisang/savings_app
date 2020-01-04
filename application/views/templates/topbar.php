<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link" href="<?php echo base_url('wallet') ?>" aria-haspopup="true" aria-expanded="false">
            <!-- <i class="fas fa-bell fa-fw"></i> -->
            <div class="card mr+6 bg-primary text-white shadow">
              <div class="card-body" style="padding: .8vw;">
                <i class="fas fa-coins fa-fw"></i>
                Rp. <?php echo number_format($wallet_value, 0, '', '.'); ?>
              </div>
            </div>
          </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-3 d-none d-lg-inline text-gray-900 medium">Hello, <?php echo $user['username']; ?></span>
            <img class="img-profile border rounded-circle" src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?php echo base_url('user/profile') ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->