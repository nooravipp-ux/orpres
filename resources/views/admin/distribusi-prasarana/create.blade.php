@extends('layouts.master')
@section('title', 'Data Survey Keolahragaan')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 14px;
    }

    .form {
        font-size: 14px;
    }

    input[type="text"] {
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('distribusiPrasarana.index')}}">Distribusi Prasarana </a> / Detail Prasarana (Peralatan Olahraga)</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="form">
                <form action="{{route('detailDistribusiPrasarana.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Lembaga Penerima</label>
                        <select type="text" class="form-control col-md-10" name="lembaga_penerima">
                            <option value="RW">RW</option>
                            <option value="Kelompok Olahraga">Kelompok Olahraga</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Nama Penerima</label>
                        <input type="text" class="form-control col-md-10" name="nama_penerima">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Alamat</label>
                        <input type="text" class="form-control col-md-10" name="alamat_lembaga">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Nama Prasarana (Alat)</label>
                        <input type="hidden" class="form-control col-md-10" name="id_distribusi_prasarana" value="{{$distribusiId}}">
                        <select type="text" class="form-control col-md-10" name="id_prasarana">
                            <option value="">-</option>
                            @foreach($prasarana as $prs)
                            <option value="{{$prs->id}}">{{$prs->nama_prasarana}} ({{$prs->stok}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Jumlah</label>
                        <input type="text" class="form-control col-md-10" name="jumlah">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Keterangan</label>
                        <input type="text" class="form-control col-md-10" name="keterangan">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Nama Prasarana</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($detailDistribusi as $pr)
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>{{$pr->nama_penerima}}</td>
                            <td>{{$pr->alamat_lembaga}}</td>
                            <td>{{$pr->nama_prasarana}}</td>
                            <td>{{$pr->jumlah}}</td>
                            <td>{{$pr->keterangan}}</td>
                            <td class="text-center"><a href=""><i class="fas fa-trash"></i></a></td>
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
