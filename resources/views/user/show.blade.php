

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
                            <h4>Data Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $employee->name }} "readonly>
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" class="form-control" name="email" value="{{ $employee->email }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="number" class="form-control" name="nik" value="{{ $employee->nik }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="nik" value="{{ $employee->gender }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Agama</label>
                                <input type="text" class="form-control" name="nik" value="{{ $employee->religion }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="birth_place" value="{{ $employee->birth_place }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control" name="birth_date" value="{{ $employee->birth_date }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="address" value="{{ $employee->address }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat Domisili</label>
                                <input type="text" class="form-control" name="residence_address" value="{{ $employee->residence_address }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Status</label>
                                <input type="text" class="form-control" name="residence_address" value="{{ $employee->status }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" class="form-control" name="child" value="{{ $employee->child }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Jabatan</label>
                                <input type="text" class="form-control" name="residence_address" value="{{ $employee->Position->name }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Divisi</label>
                                <input type="text" class="form-control" name="residence_address" value="{{ $employee->Division->name }}"readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="date_in" value="{{ $employee->date_in }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Role</label>
                                <input type="text" class="form-control" name="residence_address" value="{{ $employee->role }}"readonly>
                            </div>
                            <a href="{{ route(Auth::user()->role.'.employee.index') }}" class="btn btn-secondary" >Back</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Devisi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs">
                                    @foreach ($historyDivision as $p)
                                        <tr>
                                            <td>{{ $p->Division->name }}</td>
                                            <td>{{ date('M-Y', strtotime($p->date_start)) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Jabatan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs">
                                    @foreach ($historyPosition as $p)
                                        <tr>
                                            <td>{{ $p->Position->name }}</td>
                                            <td>{{ date('M-Y', strtotime($p->date_start)) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

