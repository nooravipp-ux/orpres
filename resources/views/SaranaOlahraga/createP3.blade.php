@extends('layouts.master')

@section('title', 'P3')

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
            <form action="{{route('sarana.storeP3')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-3">P.3 FASILITAS SARANA OLAHRAGA</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Jenis Sarana Olahraga</label>
                    <select type="text" class="form-control col-md-10" name="jenis_sarana" required>
                        <option value="" selected>-- Pilih Sarana Olahraga --</option>
                        @foreach($saranaOlahraga as $so)
                        <option value="{{$so->id}}">{{$so->nama_sarana}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" class="form-control col-md-10" name="sarana_prasarana_id" value="{{$saranaPrasaranaId}}">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Tipe Sarana Olahraga</label>
                    <select class="form-control col-md-10" name="tipe_sarana">
                        <option value="INDOOR">Indoor</option>
                        <option value="OUTDOOR">Outdoor</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Status Kepemilikan</label>
                    <input type="text" class="form-control col-md-10" name="status_kepemilikan">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Nama Pemilik</label>
                    <input type="text" class="form-control col-md-10" name="nama_pemilik">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Luas Lapangan</label>
                    <input type="text" class="form-control col-md-10" name="luas_lapang">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">kondisi Lapang</label>
                    <select type="text" class="form-control col-md-10" name="kondisi_lapang">
                        <option value="Baik">Baik</option>
                        <option value="Baik">Cukup</option>
                        <option value="Buruk">Buruk</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Alamat</label>
                    <textarea type="text" class="form-control col-md-10" name="alamat_lokasi"></textarea>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Foto Lokasi</label>
                    <input type="file" class="form-control col-md-10" name="lokasi">
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <a href="{{route('sarana.createP4', ['id' => $saranaPrasaranaId])}}" class="btn btn-sm btn-success">Lanjut Form P.4 ></a>
                    </div>
                </div>
            </form>
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