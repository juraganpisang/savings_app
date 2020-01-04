<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center" href="<?php echo base_url('user'); ?>">
    <div class="sidebar-brand-icon">
      <img class="img-fluid px-3 mt-0 mb-1" src="<?php echo base_url('assets/img/'); ?>logobrand.png" alt="logo">
    </div>
    <div class="sidebar-brand-text mx-3 ml-2">Hero</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url('user') ?>">
      <i class="fas fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Features
  </div>

  <li class="nav-item ">
    <a class="nav-link" href="<?php echo base_url('wishlist') ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>My Wishlists</span></a>
  </li>

  <li class="nav-item ">
    <a class="nav-link" href="<?php echo base_url('wallet') ?>">
      <i class="fas fa-fw fa-wallet"></i>
      <span>My Wallet</span></a>
  </li>

  <li class="nav-item ">
    <a class="nav-link" href="<?php echo base_url('user/history') ?>">
      <i class="fas fa-fw fa-history"></i>
      <span>History</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Personal
  </div>

  <li class="nav-item ">
    <a class="nav-link" href="<?php echo base_url('user/profile') ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>My Profile</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item ">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-sign-out-alt fa-fw"></i>
      <span>Log out</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->