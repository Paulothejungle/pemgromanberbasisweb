<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars">
  </button>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          <?= $user['nama']; ?>
        </span>
        <img class="img-profile rounded-circle"
            src="<?= base_url('assets/img/default.png') ?>" width="40">
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"></div>
  <a class="dropdwon-item" href="#">
    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
    Profile
  </a>
  <div class="dropdown-divider"></div>
  <span class="dropdown-item text-muted small">
  Last Login:
  <?= !empty($user['last_login']) ? date('d M Y H:i', strtotime($user['last_login'])) : 'Belum pernah login' ?>
</span>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    logout
  </a>
</div>
    </li>

  </ul>
</nav>
      