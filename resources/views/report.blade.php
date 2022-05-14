<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <style>
        <style>.row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-xs-1,
        .col-sm-1,
        .col-md-1,
        .col-lg-1,
        .col-xs-2,
        .col-sm-2,
        .col-md-2,
        .col-lg-2,
        .col-xs-3,
        .col-sm-3,
        .col-md-3,
        .col-lg-3,
        .col-xs-4,
        .col-sm-4,
        .col-md-4,
        .col-lg-4,
        .col-xs-5,
        .col-sm-5,
        .col-md-5,
        .col-lg-5,
        .col-xs-6,
        .col-sm-6,
        .col-md-6,
        .col-lg-6,
        .col-xs-7,
        .col-sm-7,
        .col-md-7,
        .col-lg-7,
        .col-xs-8,
        .col-sm-8,
        .col-md-8,
        .col-lg-8,
        .col-xs-9,
        .col-sm-9,
        .col-md-9,
        .col-lg-9,
        .col-xs-10,
        .col-sm-10,
        .col-md-10,
        .col-lg-10,
        .col-xs-11,
        .col-sm-11,
        .col-md-11,
        .col-lg-11,
        .col-xs-12,
        .col-sm-12,
        .col-md-12,
        .col-lg-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-lg-12 {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Nama Surveyor</label>
                    <input type="text" class="form-control col-md-5" name="nama_surveyor" value="{{$data->nama_surveyor}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Jabatan</label>
                    <input type="text" class="form-control col-md-10" name="jabatan_surveyor" value="{{$data->jabatan_surveyor}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Alamat</label>
                    <textarea type="text" class="form-control col-md-10" name="alamat">{{$data->alamat_surveyor}}</textarea>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">No. Telpon</label>
                    <input type="text" class="form-control col-md-10" name="alamat_surveyor" value="{{$data->no_telp_surveyor}}">
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Fasilitas Sarana Olahraga</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Sarana</th>
                            <th scope="col">Tipe Sarana</th>
                            <th scope="col">Status Kepemilikan</th>
                            <th scope="col">Nama Pemilik</th>
                            <th scope="col">Luas Lapang</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kondisi Lapang</th>
                            <th scope="col" class="text-center">Foto Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($t_sarana as $sarana)
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>{{$sarana->nama_sarana}}</td>
                            <td>{{$sarana->tipe_sarana}}</td>
                            <td>{{$sarana->status_kepemilikan}}</td>
                            <td>{{$sarana->nama_pemilik}}</td>
                            <td>{{$sarana->luas_lapang}}</td>
                            <td>{{$sarana->alamat_lokasi}}</td>
                            <td class="text-center">{{$sarana->kondisi_lapang}}</td>
                            <td class="text-center">
                                @if($sarana->foto_lokasi == "-")
                                <span>-</span>
                                @else
                                <img src="{{asset('images/pendukung/'. $sarana->foto_lokasi)}}" width="300" height="200" alt="">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Prasarana Olahraga Yang Diberikan Oleh Pemerintah</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Penerima Hibah</th>
                            <th scope="col">Jenis Penerima</th>
                            <th scope="col">Jenis Peralatan</th>
                            <th scope="col">Jumlah Peralatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j = 1; ?>
                        @foreach($t_prasarana as $prasarana)
                        <tr>
                            <td><?php echo $j++; ?></td>
                            <td>{{$prasarana->penerima_hibah}}</td>
                            <td>{{$prasarana->jenis_penerima}}</td>
                            <td>{{$prasarana->nama_prasarana}}</td>
                            <td>{{$prasarana->jumlah}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Kegiatan Olahraga Yang Berkembang Di Masyarakat</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Olahraga</th>
                            <th scope="col">Nama Club</th>
                            <th scope="col">Ketua Club</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibina Desa ?</th>
                            <th scope="col">Diunggulkan Desa ?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $k = 1; ?>
                        @foreach($t_kel_olahraga as $ko)
                        <tr>
                            <td><?php echo $k++; ?></td>
                            <td>{{$ko->nama_cabang_olahraga }}</td>
                            <td>{{$ko->nama_club}}</td>
                            <td>{{$ko->ketua_club}}</td>
                            <td>{{$ko->alamat}}</td>
                            <td>
                                @if($ko->status_club == 0)
                                <span>Tidak Terdaftar</span>
                                @else
                                <span>Terdaftar</span>
                                @endif
                            </td>
                            <td>{{$ko->dibina_desa}}</td>
                            <td>{{$ko->diunggulkan_desa}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Potensi Olahraga Prestasi Yang Ada Di Wilayah</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Atlet</th>
                            <th scope="col">Jenis Olahraga</th>
                            <th scope="col">Jenis Potensi</th>
                            <th scope="col">Tingkat Prestasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $l = 1; ?>
                        @foreach($t_prestasi_olahraga as $po)
                        <tr>
                            <td><?php echo $l++; ?></td>
                            <td>{{$po->nama}}</td>
                            <td>{{$po->nama_cabang_olahraga}}</td>
                            <td>{{$po->jenis_potensi}}</td>
                            <td>{{$po->tingkat_prestasi}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>