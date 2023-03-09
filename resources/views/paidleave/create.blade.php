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
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Informasi Halaman</h4>
                            <div class="card-header-action">
                                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            Halaman ini adalah menu Pengajuan Cuti Pegawai
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('paidleave.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Pegawai</label>
                                    <select class="form-control select2" name="employee" id="employee">
                                        <option value="">----PILIH----</option>
                                        @foreach ($employee as $employees)
                                            <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jenis Cuti</label>
                                    <select class="form-control select2" name="type" id="type">
                                        <option value="">----PILIH----</option>
                                        <option value="Tahunan">Tahunan</option>
                                        <option value="Besar">Besar</option>
                                        <option value="Bersama">Bersama</option>
                                        <option value="Hamil">Hamil</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Penting">Penting</option>
                                    </select>
                                    @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
                                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection