<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Surat Peringatan II</title>
    <style>
        * {
            color: black;

        }

        .container {
            /* height: 100%; */
            font-size: 14px;
            font-family: "Times New Roman", Times, serif;

        }

        p {
            font-size: 16px;
            color: black;
        }

        table {
            font-size: 16px;
            color: black;
        }


        ol {
            font-size: 16px;
            line-height: 1.8;
        }

        li {
            font-size: 16px;
            line-height: 1.8;
        }

        .logo-perusahaan img {
            height: 60px;
            width: 130px;
            display: flex;
        }

        .info-perusahaan {
            text-align: center;
            display: inline-block;
            padding-left: 20px;

        }

        .info-surat {
            text-align: center;
            font-size: 20px;
        }

        .info-pegawai {
            padding-top: 30px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .isi-surat {
            padding-top: 35px;
            padding-left: 25px;
            padding-right: 25px;
            text-align: justify;
        }

        .isi-surat p {
            line-height: 1.8;
        }

        .list-pelanggaran {
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 25px;
        }

        hr.hitam {
            border: 1px solid rgb(0, 0, 0);
        }

        .sign {
            padding-right: 30px;
            padding-bottom: 50px;
            padding-top: 35px;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
        }

        .left {
            width: 25%;
        }

        .right {
            width: 75%;
            text-align: center;
        }

        .column img {
            display: block;
            max-width: 150px;
            min-height: 50px;
            max-height: 120px;
            width: auto;
            height: auto;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column left">
                <?php $path = Storage::url('images/' . $company->path_logo); ?>
                <img src="{{ public_path() . $path }}">
            </div>
            <div class="column right">
                <h4>{{ $company->name }}</h4>
                <h5>{{ $company->address }}</h5>
                <h6>Email: {{ $company->email_public }}, No. Telp:{{ $company->phone }}</h6>
            </div>
        </div>
        <hr class="hitam">
        <div class="info-surat">
            <h4>SURAT PERINGATAN</h4>
            <h5>Nomor : {{ $letter_id }}/HRD/SP-II/{{ $month }}/{{ $year }}</h5>
        </div>

        <div class="info-pegawai">
            <p>Surat ini Ditujukan Kepada : </p>
            <table style="padding-left: 15px">
                <tr>
                    <td>ID Pegawai</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $employee->id }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $employee->position->name }}</td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $employee->division->name }}</td>
                </tr>
            </table>
        </div>
        <div class="isi-surat">
            <div class="pembuka">
                <p>
                    Sehubungan dengan kinerja
                    @if ($employee->gender != 'Perempuan')
                        {{ 'Saudara' }}@else{{ 'Saudari' }}@endif
                    sebagai karyawan yang harus mematuhi dan melaksanakan semua kewajiban
                    dan tata tertib serta disiplin dalam bekerja yang harus @if ($employee->gender != 'Perempuan')
                        {{ 'Saudara' }}@else{{ 'Saudari' }}@endif laksanakan sepenuhnya.
                    Maka, dengan ini Kami memberikan peringatan kepada @if ($employee->gender != 'Perempuan')
                        {{ 'Saudara' }}@else{{ 'Saudari' }}@endif atas tindakan
                    penyimpangan yang tidak dilaksanakan sebagaimana mestinya seperti yang kami sebutkan berikut ini
                    :
                </p>
            </div>
            <div class="list-pelanggaran">
                <ol>
                    @foreach ($warning as $p)
                        <li>{{ $p }}</li>
                    @endforeach
                </ol>
            </div>

            <div class="penutup">
                <p>
                    Mengingat yang bersangkutan sudah pernah mendapatkan Surat Peringatan I, untuk itu apabila yang
                    bersangkutan tidak segera mengindahkan Surat Peringatan II ini dengan memperbaiki kinerjanya, <b>
                        maka Refactory Yogyakarta akan segera mengeluarkan Surat Peringatan III. </b>
                </p>
            </div>
        </div>

        <div class="sign text-right">

            <div class="tanggal" style="padding-bottom: 20px">
                {{ $company->city . ', ' . date('d F Y', strtotime($date)) }}
            </div>
            <br>
            {{ Auth::user()->name }}
            <br>
            <div class="mt-3"></div>
            {{ Auth::user()->name }}
        </div>

    </div>
</body>

</html>
