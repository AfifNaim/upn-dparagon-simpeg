@extends('layouts.app')

@section('title', 'Surat Peringatan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Surat Peringatan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
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
                                                <a target="_blank" href="{{ route(Auth::user()->role.'.warningletter.show', $data->id) }}" class="btn btn-success btn-sm">Show</a>
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
