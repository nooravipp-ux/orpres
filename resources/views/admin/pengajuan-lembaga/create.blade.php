@extends('layouts.master')
@section('title', 'Data Survey Keolahragaan')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 12px;
    }

    input[type="text"],
    input[type="date"],
    textarea[type="text"],
    input[type="file"],
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
    input[type="file"]:focus,
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
            <h6 class="m-0 font-weight-bold text-success">Buat Pengajuan</h6>
            <h6 class="m-0 font-weight-bold text-success">Status : - </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('distribusiPrasaranaLembaga.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Nama Lembaga</label>
                    <select type="text" class="form-control col-md-10" id="kecamatan" name="nama_lembaga">
                        <option value="">-</option>
                        <option value="KONI">KONI</option>
                        <option value="DEWAN">DEWAN</option>
                        <option value="NPCI">NPCI</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Penanggung Jawab</label>
                    <input type="text" class="form-control desa_kelurahan col-md-10" name="penanggung_jawab">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Tanggal Pengajuan</label>
                    <input type="date" class="form-control col-md-2" name="tanggal_pengajuan">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 1</label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_1">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 2</label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_2">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 3</label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_3">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-sm btn-success">Simpan Draft</button>
                </div>
            </form>
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

</script>

@endsection
