@extends('layouts.app')

@section('title', 'Perusahaan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Perusahaan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.company.update', $company->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $company->name }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ $company->address }}">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city" value="{{ $company->city }}">
                                    @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ $company->phone }}">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>E-Mail Perusahaan</label>
                                    <input type="email" class="form-control  @error('public_email') is-invalid @enderror" name="public_email" value="{{ $company->public_email }}">
                                    @error('public_email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Logo Perusahaan</label>
                                    @php $path =Storage::url('images/'.$company->path_logo); @endphp
                                    <img style="display: block;
                                                    max-width:230px;
                                                    min-height:150px;
                                                    max-height:95px;
                                                    width: auto;
                                                    height: auto;" src="{{ url($path) }}">
                                    <input type="file" id="myFile" name="path_logo">
                                    <input type="hidden" name="logo_lama" value="{{ $company->path_logo }}">
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

