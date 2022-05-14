@extends('layouts.master')
@section('title', 'Data Survey Keolahragaan')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Prasarana</h6>
            <a class="btn btn-sm btn-primary" href="{{route('distribusiPrasaranaLembaga.create')}}">Buat Pengajuan</a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Lembaga</th>
                            <th>Penerima</th>
                            <th>Keterangan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($distribusiPrasarana as $dt)
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>{{$dt->kode}}</td>
                            <td>{{$dt->tanggal_pengajuan}}</td>
                            <td>{{$dt->nama_lembaga}}</td>
                            <td>{{$dt->penerima}}</td>
                            <td></td>
                            @if($dt->status == 1)
                            <td class="bg-secondary text-center">
                                <span class="text-white">Draft</span>
                            </td>
                            @elseif($dt->status == 2)
                            <td class="bg-primary text-center">
                                <span class="text-white">Submitted</span>
                            </td>
                            @elseif($dt->status == 3)
                            <td class="bg-success text-center">
                                <span class="text-white">Approved</span>
                            </td>
                            @elseif($dt->status == 4)
                            <td class="bg-success text-center">
                                <span class="text-white">Rejected</span>
                            </td>
                            @endif
                            <td class="text-center">
                                @if($dt->status == 1)
                                <a href="{{route('distribusiPrasaranaLembaga.edit', ['id' => $dt->id])}}"><i class="fas fa-edit"></i></a>
                                <a href="{{route('prestasiOlahraga.delete', ['id' => $dt->id])}}" onclick="return confirm('Apakah anda yakin untuk menghapus data?');"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{route('distribusiPrasaranaLembaga.submit')}}" onclick="event.preventDefault();
                                                     document.getElementById('kirim-pengajuan').submit();" title="Submit Data"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                <form id="kirim-pengajuan" action="{{ route('distribusiPrasaranaLembaga.submit') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="id_distribusi_prasarana" value="{{$dt->id}}">
                                </form>
                                @else
                                <a href="{{route('distribusiPrasarana.verify', ['id' => $dt->id])}}" title="Klik untuk verifikasi data"><i class="fas fa-eye"></i></a>
                                @endif
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
