@extends('layouts.master')

@section('title', 'Master Cabang Olahraga')

@section('additional-css')
<link href="{{asset('admin/vendor/kelurahantables/kelurahanTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    input[type="text"],
    select.form-control {
        background: transparent;
        border: none;
        border-bottom: 1px solid #E2E6E1;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-radius: 0;
    }

    input[type="text"]:focus,
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
            <h6 class="m-0 font-weight-bold text-success">Edit Desa / Kelurahan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('kelurahan.update')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Desa / Kelurahan</label>
                    <input type="text" class="form-control col-md-10" name="desa_kelurahan" value="{{$kelurahan->desa_kelurahan}}">
                    <input type="hidden" value="{{$kelurahan->id}}" name="id">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Nama Kades</label>
                    <input type="text" class="form-control col-md-10" name="nama_kades" value="{{$kelurahan->nama_kades}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Email Desa</label>
                    <input type="text" class="form-control col-md-10" name="email" value="{{$kelurahan->email}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Website Desa</label>
                    <input type="text" class="form-control col-md-10" name="web" value="{{$kelurahan->web}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Jumlah RT</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_rt" value="{{$kelurahan->jumlah_rt}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Jumlah RW</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_rw" value="{{$kelurahan->jumlah_rw}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Jumlah Penduduk</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_penduduk" value="{{$kelurahan->jumlah_penduduk}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Sosial Media</label>
                    <input type="text" class="form-control col-md-10" name="sosial_media" value="{{$kelurahan->sosial_media}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Demografi Desa</label>
                    <input type="text" class="form-control col-md-10" name="demografi_desa" value="{{$kelurahan->demografi_desa}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Titik Lokasi</label>
                    <input type="text" class="form-control col-md-10" name="titik_lokasi" value="{{$kelurahan->titik_lokasi}}">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Kategori</label>
                    <select type="text" class="form-control col-md-10" name="kategori">
                        <option value="Desa" <?php if ($kelurahan->kategori == "Desa") echo "selected"; ?>>Desa</option>
                        <option value="Kelurahan" <?php if ($kelurahan->kategori == "Kelurahan") echo "selected"; ?>>Kelurahan</option>
                    </select>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('additional-js')


@endsection
