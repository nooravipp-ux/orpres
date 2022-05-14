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
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Master Data Cabang Olahraga </h6>
            <a class="btn btn-sm btn-success" href="javascript(0);" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Cabang Olahraga</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Cabang Olahraga</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($cabor as $cb)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$cb->nama_cabang_olahraga}}</td>
                            <td class="text-center"><a href="{{route('cabor.edit', ['id' => $cb->id])}}"><i class="fas fa-edit"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Cabang Olahraga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('cabor.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-4">Nama Cabang Olahraga</label>
                        <input type="text" class="form-control col-md-8" name="nama_cabang_olahraga" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
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
