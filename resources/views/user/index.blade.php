@extends('layouts.app')

@section('title', 'Pengajuan Pegawai')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master Data Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route(Auth::user()->role.'.employee.create') }}" class="btn note-btn btn-success">Tambah User</a>
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
                                            <form action="{{ route(Auth::user()->role.'.employee.destroy',$user->id) }}" method="POST">
                                                <a href="{{ route(Auth::user()->role.'.employee.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route(Auth::user()->role.'.employee.show', $user->id) }}" class="btn btn-success btn-sm">Show</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                            @if (Auth::user()->role == "Admin")
                                            <form action="{{ route(Auth::user()->role.'.employee.reset',$user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin mereset password data ini?')">Reset</button>
                                            </form>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $employee->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
