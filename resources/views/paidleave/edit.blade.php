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
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Informasi Halaman</h4>
                            <div class="card-header-action">
                                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            Halaman ini adalah menu Edit Cuti Pegawai
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('paidleave.update', $paidleave) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Pegawai</label>
                                    <select class="form-control select2" name="employee" id="employee">
                                        <option value="">----PILIH----</option>
                                        @foreach ($employee as $employees)
                                            <option value="{{ $employees->id }}" {{ $paidleave->employee_id == $employees->id  ? 'selected' : '' }}>{{ $employees->name }}</option>
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
                                    <label class="text-capitalize">Tanggal Pengajuan</label>
                                    <input type="date" class="form-control" name="date_send" value="{{ $paidleave->date_send }}">
                                    @error('date_send')
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
                                <div class="form-group">
                                    <label class="display-block">Status:</label>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="Dalam Proses" class="styled" name="status"
                                                        {{ $paidleave->status == 'Dalam Proses' ? 'checked' : '' }}>
                                                    Dalam Proses
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="Diterima HRD" class="styled" name="status"
                                                        {{ $paidleave->status == 'Diterima HRD' ? 'checked' : '' }}>
                                                    Diterima HRD
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="Diterima Manager" class="styled" name="status"
                                                        {{ $paidleave->status == 'Diterima Manager' ? 'checked' : '' }}>
                                                    Diterima Manager
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="Ditolak HRD" class="styled" name="status"
                                                        {{ $paidleave->status == 'Ditolak HRD' ? 'checked' : '' }}>
                                                    Ditolak HRD
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="Ditolak Manager" class="styled" name="status"
                                                        {{ $paidleave->status == 'Ditolak Manager' ? 'checked' : '' }}>
                                                    Ditolak Manager
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Disetujui Atasan</label>
                                                <input type="date" name="date_accept_manager" class="form-control"
                                                    value="{{ $paidleave->date_accept_manager }}">
                                                @if ($errors->has('date_accept_manager'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('date_accept_manager') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Disetujui HRD</label>
                                                <input type="date" name="date_accept_hrd" class="form-control"
                                                    value="{{ $paidleave->date_accept_hrd }}">
                                                @if ($errors->has('date_accept_hrd'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('date_accept_hrd') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Ditolak Atasan</label>
                                                <input type="date" name="date_decline_manager" class="form-control"
                                                    value="{{ $paidleave->date_decline_manager }}">
                                                @if ($errors->has('date_decline_manager'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('date_decline_manager') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Ditolak HRD</label>
                                                <input type="date" name="date_decline_hrd" class="form-control"
                                                    value="{{ $paidleave->date_decline_hrd }}">
                                                @if ($errors->has('date_decline_hrd'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('date_decline_hrd') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('paidleave.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection