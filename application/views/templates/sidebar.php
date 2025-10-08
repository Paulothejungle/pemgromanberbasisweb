<ul class="navbar-nav bg-gradient-primary sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center"
  href="<?= site_url('dashboard') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">CI3 <sup>SB</sup></div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="<?= site_url('dashboard') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="<?= site_url('barang') ?> ">
      <i class="fas fa-box"></i>
      <span>Barang</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= site_url('kategori') ?>">
      <i class="fas fa-tags"></i>
      <span>Kategori</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= site_url('transaksi') ?>">
      <i class="fas fa-shopping-cart"></i>
      <span>Transaksi</span>
    </a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

</ul>

<div id="content-wrapper" class="d-flex flex-column">

  <div id="content">