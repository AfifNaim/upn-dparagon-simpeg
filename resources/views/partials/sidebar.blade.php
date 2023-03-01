<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">DASHBOARD</li>
      <li {{ Route::is('home') ? 'class=active' : '' }} ><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
      <li><a class="nav-link" target="_blank" href="{{ route('landingpage') }}"><i class="fas fa-scroll"></i> <span>Halaman Utama</span></a></li>
  </ul>
</aside>
