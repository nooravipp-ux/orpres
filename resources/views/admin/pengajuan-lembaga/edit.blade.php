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
    input[type="file"],
    input[type="number"],
    select.form-control {
        background: transparent;
        border: none;
        border-bottom: 1px solid #E2E6E1;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-radius: 0;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    input[type="file"]:focus,
    textarea[type="text"]:focus,
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
            <h6 class="m-0 font-weight-bold text-success">Buat Pengajuan</h6>
            <h6 class="m-0 font-weight-bold text-success">STATUS : <?php if ($distribusiPrasaranaLembaga->status == 1) echo 'DRAFT'; ?> </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('distribusiPrasaranaLembaga.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Nama Lembaga</label>
                    <input type="hidden" class="form-control col-md-10" name="id_distribusi_prasarana_lembaga" value="{{$distribusiPrasaranaLembaga->id}}">
                    <select type="text" class="form-control col-md-10" name="nama_lembaga">
                        <option value="">-</option>
                        <option value="KONI" <?php if ($distribusiPrasaranaLembaga->nama_lembaga == 'KONI') echo "selected"; ?>>KONI</option>
                        <option value="DEWAN" <?php if ($distribusiPrasaranaLembaga->nama_lembaga == 'DEWAN') echo "selected"; ?>>DEWAN</option>
                        <option value="">-</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Penanggung Jawab</label>
                    <input type="text" class="form-control col-md-10" name="penanggung_jawab" value="{{$distribusiPrasaranaLembaga->penanggung_jawab}}">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Tanggal Pengajuan</label>
                    <input type="date" class="form-control col-md-2" name="tanggal_pengajuan" value="{{$distribusiPrasaranaLembaga->tanggal_pengajuan}}">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 1</label>
                    <input type="text" class="form-control col-md-10" name="old_file_lampiran_1" value="{{$distribusiPrasaranaLembaga->file_lampiran_1}}">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2"></label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_1">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 2</label>
                    <input type="text" class="form-control col-md-10" name="old_file_lampiran_2" value="{{$distribusiPrasaranaLembaga->file_lampiran_2}}">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2"></label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_2">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Lampiran 3</label>
                    <input type="text" class="form-control col-md-10" name="old_file_lampiran_3" value="{{$distribusiPrasaranaLembaga->file_lampiran_3}}">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2"></label>
                    <input type="file" class="form-control col-md-10" name="file_lampiran_1">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-sm btn-success font-weight-bold">Update Informasi Pengajuan</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold mb-3 text-success">Detail Pengajuan </h6>
                <a href="javascript(0);" class="btn btn-sm btn-success m-0 font-weight-bold" data-toggle="modal" data-target="#detail-prasarana">Tambah Prasarana</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Prasarana</th>
                            <th>Jumlah</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($distribusiPrasaranaLembagaDetail as $dt)
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>{{$dt->nama_prasarana}}</td>
                            <td>{{$dt->jumlah}}</td>
                            <td class="text-center">
                                <a href="{{route('distribusiPrasaranaLembaga.editDetail', ['id' => $dt->id])}}"><i class="fas fa-edit"></i></a>
                                <a href="{{route('distribusiPrasaranaLembaga.hapusDetail', ['id' => $dt->id, 'idDistribusiPrasaranaLembaga' => $distribusiPrasaranaLembaga->id])}}" onclick="return confirm('Apakah anda yakin untuk menghapus data?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detail-prasarana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('distribusiPrasaranaLembaga.storeDetail')}}" method="POST">
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
                        <label for="recipient-name" class="col-form-label col-md-2">Prasarana</label>
                        <input type="hidden" class="form-control col-md-10" name="id_distribusi_prasarana_lembaga" value="{{$distribusiPrasaranaLembaga->id}}">
                        <select type="text" class="form-control col-md-10" name="id_prasarana">
                            <option value="">-</option>
                            @foreach($prasarana as $prs)
                            <option value="{{$prs->id}}">{{$prs->nama_prasarana}} ({{$prs->stok}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-form-label col-md-2">Jumlah</label>
                        <input type="number" class="form-control col-md-10" name="jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
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

</script>

@endsection
