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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Buat Pengajuan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('distribusiPrasarana.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
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
                    <label for="exampleFormControlInput1" class="col-form-label col-md-3">Periode Tahun</label>
                    <input type="text" class="form-control col-md-9" name="periode_tahun">
                </div>
                <!-- <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-3">Titik Lokasi</label>
                    <input type="text" class="form-control col-md-9" name="titik_lokasi">
                </div>
                <div class="row form-group">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-3">Keterangan</label>
                    <input type="text" class="form-control col-md-9" name="keterangan">
                </div> -->
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
                <div class="row form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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

    $("#kecamatan").val(g_id_kecamatan);


    $(function() {
        if (g_id_kecamatan != null) {
            $.ajax({
                url: '/kelurahan/get-desa-kelurahan-by-id-kecamatan/' + g_id_kecamatan,
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

                        $("#kelurahan").val(g_id_desa);
                    } else {
                        $('#kelurahan').empty();
                    }
                }
            });
        }
    });
</script>

@endsection
