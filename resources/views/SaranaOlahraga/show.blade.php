@extends('layouts.master')

@section('title','Detail Hasil Survey')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 12px;
    }

    input[type="text"],
    textarea[type="text"],
    select.form-control {
        background: transparent;
        border: none;
        border-bottom: 1px solid #E2E6E1;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-radius: 0;
    }

    input[type="text"]:focus,
    textarea[type="text"],
    select.form-control:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
        border-color: #54CA33;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Deskripsi Wilayah</h6>
        </div>
        <div class="card-body">
            <form action="{{route('sarana.storeP1P2')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Kecamatan</label>
                    <input type="text" class="form-control col-md-10" value="{{$data->kecamatan}}" readonly>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Desa / Kelurahan</label>
                    <input type="text" class="form-control col-md-10" value="{{$data->desa_kelurahan}}" readonly>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Fasilitas Sarana Olahraga</h6>
            <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#sarana"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            <table class="table" id="tbl-sarana">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis Sarana</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Kepemilikan</th>
                        <th scope="col">Nama Pemilik</th>
                        <th scope="col">Luas</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col" class="text-center">Foto Sarana</th>
                        <th></th>
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
                            <img src="{{asset('images/pendukung/'. $sarana->foto_lokasi)}}" width="200" height="100" alt="">
                            @endif
                        </td>
                        <td><a href="{{route('saranaOlahraga.sarana.edit', ['id' => $sarana->id])}}"><i class="fas fa-edit"></i></a> | <a href="{{route('saranaOlahraga.sarana.delete', ['id' => $sarana->id])}}" onclick="return confirm('Apakah anda yakin untuk menghapus data?');"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Prasarana Olahraga Yang Diberikan Oleh Pemerintah</h6>
            <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#prasarana"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            <table class="table" id="tbl-prasarana">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Periode Tahun</th>
                        <th scope="col">Penerima</th>
                        <th scope="col">Alamat Penerima</th>
                        <th scope="col">Nama Prasarana</th>
                        <th scope="col">Jumlah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j = 1; ?>
                    @foreach($t_prasarana as $prasarana)
                    <tr>
                        <td><?php echo $j++; ?></td>
                        <td></td>
                        <td>{{$prasarana->jenis_penerima}}</td>
                        <td></td>
                        <td>{{$prasarana->nama_prasarana}}</td>
                        <td>{{$prasarana->jumlah}}</td>
                        <td><a href="#"><i class="fas fa-edit"></i></a> | <a href="#"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Kegiatan Olahraga Yang Berkembang Di Masyarakat</h6>
            <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#kegiatan-olaharaga"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            <table class="table" id="tbl-kegiatan-olahraga">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cabang Olahraga</th>
                        <th scope="col">Nama Klub</th>
                        <th scope="col">Ketua Klub</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Dibina Desa ?</th>
                        <th scope="col">Diunggulkan Desa ?</th>
                        <th></th>
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
                        <td><a href="#"><i class="fas fa-edit"></i></a> | <a href="#"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Potensi Olahraga Prestasi Yang Ada Di Wilayah</h6>
            <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#prestasi-olahraga"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            <table class="table" id="tbl-potensi-olahraga">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Atlet</th>
                        <th scope="col">Cabang Olahraga</th>
                        <th scope="col">Jenis Potensi</th>
                        <th scope="col">Tingkat Prestasi</th>
                        <th></th>
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
                        <td><a href="#"><i class="fas fa-edit"></i></a> | <a href="#"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Sarana-->
    <div class="modal fade" id="sarana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Sarana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="p-2" action="{{route('saranaOlahraga.sarana.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Jenis Sarana</label>
                            <select type="text" class="form-control col-md-9" name="jenis_sarana" required>
                                <option value="" >-</option>
                                @foreach($m_sarana as $sarana)
                                <option value="{{$sarana->id}}"> {{$sarana->nama_sarana}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control col-md-10" name="sarana_prasarana_id" value="{{$data->id}}">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Tipe Sarana</label>
                            <select class="form-control col-md-9" name="tipe_sarana">
                                <option value="INDOOR">Indoor</option>
                                <option value="OUTDOOR">Outdoor</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Status Kepemilikan</label>
                            <input type="text" class="form-control col-md-9" name="status_kepemilikan">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Nama Pemilik</label>
                            <input type="text" class="form-control col-md-9" name="nama_pemilik">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Luas Lapangan</label>
                            <input type="text" class="form-control col-md-9" name="luas_lapang">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">kondisi Lapang</label>
                            <select type="text" class="form-control col-md-9" name="kondisi_lapang">
                                <option value="Baik">Baik</option>
                                <option value="Baik">Cukup</option>
                                <option value="Buruk">Buruk</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Alamat</label>
                            <textarea type="text" class="form-control col-md-9" name="alamat_lokasi"></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-3">Foto Lokasi</label>
                            <input type="file" class="form-control col-md-9" name="lokasi">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Prasarana-->
    <div class="modal fade" id="prasarana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prasarana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="p-2" action="{{route('sarana.storeP4')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Periode Tahun</label>
                            <input type="text" class="form-control col-md-10" name="periode_tahun">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Penerima Hibah</label>
                            <input type="text" class="form-control col-md-10" name="penerima_hibah" placeholder="ex: RW.01 / Nama Kelompok Olahraga">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Lembaga Penerima</label>
                            <select class="form-control col-md-10" name="jenis_penerima">
                                <option value="RW">RW</option>
                                <option value="Kelompok Olahraga">Kel. Olahraga</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Jenis Peralatan</label>
                            <select type="text" class="form-control col-md-10" name="jenis_peralatan">
                                <option value="">-- Pilih Jenis Peralatan --</option>

                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Jumlah</label>
                            <input type="text" class="form-control col-md-10" name="jumlah">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kegiatan Olahraga-->
    <div class="modal fade" id="kegiatan-olaharaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Kegiatan Olahraga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="p-3" action="{{route('sarana.storeP5')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Cabang Olahraga</label>
                            <select type="text" class="form-control col-md-10" name="jenis_olahraga">
                                <option value="">-- Pilih Jenis Cabang Olahraga --</option>
                                <select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Nama Club</label>
                            <input type="text" class="form-control col-md-10" name="nama_club">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Ketua Club</label>
                            <input type="text" class="form-control col-md-10" name="ketua_club">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Alamat</label>
                            <textarea type="text" class="form-control col-md-10" name="alamat"></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Status Club</label>
                            <select type="text" class="form-control col-md-10" name="status_club">
                                <option selected>-- Pilih Status --</option>
                                <option value="0">Tidak Terdaftar</option>
                                <option value="1">Terdaftar</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Dibina Oleh Desa ?</label>
                            <select type="text" class="form-control col-md-10" name="dibina_desa">
                                <option selected>-- Pilih --</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Diunggulkan wilayah ?</label>
                            <select type="text" class="form-control col-md-10" name="diunggulkan_desa">
                                <option selected>-- Pilih --</option>
                                <option value="y">Ya</option>
                                <option value="n">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Prestasi Olahraga-->
    <div class="modal fade" id="prestasi-olahraga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Potensi Olahraga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sarana.storeP6')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Nama</label>
                            <input type="text" class="form-control col-md-10" name="nama">
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Jenis Potensi</label>
                            <select type="text" class="form-control col-md-10" name="jenis_potensi">
                                <option value="-">-- Pilih Jenis Potensi --</option>
                                <option value="Atlet Profesional">Atlet Profesional</option>
                                <option value="Atlet Usia Dini">Atlet Usia Dini</option>
                                <option value="Pelatih">Pelatih</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Jenis Olahraga</label>
                            <select type="text" class="form-control col-md-10" name="jenis_olahraga">
                                <option value="-">-- Pilih Jenis Olahraga --</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-form-label col-md-2">Tingkat Prestasi</label>
                            <select type="text" class="form-control col-md-10" name="tingkat_prestasi">
                                <option value="-">-- Pilih Tingkat Prestasi --</option>
                                <option value="Daerah">Daerah</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Dunia">Dunia</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-js')
<!-- Page level plugins -->
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#tbl-sarana').DataTable();
        $('#tbl-prasarana').DataTable();
        $('#tbl-kegiatan-olahraga').DataTable();
        $('#tbl-potensi-olahraga').DataTable();
    });
</script>

@endsection
