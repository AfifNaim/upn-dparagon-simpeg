@extends('layouts.app')

@section('title', 'Peraturan Perusahaan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Peraturan Perusahaan</h1>
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
                            Halaman ini adalah menu Peraturan Perusahaan
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('rule.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Jam Masuk Kantor</label>
                                        <input type="time" class="form-control" name="time_in" value="{{ old('time_in') }}">
                                    @error('time_in')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jam Keluar Kantor</label>
                                        <input type="time" class="form-control" name="time_out" value="{{ old('time_out') }}">
                                    @error('time_out')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Tahunan</label>
                                    <input type="number" class="form-control" name="total_yearly_leave" value="{{ old('total_yearly_leave') }}">
                                    @error('total_yearly_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Bersama</label>
                                    <input type="number" class="form-control" name="total_mass_leave" value="{{ old('total_mass_leave') }}">
                                    @error('total_mass_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Besar</label>
                                    <input type="number" class="form-control" name="total_big_leave" value="{{ old('total_big_leave') }}">
                                    @error('total_big_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Hamil</label>
                                    <input type="number" class="form-control" name="total_maternity_leave" value="{{ old('total_maternity_leave') }}">
                                    @error('total_maternity_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Sakit</label>
                                    <input type="number" class="form-control" name="total_sick_leave" value="{{ old('total_sick_leave') }}">
                                    @error('total_sick_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Penting</label>
                                    <input type="number" class="form-control" name="total_important_leave" value="{{ old('total_important_leave') }}">
                                    @error('total_important_leave')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Syarat Lama Kerja Cuti Tahunan</label>
                                    <input type="number" class="form-control" name="monthly_leave_year_conditions" value="{{ old('monthly_leave_year_conditions') }}">
                                    @error('monthly_leave_year_conditions')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Syarat Lama Kerja Cuti Besar</label>
                                    <input type="number" class="form-control" name="big_month_leave_conditions" value="{{ old('big_month_leave_conditions') }}">
                                    @error('big_month_leave_conditions')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('rule.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection