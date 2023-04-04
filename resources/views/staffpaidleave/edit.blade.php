@extends('layouts.app')

@section('title', 'Pengajuan Cuti')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Cuti Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.staffpaidleave.update', $paidleave) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Jenis Cuti</label>
                                    <select class="form-control select2" name="type" id="type">
                                        <option value="">----PILIH----</option>
                                        <option value="Tahunan" {{ $paidleave->type == "Tahunan"  ? 'selected' : '' }}>Tahunan</option>
                                        <option value="Besar" {{ $paidleave->type == "Besar"  ? 'selected' : '' }}>Besar</option>
                                        <option value="Bersama" {{ $paidleave->type == "Bersama"  ? 'selected' : '' }}>Bersama</option>
                                        <option value="Hamil" {{ $paidleave->type == "Hamil"  ? 'selected' : '' }}>Hamil</option>
                                        <option value="Sakit" {{ $paidleave->type == "Sakit"  ? 'selected' : '' }}>Sakit</option>
                                        <option value="Penting" {{ $paidleave->type == "Penting"  ? 'selected' : '' }}>Penting</option>
                                    </select>
                                    @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="date_start" value="{{ $paidleave->date_start }}">
                                    @error('date_start')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="date_end" value="{{ $paidleave->date_end }}">
                                    @error('date_end')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Keterangan</label>
                                    <textarea name="description" class="form-control" cols="30" rows="5">{{ $paidleave->description }}</textarea>
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
