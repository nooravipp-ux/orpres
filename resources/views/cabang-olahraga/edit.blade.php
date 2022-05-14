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
    input[type="date"],
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
    input[type="date"]:focus,
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
            <h6 class="m-0 font-weight-bold text-success">Tambah Potensi Atlet</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('cabor.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row form-group pl-2 pr-2">
                    <label for="exampleFormControlInput1" class="col-form-label col-md-2">Nama Cabang Olahraga</label>
                    <input type="text" class="form-control col-md-10" name="nama_cabang_olahraga" value="{{$cabor->nama_cabang_olahraga}}">
                </div>
                <div class="form-group pl-2 text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('additional-js')
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
</script>
@endsection
