@extends('layouts.master')

@section('title', 'Master Cabang Olahraga')

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
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Edit Sarana</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('saranaOlahraga.sarana.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Jenis Sarana</label>
                    <select type="text" class="form-control col-md-10" name="jenis_sarana" required>
                        @foreach($m_sarana as $so)
                        <option value="{{$so->id}}" <?php if ($sarana->jenis_sarana == $so->id) echo "selected"; ?>>{{$so->nama_sarana}}</option>
                        @endforeach

                    </select>
                    <input type="hidden" class="form-control col-md-10" name="id" value="{{$sarana->id}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Tipe Sarana</label>
                    <select class="form-control col-md-10" name="tipe_sarana">
                        <option value="INDOOR" <?php if ($sarana->tipe_sarana == "INDOOR") echo "selected"; ?>>Indoor</option>
                        <option value="OUTDOOR" <?php if ($sarana->tipe_sarana == "OUTDOOR") echo "selected"; ?>>Outdoor</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Status Kepemilikan</label>
                    <input type="text" class="form-control col-md-10" name="status_kepemilikan" value="{{$sarana->status_kepemilikan}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Nama Pemilik</label>
                    <input type="text" class="form-control col-md-10" name="nama_pemilik" value="{{$sarana->nama_pemilik}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Luas Lapangan</label>
                    <input type="text" class="form-control col-md-10" name="luas_lapang" value="{{$sarana->luas_lapang}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">kondisi Lapang</label>
                    <select type="text" class="form-control col-md-10" name="kondisi_lapang">
                        <option value="Baik" <?php if ($sarana->kondisi_lapang == "Baik") echo "selected"; ?>>Baik</option>
                        <option value="Cukup" <?php if ($sarana->kondisi_lapang == "Cukup") echo "selected"; ?>>Cukup</option>
                        <option value="Buruk" <?php if ($sarana->kondisi_lapang == "Buruk") echo "selected"; ?>>Buruk</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Alamat</label>
                    <textarea type="text" class="form-control col-md-10" name="alamat_lokasi">{{$sarana->alamat_lokasi}}</textarea>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Foto Lokasi</label>
                    <img src="{{asset('images/pendukung/'. $sarana->foto_lokasi)}}" width="300" height="200" alt="">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2"></label>
                    <input type="file" class="form-control col-md-10" name="lokasi">
                    <input type="hidden" class="form-control col-md-10" name="old_lokasi" value="{{$sarana->foto_lokasi}}">
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
