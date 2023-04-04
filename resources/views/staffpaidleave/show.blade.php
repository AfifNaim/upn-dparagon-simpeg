@extends('layouts.app')

@section('title', 'Pengajuan Cuti')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Cuti Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-capitalize">Pegawai</label>
                                <input type="text" class="form-control" name="employee_id" value="{{ $paidleave->Employee->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Jenis Cuti</label>
                                <input type="text" class="form-control" name="type" value="{{ $paidleave->type }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Tanggal Pengajuan</label>
                                <input type="text" class="form-control" name="date_send" value="{{ $paidleave->date_send }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Tanggal Mulai</label>
                                <input type="text" class="form-control" name="date_start" value="{{ $paidleave->date_start }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Tanggal Selesai</label>
                                <input type="text" class="form-control" name="date_end" value="{{ $paidleave->date_end }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Keterangan</label>
                                <textarea name="description" class="form-control" cols="30" rows="5" disabled>{{ $paidleave->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Status</label>
                                <input type="text" class="form-control" name="status" value="{{ $paidleave->status }}" disabled>
                            </div>
                            <a href="{{ route(Auth::user()->role.'.staffpaidleave.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
