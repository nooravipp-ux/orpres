@extends('layouts.master')

@section('title','P5')
@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 14px;
    }

    .col-form-label {
        font-size: 14px;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4>Form Pendataan Sarana dan Prasarana</h4>
        </div>
        <div class="card-body">
            <form action="{{route('sarana.storeP6')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-12">P.6 POTENSI OLAHRAGA PRESTASI YANG ADA DI WILAYAH</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Nama</label>
                    <input type="text" class="form-control col-md-10" name="nama">
                    <input type="hidden" class="form-control col-md-10" name="sarana_prasarana_id" value="{{$saranaPrasaranaId}}">
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
                        @foreach($cabangOlahraga as $co)
                        <option value="{{$co->id}}">{{$co->nama_cabang_olahraga}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Tingkat Prestasi</label>
                    <select type="text" class="form-control col-md-10" name="tingkat_prestasi">
                        <option value="-">-- Pilih Tingkat Prestasi --</option>
                        <option value="Daerah">Daerah</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <!-- <a href="{{route('sarana.createP7', ['id' => $saranaPrasaranaId])}}" class="btn btn-sm btn-success">Lanjut Form P.7 ></a> -->
                        <a href="{{route('sarana.show', ['id' => $saranaPrasaranaId])}}" class="btn btn-sm btn-success">Selesai</a>
                    </div>
                </div>
            </form>
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
@endsection

@section('additional-js')
<!-- Page level plugins -->
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

@endsection