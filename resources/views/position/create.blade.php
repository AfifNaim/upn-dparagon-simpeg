

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route(Auth::user()->role.'.position.create') }}" class="btn note-btn btn-success">Tambah User</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.position.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label>Posisi</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Gaji</label>
                                    <input type="number" class="form-control  @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}">
                                    @error('salary')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route(Auth::user()->role.'.position.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection