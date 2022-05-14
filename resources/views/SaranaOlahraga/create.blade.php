@extends('layouts.master')

@section('title', 'Form P1')

@section('additional-css')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    table th,
    td {
        font-size: 14px;
    }

    .col-form-label {
        font-size: 14px;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4>Form Pendataan Sarana dan Prasarana</h4>
        </div>
        <div class="card-body">
            <form action="{{route('sarana.storeP1P2')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">P.2 DESKRIPSI LOKASI</label>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Kecamatan</label>
                    <select type="text" class="form-control col-md-10 kecamatan" name="kecamatan_id" id="kecamatan">
                        @foreach($kecamatan as $kec)
                        <option data-id="{{$kec->id}}" value="{{$kec->id}}">{{$kec->kode}} - {{$kec->kecamatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Desa / Kelurahan</label>
                    <select type="text" class="form-control col-md-10 desa_kelurahan" name="desa_kelurahan_id" id="kelurahan">
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Email Desa / Kelurahan</label>
                    <input type="email" class="form-control col-md-10" name="email_desa_kel">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Web Desa / Kelurahan</label>
                    <input type="text" class="form-control col-md-10" name="website_desa_kel">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">jumlah RT</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_rt">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">jumlah RW</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_rw">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">jumlah Penduduk</label>
                    <input type="text" class="form-control col-md-10" name="jumlah_penduduk">
                </div>
                <div class="form-group row">
                    <label for="recipient-name" class="col-form-label col-md-2">Demografi Desa (Softcopy)</label>
                    <input type="file" class="form-control col-md-10" name="demografi">
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <button type="submit" class="bt btn-sm btn-primary">Simpan</button>
                    </div>
                    <div class="col-md-6">

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
                                $('select[name="desa_kelurahan_id"]').append('<option value="' + desa_kelurahan.id + '">' + desa_kelurahan.desa_kelurahan + '</option>');
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
