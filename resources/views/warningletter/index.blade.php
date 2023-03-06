@extends('layouts.app')

@section('tittle', 'Surat Peringatan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master Data Surat Peringatan</h1>
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
                            Halaman ini adalah menu Surat Peringatan
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('warningletter.create') }}" class="btn note-btn btn-success">Tambah Surat Peringatan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
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
                                        @foreach ($warningLatter as $data)
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
                                            <form action="{{ route('warningletter.destroy',$data->id) }}" method="POST">
                                                <a href="{{ route('warningletter.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('warningletter.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
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