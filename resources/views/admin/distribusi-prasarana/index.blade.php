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
            <h6 class="m-0 font-weight-bold text-primary">Distribusi Prasarana</h6>
            <div>
                <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#berita-acara">Buat Pengajuan</a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode</th>
                            <th>Tahun</th>
                            <th>Kecamatan</th>
                            <th>Desa / Kelurahan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($distribusiPrasarana as $dist)
                        <tr>
                            <td>{{$dist->kode}}</td>
                            <td>{{date('Y', strtotime($dist->tanggal))}}</td>
                            <td>{{$dist->kecamatan}}</td>
                            <td>{{$dist->desa_kelurahan}}</td>
                            @if($dist->status == 'DRAFT')
                            <td class="bg-secondary text-center">
                                <span class="text-white">Draft</span>
                            </td>
                            @elseif($dist->status == 'SUBMITTED')
                            <td class="bg-primary text-center">
                                <span class="text-white">Submitted</span>
                            </td>
                            @elseif($dist->status == 'REJECTED')
                            <td class="bg-danger text-center">
                                <span class="text-white">REJECTED</span>
                            </td>
                            @elseif($dist->status == 'APPROVED')
                            <td class="bg-success text-center">
                                <span class="text-white">Approved</span>
                            </td>
                            @else
                            <td class="bg-warning text-center">
                                <span class="text-white">Closed</span>
                            </td>
                            @endif
                            <td class="text-center">
                                @if($dist->status == 'DRAFT')
                                <!-- Draft -->
                                <a href="{{route('distribusiPrasarana.create', ['id' => $dist->id])}}" title="Detail Peralatan"><i class="fas fa-edit"></i></a>
                                <a href="{{route('distribusiPrasarana.create', ['id' => $dist->id])}}" title="Detail Peralatan"><i class="fas fa-edit"></i></a>
                                @elseif($dist->status == 'SUBMITTED')
                                <!-- Submitted -->
                                <a href="{{route('distribusiPrasarana.approve', ['id' => $dist->id])}}" title="Klik Untuk Approve"><i class="fas fa-check"></i></a>
                                @elseif($dist->status == 'APPROVED')
                                <!-- Approve -->
                                <a href="{{route('distribusiPrasarana.verify', ['id' => $dist->id])}}" title="Klik Untuk Melihat Detail Data"><i class="fas fa-eye"></i></a>
                                <a href="{{route('distribusiPrasarana.done')}}" onclick="event.preventDefault();
                                                     document.getElementById('kirim-pengajuan').submit();"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <form id="kirim-pengajuan" action="{{ route('distribusiPrasarana.done') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="id_distribusi_prasarana" value="{{$dist->id}}">
                                </form>
                                @else
                                <a class="btn btn-sm btn-primary" href="{{route('distribusiPrasarana.verify', ['id' => $dist->id])}}" title="Klik Untuk Melihat Detail Data">Lihat</a> |
                                <a class="btn btn-sm btn-primary" href="{{route('distribusiPrasarana.cetakBA', ['id' => $dist->id])}}" title="Klik Untuk Cetak BA">Cetak BA</a> |
                                <a class="btn btn-sm btn-primary" href="{{route('distribusiPrasarana.cetakNPHD', ['id' => $dist->id])}}" title="Klik Untuk Cetak NPHD">Cetak NPHD</a>
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

<!-- Modal -->
<div class="modal fade" id="berita-acara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('distribusiPrasarana.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Data Sarana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kecamatan</label>
                        <select type="text" class="form-control col-md-9" id="kecamatan" name="id_kecamatan">
                            @foreach($kecamatan as $kec)
                            <option data-id="{{$kec->id}}" value="{{$kec->id}}">{{$kec->kode}} - {{$kec->kecamatan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Desa / Kelurahan</label>
                        <select type="text" class="form-control desa_kelurahan col-md-9" name="id_desa_kelurahan" id="kelurahan">
                            <option value="-">-</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Titik Lokasi</label>
                        <input type="text" class="form-control col-md-9" name="titik_lokasi">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Keterangan</label>
                        <input type="text" class="form-control col-md-9" name="keterangan">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Proposal</label>
                        <input type="file" class="form-control col-md-9" name="file_proposal">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">SK Kelompok</label>
                        <input type="file" class="form-control col-md-9" name="file_sk_kelompok">
                    </div>
                    <div class="row form-group">
                        <label for="exampleFormControlInput1" class="col-form-label col-md-3">Foto Sarana (PDF)</label>
                        <input type="file" class="form-control col-md-9" name="file_foto_sarana">
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

    $(".kecamatan").select2({
        placeholder: "Pilih Kecamatan",
        allowClear: true
    });

    $("#kecamatan").on("change", function() {
        var kecamatan_id = $(this).val();
        console.log(kecamatan_id);

        if (kecamatan_id) {
            $.ajax({
                url: '/kelurahan/get-desa-kelurahan-by-id-kecamatan/' + kecamatan_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        console.log(data);
                        $('#kelurahan').empty();
                        $('#kelurahan').append('<option hidden>Pilih Kelurahan</option>');
                        $.each(data, function(id, desa_kelurahan) {
                            $('select[name="id_desa_kelurahan"]').append('<option value="' + desa_kelurahan.id + '">' + desa_kelurahan.desa_kelurahan + '</option>');
                        });
                    } else {
                        $('#kelurahan').empty();
                    }
                }
            });
        } else {
            $('#course').empty();
        }
    });
</script>

@endsection
