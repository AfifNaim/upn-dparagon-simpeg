@extends('layouts.app')

@section('title', 'Surat Peringatan')

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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route(Auth::user()->role.'.warningletter.create') }}" class="btn note-btn btn-success">Tambah Surat Peringatan</a>
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
                                            <form action="{{ route(Auth::user()->role.'.warningletter.destroy',$data->id) }}" method="POST">
                                                <a target="_blank" href="{{ route(Auth::user()->role.'.warningletter.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
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
                                <div class="pagination justify-content-end">
                                    {!! $warningLatter->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
