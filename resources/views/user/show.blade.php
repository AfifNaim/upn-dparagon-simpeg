

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
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Informasi Halaman</h4>
                            <div class="card-header-action">
                                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            Halaman ini adalah dashboard <b>UMKM</b> yang berisi Informasi mengenai grafik keuangan dan data keuangan
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }} "readonly>
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ @$employee->Employee->nik }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Jenis Kelamin</label>
                                <input type="text" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ @$employee->Employee->gender }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Agama</label>
                                <input type="text" class="form-control  @error('nik') is-invalid @enderror" name="nik" value="{{ @$employee->Employee->religion }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control  @error('birth_place') is-invalid @enderror" name="birth_place" value="{{ @$employee->Employee->birth_place }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control  @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ @$employee->Employee->birth_date }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ @$employee->Employee->address }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat Domisili</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$employee->Employee->residence_address }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Status</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$employee->Employee->status }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" class="form-control  @error('child') is-invalid @enderror" name="child" value="{{ @$employee->Employee->child }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ @$employee->Employee->phone }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Jabatan</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$employee->Employee->Position->name }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Divisi</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$employee->Employee->Division->name }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="date_in" value="{{ @$employee->Employee->date_in }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Role</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$employee->role }}"readonly>
                            </div>
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

