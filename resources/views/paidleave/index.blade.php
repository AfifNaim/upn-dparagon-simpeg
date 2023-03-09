@extends('layouts.app')

@section('title', 'Cuti Pegawai')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cuti Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Informasi Halaman</h4>
                            <div class="card-header-action">
                                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            Halaman ini adalah menu Pengajuan Cuti Pegawai
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('paidleave.create') }}" class="btn note-btn btn-success">Buat Cuti</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
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
                                            <td class="text-center"><span <?php if ($data->status == 'Diterima HRD' || $data->status == 'Diterima Manager') {
                                                echo 'class="label bg-success"';
                                            }
                                            if ($data->status == 'Ditolak HRD' || $data->status == 'Ditolak Manager') {
                                                echo 'class="label bg-danger"';
                                            }
                                            if ($data->status == 'Diproses') {
                                                echo 'class="label bg-info"';
                                            }
                                            ?>>{{ $data->status }}</span>
                                            <td style="text-align: right">
                                            <form action="{{ route('paidleave.destroy',$data) }}" method="POST">
                                                <a href="{{ route('paidleave.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('paidleave.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
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