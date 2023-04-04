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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
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
                                            <td class="text-center"><span
                                            <?php if ($data->status == 'Diterima HRD') {
                                                echo 'class="label bg-success"';
                                            }
                                            if ($data->status == 'Ditolak HRD') {
                                                echo 'class="label bg-danger"';
                                            }
                                            if ($data->status == 'Dalam Proses') {
                                                echo 'class="label bg-info"';
                                            }
                                            ?>>{{ $data->status }}</span>
                                            <td style="text-align: center">
                                            @if($data->status == ('Dalam Proses'))
                                                <a href="{{ route(Auth::user()->role.'.staffpaidleave.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route(Auth::user()->role.'.staffpaidleave.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
                                                <form action="{{ route(Auth::user()->role.'.staffpaidleave.destroy',$data) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                </form>
                                            @else
                                                <a href="{{ route(Auth::user()->role.'.staffpaidleave.pdf', $data->id) }}" class="btn btn-primary btn-sm">Surat</a>
                                                <a href="{{ route(Auth::user()->role.'.staffpaidleave.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $paidLeave->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
