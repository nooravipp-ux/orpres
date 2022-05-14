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
            <form action="{{route('sarana.storeP5')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-12">P.5 JENIS KEGIATAN OLAHRAGA YANG AKTIF DI MASYARAKAT</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Jenis Cabang Olahraga</label>
                    <select type="text" class="form-control col-md-10" name="jenis_olahraga">
                        <option value="">-- Pilih Jenis Cabang Olahraga --</option>
                        @foreach($cabangOlahraga as $co)
                        <option value="{{$co->id}}">{{$co->nama_cabang_olahraga}}</option>
                        @endforeach
                        <select>
                            <input type="hidden" class="form-control col-md-10" name="sarana_prasarana_id" value="{{$saranaPrasaranaId}}">
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
                        <option value="y">Ya</option>
                        <option value="n">Tidak</option>
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
                        <a href="{{route('sarana.createP6', ['id' => $saranaPrasaranaId])}}" class="btn btn-sm btn-success">Lanjut Form P.6 ></a>
                    </div>
                </div>
            </form>
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