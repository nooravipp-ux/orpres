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
            <h6 class="m-0 font-weight-bold text-success">Edit Sarana</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{route('sarana.update')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="exampleFormControlInput1" class="col-md-2 pt-2">Nama Prasarana</label>
                    <input type="text" class="form-control col-md-10" name="nama_sarana" value="{{$sarana->nama_sarana}}">
                    <input type="hidden" class="form-control col-md-10" name="id" value="{{$sarana->id}}">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('additional-js')


@endsection
