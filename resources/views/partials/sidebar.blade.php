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

    @if(Auth::user()->role != 'Admin')
    <ul class="sidebar-menu">
        <li class="menu-header">Staff</li>
        <li {{ Route::is(Auth::user()->role.'.staffpaidleave.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.staffpaidleave.index') }}"><i class="fas fa-list"></i><span>Data Riwayat Cuti</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.warningletter.history') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.warningletter.history') }}"><i class="fas fa-exclamation-triangle"></i><span>Data Riwayat Surat Peringatan</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.staffpaidleave.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.staffpaidleave.create') }}"><i class="fas fa-plus-square"></i><span>Pengajuan Cuti</span></a></li>
    </ul>
    @endif

    @if(Auth::user()->role != 'Staff')
    <ul class="sidebar-menu">
        <li class="menu-header">HRD</li>
        <li {{ Route::is(Auth::user()->role.'.employee.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.employee.index') }}"><i class="fas fa-user"></i><span>Data Pegawai</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.paidleave.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.paidleave.index') }}"><i class="fas fa-money-check"></i><span>Data Cuti</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.warningletter.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.warningletter.index') }}"><i class="fas fa-exclamation-triangle"></i><span>Surat Peringatan</span></a></li>
    </ul>
    @endif

    @if(Auth::user()->role == 'Admin')
    <ul class="sidebar-menu">
        <li class="menu-header">Admin</li>
        <li {{ Route::is(Auth::user()->role.'.employee.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.employee.index') }}"><i class="fas fa-user"></i><span>Data Pegawai</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.position.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.position.index') }}"><i class="fas fa-briefcase"></i><span>Data Posisi</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.division.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.division.index') }}"><i class="fas fa-window-restore"></i><span>Data Jabatan</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.paidleave.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.paidleave.index') }}"><i class="fas fa-money-check"></i><span>Data Cuti</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.warningletter.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.warningletter.index') }}"><i class="fas fa-exclamation-triangle"></i><span>Surat Peringatan</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.rule.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.rule.index') }}"><i class="fas fa-exclamation"></i><span>Peraturan Perusahaan</span></a></li>
        <li {{ Route::is(Auth::user()->role.'.company.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route(Auth::user()->role.'.company.index') }}"><i class="fas fa-building"></i><span>Data Perusahaan</span></a></li>
    </ul>
    @endif

</aside>
