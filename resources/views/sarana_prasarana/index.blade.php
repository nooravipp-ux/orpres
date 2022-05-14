@extends('layouts.master')

@section('title', 'Master Data Sarana dan Prasarana')

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
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Master Data Prasarana </h6>
                    <a class="btn btn-sm btn-success" href="javascript(0);" data-toggle="modal" data-target="#prasarana">Tambah Prasarana</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Prasarana</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($prasarana as $pr)
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td>{{$pr->nama_prasarana}}</td>
                                    <td>{{$pr->stok}}</td>
                                    <td>{{$pr->harga}}</td>
                                    <td>{{$pr->satuan}}</td>
                                    <td class="text-center"><a href="{{route('prasarana.edit', ['id' => $pr->id])}}"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Master Data Sarana </h6>
                    <a class="btn btn-sm btn-success" href="javascript(0);" data-toggle="modal" data-target="#sarana">Tambah Sarana</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Sarana</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($sarana as $sr)
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>{{$sr->nama_sarana}}</td>
                                    <td class="text-center"><a href="{{route('sarana.edit', ['id' => $sr->id])}}"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sarana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('sarana.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Data Sarana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="exampleFormControlInput1"class="col-md-3 pt-2">Nama Sarana</label>
                        <input type="text" class="form-control col-md-9" name="nama_sarana">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="prasarana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('prasarana.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Data Prasarana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="exampleFormControlInput1" class="col-md-3 pt-2">Nama Prasarana</label>
                        <input type="text" class="form-control col-md-9" name="nama_prasarana">
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlInput1" class="col-md-3 pt-2">Jumlah Stok</label>
                        <input type="text" class="form-control col-md-9" name="stok">
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlInput1" class="col-md-3 pt-2">Harga</label>
                        <input type="text" class="form-control col-md-9" name="harga">
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlInput1" class="col-md-3 pt-2">Satuan</label>
                        <select type="text" class="form-control col-md-9" name="satuan">
                            <option value="">-</option>
                            <option value="Buah">Buah</option>
                            <option value="Set">Set</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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

    $(document).ready(function() {
        $('#dataTable1').DataTable();
    });
</script>

@endsection
