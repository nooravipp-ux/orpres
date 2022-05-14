@extends('layouts.master')

@section('title', 'Master Cabang Olahraga')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 12px;
    }

    input[type="text"],
    input[type="date"],
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
    input[type="date"]:focus,
    textarea[type="text"]:focus,
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
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Edit Informasi Atlet</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('prestasiOlahraga.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Nama Lengkap</label>
                    <input type="text" class="form-control col-md-10" name="nama" value="{{$prestasiOlahraga->nama}}">
                    <input type="hidden" class="form-control col-md-10" name="id" value="{{$prestasiOlahraga->id}}">
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Tempat Lahir</label>
                    <input type="text" class="form-control col-md-10" name="tempat_lahir" value="{{$prestasiOlahraga->tempat_lahir}}">
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Tanggal Lahir</label>
                    <input type="date" class="form-control col-md-10" name="tanggal_lahir" value="{{$prestasiOlahraga->tanggal_lahir}}">
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Kecamatan</label>
                    <select type="text" class="form-control col-md-10" id="kecamatan" name="id_kecamatan">
                        <option value="{{$prestasiOlahraga->id_kecamatan}}" selected>{{$prestasiOlahraga->kecamatan}}</option>
                        @foreach($kecamatan as $kec)
                        <option data-id="{{$kec->id}}" value="{{$kec->id}}">{{$kec->kode}} - {{$kec->kecamatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Desa / Kelurahan</label>
                    <select type="text" class="form-control desa_kelurahan col-md-10" name="id_desa_kelurahan" id="kelurahan">
                        <option value="{{$prestasiOlahraga->id_desa_kelurahan}}" selected>{{$prestasiOlahraga->desa_kelurahan}}</option>
                        @foreach($desaKelurahan as $desa)
                        <option data-id="{{$desa->id}}" value="{{$desa->id}}">{{$desa->desa_kelurahan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Alamat</label>
                    <textarea type="text" class="form-control col-md-10" name="alamat">{{$prestasiOlahraga->alamat}}</textarea>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Jenis Potensi</label>
                    <select type="text" class="form-control desa_kelurahan col-md-10" name="jenis_potensi">
                        <option value="Atlet Usia Dini" <?php if ($prestasiOlahraga->jenis_potensi == "Atlet Usia Dini") echo "selected"; ?>>Daerah</option>
                        <option value="Atlet Profesional" <?php if ($prestasiOlahraga->jenis_potensi == "Atlet Profesional") echo "selected"; ?>>Atlet Profesional</option>
                        <option value="Pelatih" <?php if ($prestasiOlahraga->jenis_potensi == "Pelatih") echo "selected"; ?>>Daerah</option>
                    </select>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Jenis Olahraga</label>
                    <select type="text" class="form-control desa_kelurahan col-md-10" name="jenis_olahraga">
                        <option value="">-</option>
                        @foreach($cabangOlahraga as $co)
                        <option value="{{$co->id}}" <?php if ($prestasiOlahraga->jenis_olahraga == $co->id) echo "selected"; ?>>{{$co->nama_cabang_olahraga}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Tingkat Prestasi</label>
                    <select type="text" class="form-control desa_kelurahan col-md-10" name="tingkat_prestasi">
                        <option value="Daerah" <?php if ($prestasiOlahraga->tingkat_prestasi == "Daerah") echo "selected"; ?>>Daerah</option>
                        <option value="Nasional" <?php if ($prestasiOlahraga->tingkat_prestasi == "Nasional") echo "selected"; ?>>Nasional</option>
                        <option value="International" <?php if ($prestasiOlahraga->tingkat_prestasi == "International") echo "selected"; ?>>International</option>
                    </select>
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="recipient-name" class="col-form-label col-md-2">Foto Atlet</label>
                    <img src="{{asset('images/atlet/'. $prestasiOlahraga->foto)}}" width="300" height="200" alt="">
                </div>
                <div class="row form-group pl-2 pr-2">
                    <label for="recipient-name" class="col-form-label col-md-2"></label>
                    <input type="file" class="form-control col-md-10" name="foto">
                    <input type="hidden" class="form-control col-md-10" name="old_foto" value="{{$prestasiOlahraga->foto}}">
                </div>

                <div class="form-group pl-2 text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Daftar Prestasi Yang diraih</h6>
            <a href="javascript(0);" data-toggle="modal" data-target="#berita-acara" class="btn btn-primary">Tambah Data</a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Tahun</th>
                            <th>Cabang Olahraga</th>
                            <th>Peringkat</th>
                            <th>Tingkat</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail_prestasi_olahraga as $dpo)
                        <tr>
                            <td>{{$dpo->tahun}}</td>
                            <td>{{$dpo->cabang_olahraga}}</td>
                            <td>{{$dpo->peringkat}}</td>
                            <td>{{$dpo->tingkat_prestasi}}</td>
                            <td>{{$dpo->keterangan}}</td>
                            <td></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="berita-acara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('detailPrestasiOlahraga.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Prestasi Yang Diraih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Tahun</label>
                        <input type="hidden" class="form-control col-md-9" name="id_prestasi_olahraga" value="{{$prestasiOlahraga->id}}">
                        <input type="text" class="form-control col-md-9" name="tahun" id="tahun">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Cabang Olahraga</label>
                        <select type="text" class="form-control desa_kelurahan col-md-9" name="id_cabang_olahraga">
                            <option value="">-</option>
                            @foreach($cabangOlahraga as $co)
                            <option value="{{$co->id}}">{{$co->nama_cabang_olahraga}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Peringkat</label>
                        <input type="text" class="form-control col-md-9" name="peringkat">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Tingkat</label>
                        <select type="text" class="form-control col-md-9" name="tingkat_prestasi">
                            <option value="">-</option>
                            <option value="Daerah">Daerah</option>
                            <option value="Nasional">Nasional</option>
                            <option value="International">International / Dunia</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Keterangan</label>
                        <textarea type="text" class="form-control col-md-9" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('additional-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $("#tahun").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
    })
</script>
@endsection
