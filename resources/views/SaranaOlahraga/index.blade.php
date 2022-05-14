@extends('layouts.master')
@section('title', 'Data Survey Keolahragaan')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 12px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Sarana & Prasarana Olahraga </h6>
            <a class="btn btn-sm btn-primary" href="{{route('saranaOlahraga.create')}}"><i class="fas fa-plus-circle"></i></a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Desa / Kelurahan</th>
                            <th>Jumlah RT</th>
                            <th>Jumlah RW</th>
                            <th>Jumlah Penduduk</th>
                            <th>Dibuat Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>{{$dt->kecamatan}}</td>
                            <td>{{$dt->desa_kelurahan}}</td>
                            <td>{{$dt->jumlah_rt}}</td>
                            <td>{{$dt->jumlah_rw}}</td>
                            <td>{{$dt->jumlah_penduduk}}</td>
                            <td>{{$dt->dibuat_tanggal}}</td>
                            <td><a href="{{route('saranaOlahraga.show', ['id' => $dt->id])}}"><i class="fas fa-edit"></i></a> | <a href="{{route('saranaOlahraga.export', ['id' => $dt->id])}}"><i class="fas fa-print"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        $('#dataTable').DataTable();
    });
</script>

@endsection
