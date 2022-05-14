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
            <h6 class="m-0 font-weight-bold text-primary">Report CPCL</h6>
            <div>
                <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#cpcl-form">Export CPCL</a>
                <a class="btn btn-sm btn-primary" href="javascript(0);" data-toggle="modal" data-target="#input-form">Input CPCL</a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Tahun</th>
                            <th>Kecamatan</th>
                            <th>Desa / Kelurahan</th>
                            <th>Penerima</th>
                            <th>Alamat Penerima</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($cpcl as $cp)
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>{{date('Y', strtotime($cp->tanggal))}}</td>
                            <td>{{$cp->kecamatan}}</td>
                            <td>{{$cp->desa_kelurahan}}</td>
                            <td>{{$cp->nama_penerima}}</td>
                            <td>{{$cp->alamat_lembaga}}</td>
                            <td>{{$cp->nama_prasarana}}</td>
                            <td>{{$cp->jumlah}}</td>
                            @if($cp->status == 'APPROVED')
                            <td class="bg-success text-center">
                                <span class="text-white">Approved</span>
                            </td>
                            @else
                            <td class="bg-warning text-center">
                                <span class="text-white"><i class="fas fa-check"></i></span>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal CPCL  -->
    <div class="modal fade" id="cpcl-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{route('distribusiPrasarana.exportCPCL')}}" method="GET" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export CPCL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Start Date</label>
                            <input type="date" name="start_date" class="form-control col-md-9">
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">End Date</label>
                            <input type="date" name="end_date" class="form-control col-md-9">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal BAST  -->
    <div class="modal fade" id="bast-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{route('distribusiPrasarana.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Print BAST</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Periode</label>
                            <select type="text" class="form-control col-md-9" id="kecamatan" name="periode">
                                <option value="">-</option>
                                @foreach($periode as $prd)
                                <option value="{{$prd->periode}}">{{$prd->periode}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kec.</label>
                            <select type="text" class="form-control col-md-9 kecamatan" id="kecamatan" name="id_kecamatan">
                                <option value="">-</option>
                                @foreach($kecamatan as $kc)
                                <option value="{{$kc->id}}">{{$kc->kecamatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Des./Kel.</label>
                            <select name="desa_kelurahan_id" class="form-control col-md-9" id="">
                                <option value="">-</option>
                                @foreach($desaKelurahan as $desa)
                                <option value="{{$desa->id}}">{{$desa->desa_kelurahan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kel. / Wil. Penerima</label>
                            <select type="text" class="form-control col-md-9" id="kelurahan" name="id_desa_kelurahan">
                                <option value="">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal nphd  -->
    <div class="modal fade" id="nphd-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{route('distribusiPrasarana.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Print NPHD</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Periode</label>
                            <select type="text" class="form-control col-md-9" id="kecamatan" name="periode">
                                <option value="">-</option>
                                @foreach($periode as $prd)
                                <option value="{{$prd->periode}}">{{$prd->periode}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kec.</label>
                            <select type="text" class="form-control col-md-9 kecamatan" id="kecamatan" name="id_kecamatan">
                                <option value="">-</option>
                                @foreach($kecamatan as $kc)
                                <option value="{{$kc->id}}">{{$kc->kecamatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Des./Kel.</label>
                            <select name="desa_kelurahan_id" class="form-control col-md-9" id="">
                                <option value="">-</option>
                                @foreach($desaKelurahan as $desa)
                                <option value="{{$desa->id}}">{{$desa->desa_kelurahan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kel. / Wil. Penerima</label>
                            <select type="text" class="form-control col-md-9" id="kelurahan" name="id_desa_kelurahan">
                                <option value="">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Input Form  -->
    <div class="modal fade" id="input-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{route('distribusiPrasarana.insertCPCL')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adjustment CPCL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Periode</label>
                            <input type="date" class="form-control col-md-9" name="tanggal">
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Kec.</label>
                            <select type="text" class="form-control col-md-9 kecamatan" id="kecamatan" name="id_kecamatan">
                                <option value="">-</option>
                                @foreach($kecamatan as $kc)
                                <option value="{{$kc->id}}">{{$kc->kecamatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="exampleFormControlInput1" class="col-form-label col-md-3">Des./Kel.</label>
                            <select type="text" class="form-control col-md-9" id="kelurahan" name="id_desa_kelurahan">
                                <option value="">-</option>
                                @foreach($desaKelurahan as $desa)
                                <option value="{{$desa->id}}">{{$desa->desa_kelurahan}}</option>
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



    // $("#kecamatan").on("change", function() {
    //     var kecamatan_id = $(this).val();
    //     console.log(kecamatan_id);

    //     if (kecamatan_id) {
    //         $.ajax({
    //             url: '/kelurahan/get-desa-kelurahan-by-id-kecamatan/' + kecamatan_id,
    //             type: "GET",
    //             data: {
    //                 "_token": "{{ csrf_token() }}"
    //             },
    //             dataType: "json",
    //             success: function(data) {
    //                 if (data) {
    //                     console.log(data);
    //                     $('#kelurahan').empty();
    //                     $('#kelurahan').append('<option hidden>Pilih Kelurahan</option>');
    //                     $.each(data, function(id, desa_kelurahan) {
    //                         $('select[name="id_desa_kelurahan"]').append('<option value="' + desa_kelurahan.id + '">' + desa_kelurahan.desa_kelurahan + '</option>');
    //                     });
    //                 } else {
    //                     $('#kelurahan').empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $('#course').empty();
    //     }
    // });
</script>

@endsection
