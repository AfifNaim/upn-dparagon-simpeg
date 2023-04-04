@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-7">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Daftar Pengajuan Cuti</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-borderless table-xs">
                                    <thead class="table-light">
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td class="text-center">Tipe Cuti</td>
                                    <td class="text-center">Tanggal Pengajuan</td>
                                    <td class="text-center">Status</td>
                                    <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    ?>
                                    @foreach ($paidLeave as $data)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->Employee->name }}</td>
                                            <td class="text-center">{{ $data->type }}</td>
                                            <td class="text-center">{{ date('d F Y', strtotime($data->date_send)) }}
                                            </td>
                                            <td class="text-center"><span
                                                <?php
                                                if ($data->status == 'Diterima HRD') {
                                                    echo 'class="label bg-success"';
                                                }
                                                if ($data->status == 'Ditolak HRD') {
                                                    echo 'class="label bg-danger"';
                                                }
                                                if ($data->status == 'Dalam Proses') {
                                                    echo 'class="label bg-info"';
                                                }
                                                ?>

                                                >{{ $data->status }}</span >
                                            <td style="text-align: right">
                                                <a href="{{ route(Auth::user()->role.'.paidleave.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Daftar Surat Peringatan</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-borderless table-xs">
                                    <thead class="table-light">
                                    <td>No</td>
                                    <td>Info Surat Peringatan</td>
                                    <td>Pelanggaran</td>
                                    <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    ?>
                                    @foreach ($warningletter as $data)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $data->Employee->name }}
                                                <br>
                                                {{ 'Dibuat : ' . date('d F Y', strtotime($data->date)) }}
                                                <br>
                                                {{ 'Tingkat : SP-' . $data->level }}
                                            </td>
                                            <td class="text-center" hidden></td>
                                            <td>
                                                <ul>
                                                    @if ($data->level != 'III')
                                                        @foreach ($data->warning as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    @else
                                                        <li>-</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td style="text-align: right">
                                                <a target="_blank" href="{{ route(Auth::user()->role.'.warningletter.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-md" id="data_table">
                                <thead class="table-light">
                                    <td>No</td>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    <td style="text-align: right">Action</td>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    ?>
                                    @foreach ($employee as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><b>{{ $user->id }}</b></span>
                                            <br>
                                            <span class="label bg-success">{{ $user->role }}</span>
                                            <br>
                                            {{ $user->name }}
                                            <br>
                                            <span class="label bg-warning">{{ @$user->Division->name }}</span>
                                            <span class="label bg-teal">

                                                @if ($user->position_id == null)
                                                    <b>Belum Ada Jabatan</b>
                                                @else
                                                    {{ $user->Position->name }}
                                                @endif

                                            </span>
                                            <br>
                                            {{ $user->email . ' / ' . $user->name }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td style="text-align: right">
                                        <a href="{{ route(Auth::user()->role.'.employee.show', $user->id) }}" class="btn btn-success btn-sm">Show</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection
