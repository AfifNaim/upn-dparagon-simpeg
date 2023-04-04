@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.employee.update', $employee->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ $employee->nik }}">
                                    @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jenis Kelamin</label>
                                    <select class="form-control select2" name="gender" id="gender">
                                        <option value="" disabled>----PILIH----</option>
                                        <option value="Laki-laki" {{ $employee->gender == "Laki-laki"  ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $employee->gender == "Perempuan"  ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Agama</label>
                                    <select class="form-control select2" name="religion" id="religion">
                                        <option value="" disabled>----PILIH----</option>
                                        <option value="Islam" {{ $employee->religion == "Islam"  ? 'selected' : '' }}>Islam</option>
                                        <option value="Khatolik" {{ $employee->religion == "Khatolik"  ? 'selected' : '' }}>Khatolik</option>
                                        <option value="Kristen" {{ $employee->religion == "Kristen"  ? 'selected' : '' }}>Kristen</option>
                                        <option value="Hindu" {{ $employee->religion == "Hindu"  ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ $employee->religion == "Budha"  ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ $employee->religion == "Konghucu"  ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control  @error('birth_place') is-invalid @enderror" name="birth_place" value="{{ $employee->birth_place }}">
                                    @error('birth_place')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="birth_date" value="{{ $employee->birth_date }}">
                                    @error('birth_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ $employee->address }}">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat Domisili</label>
                                    <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ $employee->residence_address }}">
                                    @error('residence_address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Status</label>
                                    <select class="form-control select2 " name="status" id="status">
                                        <option value="" disabled>----PILIH----</option>
                                        <option value="Lajang" {{ $employee->status == "Lajang"  ? 'selected' : '' }}>Lajang</option>
                                        <option value="Kawin" {{ $employee->status == "Kawin"  ? 'selected' : '' }}>Kawin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Anak</label>
                                    <input type="number" class="form-control  @error('child') is-invalid @enderror" name="child" value="{{ $employee->child }}">
                                    @error('child')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ $employee->phone }}">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jabatan</label>
                                    <select class="form-control select2" name="position_id" id="position_id">
                                        <option value="" disabled>----PILIH----</option>
                                        @foreach ($position as $positions)
                                            <option value="{{ $positions->id }}" {{$employee->position_id == $positions->id  ? 'selected' : ''}}>{{ $positions->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Divisi</label>
                                    <select class="form-control select2" name="division_id" id="division_id">
                                        <option value="" disabled>----PILIH----</option>
                                        @foreach ($division as $divisions)
                                            <option value="{{ $divisions->id }}" {{$employee->division_id == $divisions->id  ? 'selected' : ''}}>{{ $divisions->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="date_in" value="{{ $employee->date_in }}">
                                    @error('date_in')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Role</label>
                                    <select class="form-control select2" name="role" id="role">
                                        <option value="" disabled>----PILIH----</option>
                                        <option value="Staff" {{ $employee->role == "Staff"  ? 'selected' : '' }}>Staff</option>
                                        <option value="HRD" {{ $employee->role == "HRD"  ? 'selected' : '' }}>HRD</option>
                                        <option value="Admin" {{ $employee->role == "Admin"  ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route(Auth::user()->role.'.employee.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

