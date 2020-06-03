<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
  </div>
  <div class="sidebar-brand-text mx-3">Micro Library</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->

<li class="nav-item <?= ( strtolower($data['title']) === 'dashboard' ) ? 'active':''; ?>">
  <a class="nav-link" href="<?= BASE_URL.'admin/dashboard'; ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>
<li class="nav-item <?= ( strtolower($data['title']) === 'profil saya' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/profil/'; ?>" >
    <i class="fas fa-fw fa-user"></i>
    <span>Profil Saya</span>
  </a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Data Perpustakaan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?= ( strtolower($data['title']) === 'peminjaman' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3" href="<?= BASE_URL.'admin/peminjaman/'; ?>" >
    <i class="fas fa-fw fa-user-clock"></i>
    <span>Peminjaman</span>
  </a>
</li>
<li class="nav-item <?= ( strtolower($data['title']) === 'pengembalian' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/pengembalian/'; ?>" >
    <i class="fas fa-fw fa-caret-square-left"></i>
    <span>Pengembalian</span>
  </a>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Data Buku
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?= ( strtolower($data['title']) === 'buku' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3" href="<?= BASE_URL.'admin/buku/'; ?>" >
    <i class="fas fa-fw fa-book"></i>
    <span>Buku</span>
  </a>
</li>
<?php if( $_SESSION['petugas']['petugas_role_id'] === '1' ): ?>
<li class="nav-item <?= ( strtolower($data['title']) === 'kategori' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/kategori/'; ?>" >
    <i class="fas fa-fw fa-swatchbook"></i>
    <span>Kategori Buku</span>
  </a>
</li>
<li class="nav-item <?= ( strtolower($data['title']) === 'rak' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/rak/'; ?>" >
    <i class="fas fa-fw fa-box"></i>
    <span>Rak Buku</span>
  </a>
</li>
<li class="nav-item <?= ( strtolower($data['title']) === 'lokasi rak' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/lokasi/'; ?>" >
    <i class="fas fa-fw fa-boxes"></i>
    <span>Lokasi Rak Buku</span>
  </a>
</li>
<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Data Pengguna
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?= ( strtolower($data['title']) === 'anggota' ) ? 'active':''; ?>">
  <a class="nav-link collapsed pb-3" href="<?= BASE_URL.'admin/anggota/'; ?>" >
    <i class="fas fa-fw fa-users"></i>
    <span>Anggota</span>
  </a>
</li>

<?php if( $_SESSION['petugas']['petugas_role_id'] === '1' ): ?>
  <li class="nav-item <?= ( strtolower($data['title']) === 'petugas' ) ? 'active':''; ?>">
    <a class="nav-link collapsed pb-3 pt-0" href="<?= BASE_URL.'admin/petugas/'; ?>" >
      <i class="fas fa-fw fa-users-cog"></i>
      <span>Petugas</span>
    </a>
  </li>
<?php endif; ?>



<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline mt-2">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->