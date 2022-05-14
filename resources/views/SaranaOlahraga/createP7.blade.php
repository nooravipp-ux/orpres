@extends('layouts.master')

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
    <div class="card  shadow mb-4">
        <div class="card-header">
            <h4>Form Pendataan Sarana dan Prasarana</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-12">P.7 JENIS PEMBINAAN CABANG OLAHRAGA YANG DILAKSANAKAN OLEH PEMERINATAH DESA</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Jenis Kegiatan Olahraga</label>
                    <input type="text" class="form-control col-md-10" name="jenis_olahraga">
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
                        <option value="0">Tidak Teregistrasi</option>
                        <option value="1">Teregistrasi</option>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <a href="" class="btn btn-sm btn-success">Lanjut Form P.5 ></a>
                    </div>
                </div>
            </form>
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