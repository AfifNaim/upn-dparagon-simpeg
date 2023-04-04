@extends('layouts.app')

@section('title', 'Perusahaan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Perusahaan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="" placeholder="ex. PT Mencari Cinta Sejati">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="" placeholder="ex. Jl Senang Ria No.1">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city" value="" placeholder="ex. Tokyo">
                                    @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="" placeholder="ex. 08123456789">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>E-Mail Perusahaan</label>
                                    <input type="email" class="form-control  @error('public_email') is-invalid @enderror" name="public_email" value="" placeholder="ex. public@mail.com">
                                    @error('public_email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Logo Perusahaan</label>
                                    <input type="file" class="form-control  @error('path_logo') is-invalid @enderror" name="path_logo">
                                    @error('path_logo')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

