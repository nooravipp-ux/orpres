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
            <h6 class="m-0 font-weight-bold text-success">Data Potensi Atlet</h6>
            <div>
                <a class="btn btn-sm btn-success" href="{{route('prestasiOlahraga.create')}}">Tambah Data</a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenis Potensi</th>
                            <th>Jenis Olahraga</th>
                            <th>Tingkat Prestasi</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($prestasiOlahraga as $po)
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>{{$po->nama}}</td>
                            <td>{{$po->tempat_lahir}}, <?php echo date("d M Y", strtotime($po->tanggal_lahir));?></td>
                            <td>Kec.{{$po->desa_kelurahan}}, Desa/Kel.{{$po->kecamatan}}</td>
                            <td>{{$po->jenis_potensi}}</td>
                            <td>{{$po->nama_cabang_olahraga}}</td>
                            <td>{{$po->tingkat_prestasi}}</td>
                            <td class="text-center"><a href="{{route('prestasiOlahraga.edit', ['id' => $po->id])}}"><i class="fas fa-edit"></i></a>
                            | <a href="{{route('prestasiOlahraga.delete', ['id' => $po->id])}}" onclick="return confirm('Apakah anda yakin untuk menghapus data?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
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
