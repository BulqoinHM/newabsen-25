@extends('layouts.master')

@section('title')
    Data Menu Dropdown
@endsection

@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('failed') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Data Gagal Disimpan, Pengisian form tidak lengkap</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        {{-- <div class="title">
                        <h4>Data Guru</h4>
                    </div> --}}
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Data Menu Dropdown
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        {{-- <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            January 2018
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Export List</a>
                            <a class="dropdown-item" href="#">Policies</a>
                            <a class="dropdown-item" href="#">View Assets</a>
                        </div>
                    </div> --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Dropdown-modal">
                            <i class="icon-copy ion-plus-circled"></i>
                            Tambah Data
                        </button>


                    </div>
                </div>
                <!-- Modal Tambah Dropdown -->
                <div class="modal fade bs-example-modal-lg" data-backdrop="static" id="Dropdown-modal" tabindex="-1"
                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">
                                    Form Data Dropdown
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <ul>
                                            <li><strong>Submit Data Gagal !</strong></li>
                                            @foreach ($errors->all() as $error)
                                                <li><strong>{{ $error }}</strong></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ url('dropdown/store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" name="kategori" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Nilai</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" name="nilai" />
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Tutup
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Modal Tambah Dropdown -->
            </div>
            <!-- Fade-in effect -->
            {{-- <h5 class="h4 text-blue mb-10">Data Guru</h5> --}}
            {{-- <p class="mb-30">You can use by default <code>.da-overlay</code></p> --}}
            <!-- Checkbox select Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Menu Dropdown</h4>
                </div>
                <div class="pb-20">
                    <table class="checkbox-datatable table nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="dt-checkbox">
                                        <input type="checkbox" name="select_all" value="1" id="example-select-all" />
                                        <span class="dt-checkbox-label"></span>
                                    </div>
                                </th>
                                <th>Kategori</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td></td>
                                    <td>{{ $data->kategori }}</td>
                                    <td>{{ $data->nilai }}</td>
                                    <td>

                                        {{-- <div class="col-md-4 col-sm-12 mb-30"> --}}
                                            {{-- <div class="pd-20 card-box height-100-p"> --}}
                                                <a href="#"><i class="icon-copy fa fa-pencil" aria-hidden="true"
                                                        data-toggle="modal"
                                                        data-target="#Dropdown-editmodal{{ $data['id'] }}"></i></a>
                                                <a href="#"><i class="icon-copy fa fa-trash" aria-hidden="true"
                                                        data-toggle="modal"
                                                        data-target="#Dropdown-hapusmodal{{ $data['id'] }}"></i>
                                                </a>
                                                <div class="modal fade" id="Dropdown-hapusmodal{{ $data['id'] }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ url('dropdown/delete/' . encrypt($data->id)) }}"
                                                                method="GET" enctype="multipart/form-data">
                                                                <div class="modal-body text-center font-18">
                                                                    <h4 class="padding-top-30 mb-30 weight-500">
                                                                        Anda Yakin Ingin Menghapus Data ini?
                                                                    </h4>
                                                                    <div class="padding-bottom-30 row"
                                                                        style="max-width: 170px; margin: 0 auto">
                                                                        <div class="col-6">
                                                                            <button type="button"
                                                                                class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                                                                data-dismiss="modal">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                            Tidak
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button type="submit"
                                                                                class="btn btn-danger border-radius-100 btn-block confirmation-btn">
                                                                                <i class="fa fa-check"></i>
                                                                            </button>
                                                                            Ya
                                                                        </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                </div>
            </div>
            {{-- end modal delete --}}
            </td>
            </tr>
            <!-- Modal Edit Dropdown -->
            <div class="modal fade bs-example-modal-lg" data-backdrop="static"
                id="Dropdown-editmodal{{ $data['id'] }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                Form Edit Data Dropdown
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <ul>
                                        <li><strong>Submit Data Gagal !</strong></li>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('dropdown/update/' . encrypt($data->id)) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" type="text" name="kategori"
                                            value="{{ $data->kategori }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nilai</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" type="text" name="nilai"
                                            value="{{ $data->nilai }}" />
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Ubah
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Modal Edit Dropdown -->
            @endforeach

            </tbody>
            </table>
        </div>
    </div>
    <!-- Checkbox select Datatable End -->
    @include('layouts._includes._footersection')
    </div>
    </div>
@endsection
