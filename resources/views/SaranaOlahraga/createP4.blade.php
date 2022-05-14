@extends('layouts.master')

@section('title', 'P4')

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
            <form action="{{route('sarana.storeP4')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-12">P.4 PRASARANA OLAHRAGA YANG DIBERIKAN OLEH PEMERINTAH</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Penerima Hibah</label>
                    <input type="text" class="form-control col-md-10" name="penerima_hibah" placeholder="ex: RW.01 / Nama Kelompok Olahraga">
                    <input type="hidden" class="form-control col-md-10" name="sarana_prasarana_id" value="{{$saranaPrasaranaId}}">
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
                        @foreach($prasaranaOlahraga as $po)
                        <option value="{{$po->id}}">{{$po->nama_prasarana}} ({{$po->satuan}})</option>
                        @endforeach
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
                        <a href="{{route('sarana.createP5', ['id' => $saranaPrasaranaId])}}" class="btn btn-sm btn-success">Lanjut Form P.5 ></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Detail Prasarana Olahraga</h6>
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