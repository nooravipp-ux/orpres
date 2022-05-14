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
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('distribusiPrasarana.index')}}">Distribusi Prasarana </a> / Detail Prasarana (Peralatan Olahraga)</h6>
            <div>
                <form action="{{route('distribusiPrasarana.reject')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" class="form-control col-md-10" name="id_distribusi_prasarana" value="{{$distribusiId}}">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10 text-right">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </div>
                    </div>
                </form>
                <form action="{{route('distribusiPrasarana.approved')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" class="form-control col-md-10" name="id_distribusi_prasarana" value="{{$distribusiId}}">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Kecamatan</label>
                <input type="text" readonly class="form-control col-md-10" id="kecamatan" name="id_kecamatan" value="{{$distribusi->kecamatan}}">
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Desa / Kelurahan</label>
                <input type="text" readonly class="form-control desa_kelurahan col-md-10" name="id_desa_kelurahan" id="kelurahan" value="{{$distribusi->desa_kelurahan}}">
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Titik Lokasi</label>
                <input type="text" readonly class="form-control col-md-10" name="titik_lokasi" value="{{$distribusi->titik_lokasi}}">
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Keterangan</label>
                <input type="text" readonly class="form-control col-md-10" name="keterangan" value="{{$distribusi->keterangan}}">
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Proposal</label>
                <label for="exampleFormControlInput1" class="col-form-label col-md-10"><a href="{{asset('images/doc_pengajuan/'.$distribusi->file_proposal)}}">{{$distribusi->file_proposal}}</a></label>
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">SK Kelompok</label>
                <label for="exampleFormControlInput1" class="col-form-label col-md-10"><a href="{{asset('images/doc_pengajuan/'.$distribusi->file_sk_kelompok)}}">{{$distribusi->file_sk_kelompok}}</a></label>
            </div>
            <div class="row form-group">
                <label for="exampleFormControlInput1" class="col-form-label col-md-2">Foto Sarana (PDF)</label>
                <label for="exampleFormControlInput1" class="col-form-label col-md-10"><a href="{{asset('images/doc_pengajuan/'.$distribusi->file_foto_sarana)}}">{{$distribusi->file_foto_sarana}}</a></label>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Lembaga Penerima</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Nama Prasarana</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailDistribusi as $pr)
                        <tr>
                            <td>{{$pr->lembaga_penerima}}</td>
                            <td>{{$pr->nama_penerima}}</td>
                            <td>{{$pr->alamat_lembaga}}</td>
                            <td>{{$pr->nama_prasarana}}</td>
                            <td>{{$pr->jumlah}}</td>
                            <td>{{$pr->keterangan}}</td>
                            <td class="text-center"><a href="{{route('distribusiPrasarana.create', ['id' => $pr->id])}}"><i class="fas fa-trash"></i></a></td>
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
