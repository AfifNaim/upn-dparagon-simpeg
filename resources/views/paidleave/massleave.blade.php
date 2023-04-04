@extends('layouts.app')

@section('title', 'Pengajuan Cuti')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Cuti Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.paidleave.storeMassLeave') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="date_start" value="{{ old('date_start') }}">
                                    @error('date_start')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="date_end" value="{{ old('date_end') }}">
                                    @error('date_end')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Keterangan</label>
                                    <textarea name="description" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route(Auth::user()->role.'.paidleave.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
