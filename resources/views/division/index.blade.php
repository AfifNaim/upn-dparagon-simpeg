

@extends('layouts.app')

@section('title', 'Divisi')

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

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route(Auth::user()->role.'.division.create') }}" class="btn note-btn btn-success">Tambah Divisi</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
                                    <thead class="table-light">
                                        <td>No</td>
                                        <td>Divisi</td>
                                        <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($division as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td style="text-align: right">
                                            <form action="{{ route(Auth::user()->role.'.division.destroy',$user->id) }}" method="POST">
                                                <a href="{{ route(Auth::user()->role.'.division.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
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
                                    {!! $division->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection