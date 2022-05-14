@extends('layouts.master')

@section('title', 'Management Pengguna')

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
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Master Data Pengguna</h6>
            <a class="btn btn-sm btn-success" href="javascript(0);" data-toggle="modal" data-target="#add-form">Tambah Pengguna</a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>email</th>
                            <th>Organisasi Lembaga</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($pengguna as $png)
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>{{$png->name}}</td>
                            <td>{{$png->email}}</td>
                            <td>{{$png->nama_organisasi}}</td>
                            <td class="text-center"><a href="{{route('users.edit', ['id' => $png->id])}}"><i class="fas fa-edit"></i></a> | <a href="{{route('users.delete', ['id' => $png->id])}}" onclick="return confirm('Apakah anda yakin untuk menghapus data?');"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tamabah Data Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Username</label>
                            <input type="text" class="form-control col-md-9" name="username">
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Email</label>
                            <input type="text" class="form-control col-md-9" name="email">
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Role</label>
                            <select type="text" class="form-control col-md-9" name="role_id">
                                <option value="">-</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Kecamatan</label>
                            <select type="text" class="form-control col-md-9" name="kecamatan_id">
                                <option value="">-</option>
                                @foreach($kecamatan as $kec)
                                <option value="{{$kec->id}}">{{$kec->kecamatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Desa / Kelurahan</label>
                            <select type="text" class="form-control col-md-9" name="desa_kelurahan_id">
                                <option value="">-</option>
                                @foreach($kelurahan as $kel)
                                <option value="{{$kel->id}}">{{$kel->desa_kelurahan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlInput1" class="col-md-3 pt-2">Organisasi Lembaga</label>
                            <select type="text" class="form-control col-md-9" name="id_organisasi_lembaga">
                                <option value="">-</option>
                                @foreach($organisasiLembaga as $ol)
                                <option value="{{$ol->id}}">{{$ol->nama_organisasi}}</option>
                                @endforeach
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
