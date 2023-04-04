@extends('layouts.app')

@section('title', 'Peraturan Perusahaan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peraturan Perusahaan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route(Auth::user()->role.'.rule.update', $rule->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                                <div class="form-group">
                                    <label class="text-capitalize">Jam Masuk Kantor</label>
                                    <input type="time" class="form-control" name="time_in" value="{{ $rule->time_in }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jam Keluar Kantor</label>
                                    <input type="time" class="form-control" name="time_out" value="{{ $rule->time_out }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Tahunan</label>
                                    <input type="number" class="form-control" name="total_yearly_leave" value="{{ $rule->total_yearly_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Bersama</label>
                                    <input type="number" class="form-control" name="total_mass_leave" value="{{ $rule->total_mass_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Besar</label>
                                    <input type="number" class="form-control" name="total_big_leave" value="{{ $rule->total_big_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Hamil</label>
                                    <input type="number" class="form-control" name="total_maternity_leave" value="{{ $rule->total_maternity_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Sakit</label>
                                    <input type="number" class="form-control" name="total_sick_leave" value="{{ $rule->total_sick_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Batasan Cuti Penting</label>
                                    <input type="number" class="form-control" name="total_important_leave" value="{{ $rule->total_important_leave }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Syarat Lama Kerja Cuti Tahunan</label>
                                    <input type="number" class="form-control" name="monthly_leave_year_conditions" value="{{ $rule->monthly_leave_year_conditions }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Syarat Lama Kerja Cuti Besar</label>
                                    <input type="number" class="form-control" name="big_month_leave_conditions" value="{{ $rule->big_month_leave_conditions }}">
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