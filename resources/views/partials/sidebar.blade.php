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

      @if (Auth::user()->role == 'Admin')
        <li class="menu-header">Master</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Master Pegawai</span></a>
            <ul class="dropdown-menu">
                <li {{ Route::is('employee.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('employee.index') }}"><span>Data Pegawai</span></a></li>
                <li {{ Route::is('position.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('position.index') }}"><span>Data Jabatan</span></a></li>
                <li {{ Route::is('division.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('division.index') }}"><span>Data Divisi</span></a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Master Riwayat</span></a>
          <ul class="dropdown-menu">
              <li {{ Route::is('employee.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('employee.index') }}"><span>Data Pegawai</span></a></li>
              <li {{ Route::is('position.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('position.index') }}"><span>Data Jabatan</span></a></li>
              <li {{ Route::is('division.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('division.index') }}"><span>Data Divisi</span></a></li>
          </ul>
      </li>
        <li><a class="nav-link" href=""><i class="fas fa-users"></i> <span>Juri</span></a></li>
      @endif

  </ul>
</aside>
