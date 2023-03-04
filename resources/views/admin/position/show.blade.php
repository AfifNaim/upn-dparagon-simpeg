

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
                                <label class="text-capitalize">Posisi</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$position->name }}"readonly>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize">Gaji</label>
                                <input type="text" class="form-control  @error('residence_address') is-invalid @enderror" name="residence_address" value="{{ @$position->salary }}"readonly>
                            </div>
                            <a href="{{ route('position.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection



