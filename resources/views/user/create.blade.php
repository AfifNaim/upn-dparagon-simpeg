@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pegawai</h1>
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
                            Halaman ini adalah menu Tambah Pegawai
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}">
                                    @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jenis Kelamin</label>
                                    <select class="form-control select2" name="gender" id="gender">
                                        <option value="">----PILIH----</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Agama</label>
                                    <select class="form-control select2" name="religion" id="religion">
                                        <option value="">----PILIH----</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Khatolik">Khatolik</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control  @error('birth_place') is-invalid @enderror" name="birth_place" value="{{ old('birth_place') }}">
                                    @error('birth_place')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat Domisili</label>
                                    <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ old('residence_address') }}">
                                    @error('residence_address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Status</label>
                                    <select class="form-control select2 " name="status" id="status">
                                        <option value="">----PILIH----</option>
                                        <option value="Lajang">Lajang</option>
                                        <option value="Kawin">Kawin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Anak</label>
                                    <input type="number" class="form-control  @error('child') is-invalid @enderror" name="child" value="{{ old('child') }}">
                                    @error('child')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jabatan</label>
                                    <select class="form-control select2" name="position_id" id="position_id">
                                        <option value="">----PILIH----</option>
                                        @foreach ($position as $positions)
                                            <option value="{{ $positions->id }}">{{ $positions->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Divisi</label>
                                    <select class="form-control select2" name="division_id" id="division_id">
                                        <option value="">----PILIH----</option>
                                        @foreach ($division as $divisions)
                                            <option value="{{ $divisions->id }}">{{ $divisions->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="date_in" value="{{ old('date_in') }}">
                                    @error('date_in')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Role</label>
                                    <select class="form-control select2" name="role" id="role">
                                        <option value="">----PILIH----</option>
                                        <option value="Staff">Staff</option>
                                        <option value="HRD">HRD</option>
                                        <option value="Admin">Admin</option>
                                    </select>
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