@extends('layouts.app')

@section('title', 'Surat Peringatan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Surat Peringatan</h1>
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
                            Halaman ini adalah menu Tambah Surat Peringatan
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('warningletter.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="text-capitalize">Pegawai</label>
                                    <select class="form-control select2" name="employee_id" id="employee_id">
                                        <option value="">----PILIH----</option>
                                        @foreach ($employee as $employees)
                                            <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Tingkat</label>
                                    <select class="form-control select2" name="level" id="level">
                                        <option value="">----PILIH----</option>
                                        <option value="I">SP-I</option>
                                        <option value="II">SP-II</option>
                                        <option value="III">SP-III</option>
                                    </select>
                                    @error('level')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Pelanggaran</label>
                                    <table border="0" class="table table-bordered" id="dynamicAddRemove">
                                        <tr>
                                            <td><input type="text" name="warning[]"
                                                    placeholder="Contoh : Dikarenakan Saudara Sudah Terlambat lebih dari 3X.,Kinerja Saudara Tidak Sesuai Target,dll."
                                                    class="form-control" /></td>
                                            <td class="text-center"><button type="button" name="add" id="add-btn"
                                                    class="btn btn-success">Tambah</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('javascript')

    <script type="text/javascript">
        var i = 1;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><input type="text" name="warning[]" placeholder="Masukan Pelanggaran yang Ke-' +
                i +
                '" class="form-control" /></td><td class="text-center"><button type="button" class="btn btn-danger remove-tr">Hapus</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    </script>

@endpush