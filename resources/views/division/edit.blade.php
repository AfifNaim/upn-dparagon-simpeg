

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
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.division.update', $division->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $division->name }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <input type="submit" value="Update" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route(Auth::user()->role.'.division.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection