@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6 col-6 col-sm-6">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Pengajuan Cuti</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-borderless table-xs">
                                    @if ($paidLeave == null)
                                        <tr class="text-center">
                                            <td> Belum Ada Pengajuan Cuti!</td>
                                        </tr>

                                    @else
                                        <tr>
                                            <td>Tipe Cuti</td>
                                            <td>: </td>
                                            <td>
                                                {{ $paidLeave->type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pengajuan</td>
                                            <td>: </td>
                                            <td>{{ date('d F Y', strtotime($paidLeave->date_send)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Cuti</td>
                                            <td>:
                                            </td>
                                            <td>{{ date('d F Y', strtotime($paidLeave->date_start)) . ' s.d. ' . date('d F Y', strtotime($paidLeave->date_end)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:
                                            </td>
                                            <td>{{ $paidLeave->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:
                                            </td>
                                            <td>

                                                <span @if ($paidLeave->status == 'Diterima HRD' || $paidLeave->status == 'Diterima Manager') class="label bg-success"
                                                    @elseif ($paidLeave->status == 'Ditolak HRD' || $paidLeave->status == 'Ditolak Manager') class="label bg-danger"
                                                    @elseif ($paidLeave->status == 'Dalam Proses')echo class="label bg-info" @endif>{{ $paidLeave->status }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6 col-sm-6">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Kebijakan Kantor</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="content-group">
                                        <h5 class="text-semibold no-margin"><i class="fa fa-clock-o position-left text-slate"></i>
                                            {{ date('H:i', strtotime($rule->time_in)) }}
                                        </h5>
                                        <span class="text-muted text-size-small">Jam Masuk</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="content-group">
                                        <h5 class="text-semibold no-margin"><i
                                                class="fa fa-clock-o position position-left text-slate"></i>
                                            {{ date('H:i', strtotime($rule->time_out)) }}
                                        </h5>
                                        <span class="text-muted text-size-small">Jam Pulang</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="content-group">
                                        <h5 class="text-semibold no-margin"><i class="fa fa-hourglass-1 position-left text-slate"></i>
                                            {{ $monthly_leave_year_conditions }} Bln
                                        </h5>
                                        <span class="text-muted text-size-small">Durasi Kerja untuk Cuti Tahunan</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="content-group">
                                        <h5 class="text-semibold no-margin"><i class="fa fa-hourglass position-left text-slate"></i>
                                            {{ $rule->big_month_leave_conditions }} Bln
                                        </h5>
                                        <span class="text-muted text-size-small">Durasi Kerja untuk Cuti Besar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6 col-sm-6">
                    <div class="card " id="mycard-dimiss">
                        <div class="card-header">
                            <h4>Sisa Cuti</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                @if ($employee->gender == 'Perempuan')
                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                            @if ($durationWork < $monthly_leave_year_conditions) 0 @else
                                                    {{ $restYearly }} @endif
                                            </h5>
                                            <span class="text-muted text-size-small">Tahunan</span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restMass }}
                                            </h5>
                                            <span class="text-muted text-size-small">Bersama</span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restImportant }}
                                            </h5>
                                            <span class="text-muted text-size-small">Penting</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                            @if ($durationWork < $big_month_leave_conditions) 0 @else
                                                    {{ $restBig }} @endif
                                            </h5>
                                            <span class="text-muted text-size-small">Besar</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restSick }}
                                            </h5>
                                            <span class="text-muted text-size-small">Sakit</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restMaternity }}
                                            </h5>
                                            <span class="text-muted text-size-small">Hamil</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                            @if ($durationWork < $monthly_leave_year_conditions) 0 @else
                                                    {{ $restYearly }} @endif
                                            </h5>
                                            <span class="text-muted text-size-small">Tahunan</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restMass }}
                                            </h5>
                                            <span class="text-muted text-size-small">Bersama</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restImportant }}
                                            </h5>
                                            <span class="text-muted text-size-small">Penting</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                            @if ($durationWork < $big_month_leave_conditions) 0 @else
                                                    {{ $restBig }} @endif
                                            </h5>
                                            <span class="text-muted text-size-small">Besar</span>
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i
                                                    class="fa fa-calendar-check-o position-left text-slate"></i>
                                                {{ $restSick }}
                                            </h5>
                                            <span class="text-muted text-size-small">Sakit</span>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
